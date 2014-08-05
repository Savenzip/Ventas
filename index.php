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
<html>
<head>
<title>Carniceria</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link type="text/css" href="style.css" rel="stylesheet" />
</head>

<body>
	<div class="wrapper">
		<div class="header">
			<?php echo (date ( "D d-m-Y H:i:s", time () ));?>
		</div>
		<div class="leftBar">
			<?php print $Portal->sidebar($_SESSION["pw"]); ?>
			<a href="?modulo=salir">
				<button id="menubutton">Cerrar Sesion</button>
			</a>
		</div><?php include MODPATH . $modulo.".php";?>
	</div>
	<!--/div-->
	<div class="footer">
		<p>Copyright &#169; 2014</p>
	</div>
</body>
</html>