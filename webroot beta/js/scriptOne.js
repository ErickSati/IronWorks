//  CIE - Creative Industrial Estate
//  javascript tutorials - Edwards Manufacturing sites
//  02/16/2012

/* This is my first script.  This is a how to insert a long-form(multi-line) comment into JavaScript.  One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What's happened to me? " he thought. It wasn't a dream. His room, a proper human*/

window.onload = writeMessage;//This is a short comment.  This event handler is saying that when the window opens, perform the "writeMessage" function.

function writeMessage() {
  document.getElementById("greeting").innerHTML = "Do not adjust your screens.  We control the horizontal AND the vertical...Hello, world.";
}

//alert("Welcome to my JavaScript page..."); Commenting out this code for now...

/*if (confirm("Are you sure you want to do this?")) {
  alert("You said YES.");} 
else{
  alert("YOu said NO.");} //This snippet will be useful in confirming transactions... if we ever want to build online transactions into any of our sites...*/

/*var ans = prompt("Are you sure you want to do that?","");
  if (ans) {
    alert("You said " + ans);
}

  else{
    alert("You refused to answer.");
}*/

window.onload = initAll;

function initAll() {
  document.getElementById("redirect").onclick = initRedirect;
}

function initRedirect() {
  alert("Warning: The author of this page may, in fact, be insane.");
  window.location = this;
  return false;
}

//an alert structured like the above code, again, may be useful in setting up online transactions.

