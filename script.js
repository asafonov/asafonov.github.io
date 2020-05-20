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

  if (x.style.display == "flex") {
    x.style.display = "none";
    el.setAttribute("data-before", "///");
  } else {
    x.style.display = "flex";
    el.setAttribute("data-before", "X");
  }
}

function leftmenuFunction(el) {
  const order = parseInt(el.style.order, 10);
  el.style.order = (1 - order) + '';
}
