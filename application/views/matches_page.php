<?php $this->load->helper('form','url'); ?>
   	<div class="wrapper">
	   	<div class="container">
	   		<h2> Matches </h2>
			<?php 
			if (isset($user)){
				if(count($user) !== 0){
					echo '<p>U heeft'.count($user).' matches.</p>';
					foreach ($user as $usr):
						$p = $usr['user'];
			            echo '<div class="profiel"><figure><img src="'.base_url().'assets/uploads/';
			            if(isset($p['photo'])) { echo 'thumb_'.$p['photo']; } 
			            else { 
			              if ($p['sex'] == 'M') { echo "male.jpg"; } 
			              else { echo "female2.jpg";}     } 
			            echo '" alt="Profiel Foto" width="100"></figure><ul>';
			            echo '<li>'.$p['nickname'].'</li>';
			            echo '<li>'.$p['sex'].'</li>';
			            echo '<li>'.$p['birthdate'].'</li>';
			            echo '<li>'.$p['description'].'</li>';
			            echo '<li>'.$p['personality']['type'].'</li>';
			            echo '<li> Merken: </li>';
			            echo '<li><ul>';
			            $x = 0;
			            foreach($p['brandpref'] as $brand):
			              if($x < 4){
			              echo '<li>'.$brand['name'].'</li>';
			              $x++;
			              }
			            endforeach;
			            echo '</ul></li></ul></div>';
			          endforeach; 
				} else { echo "<p> U heeft geen matches. Probeer eens om uw voorkeuren te verruimen.</p>"; }
			} else { echo "<p>U heeft geen matches. Probeer eens om uw voorkeuren te verruimen.</p>";}?>
		</div>
	</div>

	 <script> 
    // using JQUERY's ready method to know when all dom elements are rendered
    $(document).ready(function() {
      $("#profile_button").click(function () {
        $(".profiel figure, .profiel ul").remove();
        var base = '<?php echo base_url();?>';
        $.ajax({
          'url' : base + 'welcome/ajax_profiles',
          'type' : 'POST', //the way you want to send data to your URL
          'success' : function(data){ //probably this request will return anything, it'll be put in var "data"\
            var container = $('.profielen'); //jquery selector (get element by id)
              if(data){
                container.html(data);
              }
            }
          });
      });
    });
    </script>