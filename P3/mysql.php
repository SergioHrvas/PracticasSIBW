<?php
function getEvento($idEv)
{
    $mysqli = new mysqli("mysql", "sergiohcobo", "smpahc13", "SIBW");
    if ($mysqli->connect_errno) {
        echo("Fallo al conectar: " . $mysqli->connect_error);
    }
    $res = $mysqli->query("SELECT titulo, descripcion, portada, imagen FROM eventos WHERE id=" . $idEv);
    $evento = array('titulo' => 'Not Found', 'descripcion' => 'Not Found', 'portada' => 'Not Found', 'imagen' => 'Not Found');
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $evento = array('titulo' => $row['titulo'], 'descripcion' => $row['descripcion'], 'portada' => $row['portada'], 'imagen' => $row['imagen']);

    }
    return $evento;
}
?>