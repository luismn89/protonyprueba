<?php
/*
	Template Name: shipping
	Description: Temaplate for shipping options
*/
?>
<?php get_header(); ?>
<div id="content" class="site-content container col-xs-12">
	<div class="title-products">
		<p><span class="text-left">Ordering Data</span><span class="text-right">Enter shipping information</span></p>
	</div>
	<form id="shipping" class="shipping">
		<label class="col-xs-12">First Name: </label>
		<input id="first_name" type="text" name="first_name" class="col-xs-12 field-shipping" required>
		<label class="col-xs-12">Last Name: </label>
		<input id="last_name" type="text" name="last_name" class="col-xs-12 field-shipping" required>
		<label class="col-xs-12">Email: </label>
		<input id="email" type="email" name="email" class="col-xs-12 field-shipping" placeholder="example@example.com" required>
		<label class="col-xs-12">Phone: </label>
		<input id="cod_phone" type="text" name="cod_phone" class="col-xs-2 field-shipping" placeholder="+58" required>
		<input id="number_phone" type="text" name="number_phone" class="field-shipping col-xs-9" placeholder="2234345" required>
		<label class="col-xs-12">Postal: </label>
		<input id="cod_postal" type="text" name="cod_postal" class="field-shipping col-xs-12" required>
		<label class="col-xs-12">Shipping Country: </label>
		<select name="country" id="country" class="col-xs-12 select-shipping">
			<option value="--">Select Country</option>
			<option value="VE">Venezuela</option>
			<option value="CA">Canada</option>
		</select>
		<label class="col-xs-12">Shipping State: </label>
		<select name="state" id="state" class="col-xs-12 select-shipping">
			<option value="--">Select State</option>
			<option value="BO">Bolivar</option>
			<option value="AK">Alaska</option>
		</select>
		<label class="col-xs-12">Shipping Address: </label>
		<textarea name="address" id="address" class="field-shipping col-xs-12" cols="30" rows="3" required></textarea>
		<input id="btn-send-shipping" class="col-xs-12 col-sm-9 col-md-9" type="submit" value="Send">
	</form>
</div>
<?php get_footer(); ?>