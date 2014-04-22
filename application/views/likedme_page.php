   	<div class="wrapper">
	   	<div class="container">
			<?php echo $text; ?> <br />

			<div class="profielen">
        	</div>
			<a href="<?php echo base_url(); ?>likes">Terug naar het overzicht</a><br />
			
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
        'url' : base + 'likes/ajax_likedme',
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