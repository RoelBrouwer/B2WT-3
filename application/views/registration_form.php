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
	<h1>De vragen</h1>
	<?php echo form_open('reg/submit_form'); ?>
	Gebruikersnaam: <?php echo form_input(array('name' => 'username', 'maxlength' => '25', 'size' => '30')) ?>
	<?php echo form_submit('test', 'Submit'); 
	echo form_close(); ?>
</div>

</body>
</html>