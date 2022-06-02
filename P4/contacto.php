<?php
session_start();

// Inicializamos el motor de plantillas
require_once '/usr/local/lib/php/vendor/autoload.php';
include "mysql.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$mysqli = new Database();
$mysqli->identificarse();

if (isset($_SESSION['nickUsuario'])) {
    $nombreUsuario = $_SESSION['nickUsuario'];
    $usuario = $mysqli->getDatosUsuario($nombreUsuario);
}

echo $twig->render('contacto.html', ['usuario' => $usuario]); //Pasamos información de juegos para la portada a la plantilla 
?>