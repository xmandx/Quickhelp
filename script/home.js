// contador de caracteres
var span = document.getElementById("caracteres");
var contador = 0;

setInterval(() => {
    var textarea = document.getElementById("message").value;
    var length = textarea.length;
    
    contador = 500 - length;

    span.textContent = contador;
}, 100);

// tirando o refresh
var form = document.querySelector("form");

form.addEventListener('submit', function(event) {
    event.preventDefault;
});