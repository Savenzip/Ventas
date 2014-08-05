<div class="rightBar"></div>
<div class="centerBar">
<h1 align="center">Control Productos</h1>
<form method="POST" action="#">
	<table>
		<tr>
			<td>ID Producto:</td>
			<td><input type="text" name="id" value="" size="10" /> <input
				type="submit" value="Buscar" name="buscar" /></td>
		</tr>
		<tr>
			<td>Grupo:</td>
			<td><select name="grupo">
					<option>VACUNO</option>
					<option>CERDO</option>
			</select></td>
		</tr>
		<tr>
			<td>Sub-Grupo:</td>
			<td><select name="subgrupo">
					<option>COSTILLAR</option>
					<option>CHULETA</option>
			</select></td>
		</tr>
		<tr>
			<td>Unidad:</td>
			<td><input type="text" name="unidad" value="" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Guardar" name="guardar" /><input
				type="submit" value="Editar" name="editar" /> <input type="submit"
				value="Eliminar" name="eliminar" /></td>
		</tr>
	</table>
</form>
</div>