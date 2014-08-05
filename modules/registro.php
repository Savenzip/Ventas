<?php
$Registro = new Registro ();
if (isset ( $_POST ["Registrar"] )) {
	$exito = $Registro->RegistraEmpleado ( $_POST ["rut"], $_POST ["sucursal"], $_POST ["nivelacceso"], $_POST ["nombre"], $_POST ["apellido"], $_POST ["usuario"], $_POST ["password"] );
	if ($exito) {
		echo '<script type="text/javascript"> alert("Empleado ingresado con exito!");</script>';
	} else {
		echo '<script type="text/javascript"> alert("Error al ingresar el empleado!");</script>';
	}
}

?>
<div class="rightBar"></div>
<div class="centerBar">
<form action="#" method="post" name="input">
	<table>
		<tr>
			<td>Rut:</td>
			<td><input type="text" id="rut" name="rut" required></td>
		</tr>
		<tr>
			<td>Nombre:</td>
			<td><input type="text" id="nombre" name="nombre" required></td>
		</tr>
		<tr>
			<td>Apellido:</td>
			<td><input type="text" id="apellido" name="apellido" required></td>
		</tr>
		<tr>
			<td>Sucursal:</td>
			<td><select name="sucursal">
<?php
$array = array ();
$array = $Registro->ObtieneSucursales ();
$count = count ( $array );
for($i = 0; $i < $count; $i ++) {
	echo "<option value=\"" . $array [$i] [0] . "\">" . $array [$i] [1] . "</option>";
}
?>
</select></td>
		</tr>
		<tr>
			<td>Usuario:</td>
			<td><input type="text" id="usuario" name="usuario" required></td>
		</tr>
		<tr>
			<td>Contrase&ntildea:</td>
			<td><input type="password" id="password" name="password" required></td>
		</tr>
		<tr>
			<td>Nivel de Acceso:</td>
			<td><select name="nivelacceso">
<?php print $Registro->ObtieneRoles();?>
</select></td>
		</tr>
		<tr>
			<td><input type="submit" id="Registrar" name="Registrar"
				value="Registrar"></td>
			<td></td>
		</tr>
	</table>
</form>
</div>