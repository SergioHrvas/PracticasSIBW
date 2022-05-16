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
  $usuario = $mysqli->getDatosUsuario($nombreUsuario);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(isset($_FILES['imagenperfil'])){
      $errors= array();
      $file_name = $_FILES['imagenperfil']['name'];
      $file_size = $_FILES['imagenperfil']['size'];
      $file_tmp = $_FILES['imagenperfil']['tmp_name'];
      $file_type = $_FILES['imagenperfil']['type'];
      $file_ext = strtolower(end(explode('.',$_FILES['imagenperfil']['name'])));

      $extensions= array("jpeg","jpg","png");
      
      if (in_array($file_ext,$extensions) === false){
        $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
      }
      
      if ($file_size > 2097152){
        $errors[] = 'Tamaño del fichero demasiado grande';
      }
      
      if (empty($errors)==true) {
        move_uploaded_file($file_tmp, "./status/image/" . $file_name);
        
        $varsParaTwig['imagenperfil'] = "./status/image/" . $file_name;
      }
      
      if (sizeof($errors) > 0) {
        $varsParaTwig['errores'] = $errors;
      }

    $mysqli->cambiarImagenPerfil($file_name, $nombreUsuario);
    if(isset($_SESSION['nickUsuario'])){
      $nombreUsuario = $_SESSION['nickUsuario'];
      $usuario = $mysqli->getDatosUsuario($nombreUsuario);
    }
    
  }
}


    /*
    if (checkLogin($nick, $pass)) {
      session_start();
      
      $_SESSION['nickUsuario'] = $nick;  // guardo en la sesión el nick del usuario que se ha logueado
    }
    
    header("Location: unaPaginaCualquiera.php");*/



    $paises = $mysqli->getPaises();
    
    
    echo $twig->render('modificarperfil.html',['paises' => $paises, 'usuario'=>$usuario]); //Pasamos información de juegos para la portada a la plantilla 
    




?>