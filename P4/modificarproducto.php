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
  $idEv = "leyendas";
}

if (isset($_SESSION['nickUsuario'])) {
  $nombreUsuario = $_SESSION['nickUsuario'];
  $usuario = $mysqli->getDatosUsuario($nombreUsuario);
}

$link="evento/".$idEv;
$idjuego = $mysqli->getId($idEv);
$juego = $mysqli->getEvento($idjuego);
if ($usuario[0]['gestor'] == 1) {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['portada'])) {
      $errors = array();
      $file_name = $_FILES['portada']['name'];
      $file_size = $_FILES['portada']['size'];
      $file_tmp = $_FILES['portada']['tmp_name'];
      $file_type = $_FILES['portada']['type'];
      $file_ext = strtolower(end(explode('.', $_FILES['portada']['name'])));

      $extensions = array("jpeg", "jpg", "png");

      if (in_array($file_ext, $extensions) === false) {
        $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
      }

      if ($file_size > 2097152) {
        $errors[] = 'Tamaño del fichero demasiado grande';
      }

      if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "./status/image/portadas/" . $file_name);
        $varsParaTwig['portada'] = "./status/image/portadas/" . $file_name;
      }

      if (sizeof($errors) > 0) {
        $varsParaTwig['errores'] = $errors;
      }

      $valores = $_POST;
      $valores['portadajuego'] = $file_name;


      if ($valores['titulojuego'] == "") {
        $valores['titulojuego'] = $juego['titulo'];
      }
      if ($valores['descripcion'] == "") {
        $valores['descripcion'] = $juego['descripcion'];
      }
      if ($valores['portadajuego'] == "") {
        $valores['portadajuego'] = $juego['portada'];
      }
      if ($valores['desarrollador'] == "") {
        $valores['desarrollador'] = $juego['desarrollador'];
      }
      if ($valores['preciojuego'] == "") {
        $valores['preciojuego'] = $juego['precio'];
      }
      if ($valores['video'] == "") {
        $valores['video'] = $juego['video'];
      }
      if ($valores['fecha'] == "") {
        $valores['fecha'] = $juego['fecha'];
      }
      if ($valores['genero'] == "") {
        $valores['genero'] = $juego['genero'];
      }
      if ($valores['plataforma'] == "") {
        $valores['plataforma'] = $juego['plataforma'];
      }
      if ($valores['puntuacion'] == "") {
        $valores['puntuacion'] = $juego['puntuacion'];
      }
      if ($valores['web'] == "") {
        $valores['web'] = $juego['web'];
      }
      if ($valores['masinfo'] == "") {
        $valores['masinfo'] = $juego['masinfo'];
      }
      if ($valores['facebook'] == "") {
        $valores['facebook'] = $juego['facebook'];
      }
      if ($valores['twitter'] == "") {
        $valores['twitter'] = $juego['twitter'];
      }
      if ($valores['instagram'] == "") {
        $valores['instagram'] = $juego['instagram'];
      }
      if ($valores['link'] == "") {
        $valores['link'] = $juego['link'];
      }
      $valores['id'] = $idjuego;
      $mysqli->modificarProducto($valores);
    }
    echo $twig->render('mensaje.html', ['link'=>$link,'tipo' => ":)", 'mensaje' => "Producto modificado correctamente"]);
  } else {
    echo $twig->render('modificarproducto.html', ['usuario' => $usuario, 'producto' => $juego]);
  }
} else {
  
  echo $twig->render('mensaje.html', ['link'=>$link,'tipo' => 'Error', 'mensaje' => "No tiene acceso a esta información"]);
}
?>