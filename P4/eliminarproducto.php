<?php

// Inicializamos el motor de plantillas
require_once '/usr/local/lib/php/vendor/autoload.php';
include "mysql.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$mysqli = new Database();

$mysqli->identificarse();
if (isset($_GET['ev'])) {
  $idEv = $_GET['ev'];
} else {
  $idEv = "leyendas";
}

session_start();

if (isset($_SESSION['nickUsuario'])) {
  $nombreUsuario = $_SESSION['nickUsuario'];
  $usuario = $mysqli->getDatosUsuario($nombreUsuario);
}

$idjuego = $mysqli->getId($idEv);
if ($usuario[0]['gestor'] == 1 or $usuario[0]['super'] == 1) {
  $mysqli->eliminarProducto($idjuego);
  echo $twig->render('mensaje.html', ['tipo'=>':)','usuario' => $usuario,'mensaje' => "Producto eliminado correctamente"]); //Pasamos información de juegos para la portada a la plantilla 

} else {
  echo $twig->render('mensaje.html', ['tipo'=>'Error','usuario' => $usuario,'mensaje' => "No tiene acceso a esta información"]); //Pasamos información de juegos para la portada a la plantilla 

}
?>