document.getElementById('activar').addEventListener('click', function () { ocultarPassword() }, false);
document.addEventListener('DOMContentLoaded', function () { iniciar() }, false);

function iniciar(){
    var x = document.getElementById("password");
    x.type = "password";
    document.getElementById("activar").checked = false;

}

//Generar juego random en la oferta
function ocultarPassword() {
    var x = document.getElementById("password");
    if(x.type == "password"){
        x.type = "text";
    }else{
        x.type = "password";
    }
}

