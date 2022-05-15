<?php
session_start();

// Inicializamos el motor de plantillas
require_once '/usr/local/lib/php/vendor/autoload.php';
include "mysql.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);


if (isset($_GET['ev'])) {
    $idEv = $_GET['ev'];
}
else {
     $idEv = "leyendas";
}
$mysqli = new Database();

$mysqli->identificarse();
$idEv=$mysqli->getId($idEv);
$evento = $mysqli->getEvento($idEv);
$comentarios = $mysqli->getComentarios($idEv);
$imagenes = $mysqli->getGaleria($idEv);

$evento['descripcion'] = nl2br($evento['descripcion']);
echo $twig->render('producto_imprimir.html', ['evento' => $evento, 'comentarios' => $comentarios, 'imagenes' => $imagenes]); //Pasamos información de un juego a la plantilla -> Modo imprimir

?>

