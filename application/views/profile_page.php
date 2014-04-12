<?php $this->load->helper('form','url'); ?>
   	<div class="wrapper">
	   	<div class="container">
			<div id="profile-pic"></div>
			<div id="userdata">
				<h3>Gegevens</h3>
				Gebruikersnaam: <?php echo $nickname ?> <br />
				E-mail: <?php echo $email ?> <br />
				Voornaam: <?php echo $firstname ?> <br />
				Achternaam: <?php echo $lastname ?> <br />
				Geboortedatum: <?php echo $birthdate ?> <br />
				Geslacht: <?php echo $sex ?> <br /> 
				Beschrijving: <?php echo $description ?> <br />
				<h3>Voorkeuren</h3>
				Geslacht: <?php echo $sexpref ?> <br />
				Minimumleeftijd: <?php $minage ?> Maximumleeftijd: <?php echo $maxage ?> <br />
				<?php echo form_open('profile/change_profile');
				echo form_submit('change_profile', 'Wijzig gegevens'); 
				echo form_close(); ?>
			</div>
			<div id="matching">
				<h3>Matching</h3>
				Persoonlijkheidstype: <?php echo $personality['type'] . ": <br />". $personality['percentage'] ?> <br />
				Merkvoorkeuren: <br />
				<?php if (isset($brandpref))
				{
					echo "<ul>";
					foreach ($brandpref as $b):
						echo "<li>" . $b['name'] . "</li>";
					endforeach;
					echo "</ul>";
				}
				echo form_open('profile/change_brands');
				echo form_submit('change_brands', 'Wijzig merkvoorkeuren'); 
				echo form_close();
			</div>
			?>
		</div>
	</div>