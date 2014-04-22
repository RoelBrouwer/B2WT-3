<?php $this->load->helper('form','url'); ?>
   	<div class="wrapper">
	   	<div class="container">
	   		<h2> Matches </h2>
	   		<div id="tabs">
          
        </div>
		</div>
	</div>

	 <script> 
    // using JQUERY's ready method to know when all dom elements are rendered
    $(document).ready(function() {
      getMatches();
    });

    function getMatches(){
      $(".profiel figure, .profiel ul").remove();
      var base = '<?php echo base_url();?>';
      $.ajax({
        'url' : base + 'matches/ajax_matches',
        'type' : 'POST',
        'success' : function(data){
          var container = $('#tabs');
          if(data){
              container.html(data);
          }
        }
      });
	}
    </script>