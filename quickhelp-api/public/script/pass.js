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

// confirmar senha

var input2 = document.getElementById("cpassword");
var btn_input2 = document.getElementById("btn-pass2");
var img_input2 = btn_input2.querySelector("img");

btn_input2.addEventListener('click', function () {
    console.log("teste 1");
    if (img_input2.src.includes("mostrar.png")) {
        input2.type = "text";
        img_input2.src = "../assets/icon/ocultar.png";
    }else if (img_input2.src.includes("ocultar.png")) {
        input2.type = "password";
        img_input2.src = "../assets/icon/mostrar.png";
    }
})