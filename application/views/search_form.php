<?php $this->load->helper('html'); $this->load->helper('url'); ?>

	<div class = "wrapper">
		<div class="container">
			<div id="search">
			<h2>Search</h2>
			<?php echo validation_errors();
			echo form_open('search'); ?>
			<label> Geslacht: </label><?php echo form_radio(array('name' => 'gender_pref', 'value' => 'M', 'checked' => set_radio('gender_pref', 'M'))) ?> Man <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'V', 'checked' => set_radio('gender_pref', 'V'))) ?> Vrouw <?php echo form_radio(array('name' => 'gender_pref', 'value' => 'B', 'checked' => set_radio('gender_pref', 'B'))) ?> Beide <br />
			<label> Minimumleeftijd: </label><?php echo form_input(array('name' => 'min_age', 'maxlength' => '3', 'size' => '5', 'value' => set_value('min_age'))) ?> Maximumleeftijd: <?php echo form_input(array('name' => 'max_age', 'maxlength' => '3', 'size' => '5', 'value' => set_value('max_age'))) ?> <br />
			<h4>Persoonlijkheid:</h4> <br />
			<i>De persoonlijkheid is een combinatie van vier waarden die aangeven hoe sterk iemand in de genoemde categorie valt. Elk van de waarden heeft een tegenpool (extravert -> introvert bijvoorbeeld). Vul hier vier percentages in voor de persoonlijkheidswaarden.</i><br />
			<label> Extravert: </label><?php echo form_input(array('name' => 'extravert', 'maxlength' => '3', 'size' => '5', 'value' => set_value('extravert'))) ?> 
			<label> Intuitive: </label><?php echo form_input(array('name' => 'intuitive', 'maxlength' => '3', 'size' => '5', 'value' => set_value('intuitive'))) ?> 
			<label> Thinking: </label><?php echo form_input(array('name' => 'thinking', 'maxlength' => '3', 'size' => '5', 'value' => set_value('thinking'))) ?> 
			<label> Judging: </label><?php echo form_input(array('name' => 'judging', 'maxlength' => '3', 'size' => '5', 'value' => set_value('judging'))) ?><br />
			<h4>Merken:</h4> <br />
			<i>We zoeken ook op basis van lifestyle. Selecteer daarvoor hieronder de merken die je aanspreken:</i><br />
			<div class="brands">
			<?php foreach ($brands as $b): 
				echo '<section>'.form_checkbox(array('name' => 'brandpref[]', 'value' => $b['brand_id'], 'checked' => set_checkbox('brandpref', $b['brand_id'])));
				echo '<label>'.$b['name'].'</label></section>';
			endforeach; ?>
			</div>
			<?php echo form_submit('search', 'Zoek!');
			echo form_close(); ?>
			<a href='<?php echo base_url() . "reg" ?>'>Registreer</a> om automatisch te zoeken!
			</div>
		</div>
	</div>