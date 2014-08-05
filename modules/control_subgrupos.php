<?php
$SubGrupo = new SubGrupos ();
$busqueda = false;
$nombreSubgrupo = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : "";
$idSubgrupo = isset ( $_POST ["id"] ) ? $_POST ["id"] : "";
if (isset ( $_POST ["buscar"] )) {
	$nombreSubgrupo = $SubGrupo->ObtieneSubGrupo ( $_POST ["id"] );
	if ($nombreSubgrupo != "") {
		$busqueda = true;
		$idSubgrupo = $_POST ["id"];
	} else {
		echo "<script language='javascript'>alert('No se retorno Id.');</script>";
	}
}

if (isset ( $_POST ["guardar"] )) {
	if (trim ( $_POST ["nombre"] ) != "") {
		$existe = $SubGrupo->ObtieneSubGrupo ( $_POST ["id"] );
		if ($existe == "") {
			$exito = $SubGrupo->IngresaSubGrupo ( $_POST ["id"], $_POST ["nombre"] );
			if ($exito) {
				$nombreSubgrupo = "";
				$idSubgrupo = "";
				echo "<script language='javascript'>alert('Sub-Grupo ingresado con exito.');</script>";
			} else {
				echo "<script language='javascript'>alert('Error al ingresar el sub-grupo.');</script>";
			}
		} else {
			echo "<script language='javascript'>alert('Id ya se encuentra en uso, favor edite o ingrese nuevo Id.');</script>";
		}
	} else {
		echo "<script language='javascript'>alert('Debe ingresar un nombre.');</script>";
	}
}

if (isset ( $_POST ["eliminar"] )) {
	$exito = $SubGrupo->EliminaSubGrupo ( $_POST ["id"] );
	if ($exito == 2) {
		echo "<script language='javascript'>alert('Sub-Grupo eliminado con exito.');</script>";
	} else {
		if ($exito == 1) {
			echo "<script language='javascript'>alert('Error: Sub-Grupo aun tiene asignado productos, favor elimine productos asignados y luego elimine.');</script>";
		} else {
			echo "<script language='javascript'>alert('Error al eliminar sub-grupo.');</script>";
		}
	}
	$nombreSubgrupo = "";
	$idSubgrupo = "";
}

if (isset ( $_POST ["editar"] )) {
	if (trim ( $_POST ["nombre"] ) != "") {
		$exito = $SubGrupo->ModificaSubGrupo ( $_POST ["id"], $_POST ["nombre"] );
		if ($exito) {
			echo "<script language='javascript'>alert('Sub-Grupo modificado con exito.');</script>";
		} else {
			echo "<script language='javascript'>alert('Error al modificar sub-grupo.');</script>";
		}
		$nombreGrupo = "";
		$idGrupo = "";
	} else {
		echo "<script language='javascript'>alert('Debe ingresar un nombre.');</script>";
	}
	$nombreSubgrupo = "";
	$idSubgrupo = "";
}
?>
<div class="rightBar"></div>
<div class="centerBar">
	<h1 align="center">Control Sub-Grupos</h1>
<form action="#" method="POST">
	<table>
			<tr>
				<td>ID</td>
			<?php
			if ($busqueda) {
				echo "<td><input type=\"text\" name=\"id\" value=\"$idSubgrupo\" size=\"10\" readonly /> <input
				type=\"submit\" value=\"Busar\" name=\"buscar\" disabled/></td> ";
			} else {
				echo "<td><input type=\"text\" name=\"id\" value=\"$idSubgrupo\" size=\"10\" required /> <input
				type=\"submit\" value=\"Busar\" name=\"buscar\" /></td>";
			}
			?>
		</tr>
			<tr>
				<td>Nombre:</td>
			<?php
			echo "<td><input type=\"text\" name=\"nombre\" value=\"$nombreSubgrupo\" /></td>";
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