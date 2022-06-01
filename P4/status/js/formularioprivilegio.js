
document.getElementsByClassName("flecha").item(0).addEventListener("click", function () { rotarImagenes(0) });
document.getElementsByClassName("flecha").item(1).addEventListener("click", function () { rotarImagenes(1) });




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
    for (let i = 0; i < 4; i++) {
        var posicion = (i + 4 * rot) % imagenes.length;
        if (posicion < 0) {
            posicion += imagenes.length;
        }
        console.log(i);
        document.getElementsByClassName("imagen_galeria").item(i).src = "./status/image/juegos/" + imagenes[posicion]['img'];
        document.getElementsByClassName("linkeliminarimg").item(i).href = "./eliminarimagen/" + imagenes[posicion]['id'];

    }
}