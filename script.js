function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
  document.querySelector('.home').classList.add('glitch');
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
  document.querySelector('.left_menu').classList.add('sub');
  const href = el.getAttribute('data-href');
  const goto = function() {location.href = href;};
  setTimeout(goto, 1300);
}

function handleTiramisuVisibility() {
  document.querySelector('.tiramisu').style.display = document.body.offsetHeight < document.body.scrollHeight ? 'block' : 'none';
}

function onResize() {
  document.querySelector('.tiramisu').style.display = 'none';
  handleTiramisuVisibility();
}

document.addEventListener("DOMContentLoaded", function(event) { 
  window.addEventListener('resize', onResize);
  window.addEventListener('scroll', handleTiramisuVisibility);
});

