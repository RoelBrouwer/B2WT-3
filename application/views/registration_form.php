<?php $this->load->helper('html'); $this->load->helper('url'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>DataDate - Registreren</title>
	<?php 
		echo link_tag('assets/css/reset.css');
		echo link_tag('assets/css/style.css');
		echo link_tag('http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600');
	?>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script src="<?php echo base_url(). 'assets/js/jquery-ui-1.10.4.custom.js'?>"></script>
	<script>
		$(function() {
			$( "#tabs" ).tabs();
		});
	</script>
</head>

<body>
<header>
	<div id="siteheader">
	<nav class='navbar'>
		<section id="logo">
			<a href="<?php echo base_url();?>">DataDate</a>
		</section>
		<ul>
			<li><a href="<?php echo base_url();?>">Home</a></li>
			<li><a href="<?php echo base_url();?>">Over</a></li>
			<li><a href="<?php echo base_url();?>">Zoeken</a>
				<ul>
				<li>Geslacht</li>
				<li>Minimale leeftijd</li>
				<li>Maximale leeftijd</li>
				<li>Persoonlijkheid</li>
				<li>Merken</li>
				</ul>
			</li>
			<li><a href="<?php echo base_url();?>auth">Inloggen</a></li>
			<li><a href="<?php echo base_url();?>reg">Registreren</a></li>
		</ul>
	</nav>
	</div>
</header>

<div class="wrapper">
<div id="container">
	<div id="tabs">
	  <ul>
		<li><a href="#tabs-1">Stap 1: Gegevens</a></li>
		<li><a href="#tabs-2">Stap 2: Persoonlijkheidstest</a></li>
		<li><a href="#tabs-3">Stap 3: Merkvoorkeuren</a></li>
		<li><a href="#tabs-4">Stap 4: Versturen</a></li>
	  </ul>
	  <div id="tabs-1">
		<?php echo validation_errors();
		echo form_open('reg'); ?>
		<h2>Gegevens</h2>
		Gebruikersnaam: <?php echo form_input(array('name' => 'username', 'maxlength' => '25', 'size' => '30', 'value' => set_value('username'))) ?> <i>Kies een gebruikersnaam tussen de 3 en 30 alfanumerieke karakters (a-z, 0-9).</i>  <br />
		Wachtwoord: <?php echo form_password(array('name' => 'password', 'maxlength' => '25', 'size' => '30')) ?> <i>Kies een wachtwoord tussen de 5 en 255 karakters.</i> <br />
		Herhaal wachtwoord: <?php echo form_password(array('name' => 'password_check', 'maxlength' => '25', 'size' => '30')) ?> <br />
		E-mail: <?php echo form_input(array('name' => 'email', 'maxlength' => '35', 'size' => '30', 'value' => set_value('email'))) ?> <br />
		Voornaam: <?php echo form_input(array('name' => 'first_name', 'maxlength' => '20', 'size' => '30', 'value' => set_value('first_name'))) ?> <br />
		Achternaam: <?php echo form_input(array('name' => 'last_name', 'maxlength' => '30', 'size' => '30', 'value' => set_value('last_name'))) ?> <br />
		Geboortedatum: <?php echo form_input(array('name' => 'birthdate', 'maxlength' => '10', 'size' => '12', 'value' => set_value('birthdate'))) ?> <i>Voer in jjjj-mm-dd formaat in.</i><br />
		Geslacht: <?php echo form_radio(array('name' => 'gender', 'value' => 'M', 'checked' => set_radio('gender', 'M'))) ?> Man <?php echo form_radio(array('name' => 'gender', 'value' => 'V', 'checked' => set_radio('gender', 'V'))) ?> Vrouw <br />
		Foto: <?php echo form_open_multipart('reg/do_upload');?> <?php echo form_upload(array('name' => 'picture', 'maxlength' => '35', 'size' => '30')) ?> <i>Alleen afbeeldingsbestanden (*.jpg, *.png) zijn toegestaan.</i> <br /> 
		Beschrijving: <?php echo form_open_multipart('reg/do_upload');?> <?php echo form_textarea(array('name' => 'description', 'rows' => '7', 'cols' => '30', 'value' => set_value('description'))) ?> <i>Gebruik maximaal 500 karakters.</i><br />
		<strong>Ik ben op zoek naar</strong> <br />
		Geslacht: <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'M', 'checked' => set_radio('gender_pref', 'M'))) ?> Man <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'V', 'checked' => set_radio('gender_pref', 'V'))) ?> Vrouw <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'B', 'checked' => set_radio('gender_pref', 'B'))) ?> Beide <br />
		Minimumleeftijd: <?php echo form_input(array('name' => 'min_age', 'maxlength' => '3', 'size' => '5', 'value' => set_value('min_age'))) ?> Maximumleeftijd: <?php echo form_input(array('name' => 'max_age', 'maxlength' => '3', 'size' => '5', 'value' => set_value('max_age'))) ?> <br />
		<div id="continue"><a href="#container">Terug naar boven</a></div>
	  </div>
	  <div id="tabs-2">
	    <h2>Persoonlijkheidstest</h2>
		<?php foreach ($questions as $q):?>
			<h4><?php echo $q['question_text'];?></h4>
			<?php foreach ($q['answers'] as $answer):
				echo form_radio(array('name' => $q['question_tag'], 'value' => $answer['answer_tag'], 'checked' => set_radio($q['question_tag'], $answer['answer_tag'])));
				echo $answer['answer_text'];?><br />
			<?php endforeach;
		endforeach; ?>
		<div id="continue"><a href="#container">Terug naar boven</a></div>
	  </div>
	  <div id="tabs-3">
		<h2>Merkvoorkeuren:</h2>
		<i>Selecteer hieronder een merk als het u aanspreekt, laat het gedeselecteerd als het u niet aanspreekt.</i><br />
		<?php foreach ($brands as $b): 
			echo form_checkbox(array('name' => 'brandpref[]', 'value' => $b['brand_id'], 'checked' => set_checkbox('brandpref', $b['brand_id'])));
			echo $b['name'];
		endforeach; ?>
		<div id="continue"><a href="#container">Terug naar boven</a></div>
	  </div>
	  <div id="tabs-4">
		<?php echo form_submit('reg', 'Submit'); 
		echo form_close(); ?>
		<div id="continue"><a href="#container">Terug naar boven</a></div>
	  </div>
	</div>
</div>
</div>

</body>
</html>