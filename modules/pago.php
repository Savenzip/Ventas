<?php
if (isset ( $_POST ["total"] )) {
	// header( 'Location: caja,.php' ) ;
	$total = $_POST ["total"];
} else
	$total = 560; // solo para prueba despues esto se elimina.
include 'config/includes.php';
$user = 168114737;
$Caja = new Caja ();
echo (date ( "D d-m-Y H:i:s", time () ));

?>
<script type="text/javascript">
function calculaVuelto() {
	var form = document.getElementById("frm1");
	form.Vuelto.value = form.Efectivo.value-form.total.value;
	if(form.Vuelto.value > 0){
		form.pagar.disabled = false;
form.Vuelto.style.border.color = 'black';
		
	}
else { form.pagar.disabled = true;
form.Vuelto.style.border.color = 'red';}
}
</script>

<fieldset>
	<legend>Pago</legend>
	<form action="#" id="frm1" method="post" autocomplete="off">
		<table>
			<tr>
				<td>Total:</td>
				<td><input type="text" name="total" id="total" readonly
					value="<?php print $total; ?>" required /></td>
			</tr>
			<tr>
				<td>Efectivo:</td>
				<td><input type="text" pattern="^[0-9]{1,10}" placeholder="Efectivo"
					onkeydown="calculaVuelto();" onkeyup="calculaVuelto();"
					title="Debe Ingresar el Efectivo" name="Efectivo" id="Efectivo"
					required autofocus /></td>
			</tr>
			<tr>
				<td>Vuelto:</td>
				<td><input type="text" onload="calculaVuelto();" name="Vuelto"
					id="Vuelto" readonly /></td>
			</tr>
			<tr>
				<td colspan=2><input type="submit" disabled id="pagar" name="pagar"
					value="Pagar" /></td>
			</tr>
		</table>
	</form>
</fieldset>