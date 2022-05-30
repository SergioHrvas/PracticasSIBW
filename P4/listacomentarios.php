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
$idEv = 1;
global $mysqli;

if (isset($_GET['ev'])) {
    $idEv = $_GET['ev'];
}
else {
    $idEv = 1;
}
session_start();

$mysqli = new Database();
$mysqli->identificarse();

if(isset($_SESSION['nickUsuario'])){
    $nombreUsuario = $_SESSION['nickUsuario'];
    $usuario = $mysqli->getDatosBasicos($nombreUsuario);
 }

$comentarios = $mysqli->getTodosComentarios();

//iterar comentarios
if($comentarios!=null){
    foreach ($comentarios as $key => $value) {
        $comentarios[$key]['autor'] = $mysqli->getDatosUsuarioPorId($comentarios[$key]['id_usuario'])[0];
        $comentarios[$key]['juego'] = $mysqli->getEvento($comentarios[$key]['id_juego']);
      }
}
echo $twig->render('listacomentarios.html', ['comentarios' => $comentarios, 'usuario' => $usuario]); //Pasamos información de juegos para la portada a la plantilla 

?>