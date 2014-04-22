<?php foreach ($profiles as $p): 
  echo '<div class="profiel"><div class = "profiel_foto"><a href="'.base_url().'profile/user/'.$p['user_id'].'"><figure><img src="'.base_url().'assets/uploads/';
        if(isset($p['photo']) && $usr_logged_in) { echo 'thumb_'.$p['photo']; } 
          else { 
            if ($p['sex'] == 'M') { echo "male.jpg"; } 
            else { echo "female2.jpg";}     } 
          echo '" alt="Profiel Foto" width="100"></figure></a>';

      if($usr_logged_in){
        if ($p['like'] == 4 ){
          echo "<img src='". base_url() . "assets/images/likes/likes_4.png' alt='Jullie zijn een match!' width='42' height='42'>"; 
        } elseif($p['like'] == 3){
          echo "<img src='". base_url() . "assets/images/likes/likes_3.png' alt='Jij liket ". $p['nickname'] ." maar ". $p['nickname'] ." jou niet' width='42' height='42'>"; 
        } elseif($p['like'] == 2){
          echo "<img src='". base_url() . "assets/images/likes/likes_2.png' alt='". $p['nickname'] ." liket jou, maar jij ". $p['nickname'] ." niet' width='42' height='42'>"; 
        } else{
          echo '<img src="'. base_url() . 'assets/images/likes/likes_1.png" alt="Jullie hebben elkaar niet geliked" width="42" height="42">';
        }
      }
      
            echo '</div><ul><li><a href="'.base_url().'profile/user/'.$p['user_id'].'">'.$p['nickname'].'</a></li>';
        echo '<li>'.$p['sex'].'</li>';
        echo '<li>'.$p['birthdate'].'</li>';
        echo '<li>'.substr($p['description'], 0, 20).'...</li>';
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