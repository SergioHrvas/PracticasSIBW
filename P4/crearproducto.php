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

if(isset($_SESSION['nickUsuario'])){
  $nombreUsuario = $_SESSION['nickUsuario'];
  $usuario = $mysqli->getDatosBasicos($nombreUsuario);
}

$idjuego = $mysqli->getId($idEv);
$juego = $mysqli->getEvento($idjuego);

if($usuario[0]['gestor']==1){
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(isset($_FILES['portada'])){
      $errors= array();
      $file_name = $_FILES['portada']['name'];
      $file_size = $_FILES['portada']['size'];
      $file_tmp = $_FILES['portada']['tmp_name'];
      $file_type = $_FILES['portada']['type'];
      $file_ext = strtolower(end(explode('.',$_FILES['portada']['name'])));

      $extensions= array("jpeg","jpg","png");
      
      if (in_array($file_ext,$extensions) === false){
        $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
      }
      
      if ($file_size > 2097152){
        $errors[] = 'Tamaño del fichero demasiado grande';
      }
      
      if (empty($errors)==true) {
        move_uploaded_file($file_tmp, "./status/image/" . $file_name);
        
        $varsParaTwig['portada'] = "./status/image/" . $file_name;
      }
      
      if (sizeof($errors) > 0) {
        $varsParaTwig['errores'] = $errors;
      }

      $valores = $_POST;
      $valores['portada'] = $file_name;
      $mysqli->crearProducto($valores);


  }
}


    /*
    if (checkLogin($nick, $pass)) {
      session_start();
      
      $_SESSION['nickUsuario'] = $nick;  // guardo en la sesión el nick del usuario que se ha logueado
    }
    
    header("Location: unaPaginaCualquiera.php");*/

    
    
    echo $twig->render('crearproducto.html',['usuario'=>$usuario, 'producto' => $producto]); //Pasamos información de juegos para la portada a la plantilla 
    
  }
  else{
    echo $twig->render('error.html',['mensaje'=>"No tiene acceso a esta información"]); //Pasamos información de juegos para la portada a la plantilla 

  }



?>