//Añadimos los eventos
document.getElementById("botoncomentarios").addEventListener("click", function () { mostrarComentarios() });

document.getElementById("bombilla").addEventListener("click", function () { cambiarModo() });
for (let i = 0; i < 4; i++) {
    document.getElementsByClassName("item_galeria").item(i).addEventListener("click", function () { cambiarImagen(i) });
}

let modoOscuro = false;


//Obtenemos producto
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const idEv = urlParams.get('ev')
var url = window.location.href;
url = url.split("/").pop();
var conexion_img = new XMLHttpRequest();
conexion_img.open("GET", "galeria.php?ev=" + url, true);
conexion_img.send();

//Mostramos el panel de comentarios
function mostrarComentarios() {
    var x = document.getElementById("cajacomentarios");
    if (x.style.display !== "block") {
        x.style.display = "block";
        let altura = 0;
        let id = 0;
        let opacidad_form = 0;
        let opacidad_coments = 0;
        // x.getElementsByClassName("formulario").item(0).style.opacity = opacidad_form;
        for (let i = 0; i < x.getElementsByClassName("comentario").length; i++)
            x.getElementsByClassName("comentario").item(i).style.opacity = opacidad_coments;
        clearInterval(id);
        id = setInterval(frame, 5);
        function frame() {
            if (altura > 1000) {
                x.style.maxHeight = "100%";
                clearInterval(id);
            }
            else {
                altura += 4;
                x.style.maxHeight = altura;
                if (altura >= 560) {
                    opacidad_form = opacidad_form + 0.1;
                    // x.getElementsByClassName("formulario").item(0).style.opacity = opacidad_form;
                }
                if (altura >= 950) {
                    opacidad_coments = opacidad_coments + 0.1;
                    for (let i = 0; i < x.getElementsByClassName("comentario").length; i++)
                        x.getElementsByClassName("comentario").item(i).style.opacity = opacidad_coments;
                }
            }
        }
    }
    else {
        x.style.display = "none";
        x.style.maxHeight = "0";
        for (let i = 0; i < x.getElementsByClassName("comentario").length; i++)
            x.getElementsByClassName("comentario").item(i).style.opacity = 0;
        // x.getElementsByClassName("formulario").item(0).style.opacity = 0;
    }

    return false;
};

//Generar juego random en la oferta
function juegoRandom() {
    var rand = Math.floor(Math.random() * portadas.length);
    let juego = portadas[rand];
    let url = ".\\status\\image\\portadas\\" + juego;
    document.getElementById("ofertajuego").src = url;
}

//Cambiamos a modo oscuro o normal
function cambiarModo() {
    debugger;
    if (modoOscuro) {
        document.getElementById("bombillaimg").src = "./status/image/off.png";
        document.body.style.backgroundColor = "#e60012";
        document.getElementsByTagName("main").item(0).style.backgroundColor = "rgb(148, 148, 148)";
        document.getElementsByTagName("main").item(0).style.color = "black";
        modoOscuro = false;
        for (let i = 0; i < document.getElementsByClassName("comentario").length; i++) {
            document.getElementsByClassName("comentario").item(i).style.backgroundColor = "#b6b6b6";
            document.getElementsByClassName("perfil").item(i).style.backgroundColor = "#ff8f8f";
            document.getElementsByClassName("titulocomentario").item(i).style.backgroundColor = "#c2c2c2"
            document.getElementsByClassName("fecha").item(i).style.color = "#777676";
        }
    }
    else {
        document.getElementById("bombillaimg").src = "./status/image/on.png";
        document.body.style.backgroundColor = "#921d1d";
        document.getElementsByTagName("main").item(0).style.backgroundColor = "#414141";
        document.getElementsByTagName("main").item(0).style.color = "#ffffff";
        for (let i = 0; i < document.getElementsByClassName("comentario").length; i++) {
            document.getElementsByClassName("comentario").item(i).style.backgroundColor = "#606060";
            document.getElementsByClassName("perfil").item(i).style.backgroundColor = "#650000";
            document.getElementsByClassName("titulocomentario").item(i).style.backgroundColor = "#37356c"
            document.getElementsByClassName("fecha").item(i).style.color = "white";
        }
        modoOscuro = true;
    }
}
let rot = 0;

let anterior = 1;
let primeravez = true;
function cambiarImagen(i) {
    var imagenes;
    if (conexion_img.readyState == 4 && conexion_img.status == 200) {
        imagenes = JSON.parse(conexion_img.responseText);
    }
    var opacidad = 0;
    document.getElementsByClassName("imagen").item(0).style.opacity = opacidad;

    let id = 0;
    clearInterval(id);
    id = setInterval(frame, 10);
    function frame() {
        if (opacidad <= 1) {
            opacidad += 0.01;
            document.getElementsByClassName("imagen").item(0).style.opacity = opacidad;
        }

    }
    document.getElementsByClassName("imagen").item(0).src = document.getElementsByClassName("imagen_galeria").item(i).src;
    document.getElementsByClassName("imagen").item(1).src = document.getElementsByClassName("imagen_galeria").item(i).src;
    document.getElementsByClassName("imagen_galeria").item(i).style.outline = "1px";
    document.getElementsByClassName("imagen_galeria").item(i).style.outlineColor = "black";
    document.getElementsByClassName("imagen_galeria").item(i).style.outlineStyle = "solid";
    if (!primeravez) {
        document.getElementsByClassName("imagen_galeria").item(anterior).style.outline = "0px";
        document.getElementsByClassName("imagen_galeria").item(anterior).style.outlineColor = "black";
        document.getElementsByClassName("imagen_galeria").item(anterior).style.outlineStyle = "solid";
    }
    var posicion = (i + 4 * rot) % imagenes.length;
    if (posicion < 0) {
        posicion += imagenes.length;
    }
    document.getElementsByClassName("pieimg").item(0).innerHTML = imagenes[posicion]['descripcion'];
    document.getElementsByClassName("pieimg").item(1).innerHTML = imagenes[posicion]['descripcion'];
    anterior = i;
    if (primeravez) {
        primeravez = false;
    }

}