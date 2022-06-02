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
  $idEv = "-1";
}

session_start();
$linkjuego = $mysqli->getLinkJuegoFromComentario($idEv)[0]['link'];
$link = "evento/" . $linkjuego;
if (isset($_SESSION['nickUsuario'])) {
  $nombreUsuario = $_SESSION['nickUsuario'];
  $usuario = $mysqli->getDatosUsuario($nombreUsuario);
}
$autor = $mysqli->getAutor($idEv);
if ($usuario[0]['moderador'] == 1 || $autor[0]['username'] == $usuario[0]['username']) {
  $mysqli->eliminarComentario($idEv);
  echo $twig->render('mensaje.html', ['link' => $link,'tipo'=>':)','mensaje' => "Comentario eliminado correctamente"]); //Pasamos información de juegos para la portada a la plantilla 
} else {
  echo $twig->render('mensaje.html', ['link' => $link,'tipo'=>'Error','mensaje' => "No tiene acceso a esta información"]); //Pasamos información de juegos para la portada a la plantilla 
}
?>