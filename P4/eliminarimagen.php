<?php
session_start();

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
  $idEv = "-1";
}
print($idEv);
$linkjuego = $mysqli->getLinkJuegoFromImagen($idEv)[0]['link'];
$link = "evento/" . $linkjuego;


if (isset($_SESSION['nickUsuario'])) {
  $nombreUsuario = $_SESSION['nickUsuario'];
  $usuario = $mysqli->getDatosUsuario($nombreUsuario);
}

if ($usuario[0]['gestor'] == 1 or $usuario[0]['super'] == 1) {

  $mysqli->eliminarImagen($idEv);
  echo $twig->render('mensaje.html', ['link' => $link,'usuario' => $usuario,'tipo'=>':)','mensaje' => "Imagen eliminada correctamente"]); //Pasamos información de juegos para la portada a la plantilla 

} else {
  echo $twig->render('mensaje.html', ['link' => $link,'usuario' => $usuario,'tipo'=>'Error','mensaje' => "No tiene acceso a esta información"]); //Pasamos información de juegos para la portada a la plantilla 

}
?>