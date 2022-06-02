document.getElementById('addlabel').addEventListener('click', function () { añadirEtiqueta() }, false);

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