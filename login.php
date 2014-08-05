<?php
session_start ();
require_once 'load.php';
$existe = null;
$pass = null;
$error = null;
$strError = null;
$Login = new Login ();
if (isset ( $_POST ["Entrar"] )) {
	if (! $Login->ExisteEmpleado ( $_POST ["usuario"] )) {
		$existe = false;
	} else {
		if (! $Login->ComprobarPassword ( $_POST ["usuario"], $_POST ["pass"] )) {
			$pass = false;
		} else {
			$resultado = $Login->CreaLogin ( $_POST ["usuario"] );
			if (strpos ( $resultado, 'error' ) !== FALSE) { // $resultado != "error"){
				$error = false;
				$strError = $resultado;
			} else {
				$_SESSION ["pw"] = $Login->getAccess ( $Login->getUserAcc ( $_POST ["usuario"], $_POST ["pass"] ) );
				$_SESSION ["cadena"] = $resultado;
				$_SESSION ["usuario"] = $_POST ["usuario"];
				header ( 'Location: index.php' );
				die ();
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Ingreso Sistema</title>
<style>
fieldset {
	width: 180px;
	border-radius: 10px;
	-webkit-box-shadow: 0 8px 6px -6px black;
	-moz-box-shadow: 0 8px 6px -6px black;
	box-shadow: 0 8px 6px -6px black;
	background: #ebf1f6;
	background: -moz-linear-gradient(top, #ebf1f6 0%, #abd3ee 50%, #89c3eb 51%, #d5ebfb
		100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ebf1f6),
		color-stop(50%, #abd3ee), color-stop(51%, #89c3eb),
		color-stop(100%, #d5ebfb));
	background: -webkit-linear-gradient(top, #ebf1f6 0%, #abd3ee 50%, #89c3eb 51%,
		#d5ebfb 100%);
	background: -o-linear-gradient(top, #ebf1f6 0%, #abd3ee 50%, #89c3eb 51%, #d5ebfb
		100%);
	background: -ms-linear-gradient(top, #ebf1f6 0%, #abd3ee 50%, #89c3eb 51%, #d5ebfb
		100%);
	background: linear-gradient(to bottom, #ebf1f6 0%, #abd3ee 50%, #89c3eb 51%, #d5ebfb
		100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ebf1f6',
		endColorstr='#d5ebfb', GradientType=0);
}

div.form {
	height: 180px;
	width: 180px;
	position: absolute;
	left: 50%;
	top: 50%;
	margin: -90px 0 0 -90px;
}
</style>
</head>
<body style="background-color: #ebf1f6;">
	<div class="form">
		<form name="loginForm" action="#" method="post">
			<fieldset>
				<legend>Ingreso</legend>
				<table>
					<tr>
						<td>Usuario</td>
						<td><input type="text" name="usuario" id="usuario" size="10"
							tabindex="1" required autofocus></td>
					</tr>
					<tr>
						<td>Contrase&ntildea</td>
						<td><input type="password" name="pass" id="pass" required
							size="10" tabindex="2"></td>
					</tr>
			<?php
			if (isset ( $existe ))
				echo "<tr><td colspan=\"2\">Usuario no existe.</td></tr>";
			if (isset ( $pass ))
				echo "<tr><td colspan=\"2\">Contrase�a incorrecta.</td></tr>";
			if (isset ( $error ))
				echo "<tr><td colspan=\"2\">Error de conexion. " . $strError . "</td></tr>";
			?>
			<tr>
						<td colspan="2" align="center"><input type="submit" name="Entrar"
							value="Entrar" tabindex="3"></td>
					</tr>
				</table>
			</fieldset>
		</form>
	</div>
</body>
</html>