document.addEventListener('DOMContentLoaded', function () { juegoRandom() }, false);

let portadas = new Array();
portadas[0] = "espada.jpg"
portadas[1] = "kirby.jpg"
portadas[2] = "splatoon.jpg"
portadas[3] = "sonic.jpg"

//Generar juego random en la oferta
function juegoRandom() {
    var rand = Math.floor(Math.random() * portadas.length);
    let juego = portadas[rand];
    let url = ".\\status\\image\\portadas\\" + juego;
    document.getElementById("ofertajuego").src = url;
}
