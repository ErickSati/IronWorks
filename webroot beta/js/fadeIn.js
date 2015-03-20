$(function(){

  $('.showcase img:gt(0)').hide();

  setInterval (function() { 

  $('.showcase :first-child').fadeOut()
  .next('img').fadeIn()
  .end().appendTo('.showcase');},
  4500);

});

