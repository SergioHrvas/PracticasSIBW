<?php
session_start();

// Inicializamos el motor de plantillas
require_once '/usr/local/lib/php/vendor/autoload.php';
include "mysql.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
$mysqli = new Database();

$mysqli->identificarse();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $valores = $_POST;

  $v = $mysqli->logearUsuario($valores);

  if ($v) {
    $_SESSION['nickUsuario'] = $valores['username'];  // guardo en la sesión el nick del usuario que se ha logueado
  }

  header("Location: index.php");
} else {

  echo $twig->render('login.html'); //Pasamos información de juegos para la portada a la plantilla 
}
?>