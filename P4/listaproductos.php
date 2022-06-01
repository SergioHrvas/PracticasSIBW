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

if($usuario[0]['gestor']==1){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $valores = $_POST;
        $evento = $mysqli->getJuegosContiene($valores['busqueda']);


    }
    else{
        $evento = $mysqli->getTodosJuegos();
    }
    echo $twig->render('listaproductos.html', ['juegos' => $evento, 'usuario' => $usuario]); //Pasamos información de juegos para la portada a la plantilla 
   
}
else{
    echo $twig->render('error.html', ['mensaje' => "No tienes permiso"]);
}
?>