
document.getElementById("botoncomentarios").addEventListener("click", function (){mostrarComentarios()});
document.getElementById("enviar").addEventListener("click", function (){enviar()});
document.getElementById("comentario").addEventListener("keypress", function(){censurar()});
let nombre_bien = new Boolean("true");
let apellidos_bien = new Boolean("true");
let correo_bien = new Boolean("true");
let comentario_bien = new Boolean("true");
let nombre, comentario, apellidos;

function mostrarComentarios() {
    var x = document.getElementById("cajacomentarios");
    
    if(x.style.display !== "block"){
        x.style.display = "block";
    }
    else{
        x.style.display = "none";
    }
    return false;

};

function enviar(){
    revisarNombreYApellidos();
    revisarCorreo();
    revisarComentario();
    const d = new Date();
    let dia = calcularDiaSemana(d);
    console.log(dia);
   // alert(nombre);
    //alert(comentario.value);
    if(nombre_bien && apellidos_bien && correo_bien && comentario_bien){
        var comentariodiv = document.getElementsByClassName('comentario').item(0);
        var comentarioclonado = comentariodiv.cloneNode(true);
        comentarioclonado.getElementsByClassName("cabeceracomentario").item(0).getElementsByClassName("perfil").
        item(0).getElementsByClassName("nombreusuario").item(0).innerHTML = `${nombre} ${apellidos}`;
        comentarioclonado.getElementsByClassName("opinion").item(0).innerHTML = comentario;
        comentarioclonado.getElementsByClassName("fecha").item(0).innerHTML = `${dia}, ${d.getDate()} - ${d.getMonth()+1} - ${d.getFullYear()} | ${d.getHours()}:${d.getMinutes()} `
        alert(""+comentarioclonado.children[1].innerHTML);

        comentariodiv.insertAdjacentHTML("beforebegin", "<div class=\"comentario\">" + comentarioclonado.innerHTML + "</div>");
        
    }
    return false;
}


function revisarNombreYApellidos(){
    nombre = document.getElementsByClassName("nombreyape").item(0).value;
    apellidos = document.getElementsByClassName("nombreyape").item(1).value;
    if(nombre.length <= 0){
        document.getElementById("errornombre").innerHTML = "Debes rellenar el campo 'Nombre'!";
        nombre_bien = false;
    }
    else{
        document.getElementById("errornombre").innerHTML = "";
        nombre_bien = true;
    }
    if(apellidos.length<=0){
        document.getElementById("errorapellidos").innerHTML = "Debes rellenar el campo 'Apellidos'!";
        apellidos_bien = false;
    }
    else{
        document.getElementById("errorapellidos").innerHTML = "";
        apellidos_bien = true;
    }
    return false;
}

function revisarCorreo(){
    let correo = document.getElementById("correo_electronico").value;
    let re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(correo.length <= 0){
        document.getElementById("erroremail").innerHTML = "Debes rellenar el campo 'email'!";
        correo_bien = false;
    }
    else{
        if(correo.search(re)==-1){
            document.getElementById("erroremail").innerHTML = "Rellena el campo 'email' correctamente!";
            correo_bien = false;
        }
        else
            document.getElementById("erroremail").innerHTML = "";
            correo_bien = true;
    }
    return false;
}

function revisarComentario(){
    comentario = document.getElementById("comentario").value;
    if(comentario <= 0){
        document.getElementById("errorcomentario").innerHTML = "Debes rellenar el campo 'Comentarios'!";
        comentario_bien = false;
    }
    else{
        document.getElementById("errorcomentario").innerHTML = "";
        comentario_bien = true;
    }
    return false;
}



function censurar(){
    comentario = document.getElementById("comentario").value;
    let censuradas = [];
    censuradas.push("xbox", "playsation","mierda","coño","steam", "polla", "puta", "puto", "maricon", "cabron");
    for(let i = 0; i < censuradas.length; i++){
        let indice = comentario.indexOf(censuradas[i]);
        if(indice != -1){
            comentario = comentario.replace(censuradas[i], '****');
            document.getElementById("comentario").value = comentario;
        }
    }
    return false;
}

function calcularDiaSemana(d){
    let dia;
    switch(d.getDay()){
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