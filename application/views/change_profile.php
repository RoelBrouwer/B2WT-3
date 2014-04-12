<?php $this->load->helper('form','url'); ?>
   	<div class="wrapper">
	   	<div class="container">
			<?php echo validation_errors();
			echo form_open('profile/change_profile'); ?>
			<h2>Gegevens</h2>
			Gebruikersnaam: <?php echo form_input(array('name' => 'username', 'maxlength' => '25', 'size' => '30', 'value' => set_value('username'))) ?> <i>Kies een gebruikersnaam tussen de 3 en 30 alfanumerieke karakters (a-z, 0-9).</i>  <br />
			Nieuw wachtwoord: <?php echo form_password(array('name' => 'password', 'maxlength' => '25', 'size' => '30')) ?> <i>Kies een wachtwoord tussen de 5 en 255 karakters.</i> <br />
			Herhaal wachtwoord: <?php echo form_password(array('name' => 'password_check', 'maxlength' => '25', 'size' => '30')) ?> <br />
			E-mail: <?php echo form_input(array('name' => 'email', 'maxlength' => '35', 'size' => '30', 'value' => set_value('email'))) ?> <br />
			Voornaam: <?php echo form_input(array('name' => 'first_name', 'maxlength' => '20', 'size' => '30', 'value' => set_value('first_name'))) ?> <br />
			Achternaam: <?php echo form_input(array('name' => 'last_name', 'maxlength' => '30', 'size' => '30', 'value' => set_value('last_name'))) ?> <br />
			Geboortedatum: <?php echo form_input(array('name' => 'birthdate', 'maxlength' => '10', 'size' => '12', 'value' => set_value('birthdate'))) ?> <i>Voer in jjjj-mm-dd formaat in.</i><br />
			Geslacht: <?php echo form_radio(array('name' => 'gender', 'value' => 'M', 'checked' => set_radio('gender', 'M'))) ?> Man <?php echo form_radio(array('name' => 'gender', 'value' => 'V', 'checked' => set_radio('gender', 'V'))) ?> Vrouw <br />
			Beschrijving: <?php echo form_open_multipart('reg/do_upload');?> <?php echo form_textarea(array('name' => 'description', 'rows' => '7', 'cols' => '30', 'value' => set_value('description'))) ?> <i>Gebruik maximaal 500 karakters.</i><br />
			<strong>Ik ben op zoek naar</strong> <br />
			Geslacht: <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'M', 'checked' => set_radio('gender_pref', 'M'))) ?> Man <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'V', 'checked' => set_radio('gender_pref', 'V'))) ?> Vrouw <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'B', 'checked' => set_radio('gender_pref', 'B'))) ?> Beide <br />
			Minimumleeftijd: <?php echo form_input(array('name' => 'min_age', 'maxlength' => '3', 'size' => '5', 'value' => set_value('min_age'))) ?> Maximumleeftijd: <?php echo form_input(array('name' => 'max_age', 'maxlength' => '3', 'size' => '5', 'value' => set_value('max_age'))) ?> <br />
		</div>
	</div>