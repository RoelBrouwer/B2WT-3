<?php 
$this->load->helper(array('html', 'url'));
$this->load->model('user_profiles');
?>
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
			<a href="<?php echo base_url();?>">DataDate</a>
		</section>
		<ul>
			<li><a href="<?php echo base_url();?>">Home</a></li>
			<li><a href="<?php echo base_url();?>profile">Profiel</a></li>
			<li><a href="<?php echo base_url();?>">Over</a></li>
			<li><a href="<?php echo base_url();?>">Matchen</a></li>
			<li><a href="<?php echo base_url();?>auth/logout"> Uitloggen </a><li>
			<?php
			if($this->user_profiles->is_admin()){
				 echo'<li><a href="'.base_url().'admin">Admin omgeving</a></li';
			}
			?>
		</ul>
	</nav>
	</div>
</header>