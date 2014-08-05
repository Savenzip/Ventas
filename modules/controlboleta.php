define ( "BOLETA_INS_BOLETA", "INSERT INTO Boletas (codigo,monto,id_caja,estado) VALUES (?,?,?,?)" );
define( "BOLETA_SEL_IDCAJA,"SELECT id_caja from caja where sucursal_caja=? and fecha_caja=?"); 
define ("BOLETA_DEL_BOLETA", "DELETE from Boletas where codigo=?");
define ("BOLETA_UPD_BOLETA","UPDATE Boletas set monto=?,estado=? where codigo=?");
<?php
class boleta {
	private $MySQL;
	function boleta() {
		$this->MySQL = new MySQL ();
		$this->MySQL->Init ();
	}
	function insert($_codigo, $_idcaja, $_monto, $_estado) {
		if ($stmt = $this->MySQL->PrepareQuery ( BOLETA_INS_BOLETA )) {
			$stmt->bind_param ( "iiii", $_codigo, $_idcaja, $_monto, $_estado );
			$stmt->execute ();
			$stmt->close ();
		} else {
			print "Error al ingresar Boleta\n";
		}
	}
	function getIDCAJA($session, $fecha) {
		if ($stmt = $this->MySQL->PrepareQuery ( BOLETA_SEL_IDCAJA )) {
			$stmt->bind_param ( "ii", $session ["sucursal"], $fecha );
			$list = '';
			$stmt->execute ();
			$stmt->bind_result ( $id_caja );
			$stmt->fetch ();
			
			$stmt->close ();
			return $id_caja;
		} else {
			return "Error";
		}
	}
	//
	function delBoleta($codigo) {
		if ($stmt = $this->MySQL->PrepareQuery ( BOLETA_DEL_BOLETA )) {
			$stmt->bind_param ( "i", $codigo );
			$stmt->execute ();
			$stmt->close ();
		} else {
			print "No hay nada que Eliminar\n";
		}
	}
	function insert($_codigo, $_monto, $_estado) {
		if ($stmt = $this->MySQL->PrepareQuery ( BOLETA_UPD_BOLETA )) {
			$stmt->bind_param ( "iii", $_codigo, $_monto, $_estado );
			$stmt->execute ();
			$stmt->close ();
		} else {
			print "Error al Editar Boleta\n";
		}
	}
}