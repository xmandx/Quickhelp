var input = document.getElementById("password");
var btn_input = document.getElementById("btn-pass");
var img_input = btn_input.querySelector("img");

btn_input.addEventListener('click', function () {
    console.log("teste 1");
    if (img_input.src.includes("mostrar.png")) {
        input.type = "text";
        img_input.src = "../assets/icon/ocultar.png";
    }else if (img_input.src.includes("ocultar.png")) {
        input.type = "password";
        img_input.src = "../assets/icon/mostrar.png";
    }
})