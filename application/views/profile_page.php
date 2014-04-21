<?php $this->load->helper('form','url'); ?>
   	<div class="wrapper">
	   	<div class="container">
	   		<div class="sidebar">
	   			<div id="profile-pic"><figure><img src="<? echo base_url()?>assets/uploads/<?php if(isset($photo)) { echo $photo; } else { if ($sex == 'M') { echo "male.jpg"; } else { echo "female2.jpg";} } ?>" alt="Profiel Foto"></figure></div>
	   			<div id="profile-name"><p> <?php echo $firstname." ".$lastname ?> </p></div>
	   			<ul>
	   				<li><a href="<?php echo base_url() ?>profile/change_profile">Wijzig gegevens</a></li>
	   				<li><a href="<?php echo base_url() ?>profile/change_brands">Wijzig merkvoorkeuren</a></li>
					<?php if (isset($photo)) {?>
	   				<li><a href="<?php echo base_url() ?>profile/change_picture">Wijzig profielfoto</a></li>
	   				<li><a href="<?php echo base_url() ?>profile/delete_picture" onclick="return confirm('Weet u zeker dat u uw profielfoto wil verwijderen? Dit kan niet ongedaan gemaakt worden.');">Verwijder profielfoto</a></li>
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
				<li><strong>Gebruikersnaam:</strong> <?php echo $nickname ?></li>
				<li><strong>E-mail: </strong><?php echo $email ?></li>
				<li><strong>Voornaam:</strong> <?php echo $firstname ?></li>
				<li><strong>Achternaam:</strong> <?php echo $lastname ?></li>
				<li><strong>Geboortedatum:</strong> <?php echo $birthdate ?></li>
				<li><strong>Geslacht:</strong> <?php echo $sex ?> </li>
				<li><strong>Beschrijving:</strong> <?php echo $description ?></li>
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
			</div>
	</div>