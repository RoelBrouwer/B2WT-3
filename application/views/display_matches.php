<?php $this->load->helper('form','url'); ?>
   	<div class="wrapper">
	   	<div class="container">
			<?php if (isset($user)){
				if(count($user) !== 0){?>
					U heeft <?php echo count($user) ?> matches.
					<?php foreach ($user as $usr):?>
						<div id="userprofile">
							GEGEVENS <br />
							<?php echo $usr['firstname']. " " . $usr['lastname'] ?>
						</div>
					<?php endforeach; 
				} else { echo "U heeft geen matches. Probeer eens om uw voorkeuren te verruimen."; }
			} else { echo "U heeft geen matches. Probeer eens om uw voorkeuren te verruimen.";}?>
		</div>
	</div>