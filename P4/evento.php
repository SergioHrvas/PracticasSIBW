<?php
session_start();

// Inicializamos el motor de plantillas
require_once '/usr/local/lib/php/vendor/autoload.php';
include "mysql.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
// Averiguo que la página que se quiere mostrar es la del producto 12,
// porque hemos accedido desde http://localhost/?producto=12
// Busco en la base de datos la información del producto y lo
// almaceno en las variables $productoNombre, $productoMarca, $productoFoto...

if (isset($_GET['ev'])) {
    $idEv = $_GET['ev'];
}
else {
     $idEv = "leyendas";
}



$mysqli = new Database();

$mysqli->identificarse();
if(isset($_SESSION['nickUsuario'])){
    $nombreUsuario = $_SESSION['nickUsuario'];
    $usuario = $mysqli->getDatosBasicos($nombreUsuario);
 }

$idEv=$mysqli->getId($idEv);

$evento = $mysqli->getEvento($idEv);
$comentarios = $mysqli->getComentarios($idEv);
$imagenes = $mysqli->getGaleria($idEv);

$evento['descripcion'] = nl2br($evento['descripcion']);
echo $twig->render('producto.html', ['evento' => $evento, 'comentarios' => $comentarios, 'imagenes' => $imagenes, 'usuario' => $usuario]); //Pasamos información completa de un juego a la plantilla

?>