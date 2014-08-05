<?php
session_start ();
require_once 'load.php';
$Login = new Login ();
if (! isset ( $_SESSION ["cadena"] )) {
	header ( "Location: login.php" );
	die ();
} else {
	$accion = $Login->CompruebaCadena ( $_SESSION ["cadena"] );
	switch ($accion) {
		case 0 :
			header ( "Location: login.php" );
			die ();
			break;
		case 1 :
			header ( "Location: login.php" );
			die ();
			break;
		case 2 :
			header ( "Location: login.php" );
			die ();
			break;
	}
}
$modulo = "main";
if (isset ( $_GET ["modulo"] )) {
	$modulo = $_GET ["modulo"];
}
$Portal = new Portal ();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">


<head>
<title>Carniceria</title>
</head>
<body>
	<div class="wrapper">

		<div class="header"><?php echo (date ( "D d-m-Y H:i:s", time () ));?></div>

		<div class="sidebar">
		<?php print $Portal->sidebar($_SESSION["pw"]); ?>
		<a href="?modulo=salir">
				<button id="menubutton">Cerrar Sesion</button>
			</a>

		</div>

		<div class="content">
			<?php include MODPATH . $modulo.".php";?>

		</div>
	</div>
	<div class="footer">
		<p>Copyright (c) 2014</p>
	</div>
</body>
</html>