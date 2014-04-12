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
	<?php echo validation_errors(); ?>
	<h1>Login</h1>
	<?php echo form_open('auth'); ?>
	Gebruikersnaam: <?php echo form_input('username'); ?> <br />
	Wachtwoord: <?php echo form_password('password'); ?> <br />
	<?php echo form_submit('login', 'Log in!');
	echo form_close(); ?>
	Nog geen account? <a href='<?php echo base_url() . "reg" ?>'>Registreer!</a>
	</div>
	</div>
</body>
</html>