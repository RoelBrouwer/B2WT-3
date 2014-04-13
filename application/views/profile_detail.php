<?php $this->load->helper('form','url'); ?>
   	<div class="wrapper">
	   	<div class="container">
	   		<div class="sidebar">
	   			<div id="profile-pic"><figure>
	   				<?php 
	   					if($usr_logged_in && isset($photo)) {
	   						echo '<img src="'.base_url().'assets/uploads/'.$photo.'" alt="Profiel Foto">';
						}else {
							if($sex == 'M'){ 
								echo '<img src="'.base_url().'assets/uploads/male.jpg" alt="Male Foto">';
							} else{
								echo '<img src="'.base_url().'assets/uploads/female2.jpg" alt="Female Foto">';
							}
						}
					?>
	   			</figure></div>
	   			<div id="profile-name"><p> <?php echo $firstname." ".$lastname ?> </p></div>
	   			<ul>
	   				<li><a href="<?php echo base_url() ?>profile/change_profile">Wijzig gegevens</a></li>
	   				<li><a href="<?php echo base_url() ?>profile/change_brands">Wijzig merkvoorkeuren</a></li>
					<?php if (isset($photo)) {?>
	   				<li><a href="<?php echo base_url() ?>profile/change_picture">Wijzig profielfoto</a></li>
	   				<li><a href="<?php echo base_url() ?>profile/delete_picture">Verwijder profielfoto</a></li>
					<?php } else { ?>
					<li><a href="<?php echo base_url() ?>profile/add_picture">Upload profielfoto</a></li>
					<?php } ?>
	   				<li><a href="<? echo base_url()?>profile/deregister" onclick="return confirm('Weet u zeker dat u uw account wil verwijderen? Dit kan niet ongedaan gemaakt worden.');">Verwijder account</a></li>
	   			</ul>
	   		</div>
				
			<div class="profilecontent">
			<div id="userdata">
				<h3>Gegevens</h3>
				<ul>
				<li>Gebruikersnaam: <?php echo $nickname ?></li>
				<?php if($usr_logged_in) {
					if ($like == 4) {?>
				<li>E-mail: <?php echo $email ?></li>
				<li>Voornaam: <?php echo $firstname ?></li>
				<li>Achternaam: <?php echo $lastname ?></li>
				<?php } 
				}?>
				<li>Geboortedatum: <?php echo $birthdate ?></li>
				<li>Geslacht: <?php echo $sex ?> </li>
				<li>Beschrijving: <?php echo $description ?></li>
				</ul>
			</div>
			<div id="userpref">
				<h3>Voorkeuren</h3>
				<ul>
				<li>Geslacht: <?php echo $sexpref ?></li>
				<li>Minimumleeftijd: <?php echo $minage ?> </li>
				<li> Maximumleeftijd: <?php echo $maxage ?></li>
			</div>
			<div id="matching">
				<h3>Matching</h3>
				<ul>
				<li><strong>Persoonlijkheidstype</strong> <br /><?php echo $personality['type'] . ": <br />". $personality['percentage'] ?> </li>
				<br />
				<li><strong>Persoonlijkheidsvoorkeur</strong> <br /> <?php echo $perspref['type'] . ": <br />". $perspref['percentage'] ?> </li>
				</ul>
				<br />

				<strong>Merkvoorkeuren</strong> <br />
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
				<?php if($usr_logged_in) {
					if($like == 1 || $like == 2){
						echo '<a href="'.base_url().'profile/likeuser/'.$user_id.'">Like!</a>';
					}  else{
						echo '<p> Je hebt deze persoon al geliked </p>';
					}

					if ($like == 4){
						echo "<img src='". base_url() . "assets/images/likes/likes_4.png' alt='Jullie zijn een match!' width='42' height='42'>"; echo "Jullie zijn een match!"; 
					} elseif($like == 3){
						echo "<img src='". base_url() . "assets/images/likes/likes_3.png' alt='Jij liket ". $nickname ." maar ". $nickname ." jou niet' width='42' height='42'>"; echo "Jij liket ". $nickname ." maar ". $nickname ." jou niet."; 
					} elseif($like == 2){
						echo "<img src='". base_url() . "assets/images/likes/likes_2.png' alt='". $nickname ." liket jou, maar jij ". $nickname ." niet' width='42' height='42'>"; echo $nickname ." liket jou, maar jij ". $nickname ." niet.";
					} else{
						echo "<img src='". base_url() . "assets/images/likes/likes_1.png' alt='Jullie hebben elkaar niet geliked' width='42' height='42'>"; echo "Jullie hebben elkaar niet geliked.";
					}
				} else{
					echo '<a href="'.base_url().'auth">Leer'.$nickname.'beter kennen..</a>';
				}?>

					
			</div>
		</div>
	</div>