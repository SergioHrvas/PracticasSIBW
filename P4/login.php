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
    print($valores['username']);
    print($valores['password']);

    $v = $mysqli->logearUsuario($valores);
    if($v){
        print("Usuario registrado con éxito");
    }
    else{
        print("Usuario no registrado con exito");
    }
  /*
    if (checkLogin($nick, $pass)) {
      session_start();
      
      $_SESSION['nickUsuario'] = $nick;  // guardo en la sesión el nick del usuario que se ha logueado
    }
    
    header("Location: unaPaginaCualquiera.php");*/
    }


echo $twig->render('login.html'); //Pasamos información de juegos para la portada a la plantilla 

?>
