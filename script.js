
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
  var x = document.getElementsByClassName("home")[0];
  x.setAttribute("class", "home glitch");
}

function menuFunction(el) {
  var x = document.getElementsByClassName("top_menu_mobile")[0];
  if (x.style.display === "flex") {
    x.style.display = "none";
    el.setAttribute("data-before", "///");
  } else {
    x.style.display = "flex";
    el.setAttribute("data-before", "X");
  }
}

function leftmenuFunction(el) {
  if (el.style.order === "1") {
    el.style.order = "0";
  } else {
    el.style.order = "1";
  }
}