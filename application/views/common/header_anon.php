<?php $this->load->helper('html'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>DataDate</title>
	<?php 
		echo link_tag('assets/css/reset.css');
		echo link_tag('assets/css/style.css');
		echo link_tag('http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600');
	?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
</head>

<body>
<header>
	<div id="siteheader">
	<nav class='navbar'>
		<section id="logo">
			<a href="#">DataDate</a>
		</section>
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Over</a></li>
			<li><a href="#">Zoeken</a>
				<ul>
				<li>Geslacht</li>
				<li>Minimale leeftijd</li>
				<li>Maximale leeftijd</li>
				<li>Persoonlijkheid</li>
				<li>Merken</li>
				</ul>
			</li>
			<li><a href="#">Inloggen</a></li>
			<li><a href="#">Registreren</a></li>
		</ul>
	</nav>
	</div>
</header>