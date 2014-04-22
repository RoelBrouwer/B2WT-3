<?php $this->load->helper('html'); $this->load->helper('url'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>DataDate</title>
	<?php 
		echo link_tag('assets/css/reset.css');
		echo link_tag('assets/css/style.css');
		echo link_tag('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600');
	?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script src="<?php echo base_url(). 'assets/js/jquery-ui-1.10.4.custom.js'?>"></script>
	
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