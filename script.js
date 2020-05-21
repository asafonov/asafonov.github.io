function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
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
  el.style.order = '1';
  el.classList.add('sub');
  const href = el.getAttribute('data-href');
  const goto = function() {location.href = href;};
  setTimeout(goto, 3000);
}
