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
          endforeach; ?>
        </div>
		</div>

    <script> 
    // using JQUERY's ready method to know when all dom elements are rendered
    $(document).ready(function() {
      // set an on click on the button
      $("#button").click(function () {
        $(".profiel figure, .profiel ul").remove();
        $.get("getProfile", function (all) {
           console.debug("hoi");
          $.each(all, function(index, object){
            alert(object.person1.age);        
          });
        });
      });
    });
  </script>
	</div>
