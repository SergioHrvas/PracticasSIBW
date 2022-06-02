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
    $idEv = 1;
}

//$idusuario = $mysqli->getIdUsuario($idEv);
$user = $mysqli->getDatosUsuario($idEv);

if (isset($_SESSION['nickUsuario'])) {
    $nombreUsuario = $_SESSION['nickUsuario'];
    $usuario = $mysqli->getDatosUsuario($nombreUsuario);
}

//Si usuario no es nulo
if ($usuario != null) {
    $pais = $mysqli->getPais($usuario[0]['pais']);
    echo $twig->render('perfil.html', ['user' => $user, 'pais' => $pais, 'usuario' => $usuario]);
} else {
    echo $twig->render('error.html', ['tipo' => 'Error', 'usuario' => $usuario, 'mensaje' => "No tiene acceso a esta información"]);
}
?>