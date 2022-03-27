
document.getElementById("botoncomentarios").addEventListener("click", function () { mostrarComentarios() });
document.getElementById("enviar").addEventListener("click", function () { enviar() });
document.getElementById("comentario").addEventListener("keypress", function () { censurar() });
document.getElementById("bombilla").addEventListener("click", function () { cambiarModo() });

let nombre_bien = new Boolean("true");
let apellidos_bien = new Boolean("true");
let correo_bien = new Boolean("true");
let comentario_bien = new Boolean("true");
let nombre, comentario, apellidos;
let opacidad_form = 0;
let opacidad_coments = 0;
let altura = 0, id = 0;
let modoOscuro = true;





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
            if (altura > 10000) {
                x.style.maxHeight = "auto";
                clearInterval(id);
            }
            else {
                altura += 2;
                x.style.maxHeight = altura;
                if (altura >= 530) {
                    opacidad_form = opacidad_form + 0.1;
                    x.getElementsByClassName("formulario").item(0).style.opacity = opacidad_form;
                }
                if (altura >= 850) {
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

function enviar() {
    revisarNombreYApellidos();
    revisarCorreo();
    revisarComentario();
    const d = new Date();
    let dia = calcularDiaSemana(d);
    console.log(dia);
    // alert(nombre);
    //alert(comentario.value);
    if (nombre_bien && apellidos_bien && correo_bien && comentario_bien) {
        var comentariodiv = document.getElementsByClassName('comentario').item(0);
        var comentarioclonado = comentariodiv.cloneNode(true);
        comentarioclonado.getElementsByClassName("cabeceracomentario").item(0).getElementsByClassName("perfil").
            item(0).getElementsByClassName("nombreusuario").item(0).innerHTML = `${nombre} ${apellidos}`;
        comentarioclonado.getElementsByClassName("opinion").item(0).innerHTML = comentario;
        comentarioclonado.getElementsByClassName("fecha").item(0).innerHTML = `${dia}, ${d.getDate()} - ${d.getMonth() + 1} - ${d.getFullYear()} | ${d.getHours()}:${d.getMinutes()} `
        //alert(""+comentarioclonado.children[1].innerHTML);

        comentariodiv.insertAdjacentHTML("beforebegin", "<div class=\"comentario\">" + comentarioclonado.innerHTML + "</div>");
        comentarioclonado = document.getElementsByClassName('comentario').item(0);
        let opacidad = 0.0;
        comentarioclonado.style.opacity = opacidad;
        let id = 0;
        clearInterval(id);
        id = setInterval(frame, 10);
        function frame() {
            if (opacidad <= 1)
                console.log(opacidad);
            opacidad += 0.01;
            comentarioclonado.style.opacity = opacidad;

        }

    }
    return false;
}


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

function revisarCorreo() {
    let correo = document.getElementById("correo_electronico").value;
    let re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (correo.length <= 0) {
        document.getElementsByClassName("error").item(2).innerHTML = "Debes rellenar el campo 'email'!";
        correo_bien = false;
    }
    else {
        if (correo.search(re) == -1) {
            document.getElementsByClassName("error").item(2).innerHTML = "Rellena el campo 'email' correctamente!";
            correo_bien = false;
        }
        else
            document.getElementsByClassName("error").item(2).innerHTML = "";
        correo_bien = true;
    }
    return false;
}

function revisarComentario() {
    comentario = document.getElementById("comentario").value;
    if (comentario <= 0) {
        document.getElementsByClassName("error").item(3).innerHTML = "Debes rellenar el campo 'Comentarios'!";
        comentario_bien = false;
    }
    else {
        document.getElementsByClassName("error").item(3).innerHTML = "";
        comentario_bien = true;
    }
    return false;
}



function censurar() {
    comentario = document.getElementById("comentario").value;
    let censuradas = [];
    censuradas.push("xbox", "playsation", "mierda", "coño", "steam", "polla", "puta", "puto", "maricon", "cabron");
    for (let i = 0; i < censuradas.length; i++) {
        let indice = comentario.indexOf(censuradas[i]);
        if (indice != -1) {
            comentario = comentario.replace(censuradas[i], '****');
            document.getElementById("comentario").value = comentario;
        }
    }
    return false;
}

function calcularDiaSemana(d) {
    let dia;
    switch (d.getDay()) {
        case 0:
            dia = "Domingo";
            console.log("34234");
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


function cambiarModo(){
    if(modoOscuro){
        document.getElementById("bombillaimg").src = "./status/image/on.png";
        document.body.style.backgroundColor = "#e60012";
        document.getElementsByTagName("main").item(0).style.backgroundColor = "rgb(148, 148, 148)";
        document.getElementsByTagName("main").item(0).style.color = "black";
        modoOscuro = false;
        for(let i = 0; i < document.getElementsByClassName("comentario").length; i++ ){
            document.getElementsByClassName("comentario").item(i).style.backgroundColor = "#b6b6b6";
            document.getElementsByClassName("perfil").item(i).style.backgroundColor = "#ff8f8f";
            document.getElementsByClassName("titulocomentario").item(i).style.backgroundColor = "#c2c2c2"
            document.getElementsByClassName("fecha").item(i).style.color = "#777676";
        }
    }
    else{
        document.getElementById("bombillaimg").src = "./status/image/off.png";
        document.body.style.backgroundColor = "#921d1d";
        document.getElementsByTagName("main").item(0).style.backgroundColor = "#414141";
        document.getElementsByTagName("main").item(0).style.color = "#ffffff";
        for(let i = 0; i < document.getElementsByClassName("comentario").length; i++ ){
            document.getElementsByClassName("comentario").item(i).style.backgroundColor = "#606060";
            document.getElementsByClassName("perfil").item(i).style.backgroundColor = "#650000";
            document.getElementsByClassName("titulocomentario").item(i).style.backgroundColor = "#37356c"
            document.getElementsByClassName("fecha").item(i).style.color = "white";
        }

        modoOscuro = true;
    }

}