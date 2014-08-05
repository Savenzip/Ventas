<?php
class Caja {
	private $MySQL;
	function Caja() {
		$this->MySQL = new MySQL ();
		$this->MySQL->Init ();
	}
	function insert($_login, $_vendedor, $_cod, $_peso, $_voucher) {
		if ($stmt = $this->MySQL->PrepareQuery ( CAJA_INS_PRODUCT )) {
			$stmt->bind_param ( "iiidi", $_login, $_vendedor, $_cod, $_peso, $_voucher );
			$stmt->execute ();
			$stmt->close ();
		} else {
			print "Error al ingresar el Producto\n";
		}
	}
	function finish($session) {
		// falta agregar todo el procedimiento para preparar el pago de la venta
		if ($stmt = $this->MySQL->PrepareQuery ( CAJA_DEL_PRODUCTS )) {
			$stmt->bind_param ( "i", $session );
			$stmt->execute ();
			$stmt->close ();
		} else {
			print "No hay productos para vender\n";
		}
	}
	function anular($session) {
		if ($stmt = $this->MySQL->PrepareQuery ( CAJA_DEL_PRODUCTS )) {
			$stmt->bind_param ( "i", $session );
			$stmt->execute ();
			$stmt->close ();
		} else {
			print "No hay nada que Anular\n";
		}
	}
	function getList($session) {
		$c_prod = 0;
		$monto = 0;
		if ($stmt = $this->MySQL->PrepareQuery ( CAJA_GET_PRODUCT )) {
			$stmt->bind_param ( "i", $session );
			$list = '';
			$stmt->execute ();
			$stmt->bind_result ( $id, $c_prod, $peso, $nombre_carne, $precio );
			while ( $stmt->fetch () ) {
				$monto += round ( $peso * $precio );
				$list .= "<tr><td>$c_prod</td><td>$nombre_carne</td><td>$peso</td><td>$precio</td><td>" . round ( $peso * $precio ) . "</td><td>
					<form action=\"#\" method=\"POST\" id=\"form$id\" name=\"form$id\">
					<input type=\"hidden\" value = \"$id\" name=\"item\" id = \"item\" /></form><button  onclick=\"document.getElementById('form$id').submit();\" id=\"Delete\" name=\"Delete\" class=\"delete\"/>
					</td></tr>";
			}
			$list .= "<tr><td colspan=3></td><td>Total:</td><td>$monto</td><td>";
			$stmt->close ();
			return $list;
		} else {
			return "Error";
		}
	}
	function delItem($item) {
		if ($stmt = $this->MySQL->PrepareQuery ( CAJA_DEL_ITEM )) {
			$stmt->bind_param ( "i", $item );
			$stmt->execute ();
			$stmt->close ();
		} else {
			print "No hay nada que Eliminar\n";
		}
	}
}
class Registro {
	private $MySQL;
	function Registro() {
		$this->MySQL = new MySQL ();
		$this->MySQL->Init ();
	}
	function ObtieneSucursales() {
		if ($stmt = $this->MySQL->PrepareQuery ( REGISTRO_SEL_SUCURSAL )) {
			$stmt->execute ();
			$stmt->bind_result ( $id_sucursal, $nombre_sucursal );
			$array = array ();
			while ( $stmt->fetch () ) {
				$array [] = array (
						$id_sucursal,
						$nombre_sucursal 
				);
			}
			$stmt->close ();
		} else {
			$array [] = array (
					'-1',
					'SIN ASIGNAR' 
			);
		}
		return $array;
	}
	function ObtieneRoles() {
		$sel = "";
		if ($stmt = $this->MySQL->PrepareQuery ( REGISTRO_SEL_ROLUSER )) {
			$stmt->execute ();
			$stmt->bind_result ( $rol, $nivel );
			while ( $stmt->fetch () ) {
				$sel .= "<option value=\"$nivel\">$rol</option>";
			}
			$stmt->close ();
		}
		return $sel;
	}
	function RegistraEmpleado($rut, $sucursal, $nivel, $nombre, $apellido, $user, $pass) {
		$str = sha1 ( $user . ":" . $pass );
		if ($stmt = $this->MySQL->PrepareQuery ( REGISTRO_INS_EMPLEADO )) {
			$stmt->bind_param ( "iiissss", $rut, $sucursal, $nivel, $nombre, $apellido, $user, $str );
			if ($stmt->execute ()) {
				$stmt->close ();
				return TRUE;
			} else {
				$stmt->close ();
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
}
class Login {
	private $MySQL;
	function Login() {
		$this->MySQL = new MySQL ();
		$this->MySQL->Init ();
	}
	function ExisteEmpleado($user) {
		if ($stmt = $this->MySQL->PrepareQuery ( LOGIN_SEL_EMPLEADO )) {
			$stmt->bind_param ( "s", $user );
			$stmt->execute ();
			if ($stmt->fetch ()) {
				$stmt->close ();
				return TRUE;
			} else {
				$stmt->close ();
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
	function getAccess($user) {
		if ($stmt = $this->MySQL->PrepareQuery ( LOGIN_SEL_LEVELACC )) {
			$stmt->bind_param ( "s", $user );
			$stmt->execute ();
			$stmt->bind_result ( $levelacc );
			if ($stmt->fetch ()) {
				$stmt->close ();
				return $levelacc;
			} else {
				$stmt->close ();
				return 0;
			}
		} else {
			return 0;
		}
	}
	function ComprobarPassword($user, $pass) {
		$str = sha1 ( $user . ":" . $pass );
		if ($stmt = $this->MySQL->PrepareQuery ( LOGIN_SEL_EMPLEADOPWD )) {
			$stmt->bind_param ( "ss", $user, $str );
			$stmt->execute ();
			if ($stmt->fetch ()) {
				$stmt->close ();
				return TRUE;
			} else {
				$stmt->close ();
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
	function getUserAcc($user, $pass) {
		$str = sha1 ( $user . ":" . $pass );
		if ($stmt = $this->MySQL->PrepareQuery ( LOGIN_SEL_EMPLEADOPWD )) {
			$stmt->bind_param ( "ss", $user, $str );
			$stmt->execute ();
			$stmt->bind_result ( $nombre );
			$stmt->fetch ();
			$stmt->close ();
			return $nombre;
		} else {
			return FALSE;
		}
	}
	function CreaLogin($user) {
		if ($stmt = $this->MySQL->PrepareQuery ( LOGIN_SEL_LOGIN )) {
			$rand = rand ( 10000000, 99999999 );
			$stmt->bind_param ( "i", $rand );
			$stmt->execute ();
			while ( $stmt->fetch () ) {
				$rand = rand ( 10000000, 99999999 );
				$stmt->bind_param ( "i", $rand );
				$stmt->execute ();
			}
			if ($stmt2 = $this->MySQL->PrepareQuery ( LOGIN_SEL_EMPLEADO )) {
				$stmt2->bind_param ( "s", $user );
				$stmt2->execute ();
				$stmt2->bind_result ( $rut );
				if ($stmt2->fetch ()) {
					$this->MySQL->Init ();
					if ($stmt3 = $this->MySQL->PrepareQuery ( LOGIN_INS_LOGIN )) {
						$stmt3->bind_param ( "ii", $rand, $rut );
						if ($stmt3->execute ()) {
							$stmt3->close ();
							$stmt2->close ();
							$stmt->close ();
							return $rand;
						} else {
							$stmt3->close ();
							return "error1";
						}
					} else {
						return "error2" . $rand;
					}
				} else {
					$stmt2->close ();
					return "error3";
				}
			} else {
				$stmt->close ();
				return "error4";
			}
		} else {
			return "error5";
		}
	}
	
	/*
	 * 0->ErrorBD 1->NoExisteLogin 2->FinDeSesion 3->Cadena/Login OK
	 */
	function CompruebaCadena($cadenalogin) {
		if ($stmt = $this->MySQL->PrepareQuery ( LOGIN_SEL_LOGIN )) {
			$stmt->bind_param ( "i", $cadenalogin );
			$stmt->execute ();
			if ($stmt->fetch ()) {
				$stmt->close ();
				if ($stmt2 = $this->MySQL->PrepareQuery ( LOGIN_SEL_LOGINTIME )) {
					$stmt2->bind_param ( "i", $cadenalogin );
					$stmt2->execute ();
					if ($stmt2->fetch ()) {
						$stmt2->close ();
						if ($stmt4 = $this->MySQL->PrepareQuery ( LOGIN_UPD_LOGINTIME )) {
							$stmt4->bind_param ( "i", $cadenalogin );
							if ($stmt4->execute ()) {
								$stmt4->close ();
								return 3;
							} else {
								$stmt4->close ();
								return 0;
							}
						} else {
							return 0;
						}
					} else {
						$stmt2->close ();
						if ($stmt3 = $this->MySQL->PrepareQuery ( LOGIN_UPD_LOGINKILL )) {
							$stmt3->bind_param ( "i", $cadenalogin );
							if ($stmt3->execute ()) {
								$stmt3->close ();
								return 2;
							} else {
								$stmt3->close ();
								return 0;
							}
						} else {
							return 0;
						}
					}
				} else {
					return 0;
				}
			} else {
				$stmt->close ();
				return 1;
			}
		} else {
			return 0;
		}
	}
}
class MySQL {
	private $_webdb;
	private $_host;
	function Init() {
		$this->_webdb = new mysqli ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
	}
	function PrepareQuery($query) {
		return $this->_webdb->prepare ( $query );
	}
	function Kill() {
		$this->_webdb->close ();
	}
}
class Portal {
	private $MySQL;
	function Portal() {
		$this->MySQL = new MySQL ();
		$this->MySQL->Init ();
	}
	function sidebar($level) {
		$menu = "";
		if ($stmt = $this->MySQL->PrepareQuery ( PORTAL_SEL_MODULOS )) {
			$stmt->bind_param ( "i", $level );
			$stmt->execute ();
			$stmt->bind_result ( $nombre, $texto );
			while ( $stmt->fetch () ) {
				$menu .= "<a href=\"?modulo=$nombre\"><button id=\"menubutton\">$texto</button></a>";
			}
		}
		return $menu;
	}
}
class Grupos {
	function Grupos() {
		$this->MySQL = new MySQL ();
		$this->MySQL->Init ();
	}
	function ObtieneGrupo($id) {
		$nombre = "";
		if ($stmt = $this->MySQL->PrepareQuery ( GRUPO_SEL_GRUPO )) {
			$stmt->bind_param ( "s", $id );
			$stmt->execute ();
			$stmt->bind_result ( $nombre );
			$stmt->fetch ();
		}
		$stmt->close ();
		return $nombre;
	}
	function IngresaGrupo($id, $nombre) {
		$exito = false;
		if ($stmt = $this->MySQL->PrepareQuery ( GRUPO_INS_GRUPO )) {
			$stmt->bind_param ( "is", $id, $nombre );
			if ($stmt->execute ()) {
				$stmt->close ();
				$exito = true;
			}
		}
		return $exito;
	}
	function EliminaGrupo($id) {
		// 0 -> error; 1-> foreign key error ; 2-> OK eliminado
		$exito = 0;
		if ($stmt = $this->MySQL->PrepareQuery ( GRUPO_DEL_GRUPO )) {
			$stmt->bind_param ( "i", $id );
			if ($stmt->execute ()) {
				$stmt->close ();
				$exito = 2;
			} else {
				if (strpos ( $stmt->error, 'foreign key' ) !== FALSE) {
					$exito = 1;
				}
			}
		}
		return $exito;
	}
	function ModificaGrupo($id, $nombre) {
		$exito = false;
		if ($stmt = $this->MySQL->PrepareQuery ( GRUPO_UPD_GRUPO )) {
			$stmt->bind_param ( "si", $nombre, $id );
			if ($stmt->execute ()) {
				$stmt->close ();
				$exito = true;
			}
		}
		return $exito;
	}
}
class SubGrupos {
	function SubGrupos() {
		$this->MySQL = new MySQL ();
		$this->MySQL->Init ();
	}
	function ObtieneSubGrupo($id) {
		$nombre = "";
		if ($stmt = $this->MySQL->PrepareQuery ( SUBGRP_SEL_SUBGRP )) {
			$stmt->bind_param ( "s", $id );
			$stmt->execute ();
			$stmt->bind_result ( $nombre );
			$stmt->fetch ();
		}
		$stmt->close ();
		return $nombre;
	}
	function IngresaSubGrupo($id, $nombre) {
		$exito = false;
		if ($stmt = $this->MySQL->PrepareQuery ( SUBGRP_INS_SUBGRP )) {
			$stmt->bind_param ( "is", $id, $nombre );
			if ($stmt->execute ()) {
				$stmt->close ();
				$exito = true;
			}
		}
		return $exito;
	}
	function EliminaSubGrupo($id) {
		// 0 -> error; 1-> foreign key error ; 2-> OK eliminado
		$exito = 0;
		if ($stmt = $this->MySQL->PrepareQuery ( SUBGRP_DEL_SUBGRP )) {
			$stmt->bind_param ( "i", $id );
			if ($stmt->execute ()) {
				$stmt->close ();
				$exito = 2;
			} else {
				if (strpos ( $stmt->error, 'foreign key' ) !== FALSE) {
					$exito = 1;
				}
			}
		}
		return $exito;
	}
	function ModificaSubGrupo($id, $nombre) {
		$exito = false;
		if ($stmt = $this->MySQL->PrepareQuery ( SUBGRP_UPD_SUBGRP )) {
			$stmt->bind_param ( "si", $nombre, $id );
			if ($stmt->execute ()) {
				$stmt->close ();
				$exito = true;
			}
		}
		return $exito;
	}
}
class producto {
	private $MySQL;
	function producto() {
		$this->MySQL = new MySQL ();
		$this->MySQL->Init ();
	}
	function insert($_idProdcuto, $_nombreProducto, $_idCCarne, $_idCarne, $_unidadMedida) {
		if ($stmt = $this->MySQL->PrepareQuery ( PRODUCTO_INS_PRODUCTO )) {
			$stmt->bind_param ( "isiis", $_idProdcuto, $_nombreProducto, $_idCCarne, $_idCarne, $_unidadMedida );
			$stmt->execute ();
			$stmt->close ();
		} else {
			print "Error al ingresar Producto\n";
		}
	}
	function getIDPRODCUTO($idProducto) {
		if ($stmt = $this->MySQL->PrepareQuery ( PRODUCTO_SEL_PRODCUTO )) {
			$stmt->bind_param ( "i", $idProducto );
			$list = '';
			$stmt->execute ();
			$stmt->bind_result ( $nombreProducto, $idCCarne, $idCarne, $unidadMedida );
			$stmt->fetch ();
			$list [0] = $nombreProducto;
			$list [1] = $idCCarne;
			$list [2] = $idCarne;
			$list [3] = $unidadMedida;
			$stmt->close ();
			return $list;
		} else {
			return "Error No se encuentra el producto";
		}
	}
	//
	function delProductos($codigo) {
		if ($stmt = $this->MySQL->PrepareQuery ( PRODUCTO_DEL_PRODCUTO )) {
			$stmt->bind_param ( "i", $codigo );
			$stmt->execute ();
			$stmt->close ();
		} else {
			print "No hay nada que Eliminar\n";
		}
	}
	function update($_idProdcuto, $_nombreProducto, $_idCCarne, $_idCarne, $_unidadMedida) {
		if ($stmt = $this->MySQL->PrepareQuery ( PRODUCTO_UPD_PRODUCTO )) {
			$stmt->bind_param ( "iissi", $_idCarne, $_idCCarne, $_nombreProducto, $_unidadMedida, $_idProdcuto );
			$stmt->execute ();
			$stmt->close ();
		} else {
			print "Error al Editar Producto\n";
		}
	}
	function ObtieneListadoGrupos() {
		$list = "";
		if ($stmt = $this->MySQL->PrepareQuery ( PRODUCTO_SEL_GRUPO )) {
			$stmt->execute ();
			$stmt->bind_result ( $id, $nombre );
			while ( $stmt->fetch () ) {
				$list .= "<option value=\"$id\">$nombre</option>";
			}
			$stmt->close ();
		}
		return $list;
	}
	function ObtieneListadoSubGrupos() {
		$list = "";
		if ($stmt = $this->MySQL->PrepareQuery ( PRODUCTO_SEL_SUBGRUPO )) {
			$stmt->execute ();
			$stmt->bind_result ( $id, $nombre );
			while ( $stmt->fetch () ) {
				$list .= "<option value=\"$id\">$nombre</option>";
			}
			$stmt->close ();
		}
		return $list;
	}
}
?>