   	<div class="wrapper">
   		<div id="homeheader">
   		<h1>DataDate</h1>	
   		</div>
	   	<div class="container">
		    <h2 id = "waarom">Waarom DataDate?</h2>
		    <p>
		    	De bijzonderheid in onze site is dat ons dating paradigma gebaseerd is op een unieke en wetenschappelijk correct bewezen profilerings- en matching techniek die zowel de persoonlijkheid als de lifestyle in de "dating equation" meeneemt en leert van de voorkeuren van de gebruiker om de dating ervaring te optimaliseren. Tot op zekere hoogte is dit al eens eerder vertoond (BrandDating.nl voor dating op basis van lifestyle - deze site is kennelijk wegen succes beëindigd - en Parship voor dating op basis van persoonlijkheid), maar wij hebben niet alleen betere technologieën; we combineren ook nog eens deze systemen en breiden ze uit met "playing field changing" zelflerende functionaliteit.
        </p>

        <h2>Profielen</h2>
        <button id="button">Click Me!</button>
        <div class="profielen">
          <?php foreach ($profiles as $p): 
            echo '<div class="profiel"><figure><img src="'.base_url().'assets/uploads/female2.jpg" alt="Profiel Foto" width="100"></figure><ul>';
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
          endforeach; ?>
        </div>
		</div>

    <script> 
    // using JQUERY's ready method to know when all dom elements are rendered
    $(document).ready(function() {
      $("#button").click(function () {
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
	</div>
