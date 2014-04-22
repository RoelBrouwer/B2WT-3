<?php $this->load->helper('form','url'); ?>
   	<div class="wrapper">
	   	<div class="container">
	   		<h2> Matches </h2>
	   		<div class="profielen">
        </div>
        <div class="buttons">
        <button id="previous">Vorige profielen!</button>
        <button id="next">Nieuwe profielen!</button>
        </div>
		</div>
	</div>

	 <script> 
    // using JQUERY's ready method to know when all dom elements are rendered
    $(document).ready(function() {
      var page = 1;
      getMatches(page);
      $("#previous").click(function () {
        if (page == 1) {
          getMatches(page);
        }
        else{
          page = page - 1;
          getMatches(page);
        }
      });  
      $("#next").click(function () {
          page = page + 1;
          getMatches(page);
      });  
    });

    function getMatches(page){
      $(".profiel figure, .profiel ul").remove();
      var base = '<?php echo base_url();?>';
      $.ajax({
        'url' : base + 'matches/ajax_matches/' + page,
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