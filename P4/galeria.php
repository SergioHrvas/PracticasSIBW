<?php
include "mysql.php";
$idEv = 1;
if (isset($_GET['ev'])) {
    $idEv = $_GET['ev'];
} else {
    $idEv = 1;
}
$mysqli = new Database();

$mysqli->identificarse();
$idEv = $mysqli->getId($idEv);

$galeria = $mysqli->getGaleria($idEv);
echo json_encode($galeria); //Pasamos imágenes de la galería a javascript
?>