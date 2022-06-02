<?php

// Inicializamos el motor de plantillas
require_once '/usr/local/lib/php/vendor/autoload.php';
include "mysql.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
// Averiguo que la página que se quiere mostrar es la del producto 12,
// porque hemos accedido desde http://localhost/?producto=12
// Busco en la base de datos la información del producto y lo
// almaceno en las variables $productoNombre, $productoMarca, $productoFoto...
$mysqli = new Database();

$mysqli->identificarse();
session_start();

if (isset($_SESSION['nickUsuario'])) {
  $nombreUsuario = $_SESSION['nickUsuario'];
  $usuario = $mysqli->getDatosUsuario($nombreUsuario);
}

$idjuego = $mysqli->getId($idEv);
$juego = $mysqli->getEvento($idjuego);

if ($usuario[0]['gestor'] == 1 or $usuario[0]['super'] == 1) {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['portada'])) {
      $errors = array();
      $file_name_p = $_FILES['portada']['name'];
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
        move_uploaded_file($file_tmp, "./status/image/" . $file_name_p);

        $varsParaTwig['portada'] = "./status/image/" . $file_name_p;
      }

      if (sizeof($errors) > 0) {
        $varsParaTwig['errores'] = $errors;
      }
    }
    if (isset($_FILES['imagenes'])) {
      $errors = array();


      //Iterate $_FILES['imagenes']['name']
      foreach ($_FILES['imagenes']['name'] as $key => $value) {
        $file_name = $_FILES['imagenes']['name'][$key];
        $file_size = $_FILES['imagenes']['size'][$key];
        $file_tmp = $_FILES['imagenes']['tmp_name'][$key];
        $file_type = $_FILES['imagenes']['type'][$key];
        $file_ext = strtolower(end(explode('.', $_FILES['imagenes']['name'][$key])));


        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
          $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
        }

        if ($file_size > 2097152) {
          $errors[] = 'Tamaño del fichero demasiado grande';
        }

        if (empty($errors) == true) {
          move_uploaded_file($file_tmp, "./status/image/juegos/" . $file_name);
          $varsParaTwig['portada'] = "./status/image/juegos/" . $file_name;
        }

        if (sizeof($errors) > 0) {
          $varsParaTwig['errores'] = $errors;
        }
      }
    }

    $valores = $_POST;
    if ($valores['preciojuego'] == "") {
      $valores['preciojuego'] = 999.999;
    }
    if ($valores['fecha'] == "") {
      $valores['fecha'] = "2001-01-01";
    }
    if ($valores['puntuacion'] == "") {
      $valores['puntuacion'] = 1;
    }


    $valores['portada'] = $file_name_p;
    $mysqli->crearProducto($valores);
    // print($mysqli->getInsertId());
    // print("<br/>");
    $idjuego = $mysqli->getInsertId();
    //Print all values of $valores['label']
    foreach ($valores['label'] as $key => $value) {
      // print($valores['label'][$key] . " - " . $idjuego . "<br/>");
      $mysqli->añadirEtiquetas($valores['label'][$key], $idjuego);
    }

    if (isset($_FILES['imagenes'])) {
      echo $twig->render('añadirdescripcion.html', ['usuario' => $usuario, 'imagenes' => $_FILES['imagenes']['name'], 'link' => $_POST['link']]);
    } else {
      echo $twig->render('mensaje.html', ['tipo'=>':)','mensaje' => "Producto creado correctamente"]);
    }
  }
  if (!isset($_FILES['imagenes']))
    echo $twig->render('crearproducto.html', ['usuario' => $usuario, 'producto' => $producto]); //Pasamos información de juegos para la portada a la plantilla 

} else {
  echo $twig->render('mensaje.html', ['tipo'=>'Error','usuario' => $usuario, 'mensaje' => "No tiene acceso a esta información"]); //Pasamos información de juegos para la portada a la plantilla 

}
?>