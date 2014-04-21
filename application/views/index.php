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
        <button id="profile_button">Laad nieuwe profielen!</button>
        <div class="profielen">
        </div>
		</div>

    <script> 
    // using JQUERY's ready method to know when all dom elements are rendered
    $(document).ready(function() {
      getProfiles();
      $("#profile_button").click(function () {
        getProfiles();
      });  
    });

    function getProfiles(){
      $(".profiel figure, .profiel ul").remove();
      var base = '<?php echo base_url();?>';
      $.ajax({
        'url' : base + 'welcome/ajax_profiles',
        'type' : 'POST',
        'success' : function(data){
          var container = $('.profielen');
          if(data){
              container.html(data);
          }
        }
      });
    }
    </script>
	</div>
