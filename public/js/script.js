// ajustement du padding du body pour la navbar
function navbarBodyPadding() {
  const navbar = document.getElementById('mainNav');
  const style = window.getComputedStyle(navbar);
  const marginTop = parseFloat(style.marginTop);
  const marginBottom = parseFloat(style.marginBottom);
  document.body.style.paddingTop = (navbar.offsetHeight + marginTop + marginBottom) + 'px';
}

function navbarScroll() {
  const navbar = document.getElementById('mainNav');
  navbar.classList.toggle('scrolled', window.scrollY > 75);
}

document.addEventListener('DOMContentLoaded', navbarBodyPadding);
window.addEventListener('resize', navbarBodyPadding);
window.addEventListener('scroll', navbarScroll);