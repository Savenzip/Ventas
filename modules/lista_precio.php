<html>
<?php
$listaprecio = new listaprecio ();
$id = null;
if (isset ( $_POST ["id_texto"] )) {
	if ($_POST ["id_texto"] != "") {
		$id = $_POST ["id_texto"];
	}
} else if (isset ( $_POST ["id_box"] )) {
	if ($_POST ["id_box"] != "")
		$id = $_POST ["id_box"];
}
if (isset ( $_POST ["buscar"] )) {
	$resultado = $listaprecio->getListaPrecio ( $id );
}
if (isset ( $_POST ["guardar"] ))
	$exito = $listaprecio->insert ( $id, $_POST ['precio'] );
if (isset ( $_POST ["editar"] ))
	$exito = $listaprecio->update ( $id, $_POST ["precio"], $_POST ["preciopast"] );
if (isset ( $_POST ["eliminar"] ))
	$exito = $listaprecio->delListPrecio ( $id );
?>
<div class="rightBar">
	<table>
		<tr>
			<th>Codigo</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Fecha Cambio</th>
			<th>Precio Anterior</th>
		</tr>
<?php print $Portal->ObtieneTablaPrecios();?>

	
	</table>
</div>
<div class="centerBar">
	<h1 align="center">Control Precios</h1>
	<form action="#" method="POST">
		<table>
			<tr>
				<td>ID Producto:</td>
				<td><input type="text" name="id_texto" id="id_texto"
					value="<?php print $id = isset ( $id ) ? $id : "";?>" size="10" />
					<select id="id_box" name="id_box"><option value="" selected>Seleccionar</option>
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
				<td><input type="text" name=""
					value="<?php print $preciopast = isset ( $resultado ["precioanterior"] ) ? $resultado ["precioanterior"] : "";?>"
					readonly /> <input type="hidden" name="preciopast"
					value="<?php print $precio = isset ( $resultado ["precio"] ) ? $resultado ["precio"] : "";?>" /></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="Guardar" name="guardar"
					id="guardar" /> <input type="submit" value="Editar" id="editar"
					name="editar" /> <input type="submit" value="Eliminar"
					id="eliminar" name="eliminar" /></td>
			</tr>
		</table>
	</form>
</div>