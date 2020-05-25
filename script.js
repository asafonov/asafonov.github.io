function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
  var x = document.getElementsByClassName("home")[0];
  x.setAttribute("class", "home glitch");
}

function menuFunction (el) {
  const x = document.querySelector(".top_menu_mobile");

  if (x === null || x === undefined) {
    return ;
  }

  const isFlex = x.style.display == 'flex';
  x.style.display = isFlex ? 'none' : 'flex';
  el.setAttribute('data-before', isFlex ? '///' : "X");
}

function leftmenuFunction (el) {
  el.classList.add('active');
  var x = document.getElementsByClassName("left_menu")[0];
  x.setAttribute("class", "left_menu sub");
  const href = el.getAttribute('data-href');
  const goto = function() {location.href = href;};
  setTimeout(goto, 1300);
}
