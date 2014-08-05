<html>
<?php
$listaprecio = new listaprecio ();
if (isset ( $_POST ["guardar"] ))
	$exito = $listaprecio->insert ( $_POST ['id'], $_POST ['precio'], $_POST ['preciopast'] );
if (isset ( $_POST ["editar"] ))
	$exito = $listaprecio->update ( $_POST ["id"], $_POST ["precio"], $_POST ["preciopast"] );
if (isset ( $_POST ["buscar"] ))
	$resultado = $listaprecio->getListaPrecio ( $_POST ["id"] );
if (isset ( $_POST ["eliminar"] ))
	$exito = $listaprecio->delListPrecio ( $_POST ["id"] );
?>
<div class="rightBar"></div>
<div class="centerBar">
	<h1 align="center">Control Precios</h1>
	<form action="#" method="POST">
		<table>
			<tr>
				<td>ID Producto:</td>
				<td><input type="text" name="id"
					value="<?php print $id = isset ( $_POST ["id"] ) ? $_POST ["id"] : "";?>"
					size="10" /> <select id="id" name="id"><option value="" selected >Seleccionar</option>
<?php

print $listaprecio->ObtieneListadoProductos ();

?>
				</select> <input type="submit" value="Buscar" id="buscar"
					name="buscar" /></td>
			</tr>
			<tr>
				<td>Precio:</td>
				<td><input type="text" name="precio"
					value="<?php print $precio = isset ( $resultado ["precio"] ) ? $resultado ["precio"] : "";?>" /></td>
			</tr>
			<tr>
				<td>Fecha Ultimo Cambio Precio:</td>
				<td><input type="text" name="fecha"
					value="<?php print $fecha = isset ( $resultado ["fechacambioprecio"] ) ? $resultado ["fechacambioprecio"] : "";?>"
					readonly /></td>
			</tr>
			<tr>
				<td>Precio Anterior</td>
				<td><input type="text" name="preciopast"
					value="<?php print $preciopast = isset ( $resultado ["precioanterior"] ) ? $resultado ["precioanterior"] : "";?>"
					readonly /></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="Guardar" id="guardar" />
					<input type="submit" value="Editar" id="editar" /> <input
					type="submit" value="Eliminar" id="eliminar" /></td>
			</tr>
		</table>
	</form>
</div>