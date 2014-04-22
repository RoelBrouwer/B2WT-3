    <div class="wrapper">
      <div class="container">
      <?php echo $text; ?> <br />

      <div class="profielen">
      </div>
      <div class="buttons">
        <button id="previous">Vorige profielen!</button>
        <button id="next">Nieuwe profielen!</button>
      </div>
      <a href="<?php echo base_url(); ?>likes">Terug naar het overzicht</a><br />
      
    </div>
  </div>

  <script> 
    // using JQUERY's ready method to know when all dom elements are rendered
    $(document).ready(function() {
      getMatches();
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
        'url' : base + 'likes/ajax_mutuallikes/' + page,
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