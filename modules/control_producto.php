<?php
$producto = new producto ();
if (isset ( $_POST ["guardar"] ))
	$exito = $producto->insert ( $_POST ["id"], $_POST ["nombre"], $_POST ["subgrupo"], $_POST ["grupo"], $_POST ["unidad"] );
if (isset ( $_POST ["editar"] ))
	$exito = $producto->update ( $_POST ["id"], $_POST ["nombre"], $_POST ["subgrupo"], $_POST ["grupo"], $_POST ["unidad"] );
if (isset ( $_POST ["buscar"] ))
	$resultado = $producto->getIDPRODCUTO ( $_POST ["id"] );
if (isset ( $_POST ["eliminar"] ))
	$exito = $producto->delProductos ( $_POST ["id"] );
?>
<div class="rightBar"></div>
<div class="centerBar">
<h1 align="center">Control Productos</h1>
<form action="#" method="POST">
	<table>
		<tr>
			<td>ID Producto:</td>
			<td><input type="text" name="id"
				value="<?php print $idGrupo = isset ( $_POST ["id"] ) ? $_POST ["id"] : "";?>"
				size="10" /> <input type="submit" value="Buscar" id="buscar"
				name="buscar" /></td>
		</tr>
		<tr>
			<td>Nombre Producto:</td>
			<td><input type="text" name="nombre"
				value="<?php print $idGrupo = isset ( $resultado["nombre"] ) ? $resultado["nombre"] : "";?>" />
		
		</tr>
		<tr>
			<td>Grupo:</td>
			<td><select id="grupo" name="grupo">
<?php

print $producto->ObtieneListadoGrupos ( $resultado ["idcarne"] );

?>
				</select></td>
		</tr>
		<tr>
			<td>Sub-Grupo:</td>
			<td><select id="grupo" name="subgrupo">
<?php

print $producto->ObtieneListadoSubGrupos ( $resultado ["idccarne"] );

?>
				</select></td>
		</tr>
		<tr>
			<td>Unidad:</td>
			<td><input type="text" name="unidad"
				value="<?php print $idGrupo = isset ( $resultado["unidad"] ) ? $resultado["unidad"] : "";?>" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Guardar" name="guardar" /><input
				type="submit" value="Editar" id="editar" name="editar" /> <input
				type="submit" value="Eliminar" id="eliminar" name="eliminar" /></td>
		</tr>
	</table>
</form>
</div>