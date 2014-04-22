<?php $this->load->helper('form','url'); ?>
   	<div class="wrapper">
	   	<div class="container">
	   		<div class="inputform">
			<?php echo validation_errors();
			echo form_open('profile/change_profile'); ?>
			
			<h2>Gegevens</h2>
			<label> Gebruikersnaam: </label> <?php echo form_input(array('name' => 'username', 'maxlength' => '25', 'size' => '30', 'value' => $nickname)) ?> <i>Kies een gebruikersnaam tussen de 3 en 30 alfanumerieke karakters (a-z, 0-9).</i>  <br />
			<label>Nieuw wachtwoord: </label><?php echo form_password(array('name' => 'password', 'maxlength' => '25', 'size' => '30')) ?> <i>Kies een wachtwoord tussen de 5 en 255 karakters.</i> <br />
			<label>Herhaal wachtwoord: </label><?php echo form_password(array('name' => 'password_check', 'maxlength' => '25', 'size' => '30')) ?> <br />
			<label>E-mail: </label><?php echo form_input(array('name' => 'email', 'maxlength' => '35', 'size' => '30', 'value' => $email)) ?> <br />
			<label>Voornaam: </label><?php echo form_input(array('name' => 'first_name', 'maxlength' => '20', 'size' => '30', 'value' => $firstname)) ?> <br />
			<label>Achternaam: </label><?php echo form_input(array('name' => 'last_name', 'maxlength' => '30', 'size' => '30', 'value' => $lastname)) ?> <br />
			<label>Geboortedatum: </label><?php echo form_input(array('name' => 'birthdate', 'maxlength' => '10', 'size' => '12', 'value' => $birthdate)) ?> <i>Voer in jjjj-mm-dd formaat in.</i><br />
			<?php if($sex=='M'){$m = true; $v = false;}else{$m = false; $v = true;} ?>
			<label>Geslacht: </label><?php echo form_radio(array('name' => 'gender', 'value' => 'M', 'checked' => $m)) ?> Man <?php echo form_radio(array('name' => 'gender', 'value' => 'V', 'checked' => $v)) ?> Vrouw <br />
			<label>Beschrijving: </label><?php echo form_open_multipart('reg/do_upload');?> <?php echo form_textarea(array('name' => 'description', 'rows' => '7', 'cols' => '30', 'value' => $description)) ?> <i>Gebruik maximaal 500 karakters.</i><br />
			<h4>Ik ben op zoek naar</h4>
			<?php if($sexpref=='M'){$m2 = true; $v2 = false; $b = false;}else{if($sexpref=='V'){$m2 = false; $v2 = true; $b = false;}else{$m2 = false; $v2 = false; $b = true;}} ?>
			<label>Geslacht: </label><?php echo form_radio(array('name' => 'gender_pref', 'value' => 'M', 'checked' => $m2)) ?> Man <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'V', 'checked' => $v2)) ?> Vrouw <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'B', 'checked' => $b)) ?> Beide <br />
			<label>Minimumleeftijd: </label><?php echo form_input(array('name' => 'min_age', 'maxlength' => '3', 'size' => '5', 'value' => $minage)) ?> Maximumleeftijd: <?php echo form_input(array('name' => 'max_age', 'maxlength' => '3', 'size' => '5', 'value' => $maxage)) ?> <br />
			<?php echo form_submit('change_profile', 'Wijzig'); 
			echo form_close(); ?>
			</div>
		</div>
	</div>