<?php
$user = $_SESSION ["cadena"];
$Caja = new Caja ();
$voucher = $disabled = $focus1 = $value = $focus2 = "";
if (isset ( $_POST ["man"] )) {
	$focus1 = "";
	$focus2 = "autofocus";
	$disabled = "readonly";
	$value = $_POST ["man"];
	$voucher = $_POST ["voucher"];
} else {
	$focus1 = "autofocus";
	$focus2 = "";
}
if (isset ( $_POST ["agregar"] )) {
	$Caja->insert ( $user, $_POST ["man"], $_POST ["cod"], $_POST ["peso"], $_POST ["voucher"] );
}
if (isset ( $_POST ["Finalizar"] )) {
	$Caja->finish ( $user );
}
if (isset ( $_POST ["Anular"] )) {
	$Caja->anular ( $user );
}
if (isset ( $_POST ["Delete"] )) {
	$Caja->delItem ( $_POST ["item"] );
}
?>

<form action="#" method="post" autocomplete="off">
	<table>
		<tr>
			<td>Vendedor:</td>
			<td><input type="text" name="man" id="man"
				<?php print $disabled; print $focus1;?>
				value="<?php print $value;?>" required /></td>
		</tr>
		<tr>
			<td>Voucher:</td>
			<td><input title="Debe Ingresar numero de Voucher" type="text"
				value="<?php print $voucher;?>" name="voucher" id="voucher" required /></td>
		</tr>
		<tr>
			<td>Codigo:</td>
			<td><input title="Debe Ingresar el Codigo del Producto"
				pattern="^[0-9]{1,4}" type="text" name="cod" id="cod" required
				<?php print $focus2; ?> /></td>
		</tr>
		<tr>
			<td>Peso:</td>
			<td><input title="Debe Ingresar el Peso del Producto" type="text"
				name="peso" id="peso" required /></td>
		</tr>
		<tr>
			<td colspan=2><input type="submit" id="agregar" name="agregar"
				value="Agregar" /></td>
		</tr>
	</table>
</form>
<divn class="lista">
<fieldset>
	<legend>Carro</legend>
	<form action="#" method="post">
		<table>
			<tr>
				<th>Codigo</th>
				<th>Item</th>
				<th>Peso</th>
				<th>Valor</th>
				<th>Total</th>
				<th></th>
			</tr>
		<?php echo $Caja->getList($user);?>
			<tr>
				<td colspan=3><input type="submit" id="Anular" name="Anular"
					value="Anular" /></td>
				<td colspan=3><input type="submit" id="Finalizar" name="Finalizar"
					value="Finalizar" /></td>

			</tr>
		</table>
	</form>
</fieldset>
</div>