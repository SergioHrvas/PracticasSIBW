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

if ($usuario[0]['moderador'] == 1) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $valores = $_POST;
        $comentarios = $mysqli->getComentariosContiene($valores['busqueda']);
    } else {

        $comentarios = $mysqli->getTodosComentarios();
    }
    //iterar comentarios
    if ($comentarios != null) {
        foreach ($comentarios as $key => $value) {
            $comentarios[$key]['autor'] = $mysqli->getDatosUsuarioPorId($comentarios[$key]['id_usuario'])[0];
            $comentarios[$key]['juego'] = $mysqli->getEvento($comentarios[$key]['id_juego']);
        }
    }
    echo $twig->render('listacomentarios.html', ['comentarios' => $comentarios, 'usuario' => $usuario, 'valor' => $valores['busqueda']]); //Pasamos información de juegos para la portada a la plantilla 

} else {
    echo $twig->render('mensaje.html', ['tipo' => 'Error', 'mensaje' => "No tiene acceso a esta información"]);
}
?>