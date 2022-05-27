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
if (isset($_GET['ev'])) {
  $idEv = $_GET['ev'];
}
else {
   $idEv = "leyendas";
}

session_start();

if(isset($_SESSION['nickUsuario'])){
  $nombreUsuario = $_SESSION['nickUsuario'];
  $usuario = $mysqli->getDatosBasicos($nombreUsuario);
}

$idjuego = $mysqli->getId($idEv);
if($usuario[0]['gestor']==1){
  print($idjuego);

  $mysqli->eliminarProducto($idjuego);
   echo $twig->render('error.html',['mensaje'=>"Producto eliminado correctamente"]); //Pasamos información de juegos para la portada a la plantilla 

}

    /*
    if (checkLogin($nick, $pass)) {
      session_start();
      
      $_SESSION['nickUsuario'] = $nick;  // guardo en la sesión el nick del usuario que se ha logueado
    }
    
    header("Location: unaPaginaCualquiera.php");*/

    
    
  
  else{
    echo $twig->render('error.html',['mensaje'=>"No tiene acceso a esta información"]); //Pasamos información de juegos para la portada a la plantilla 

  }



?>