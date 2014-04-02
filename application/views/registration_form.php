<!DOCTYPE html>
<html lang="en">
<?php $this->load->helper('form'); ?>
<head>
	<meta charset="utf-8">
	<title>DataDate - Registreren</title>
</head>
<body>
<div id="container">
	<?php if (isset($debuginfo)) { echo $debuginfo; } ?>
	<h1>Registratie</h1>
	<?php echo form_open('reg/submit_form'); ?>
	Gebruikersnaam: <?php echo form_input(array('name' => 'username', 'maxlength' => '25', 'size' => '30')) ?> <br />
	Wachtwoord: <?php echo form_password(array('name' => 'password', 'maxlength' => '25', 'size' => '30')) ?> <br />
	Herhaal wachtwoord: <?php echo form_password(array('name' => 'password_check', 'maxlength' => '25', 'size' => '30')) ?> <br />
	E-mail: <?php echo form_input(array('name' => 'email', 'maxlength' => '35', 'size' => '30')) ?> <br />
	Voornaam: <?php echo form_input(array('name' => 'first_name', 'maxlength' => '20', 'size' => '30')) ?> <br />
	Achternaam: <?php echo form_input(array('name' => 'last_name', 'maxlength' => '30', 'size' => '30')) ?> <br />
	Geslacht: <?php echo form_radio(array('name' => 'gender', 'value' => 'M', 'checked' => 'checked')) ?> Man <?php echo form_radio(array('name' => 'gender', 'value' => 'V')) ?> Vrouw <br />
	Foto: <?php echo form_upload(array('name' => 'picture', 'maxlength' => '35', 'size' => '30')) ?> <br />
	Beschrijving: <?php echo form_textarea(array('name' => 'description', 'rows' => '7', 'cols' => '30')) ?> <br />
	<strong>Ik ben op zoek naar</strong> <br />
	Geslacht: <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'M', 'checked' => 'checked')) ?> Man <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'V')) ?> Vrouw <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'B')) ?> Beide <br />
	Minimumleeftijd: <?php echo form_input(array('name' => 'min_age', 'maxlength' => '3', 'size' => '5')) ?> Maximumleeftijd: <?php echo form_input(array('name' => 'max_age', 'maxlength' => '3', 'size' => '5')) ?> <br />
	<?php echo form_submit('reg', 'Submit'); 
	echo form_close(); ?>
</div>

</body>
</html>