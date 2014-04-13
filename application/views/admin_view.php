<?php $this->load->helper('form','url'); ?>
   	<div class="wrapper">
	   	<div class="container">
			<h2>Admin Omgeving</h2>
			<?php echo validation_errors();
			echo form_open('admin'); ?>
			Verander alpha, de leerparameter: <?php echo form_input(array('name' => 'alpha', 'maxlength' => '8', 'size' => '8', 'value' => $alpha)) ?> <br />
			Verander de x-factor, die bepaalt hoe zwaar de persoonlijkheid telt t.o.v. de merkvoorkeuren: <?php echo form_input(array('name' => 'xfactor', 'maxlength' => '8', 'size' => '8', 'value' => $xfactor)) ?> <br />
			Verander de distance measure, een getal tussen 1 en 4: <?php echo form_input(array('name' => 'distance_measure', 'maxlength' => '1', 'size' => '2', 'value' => $distance_measure)) ?> <br />
			<?php echo form_submit('admin', 'Verander'); 
			echo form_close(); ?>
		</div>
	</div>