<?php $this->load->helper('form','url'); ?>
   	<div class="wrapper">
	   	<div class="container">
			<div id="profile-pic"></div>
				<?php if($usr_logged_in) { ?>
				Show foto
				<?php } else { ?>
				Show placeholder
				<?php } ?>
			<div id="userdata">
				<h3>Gegevens</h3>
				Gebruikersnaam: <?php echo $nickname ?> <br />
				<?php if($usr_logged_in) {
					if ($like == 4) {?>
				E-mail: <?php echo $email ?> <br />
				Voornaam: <?php echo $firstname ?> <br />
				Achternaam: <?php echo $lastname ?> <br />
				<?php } 
				}?>
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
			</div>
			<div id="likes">
				<?php if($usr_logged_in) { ?>
				Likes en dislikes -- TO DO. <br />
				<?php if ($like == 1 || $like == 3) {?>
				<a href="<?php echo base_url();?>profile/likeuser/<?php echo $user_id?>">Like!</a>
				<?php } else { ?>
				##Plaats al geliked-plaatje hier##
				<?php } 
				if ($like == 4) { echo "<img src='". base_url() . "assets/images/likes/likes_4.png' alt='Jullie zijn een match!' width='42' height='42'>"; echo "Jullie zijn een match!"; }
				elseif ($like == 3) { echo "<img src='". base_url() . "assets/images/likes/likes_3.png' alt='Jij liket ". $nickname ." maar ". $nickname ." jou niet' width='42' height='42'>"; echo "Jij liket ". $nickname ." maar ". $nickname ." jou niet."; }
				elseif ($like == 2) { echo "<img src='". base_url() . "assets/images/likes/likes_2.png' alt='". $nickname ." liket jou, maar jij ". $nickname ." niet' width='42' height='42'>"; echo $nickname ." liket jou, maar jij ". $nickname ." niet."; }
				else { echo "<img src='". base_url() . "assets/images/likes/likes_1.png' alt='Jullie hebben elkaar niet geliked' width='42' height='42'>"; echo "Jullie hebben elkaar niet geliked."; }
				} else { ?>
				<a href="<?php echo base_url();?>auth">Leer <?php echo $nickname ?> beter kennen...</a>
				<?php } ?>
			</div>
			<a href="<?php echo base_url();?>profile/deregister" onclick="return confirm('Weet u zeker dat u uw account wil verwijderen? Dit kan niet ongedaan gemaakt worden.');">Verwijder account.</a>
		</div>
	</div>