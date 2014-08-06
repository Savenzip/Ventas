<?php
$Grupos = new Grupos ();
$busqueda = false;
$nombreGrupo = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : "";
$idGrupo = isset ( $_POST ["id"] ) ? $_POST ["id"] : "";
if (isset ( $_POST ["buscar"] )) {
	$nombreGrupo = $Grupos->ObtieneGrupo ( $_POST ["id"] );
	if ($nombreGrupo != "") {
		$busqueda = true;
		$idGrupo = $_POST ["id"];
	} else {
		echo "<script language='javascript'>alert('No se retorno Id.');</script>";
	}
}

if (isset ( $_POST ["guardar"] )) {
	if (trim ( $_POST ["nombre"] ) != "") {
		$existe = $Grupos->ObtieneGrupo ( $_POST ["id"] );
		if ($existe == "") {
			$exito = $Grupos->IngresaGrupo ( $_POST ["id"], $_POST ["nombre"] );
			if ($exito) {
				$nombreGrupo = "";
				$idGrupo = "";
				echo "<script language='javascript'>alert('Grupo ingresado con exito.');</script>";
			} else {
				echo "<script language='javascript'>alert('Error al ingresar el grupo.');</script>";
			}
		} else {
			echo "<script language='javascript'>alert('Id ya se encuentra en uso, favor edite o ingrese nuevo Id.');</script>";
		}
	} else {
		echo "<script language='javascript'>alert('Debe ingresar un nombre.');</script>";
	}
}

if (isset ( $_POST ["eliminar"] )) {
	$exito = $Grupos->EliminaGrupo ( $_POST ["id"] );
	if ($exito == 2) {
		echo "<script language='javascript'>alert('Grupo eliminado con exito.');</script>";
	} else {
		if ($exito == 1) {
			echo "<script language='javascript'>alert('Error: Grupo aun tiene asignado productos, favor elimine productos asignados y luego elimine.');</script>";
		} else {
			echo "<script language='javascript'>alert('Error al eliminar grupo.');</script>";
		}
	}
	$nombreGrupo = "";
	$idGrupo = "";
}

if (isset ( $_POST ["editar"] )) {
	if (trim ( $_POST ["nombre"] ) != "") {
		$exito = $Grupos->ModificaGrupo ( $_POST ["id"], $_POST ["nombre"] );
		if ($exito) {
			echo "<script language='javascript'>alert('Grupo modificado con exito.');</script>";
		} else {
			echo "<script language='javascript'>alert('Error al modificar grupo.');</script>";
		}
		$nombreGrupo = "";
		$idGrupo = "";
	} else {
		echo "<script language='javascript'>alert('Debe ingresar un nombre.');</script>";
	}
}
?>
<div class="rightBar">
	<table>
		<tr>
			<th>Codigo</th>
			<th>Nombre</th>
		</tr>
<?php print $Portal->ObtieneTablaGrupos();?>

	
	</table>
</div>
<div class="centerBar">
	<h1 align="center">Control Grupos</h1>
	<form action="#" method="POST">
		<table>
			<tr>
				<td>ID</td>
			<?php
			if ($busqueda) {
				echo "<td><input type=\"text\" name=\"id\" value=\"$idGrupo\" size=\"10\" readonly /> <input
				type=\"submit\" value=\"Buscar\" name=\"buscar\" disabled /></td>";
			} else {
				echo "<td><input type=\"text\" name=\"id\" value=\"$idGrupo\" size=\"10\"/ required> <input
				type=\"submit\" value=\"Buscar\" name=\"buscar\" /></td>";
			}
			?>
		</tr>
			<tr>
				<td>Nombre:</td>
			<?php
			echo "<td><input type=\"text\" name=\"nombre\" value=\"$nombreGrupo\" /></td>";
			?>
		</tr>
			<tr>
			<?php
			if ($busqueda) {
				echo "<td colspan=\"2\"><input type=\"submit\" value=\"Guardar\" name=\"guardar\" disabled/>
				<input type=\"submit\" value=\"Eliminar\" name=\"eliminar\" /> <input
				type=\"submit\" value=\"Editar\" name=\"editar\" /></td>";
			} else {
				echo "<td colspan=\"2\"><input type=\"submit\" value=\"Guardar\" name=\"guardar\" />
				<input type=\"submit\" value=\"Eliminar\" name=\"eliminar\" disabled/> <input
				type=\"submit\" value=\"Editar\" name=\"editar\" disabled/></td>";
			}
			?>
		</tr>
		</table>
	</form>
</div>