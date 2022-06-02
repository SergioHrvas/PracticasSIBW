<?php
session_start();

// Inicializamos el motor de plantillas
require_once '/usr/local/lib/php/vendor/autoload.php';
include "mysql.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
// Averiguo que la página que se quiere mostrar es la del producto 12,
// porque hemos accedido desde http://localhost/?producto=12
// Busco en la base de datos la información del producto y lo
// almaceno en las variables $productoNombre, $productoMarca, $productoFoto...

if (isset($_GET['ev'])) {
  $idEv = $_GET['ev'];
} else {
  $idEv = "1";
}


$mysqli = new Database();
$mysqli->identificarse();

if (isset($_SESSION['nickUsuario'])) {
  $nombreUsuario = $_SESSION['nickUsuario'];
  $usuario = $mysqli->getDatosUsuario($nombreUsuario);
}
$comentariooriginal = $mysqli->getComentario($idEv);

$autor = $mysqli->getAutor($idEv);

if ($usuario[0]['moderador'] == 1 or $usuario[0]['super'] == 1 || $usuario[0]['username'] == $autor[0]['username']) {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['titulo'] == "") {
      $_POST['titulo'] = $comentariooriginal[0]['titulo'];
    }
    if ($_POST['descripcion'] == "") {
      $_POST['descripcion'] = $comentariooriginal[0]['comentario'];
    } else {
      if ($usuario[0]['moderador'] == 1) {
        $_POST['descripcion'] = $_POST['descripcion'] . "           Editado por: " . $usuario[0]['username'];
      } else {
        $_POST['descripcion'] = $_POST['descripcion'] . "           Editado";
      }
    }

    $link = "../evento/".$mysqli->getLinkJuegoFromComentario($idEv)[0]['link'];
    $mysqli->modificarComentario($_POST, $idEv);
    header("Location: ".$link);
  } else {
    echo $twig->render('modificarcomentario.html', ['usuario' => $usuario, 'comentario' => $comentariooriginal]); //Pasamos información de juegos para la portada a la plantilla 
  }
} else {
  $linkjuego = $mysqli->getLinkJuegoFromComentario($idEv)[0]['link'];
  $link = "evento/" . $linkjuego;

  echo $twig->render('mensaje.html', ['link' => $link,'usuario' => $usuario,  'tipo' => 'Error', 'mensaje' => "No tiene acceso a esta información"]); //Pasamos información de juegos para la portada a la plantilla 
}
