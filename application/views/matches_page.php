<?php $this->load->helper('form','url'); ?>
   	<div class="wrapper">
	   	<div class="container">
	   		<h2> Matches </h2>
	   		<div class="profielen">
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
        'type' : 'POST', //the way you want to send data to your URL
        'success' : function(data){ //probably this request will return anything, it'll be put in var "data"\
          var container = $('.profielen'); //jquery selector (get element by id)
          if(data){
              container.html(data);
          }
        }
      });
	}
    </script>