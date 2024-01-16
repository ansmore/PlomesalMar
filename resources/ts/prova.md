<?php $idioma = ?> <script> = $variable; </script>



// Variable en JavaScript
var language = "JavaScript";

// Crea un formulario dinámico y envía la variable por POST
var form = document.createElement("form");
form.method = "post";
form.action = "index.php";

var input = document.createElement("input");
input.type = "hidden";
input.name = "language";
input.value = language;

form.appendChild(input);
document.body.appendChild(form);

form.submit();


// Nueva función para cambiar el idioma y enviar la variable al controlador
window.changeLanguage = async (language) => {
    await setLanguage(language);

    // Redirigir a la misma página para que la variable se envíe al controlador
    window.location.reload();
};

onclick="changeLanguage('es')"

string(2) "es"
string(2) "es"

es
string(8) "language"
Pymesoft

