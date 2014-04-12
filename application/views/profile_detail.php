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
				Minimumleeftijd: <?php echo $minage ?> Maximumleeftijd: <?php echo $maxage ?> <br />
			</div>
			<div id="matching">
				<h3>Matching</h3>
				Persoonlijkheidstype: <?php echo $personality['type'] . ": <br />". $personality['percentage'] ?> <br />
				Persoonlijkheidsvoorkeur: <?php echo $perspref['type'] . ": <br />". $perspref['percentage'] ?> <br />
				Merkvoorkeuren: <br />
				<?php if (isset($brandpref))
				{
					echo "<ul>";
					foreach ($brandpref as $b):
						echo "<li>" . $b['name'] . "</li>";
					endforeach;
					echo "</ul>";
				}
				?>
				<div id="changebutton"><a href="<?php echo base_url() ?>profile/change_brands">Wijzig merkvoorkeuren</a>
			</div>
			<div id="likes">
				Likes en dislikes -- TO DO.
			</div>
			<a href="<? echo base_url()?>profile/deregister" onclick="return confirm('Weet u zeker dat u uw account wil verwijderen? Dit kan niet ongedaan gemaakt worden.');">Verwijder account.</a>
		</div>
	</div>