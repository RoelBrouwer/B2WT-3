<?php $this->load->helper('html'); $this->load->helper('url'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>DataDate - Zoeken</title>
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
	<div class = "wrapper">
	<div class="container">
		<?php echo validation_errors(); ?>
		<h1>Search</h1>
		<?php echo form_open('search'); ?>
		Geslacht: <?php echo form_input('username'); ?> <br />
		Minimale leeftijd: <?php echo form_password('password'); ?> <br />
		Maximale leeftijd
		Persoonlijkheid
		Merken
		<?php echo form_submit('login', 'Log in!');
		echo form_close(); ?>
		Nog geen account? <a href='<?php echo base_url() . "reg" ?>'>Registreer!</a>
	</div>
	</div>
</body>
</html>