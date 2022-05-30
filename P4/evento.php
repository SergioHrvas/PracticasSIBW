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
}
else {
     $idEv = "leyendas";
}


$mysqli = new Database();
$mysqli->identificarse();

if(isset($_SESSION['nickUsuario'])){
    $nombreUsuario = $_SESSION['nickUsuario'];
    $usuario = $mysqli->getDatosBasicos($nombreUsuario);
 }


$idEv=$mysqli->getId($idEv);

$evento = $mysqli->getEvento($idEv);
$comentarios = $mysqli->getComentarios($idEv);

//traverse array comentarios
if($comentarios!=null){
    foreach ($comentarios as $key => $value) {
        $comentarios[$key]['autor'] = $mysqli->getDatosUsuarioPorId($comentarios[$key]['id_usuario'])[0];
      
      }
}





$imagenes = $mysqli->getGaleria($idEv);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $valores = $_POST;
        $valores['id_juego'] = $idEv;
        $valores['id_usuario'] = $usuario[0]['id'];

    
        $mysqli->insertarComentario($valores);
  

}


$evento['descripcion'] = nl2br($evento['descripcion']);
echo $twig->render('producto.html', ['evento' => $evento, 'comentarios' => $comentarios, 'imagenes' => $imagenes, 'usuario' => $usuario]); //Pasamos información completa de un juego a la plantilla
?>