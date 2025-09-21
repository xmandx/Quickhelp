var btn = document.getElementById("tema");
var img = btn.querySelector("img");
var body = document.body;


btn.addEventListener('click', function() {
    if (img.src.includes("sol-vermelho.png")) {
        img.src = "assets/icon/lua-vermelha.png";
        body.classList.add("dark");

    }else if (img.src.includes("lua-vermelha.png")) {
        img.src = "assets/icon/sol-vermelho.png";
        body.classList.remove("dark");
    }
});