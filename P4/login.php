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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valores = $_POST;

    $v = $mysqli->logearUsuario($valores);

    if ($v) {
      session_start();
     // print($valores['username']);
      $_SESSION['nickUsuario'] = $valores['username'];  // guardo en la sesión el nick del usuario que se ha logueado
    }
    
    header("Location: index.php");
   // exit();
    }
else{

echo $twig->render('login.html'); //Pasamos información de juegos para la portada a la plantilla 
}
?>