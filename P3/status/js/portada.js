let modoOscuro = false;
document.getElementById("bombilla").addEventListener("click", function () { cambiarModo() });
document.getElementsByClassName("numpag").item(0).addEventListener("click", function () { moverIzquierda() });
document.getElementsByClassName("numpag").item(7).addEventListener("click", function () { moverDerecha() });

//Cambiamos a modo oscuro o normal
function cambiarModo() {
    debugger;
    if (modoOscuro) {
        document.getElementById("bombillaimg").src = "./status/image/off.png";
        document.body.style.backgroundColor = "#e60012";
        document.getElementsByTagName("main").item(0).style.backgroundColor = "#343434";
        document.getElementById("panel").style.backgroundColor = "#343434";

        document.getElementsByTagName("main").item(0).style.color = "black";
        modoOscuro = false;
        for (let i = 0; i < document.getElementsByClassName("juego").length; i++) {
            document.getElementsByClassName("caja").item(i).setAttribute("style", "-webkit-filter:grayscale(0%)");
            document.getElementsByClassName("caja").item(i).setAttribute("style", "filter:grayscale(0%)");
        }
    }
    else {
        document.getElementById("bombillaimg").src = "./status/image/on.png";
        document.body.style.backgroundColor = "#921d1d";
        document.getElementsByTagName("main").item(0).style.backgroundColor = "#1a1a1a";
        document.getElementById("panel").style.backgroundColor = "#1a1a1a";

        document.getElementsByTagName("main").item(0).style.color = "#ffffff";
        for (let i = 0; i < document.getElementsByClassName("juego").length; i++) {
            document.getElementsByClassName("caja").item(i).setAttribute("style", "-webkit-filter:grayscale(50%)");
            document.getElementsByClassName("caja").item(i).setAttribute("style", "filter:grayscale(50%)");
        }
        modoOscuro = true;
    }
}

//Función que mueve a la izquierda los números de las páginas
function moverIzquierda() {
    if (parseInt(document.getElementsByClassName("pag").item(1).innerHTML) > 1) {
        for (var i = 1; i <= 6; i++) {
            var num = parseInt(document.getElementsByClassName("pag").item(i).innerHTML) - 1;
            document.getElementsByClassName("pag").item(i).innerHTML = num;
            var a = "\index.php?ev=" + num;
            document.getElementsByClassName("numpag").item(i).href = a;
        }
    }

}

//Función que mueve a la derecha los números de las páginas
function moverDerecha() {
    for (var i = 1; i <= 6; i++) {
        var num = parseInt(document.getElementsByClassName("pag").item(i).innerHTML) + 1;

        document.getElementsByClassName("pag").item(i).innerHTML = num;
        var a = "\index.php?ev=" + num;
        document.getElementsByClassName("numpag").item(i).href = a;

    }
}