$(document).ready(function() {
  $("#profile_button").click(function () {
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