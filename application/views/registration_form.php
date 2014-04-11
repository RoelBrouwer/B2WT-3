<!DOCTYPE html>
<html lang="en">
<?php $this->load->helper('form'); ?>
<head>
	<meta charset="utf-8">
	<title>DataDate - Registreren</title>
</head>
<body>
<div id="container">
	<?php echo validation_errors(); ?>
	<h1>Registratie</h1>
	<?php echo form_open('reg'); ?>
	Gebruikersnaam: <?php echo form_input(array('name' => 'username', 'maxlength' => '25', 'size' => '30', 'value' => set_value('username'))) ?> <i>Kies een gebruikersnaam tussen de 3 en 30 alfanumerieke karakters (a-z, 0-9).</i>  <br />
	Wachtwoord: <?php echo form_password(array('name' => 'password', 'maxlength' => '25', 'size' => '30')) ?> <i>Kies een wachtwoord tussen de 5 en 255 karakters.</i> <br />
	Herhaal wachtwoord: <?php echo form_password(array('name' => 'password_check', 'maxlength' => '25', 'size' => '30')) ?> <br />
	E-mail: <?php echo form_input(array('name' => 'email', 'maxlength' => '35', 'size' => '30', 'value' => set_value('email'))) ?> <br />
	Voornaam: <?php echo form_input(array('name' => 'first_name', 'maxlength' => '20', 'size' => '30', 'value' => set_value('first_name'))) ?> <br />
	Achternaam: <?php echo form_input(array('name' => 'last_name', 'maxlength' => '30', 'size' => '30', 'value' => set_value('last_name'))) ?> <br />
	Geboortedatum: <?php echo form_input(array('name' => 'birthdate', 'maxlength' => '10', 'size' => '12', 'value' => set_value('birthdate'))) ?> <br />
	Geslacht: <?php echo form_radio(array('name' => 'gender', 'value' => 'M', 'checked' => set_radio('gender', 'M'))) ?> Man <?php echo form_radio(array('name' => 'gender', 'value' => 'V', 'checked' => set_radio('gender', 'V'))) ?> Vrouw <br />
	Foto: <?php echo form_upload(array('name' => 'picture', 'maxlength' => '35', 'size' => '30')) ?> <i>Alleen afbeeldingsbestanden (*.jpg, *.png) zijn toegestaan.</i> <br /> 
	Beschrijving: <?php echo form_open_multipart('reg/do_upload');?> <?php echo form_textarea(array('name' => 'description', 'rows' => '7', 'cols' => '30', 'value' => set_value('description'))) ?> <i>Gebruik maximaal 500 karakters.</i><br />
	<strong>Ik ben op zoek naar</strong> <br />
	Geslacht: <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'M', 'checked' => set_radio('gender_pref', 'M'))) ?> Man <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'V', 'checked' => set_radio('gender_pref', 'V'))) ?> Vrouw <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'B', 'checked' => set_radio('gender_pref', 'B'))) ?> Beide <br />
	Minimumleeftijd: <?php echo form_input(array('name' => 'min_age', 'maxlength' => '3', 'size' => '5', 'value' => set_value('min_age'))) ?> Maximumleeftijd: <?php echo form_input(array('name' => 'max_age', 'maxlength' => '3', 'size' => '5', 'value' => set_value('max_age'))) ?> <br />
	<?php echo form_submit('reg', 'Submit'); 
	echo form_close(); ?>
</div>

</body>
</html>