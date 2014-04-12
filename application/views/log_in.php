<!DOCTYPE html>
<html lang="en">
<?php $this->load->helper('form', 'url'); ?>
<head>
	<meta charset="utf-8">
	<title>DataDate - Inloggen</title>
</head>
<body>
	<div class = "wrapper">
	<div class="container">
	
	<h2>Login</h2>
	<div class="error">
	<?php echo validation_errors(); ?>
	</div>
	<div id="login">
	<?php echo form_open('auth'); ?>
	<label>Gebruikersnaam: </label><?php echo form_input('username'); ?> <br />
	<label>Wachtwoord: </label><?php echo form_password('password'); ?> <br />
	<?php echo form_submit('login', 'Log in!');
	echo form_close(); ?>
	Nog geen account? <a href='<?php echo base_url() . "reg" ?>'>Registreer!</a>
	</div>
	</div>
	</div>
</body>
</html>