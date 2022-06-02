<?php

// Inicializamos el motor de plantillas
require_once '/usr/local/lib/php/vendor/autoload.php';
include "mysql.php";
session_start();

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$mysqli = new Database();
$mysqli->identificarse();

if (isset($_GET['ev'])) {
  $idEv = $_GET['ev'];
} else {
  $idEv = "-1";
}

if (isset($_SESSION['nickUsuario'])) {
  $nombreUsuario = $_SESSION['nickUsuario'];
  $usuario = $mysqli->getDatosUsuario($nombreUsuario);
}

if ($usuario[0]['gestor'] == 1 or $usuario[0]['super'] == 1) {
  $juegos = $mysqli->getJuegosEtiqueta($idEv);
  $textoetiqueta = $mysqli->getEtiqueta($idEv)[0]['texto'];
  if ($juegos != null) {

    foreach ($juegos as $key => $value) {
        $juegos[$key]['descripcion'] = substr($juegos[$key]['descripcion'], 0, 500);
        $juegos[$key]['descripcion'] = $juegos[$key]['descripcion'] . "...";
    }
}
  echo $twig->render('listaproductos.html', ['juegos' => $juegos, 'usuario' => $usuario, 'etiq' => false, 'textoetiqueta' => $textoetiqueta]);
} else {
  echo $twig->render('mensaje.html', ['link'=>$link, 'usuario' => $usuario, 'mensaje' => "No tiene acceso a esta información"]); //Pasamos información de juegos para la portada a la plantilla 

}
?>