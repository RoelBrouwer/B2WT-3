<?php $this->load->helper('form','url'); ?>
   	<div class="wrapper">
	   	<div class="container">
			U heeft <?php echo count($usr) ?> matches.
			<?php foreach ($user as $usr)?>
				<div id="userprofile">
					GEGEVENS
				</div>
			<?php endforeach; ?>
		</div>
	</div>