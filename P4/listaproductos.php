<?php

// Inicializamos el motor de plantillas
require_once '/usr/local/lib/php/vendor/autoload.php';
include "mysql.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
// Averiguo que la página que se quiere mostrar es la del producto 12,
// porque hemos accedido desde http://localhost/?producto=12
// Busco en la base de datos la información del producto y lo
// almaceno en las variables $productoNombre, $productoMarca, $productoFoto...
$idEv = 1;
global $mysqli;

if (isset($_GET['ev'])) {
    $idEv = $_GET['ev'];
}
else {
    $idEv = 1;
}
session_start();

$mysqli = new Database();
$mysqli->identificarse();

if(isset($_SESSION['nickUsuario'])){
    $nombreUsuario = $_SESSION['nickUsuario'];
    $usuario = $mysqli->getDatosBasicos($nombreUsuario);
 }

$evento = $mysqli->getJuegos($idEv, 18);

echo $twig->render('listaproductos.html', ['juego' => $evento, 'usuario' => $usuario]); //Pasamos información de juegos para la portada a la plantilla 

?>