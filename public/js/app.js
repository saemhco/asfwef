function esDispositivoMovil() {
  return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
    navigator.userAgent
  );
}
$(window).scroll(function () {
  let pxScroll = $(window).scrollTop();
  var navbar = document.querySelector(".navbar-brand");
  var msNavbar = document.querySelector("#ms-navbar");
  var navbarStatic = document.querySelector(".navbar-static");
  var uncaLogo = document.querySelector("#unca-logo");
  
  var dropdownMenuArcjas = document.querySelectorAll(
    ".dropdown-menu.dropdown-megamenu"
  );

  if (pxScroll > 120) {
    if (esDispositivoMovil()) {
      navbarStatic.style.height = "50px";
    } else {
      navbarStatic.style.height = "160px";
    }
    dropdownMenuArcjas.forEach((elemento) => {
      elemento.style.marginTop = "100px";
      elemento.style.marginLeft = "0px";
    });
    uncaLogo.style.width= "605px";
    navbar.style.position = "absolute";
    navbar.style.left = "19px";
    navbar.style.marginTop = "-45px";
    msNavbar.style.marginTop = "99px";
    msNavbar.style.marginLeft = "-30px";
  } else if (pxScroll < 120) {
    dropdownMenuArcjas.forEach((elemento) => {
        elemento.style.marginTop = "0px";
      elemento.style.marginLeft = "0px";

      });
    navbarStatic.style.height = "50px";
    navbar.style.marginTop = "0px";
    msNavbar.style.marginTop = "0px";
    msNavbar.style.marginLeft = "0px";
  }
});

