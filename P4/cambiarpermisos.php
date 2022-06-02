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
$mysqli = new Database();

$mysqli->identificarse();


if (isset($_GET['ev'])) {
  $idEv = $_GET['ev'];
} else {
  $idEv = 1;
}

if (isset($_SESSION['nickUsuario'])) {
  $nombreUsuario = $_SESSION['nickUsuario'];
  $usuario = $mysqli->getDatosUsuario($nombreUsuario);
}
$user = $mysqli->getDatosUsuario($idEv);

//Si usuario es super
if ($usuario['super']) {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valores = $_POST;

    //Print $valores
    if ($valores['moderador'] == "") {
      $valores['moderador'] = 0;
    }
    if ($valores['gestor'] == "") {
      $valores['gestor'] = 0;
    }
    if ($valores['super'] == "") {
      $valores['super'] = 0;
    }

    $mysqli->cambiarPermisos($valores, $user[0]['id']);
    echo $twig->render('mensaje.html', ['tipo' => ':)', 'usuario' => $usuario, 'mensaje' => "Permisos modificados correctamente"]);
  } else {


    $user = $mysqli->getDatosUsuario($idEv);


    echo $twig->render('cambiarpermisos.html', ['usuario' => $usuario, 'user' => $user]); //Pasamos información de juegos para la portada a la plantilla 
  }
} else {

  echo $twig->render('mensaje.html', ['tipo' => 'Error', 'usuario' => $usuario, 'mensaje' => "No tiene acceso a esta información"]);
}
?>