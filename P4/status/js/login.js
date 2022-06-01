document.getElementById('activar').addEventListener('click', function () { ocultarPassword() }, false);
document.addEventListener('DOMContentLoaded', function () { iniciar() }, false);
document.getElementById('addlabel').addEventListener('click', function () { añadirEtiqueta() }, false);

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

var num = 2;
function añadirEtiqueta(){
    var x = document.getElementById("labeletiq");
    //Clonar x

    var clonado = x.cloneNode(true);
    clonado.innerHTML = "Etiqueta #" + num;
    num++;
    //Añadir antes de addlabel
    
    document.getElementById("addlabel").parentNode.insertBefore(clonado.cloneNode(true), document.getElementById("addlabel"));
    
    var y = document.getElementById("labelinput");
    var clonado2 = y.cloneNode(true);
    document.getElementById("addlabel").parentNode.insertBefore(clonado2.cloneNode(true), document.getElementById("addlabel"));

}