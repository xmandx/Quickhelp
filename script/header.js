// box shadow ao scrollar
var header = document.querySelector("header");

window.addEventListener('scroll', function () {
    if (window.scrollY > 0) {
        header.classList.add("scrolled");
        header.style.opacity = "0.7";

        header.addEventListener('mouseover', function () {
            header.style.opacity = "1";
        });

        header.addEventListener('mouseleave', function () {
            header.style.opacity = "0.7";
        });

    } else {
        header.classList.remove("scrolled");
        header.style.opacity = "1";
    }
});

// menu hamburguer

var menu = document.getElementById("menu");
var nav = document.querySelector("nav");

menu.addEventListener('click', function (e) {
    e.stopPropagation();

    if (nav.classList.contains("ativado")) {
        nav.classList.remove("ativado");
        document.removeEventListener("click", closeOnClickOutside);
    } else {
        nav.classList.add("ativado");
        document.addEventListener("click", closeOnClickOutside);
    }
});

function closeOnClickOutside(e) {
    if (!nav.contains(e.target) && e.target !== menu) {
        nav.classList.remove("ativado");
        document.removeEventListener("click", closeOnClickOutside); // remove para não acumular listeners
    }
}