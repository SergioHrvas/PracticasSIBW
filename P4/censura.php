<?php

include "mysql.php";
$mysqli = new Database();

$mysqli->identificarse();

$palabras = $mysqli->getCensura($mysqli);
echo json_encode($palabras); //Pasamos palabras censuradas a javascript
?>