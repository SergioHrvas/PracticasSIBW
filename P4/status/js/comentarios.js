document.getElementById("enviar").addEventListener("click", function (event) { enviar(event)});
document.getElementById("comentario").addEventListener("keyup", function () { evaluarComent() });

//Declaramos variables
let nombre_bien = new Boolean("true"), apellidos_bien = new Boolean("true"),
    correo_bien = new Boolean("true"), comentario_bien = new Boolean("true"), titulo_bien = new Boolean("true");
let nombre, comentario, apellidos, titulo;
// let opacidad_form = 0, opacidad_coments = 0;
// let altura = 0, id = 0;
let longitudmax = 1000, longitudrestante = 1000;


//Obtenemos palabras censuradas
var xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET", "censura.php", true);
xmlhttp.send();


//llamamos a la función para activar el contador de comentarios.
contar();

//Función que agrupa las dos funciones al escribir comentario
function evaluarComent() {
    censurar();
    contar();
}




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
