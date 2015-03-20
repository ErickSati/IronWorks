$(document).ready(function() {
		
$('#gallery img').each(function(i) {
	var imgFile = $(this).attr('src');
	var preloadImage = new Image();
  var imgExt = /(\.\w{3,4}$)/;
  preloadImage.src = imgFile.replace(imgExt,'_h$1');
		
	$(this).hover(
		function() {
			$(this).attr('src', preloadImage.src);
		},
		function () {
		var currentSource=$(this).attr('src');
			$(this).attr('src', imgFile);
	}); // end hover
}); // end each
	
//insert new programming below this line

$('#gallery a').click(function(evt) {
  evt.preventDefault();
  var imgPath = $(this).attr('href');
  var oldImage=$('#imgFrame img');
  var newImage=$('<img src="' + imgPath + '">');
  newImage.hide();
  $('#imgFrame').prepend(newImage);
  newImage.fadeIn(1000);

  oldImage.fadeOut(1000, function(){
    $(this).remove();
  }); //end fadeout

});//end click

  $('#gallery a:first').click();

}); // end ready