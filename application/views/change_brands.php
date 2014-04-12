<?php $this->load->helper('form','url'); ?>
   	<div class="wrapper">
	   	<div class="container">
			<?php echo validation_errors();
			echo form_open('profile/change_brands'); ?>
			<h2>Merkvoorkeuren</h2>
			<i>Selecteer hieronder een merk als het u aanspreekt, laat het gedeselecteerd als het u niet aanspreekt.</i><br />
			<?php foreach ($brands as $b):
				$check = false;
				foreach($brandpref as $br):
					if ($br['name']==$b['name']){$check = true;}
				endforeach;
				echo form_checkbox(array('name' => 'brandpref[]', 'value' => $b['brand_id'], 'checked' => $check));
				echo $b['name'];
			endforeach; ?> <br />
			<?php echo form_submit('change_brands', 'Wijzig'); 
			echo form_close(); ?>
		</div>
	</div>