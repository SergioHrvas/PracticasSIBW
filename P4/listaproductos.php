<?php

// Inicializamos el motor de plantillas
require_once '/usr/local/lib/php/vendor/autoload.php';
include "mysql.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
$idEv = 1;
global $mysqli;

if (isset($_GET['ev'])) {
    $idEv = $_GET['ev'];
} else {
    $idEv = 1;
}
session_start();

$mysqli = new Database();
$mysqli->identificarse();

if (isset($_SESSION['nickUsuario'])) {
    $nombreUsuario = $_SESSION['nickUsuario'];
    $usuario = $mysqli->getDatosUsuario($nombreUsuario);
}

if ($usuario[0]['gestor'] == 1 or $usuario[0]['super'] == 1) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $valores = $_POST;
        $evento = $mysqli->getJuegosContiene($valores['busqueda']);
    } else {
        $evento = $mysqli->getTodosJuegos();
    }

    //para cada evento
    if ($evento != null) {

        foreach ($evento as $key => $value) {
            $evento[$key]['descripcion'] = substr($evento[$key]['descripcion'], 0, 500);
            $evento[$key]['descripcion'] = $evento[$key]['descripcion'] . "...";
        }
    }
    echo $twig->render('listaproductos.html', ['juegos' => $evento, 'usuario' => $usuario, 'valor' => $valores['busqueda'], 'etiq'=>true]);
} else {
    echo $twig->render('mensaje.html', ['tipo' => 'Error','usuario' => $usuario,  'mensaje' => "No tiene acceso a esta información"]);
}
?>