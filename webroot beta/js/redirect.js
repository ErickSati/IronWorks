//Tony Harrington

//Edwards Manufacturing - CIE

//031812

//study tutorial external scripts - very basic
//this script redirects a user to another page.

window.onload = initAll;

function initAll() {
  document.getElementById("redirect").onclick = initRedirect;
}

function initRedirect() {
  window.location = "ciePage2.html";
  return false;
}


//end