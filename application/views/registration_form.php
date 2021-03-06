<?php $this->load->helper('html'); $this->load->helper('url'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>DataDate - Registreren</title>
	<?php 
		echo link_tag('assets/css/reset.css');
		echo link_tag('assets/css/style.css');
		echo link_tag('assets/css/jquery-ui-1.10.4.custom.css');
		echo link_tag('https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600');
	?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script src="<?php echo base_url(). 'assets/js/jquery-ui-1.10.4.custom.js'?>"></script>
	<script src="<?php echo base_url(). 'assets/js/validation.js'?>"></script>
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
			<li><a href="<?php echo base_url();?>search">Zoeken</a></li>
			<li><a href="<?php echo base_url();?>auth">Inloggen</a></li>
			<li><a href="<?php echo base_url();?>reg">Registreren</a></li>
		</ul>
	</nav>
	</div>
</header>

<div class="wrapper">
<div class="container">
	<div id="tabs">
	  <ul>
		<li><a href="#tabs-1">Stap 1: Gegevens</a></li>
		<li><a href="#tabs-2">Stap 2: Persoonlijkheidstest</a></li>
		<li><a href="#tabs-3">Stap 3: Merkvoorkeuren</a></li>
		<li><a href="#tabs-4">Stap 4: Versturen</a></li>
	  </ul>
	  <div id="tabs-1">
	  <div class="inputform">
		<?php if(validation_errors() != false) { 
		echo '<div class="error">'.validation_errors().'</div>';
	 	}
		echo form_open_multipart('reg'); ?>
		<h2>Gegevens</h2>
		<label> Gebruikersnaam: </label><?php echo form_input(array('name' => 'username', 'maxlength' => '25', 'size' => '30', 'value' => set_value('username'))) ?> <i>Kies een gebruikersnaam tussen de 3 en 30 alfanumerieke karakters (a-z, 0-9).</i>  <br />
		<label> Wachtwoord: </label><?php echo form_password(array('name' => 'password', 'maxlength' => '25', 'size' => '30')) ?> <i>Kies een wachtwoord tussen de 5 en 255 karakters.</i> <br />
		<label> Herhaal wachtwoord: </label> <?php echo form_password(array('name' => 'password_check', 'maxlength' => '25', 'size' => '30')) ?> <br />
		<label> E-mail: </label> <?php echo form_input(array('name' => 'email', 'maxlength' => '35', 'size' => '30', 'value' => set_value('email'))) ?> <br />
		<label> Voornaam: </label><?php echo form_input(array('name' => 'first_name', 'maxlength' => '20', 'size' => '30', 'value' => set_value('first_name'))) ?> <br />
		<label> Achternaam: </label><?php echo form_input(array('name' => 'last_name', 'maxlength' => '30', 'size' => '30', 'value' => set_value('last_name'))) ?> <br />
		<label> Geboortedatum: </label><?php echo form_input(array('name' => 'birthdate', 'maxlength' => '10', 'size' => '12', 'value' => set_value('birthdate'))) ?> <i>Voer in jjjj-mm-dd formaat in.</i><br />
		<label> Geslacht: </label> <?php echo form_radio(array('name' => 'gender', 'maxlength' => '500', 'value' => 'M', 'checked' => set_radio('gender', 'M'))) ?> Man <?php echo form_radio(array('name' => 'gender', 'value' => 'V', 'checked' => set_radio('gender', 'V'))) ?> Vrouw <br />
		<label> Beschrijving: </label><?php echo form_open_multipart('reg/do_upload');?> <?php echo form_textarea(array('name' => 'description', 'rows' => '7', 'cols' => '30', 'value' => set_value('description'))) ?> <i>Gebruik maximaal 500 karakters.</i><br /> <br /> 
		<p><i>Na bevestiging van uw registratie kunt u ook nog een profielfoto uploaden!</i></p>
		<h3>Ik ben op zoek naar</h3>
		<label> Geslacht: </label><?php echo form_radio(array('name' => 'gender_pref', 'value' => 'M', 'checked' => set_radio('gender_pref', 'M'))) ?> Man <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'V', 'checked' => set_radio('gender_pref', 'V'))) ?> Vrouw <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'B', 'checked' => set_radio('gender_pref', 'B'))) ?> Beide <br />
		<label> Minimumleeftijd: </label><?php echo form_input(array('name' => 'min_age', 'maxlength' => '3', 'size' => '5', 'value' => set_value('min_age'))) ?> Maximumleeftijd: <?php echo form_input(array('name' => 'max_age', 'maxlength' => '3', 'size' => '5', 'value' => set_value('max_age'))) ?> <br />
		<div class="continue"><a href="#tabs">Terug naar boven</a></div>
	  </div>
	  </div>
	  <div id="tabs-2">
	  <div class="inputform">
	    <h2>Persoonlijkheidstest</h2>
		<?php foreach ($questions as $q):?>
			<h4><?php echo $q['question_text'];?></h4>
			<?php foreach ($q['answers'] as $answer):
				echo form_radio(array('name' => $q['question_tag'], 'value' => $answer['answer_tag'], 'checked' => set_radio($q['question_tag'], $answer['answer_tag'])));
				echo $answer['answer_text'];?><br />
			<?php endforeach;
		endforeach; ?>
		<div class="continue"><a href="#tabs">Terug naar boven</a></div>
		</div>
	  </div>
	  <div id="tabs-3">
	  <div class="brands">
		<h2>Merkvoorkeuren:</h2>
		<i>Selecteer hieronder een merk als het u aanspreekt, laat het gedeselecteerd als het u niet aanspreekt.</i><br />
		<?php foreach ($brands as $b): 
			echo '<section>'.form_checkbox(array('name' => 'brandpref[]', 'value' => $b['brand_id'], 'checked' => set_checkbox('brandpref', $b['brand_id'])));
			echo '<label>'.$b['name'].'</label></section>';
		endforeach; ?>
		<div class="continue"><a href="#tabs">Terug naar boven</a></div>
	  </div>
	  </div>
	  <div id="tabs-4">
		<?php echo form_submit('reg', 'Submit'); 
		echo form_close(); ?>
	  </div>
	</div>
</div>
</div>