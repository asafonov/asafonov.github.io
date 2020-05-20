function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
  document.querySelector(".home").className = 'home glitch';
}

function menuFunction(el) {
  const x = document.querySelector(".top_menu_mobile");

  if (x === null || x === undefined) {
    return ;
  }

  const isFlex = x.style.display == 'flex';
  x.style.display = isFlex ? 'none' : 'flex';
  el.setAttribute('data-before', isFlex ? '///' : "X");
}

function leftmenuFunction(el) {
  const order = parseInt(el.style.order, 10);
  el.style.order = (1 - order) + '';
}
