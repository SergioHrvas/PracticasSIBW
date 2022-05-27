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

if (isset($_GET['ev'])) {
    $idEv = $_GET['ev'];
}
else {
     $idEv = "leyendas";
}

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
        
         
        $mysqli->crearComentario($valores);
  
  
    }
  }
session_start();
$mysqli = new Database();
$mysqli->identificarse();

if(isset($_SESSION['nickUsuario'])){
    $nombreUsuario = $_SESSION['nickUsuario'];
    $usuario = $mysqli->getDatosBasicos($nombreUsuario);
 }

$idEv=$mysqli->getId($idEv);

$evento = $mysqli->getEvento($idEv);
$comentarios = $mysqli->getComentarios($idEv);
$imagenes = $mysqli->getGaleria($idEv);

$evento['descripcion'] = nl2br($evento['descripcion']);
echo $twig->render('producto.html', ['evento' => $evento, 'comentarios' => $comentarios, 'imagenes' => $imagenes, 'usuario' => $usuario]); //Pasamos información completa de un juego a la plantilla
?>