<?php 
	if (isset($user)){
	if(count($user) !== 0){?>
	<p>U heeft <?php echo count($user) ?> matches.</p>
	<?php foreach ($user as $usr):
		$p = $usr['user'];
	    echo '<div class="profiel"><a href="'.base_url().'profile/user/'.$p['user_id'].'"><figure><img src="'.base_url().'assets/uploads/';
    	if(isset($p['photo'])) { echo 'thumb_'.$p['photo']; } 
        else { 
        	if ($p['sex'] == 'M') { echo "male.jpg"; } 
        	else { echo "female2.jpg";}     } 
        	echo '" alt="Profiel Foto" width="100"></figure></a><ul>';
        	echo '<li><a href="'.base_url().'profile/user/'.$p['user_id'].'">'.$p['nickname'].'</a></li>';
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
	} else { echo "<p>U heeft geen matches. Probeer eens om uw voorkeuren te verruimen.</p>";}
?>