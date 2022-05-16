document.getElementById('activar1').addEventListener('click', function () { ocultarPassword(1) }, false);
document.addEventListener('DOMContentLoaded', function () { iniciar() }, false);
document.getElementById('activar2').addEventListener('click', function () { ocultarPassword(2) }, false);

function iniciar(){
    var x = document.getElementById("password1");
    x.type = "password";
    document.getElementById("activar1").checked = false;

    x = document.getElementById("password2");
    x.type = "password";
    document.getElementById("activar2").checked = false;

}

function ocultarPassword(id) {
    var x = document.getElementById("password"+id);
    if(x.type == "password"){
        x.type = "text";
    }else{
        x.type = "password";
    }
}

