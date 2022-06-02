<?php

// Inicializamos el motor de plantillas
require_once '/usr/local/lib/php/vendor/autoload.php';
include "mysql.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
$mysqli = new Database();

$mysqli->identificarse();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $valores = $_POST;
  $mysqli->nuevoUsuario($valores);
  header("Location: login.php");
}

$paises = $mysqli->getPaises();

echo $twig->render('registro.html', ['paises' => $paises]); //Pasamos información de juegos para la portada a la plantilla 
?>