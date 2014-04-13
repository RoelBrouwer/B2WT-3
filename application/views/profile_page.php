<?php $this->load->helper('form','url'); ?>
   	<div class="wrapper">
	   	<div class="container">
	   		<div class="sidebar">
	   			<div id="profile-pic"><figure><img src="<? echo base_url()?>assets/uploads/Klasher_Taru_2.jpg" alt="Profiel Foto"></figure></div>
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
	   				<li><a href="<? echo base_url()?>profile/deregister" onclick="return confirm('Weet u zeker dat u uw account wil verwijderen? Dit kan niet ongedaan gemaakt worden.');">Verwijder account</a>
		</li>

	   			</ul>
	   		</div>
			
			<div class="profilecontent">
			<div id="userdata">
				<h3>Gegevens</h3>
				<ul>
				<li>Gebruikersnaam: <?php echo $nickname ?></li>
				<li>E-mail: <?php echo $email ?></li>
				<li>Voornaam: <?php echo $firstname ?></li>
				<li>Achternaam: <?php echo $lastname ?></li>
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
				<div id="likes">
					
				</div>
			</div>
			</div>
	</div>