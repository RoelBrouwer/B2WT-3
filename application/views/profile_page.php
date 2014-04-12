   	<div class="wrapper">
	   	<div class="container">
			<div id="profile-pic"></div>
			<h3>Gegevens</h3>
			Gebruikersnaam: <?php echo $nickname ?> <br />
			E-mail: <?php echo $email ?> <br />
			Voornaam: <?php echo $firstname ?> <br />
			Achternaam: <?php echo $lastname ?> <br />
			Geboortedatum: <?php echo $birthdate ?> <br />
			Geslacht: <?php echo $sex ?> <br /> 
			<!-- Beschrijving: <?php //echo $description ?> <br /> -->
			<h3>Voorkeuren</h3>
			Geslacht: <?php echo $sexpref ?> <br />
			Minimumleeftijd: <?php $minage ?> Maximumleeftijd: <?php echo $maxage ?> <br />
			<h3>Matching</h3>
			Persoonlijkheidstype: <?php echo $personality ?>
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
		</div>
	</div>