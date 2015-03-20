
$(document).ready(function() {
  $('.tabs a').click(function() {
    var $this=$(this);
    $('.panel').hide();
    $('.tabs a.active').removeClass('active');
    $this.addClass('active').blur();
    var panel=$this.attr('href');
    $(panel).fadeIn(250);
    return false;
  }); //end click
$('.tabs li:first a').click();
}); // end ready