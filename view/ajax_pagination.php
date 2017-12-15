$(document).ready(function(){
  function hideLoading() {
    $("#loading").fadeOut('slow');
  };
  $("#paginate li:first").css({'color' : '#FF0084', 'border' : 'none'});
  $("#content_container").load("data.php?page=1", hideLoading());
  $("#paginate li").click(function(){
    $("#paginate li").css({'border' : 'solid #dddddd 1px', 'color' : '#0063DC'});
    $(this).css({'color' : '#FF0084', 'border' : 'none'});
    var page_num = this.id;
    $("#content_container").load("data.php?page=" + page_num, hideLoading());
  });
});
