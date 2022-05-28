//Añadimos los eventos
document.getElementById("botoncomentarios").addEventListener("click", function () { mostrarComentarios() });
document.getElementById("enviar").addEventListener("click", function (event) { enviar(event)});
document.getElementById("comentario").addEventListener("keyup", function () { evaluarComent() });
document.getElementById("bombilla").addEventListener("click", function () { cambiarModo() });
for (let i = 0; i < 4; i++) {
    document.getElementsByClassName("item_galeria").item(i).addEventListener("click", function () { cambiarImagen(i) });
}
document.getElementsByClassName("flecha").item(0).addEventListener("click", function () { rotarImagenes(0) });
document.getElementsByClassName("flecha").item(1).addEventListener("click", function () { rotarImagenes(1) });

//Declaramos variables
let nombre_bien = new Boolean("true"), apellidos_bien = new Boolean("true"),
    correo_bien = new Boolean("true"), comentario_bien = new Boolean("true"), titulo_bien = new Boolean("true");
let nombre, comentario, apellidos, titulo;
let opacidad_form = 0, opacidad_coments = 0;
let altura = 0, id = 0;
let modoOscuro = false;
let longitudmax = 1000, longitudrestante = 1000;

//Obtenemos palabras censuradas
var xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET", "censura.php", true);
xmlhttp.send();

//Obtenemos producto
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const idEv = urlParams.get('ev')
var url = window.location.href;
url = url.split("/").pop();
var conexion_img = new XMLHttpRequest();
conexion_img.open("GET", "galeria.php?ev=" + url, true);
conexion_img.send();

//llamamos a la función para activar el contador de comentarios.
contar();

//Función que agrupa las dos funciones al escribir comentario
function evaluarComent() {
    censurar();
    contar();
}

//Generar juego random en la oferta
function juegoRandom() {
    var rand = Math.floor(Math.random() * portadas.length);
    let juego = portadas[rand];
    let url = ".\\status\\image\\portadas\\" + juego;
    document.getElementById("ofertajuego").src = url;
}

//Mostramos el panel de comentarios
function mostrarComentarios() {
    var x = document.getElementById("cajacomentarios");
    if (x.style.display !== "block") {
        x.style.display = "block";
        altura = 0;
        id = 0;
        opacidad_form = 0;
        opacidad_coments = 0;
        x.getElementsByClassName("formulario").item(0).style.opacity = opacidad_form;
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
                    x.getElementsByClassName("formulario").item(0).style.opacity = opacidad_form;
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
        x.getElementsByClassName("formulario").item(0).style.opacity = 0;
    }

    return false;
};

//Enviamos el formulario y lo insertamos
function enviar(event) {
    console.log("asdasd");
    revisarComentario();
    if(comentario_bien == false){
        event.preventDefault();
    }
   // revisarTitulo();
    const d = new Date();
    let dia = calcularDiaSemana(d);
    if (nombre_bien && apellidos_bien && correo_bien && comentario_bien) {
        var codigo = "<div class=\"comentario\"><div class=\"cabeceracomentario\"><div class=\"perfil\"><div class=\"imagenperfil\"><img class=\"avatar\" src=\"./status/image/avatar.png\"></div><div class=\"nombreusuario\">{{coment['nombreyapellidos']}}</div></div><div class=\"titulocomentario\"><h4 class=\"textoopinion\">{{coment['titulo']}}</h4><span class=\"fecha\">{{coment['fecha']}}</span></div></div><div class=\"opinion\">{{coment['descripcion']}}</div></div>";
        (document.getElementsByClassName("formulario")).item(0).insertAdjacentHTML('afterend', codigo);

        var comentarioclonado = document.getElementsByClassName("comentario").item(0);
        comentarioclonado.getElementsByClassName("nombreusuario").item(0).innerHTML = `${nombre} ${apellidos}`;
        comentarioclonado.getElementsByClassName("textoopinion").item(0).innerHTML = titulo;
        comentarioclonado.getElementsByClassName("opinion").item(0).innerHTML = comentario;
        var minutos = revisarNumero(d.getMinutes());
        var horas = revisarNumero(d.getHours());
        comentarioclonado.getElementsByClassName("fecha").item(0).innerHTML = `${dia}, ${d.getDate()} - ${d.getMonth() + 1} - ${d.getFullYear()} | ${horas}:${minutos} `
        //alert(""+comentarioclonado.children[1].innerHTML);

        //comentariodiv.insertAdjacentHTML("beforebegin", "<div class=\"comentario\">" + comentarioclonado.innerHTML + "</div>");
        //comentarioclonado = document.getElementsByClassName('comentario').item(0);
        let opacidad = 0.0;
        comentarioclonado.style.opacity = opacidad;
        let id = 0;
        clearInterval(id);
        id = setInterval(frame, 10);
        function frame() {
            if (opacidad <= 1) {
                opacidad += 0.01;
                comentarioclonado.style.opacity = opacidad;
            }

        }

    }
    return false;
}

//Revisamos el número para la correcta visualización de las horas y minutos
function revisarNumero(d) {
    let minutos;
    if (d < 10) {
        minutos = `0${d}`;
    }
    else {
        minutos = d;
    }
    return minutos;
}

//Revisamos si el nombre y apellidos han sido insertados
function revisarNombreYApellidos() {
    nombre = document.getElementsByClassName("nombreyape").item(0).value;
    apellidos = document.getElementsByClassName("nombreyape").item(1).value;
    if (nombre.length <= 0) {
        document.getElementsByClassName("error").item(0).innerHTML = "Debes rellenar el campo 'Nombre'!";
        nombre_bien = false;
    }
    else {
        document.getElementsByClassName("error").item(0).innerHTML = "";
        nombre_bien = true;
    }
    if (apellidos.length <= 0) {
        document.getElementsByClassName("error").item(1).innerHTML = "Debes rellenar el campo 'Apellidos'!";
        apellidos_bien = false;
    }
    else {
        document.getElementsByClassName("error").item(1).innerHTML = "";
        apellidos_bien = true;
    }
    return false;
}

//Revisamos si el título ha sido añadido
function revisarTitulo() {
    titulo = document.getElementById("titulocomen").value;
    if (titulo.length <= 0) {
        document.getElementsByClassName("error").item(2).innerHTML = "Debes rellenar el campo 'Titulo'!";
        titulo_bien = false;
    }
    else {
        document.getElementsByClassName("error").item(2).innerHTML = "";
        titulo_bien = true;
    }
    return false;
}

//Revisamos si el formato del correo electrónico es correcto (loquesea@loquesea)
function revisarCorreo() {
    correo_bien = false;
    let correo = document.getElementById("correo_electronico").value;
    let re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (correo.length <= 0) {
        document.getElementsByClassName("error").item(3).innerHTML = "Debes rellenar el campo 'email'!";
        correo_bien = false;
    }
    else {
        if (correo.search(re) == -1) {
            document.getElementsByClassName("error").item(3).innerHTML = "Rellena el campo 'email' correctamente!";
            correo_bien = false;
        }
        else {
            document.getElementsByClassName("error").item(3).innerHTML = "";
            correo_bien = true;

        }
    }
    return false;
}

//Revisamos si el comentario se ha rellenado
function revisarComentario() {
    comentario = document.getElementById("comentario").value;

    if (comentario <= 0) {
        document.getElementsByClassName("error").item(0).innerHTML = "Debes rellenar el campo 'Comentarios'!";
        comentario_bien = false;
    }
    else {
        document.getElementsByClassName("error").item(0).innerHTML = "";
        comentario_bien = true;
    }
    return false;
}

//Censuramos palabras malsonantes
function censurar() {
    comentario = document.getElementById("comentario").value;

    let censuradas;
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        censuradas = JSON.parse(xmlhttp.responseText);

        for (let i = 0; i < censuradas.length; i++) {
            let indice = comentario.indexOf(censuradas[i]['palabra']);
            if (indice != -1) {
                comentario = comentario.replace(censuradas[i]['palabra'], '****');
                document.getElementById("comentario").value = comentario;
            }
        }

    }


    return false;
}

//Contamos los caractéres
function contar() {
    comentario = document.getElementById("comentario").value;
    longitudrestante = longitudmax - comentario.length;
    document.getElementById("contador").innerHTML = longitudrestante;

    if (longitudrestante > 200) {
        document.getElementById("contador").style.backgroundColor = "#98ff8f";
        document.getElementById("contador").style.color = "#085d00";
    }
    else if (longitudrestante > 50) {
        document.getElementById("contador").style.backgroundColor = "#ffc67e";
        document.getElementById("contador").style.color = "#d84e00";
    }
    else {
        document.getElementById("contador").style.backgroundColor = "#ff6969";
        document.getElementById("contador").style.color = "#b50000";
    }
    return false;
}

//Calculamos el día de la semana
function calcularDiaSemana(d) {
    let dia;
    switch (d.getDay()) {
        case 0:
            dia = "Domingo";
            break;
        case 1:
            dia = "Lunes";
            break;
        case 2:
            dia = "Martes";
            break;
        case 3:
            dia = "Miércoles";
            break;
        case 4:
            dia = "Jueves";
            break;
        case 5:
            dia = "Viernes";
            break;
        case 6:
            dia = "Sábado";
            break;
    }
    return dia;
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
    console.log(conexion_img.readyState);
    console.log(conexion_img.status);
    if (conexion_img.readyState == 4 && conexion_img.status == 200) {
        console.log(conexion_img.responseText);
        imagenes = JSON.parse(conexion_img.responseText);
        console.log(imagenes);
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

//Función que rota las imágenes de la galería de un producto a la derecha o a la izquierda.
function rotarImagenes(direccion) {
    var imagenes;
    if (direccion == 1)
        rot++;
    else
        rot--;
    if (conexion_img.readyState == 4 && conexion_img.status == 200) {
        imagenes = JSON.parse(conexion_img.responseText);
    }
    console.log(imagenes[0]['img']);
    for (let i = 0; i < 4; i++) {
        var posicion = (i + 4 * rot) % imagenes.length;
        if (posicion < 0) {
            posicion += imagenes.length;
        }
        document.getElementsByClassName("imagen_galeria").item(i).src = "./status/image/juegos/" + imagenes[posicion]['img'];

    }
}