//Tony Harrington

//Edwards Manufacturing - miaFurnishings website

//030712

//an attempt to create an introductory slideshow on the homepage for miaFurnishings.

window.onload = rotate;

var thisAd = 0;


function rotate() {

//create an array container for the images...

  var miaSlide = new Array("images/jpg/introSlide/20tonPress.jpg","images/jpg/introSlide/elite110_2.png","images/jpg/introSlide/elite110-65_1.png");

//increment thisAd by 1

  thisAd++;

//set an if-loop that sets the size of thisAd to the size of the array miaSlide
 
  if (thisAd == miaSlide.length) {
	thisAd = 0;
  }

//The document introSlide is populated by whatever instance of miaSlide we're on to...

  document.getElementById("introSlide").src = miaSlide[thisAd];

//image changes every 5 seconds (or 5000 milliseconds)
  setTimeout(rotate, 5 * 1000);
}



//success! Now to work on transitions...
//end