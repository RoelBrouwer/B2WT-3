<?php foreach ($profiles as $p): 
            echo '<div class="profiel"><a href="'.base_url().'profile/user/'.$p['user_id'].'"><figure><img src="'.base_url().'assets/uploads/';
            if(isset($p['photo']) && $usr_logged_in) { echo 'thumb_'.$p['photo']; } 
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
          endforeach; ?>