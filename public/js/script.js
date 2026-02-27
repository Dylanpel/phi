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

function userBubbleInit() {
  const el = document.querySelector('[data-bs-toggle="popover"]');
  const popover = new bootstrap.Popover(el, { sanitize: false });

  // Fermer le popover en cliquant ailleurs
  document.addEventListener('click', function (e) {
    if (!el.contains(e.target)) {
      popover.hide();
    }
  });
}

document.addEventListener('DOMContentLoaded', function () {
  navbarBodyPadding();
  userBubbleInit();
});

window.addEventListener('resize', navbarBodyPadding);
window.addEventListener('scroll', navbarScroll);