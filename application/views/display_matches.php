<?php $this->load->helper('form','url'); ?>
   	<div class="wrapper">
	   	<div class="container">
	   		<h2> Matches </h2>
			<?php if (isset($user)){
				if(count($user) !== 0){?>
					U heeft <?php echo count($user) ?> matches.
					<?php foreach ($user as $usr):
						$p = $usr['user'];?>
							<?php 
					            echo '<div class="profiel"><figure><img src="#" alt="Profiel Foto"></figure><ul>';
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
				} else { echo "U heeft geen matches. Probeer eens om uw voorkeuren te verruimen."; }
			} else { echo "U heeft geen matches. Probeer eens om uw voorkeuren te verruimen.";}?>
		</div>
	</div>