var btn = document.getElementById("tema");
var img = btn.querySelector("img");
var body = document.body;

window.addEventListener('load', function () {
    if (localStorage.getItem("tema") == "dark") {
        if ((window.location.href.includes("usuario.html")) || (window.location.href.includes("dashboard.html"))) {
            body.classList.add("dark");
            img.src = "../assets/icon/lua-branca.png";
            img.alt = "Tema claro";
        }else{
            body.classList.add("dark");
            img.src = "../assets/icon/lua-vermelha.png";
            img.alt = "Tema claro";
        }
    }
});

btn.addEventListener('click', function () {
    if (img.src.includes("sol-vermelho.png")) {
        img.src = "../assets/icon/lua-vermelha.png";
        img.alt = "Tema claro";
        body.classList.add("dark");
        localStorage.setItem("tema", "dark")

    } else if (img.src.includes("lua-vermelha.png")) {
        img.src = "../assets/icon/sol-vermelho.png";
        img.alt = "Tema escuro";
        body.classList.remove("dark");
        localStorage.setItem("tema", "light")
    }

    if (img.src.includes("sol-branco.png")) {
        img.src = "../assets/icon/lua-branca.png";
        img.alt = "Tema claro";
        body.classList.add("dark");
        localStorage.setItem("tema", "dark")

    } else if (img.src.includes("lua-branca.png")) {
        img.src = "../assets/icon/sol-branco.png";
        img.alt = "Tema escuro";
        body.classList.remove("dark");
        localStorage.setItem("tema", "light")
    }
});