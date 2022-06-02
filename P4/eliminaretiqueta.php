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
$mysqli = new Database();

$mysqli->identificarse();
if (isset($_GET['ev'])) {
  $idEv = $_GET['ev'];
} else {
  $idEv = "-1";
}

if (isset($_GET['et'])) {
  $idEt = $_GET['et'];
} else {
  $idEt = "-1";
}


session_start();

$linkjuego = $mysqli->getLinkJuego($idEv)[0]['link'];
$link = "evento/" . $linkjuego;

if (isset($_SESSION['nickUsuario'])) {
  $nombreUsuario = $_SESSION['nickUsuario'];
  $usuario = $mysqli->getDatosUsuario($nombreUsuario);
}

if ($usuario[0]['gestor'] == 1 or $usuario[0]['super'] == 1) {
  $mysqli->eliminarEtiqueta($idEt);
  echo $twig->render('mensaje.html', ['link' => $link,'usuario' => $usuario, 'tipo' => ':)', 'mensaje' => "Etiqueta eliminada correctamente"]); //Pasamos información de juegos para la portada a la plantilla 

} else {
  echo $twig->render('mensaje.html', ['link' => $link, 'usuario' => $usuario, 'tipo' => 'Error', 'mensaje' => "No tiene acceso a esta información"]); //Pasamos información de juegos para la portada a la plantilla 
  
}

?>