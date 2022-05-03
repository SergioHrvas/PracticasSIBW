<?php
<<<<<<< HEAD
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
=======
class Database
{
    private $mysqli;

//Obtener información del producto
    public function getEvento($idEv)
{
    $res = $this->mysqli->prepare("SELECT titulo, descripcion, portada, precio,video, fecha, genero, plataforma, desarrollador, puntuacion, web, masinfo, facebook, twitter, instagram, link FROM juegos WHERE id= ?");
    $com = $res->bind_param("i",$idEv);
    $res->execute();
    $res = $res->get_result();

    $evento = array('titulo' => 'Not Found', 'descripcion' => 'Not Found', 'portada' => 'Not Found', 'precio' => 0.00, 'video' => 'Not Found', 'fecha' => '1900-01-01', 'genero' => 'Not Found', 'plataforma' => 'Not Found', 'desarrollador' => 'Not Found', 'puntuacion' => -1, 'web' => 'Not Found', 'masinfo' => 'Not Found', 'facebook' => 'Not Found', 'twitter' => 'Not Found', 'instagram' => 'Not Found', 'link' => 'Not Found');
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $evento = array('titulo' => $row['titulo'], 'descripcion' => $row['descripcion'], 'portada' => $row['portada'], 'precio' => $row['precio'], 'video' => $row['video'], 'fecha' => $row['fecha'], 'genero' => $row['genero'], 'plataforma' => $row['plataforma'], 'desarrollador' => $row['desarrollador'], 'puntuacion' => $row['puntuacion'], 'web' => $row['web'], 'masinfo' => $row['masinfo'], 'facebook' => $row['facebook'], 'twitter' => $row['twitter'], 'instagram' => $row['instagram'], 'link' => $row['link']);
    }
    return $evento;
}

//Obtener información del juego para la portada
public function getJuegos($idEv)
{   
    $numproductos = $this->mysqli->query("SELECT COUNT(*) FROM juegos");
    $num = $numproductos->fetch_assoc();

    //Rotacion de juegos
    $num =  $num["COUNT(*)"];
    $menor = (($idEv - 1)*9 + 1);
    if($menor > $num){
        $menor=$menor%$num;
    }
    $mayor = ($menor+8);
    if($mayor > $num){
         $mayor = $mayor%$num;
    }
    if($menor==0){
       $menor+=1;
       $mayor+=1;
    }
    if($mayor<$menor){
        $res = $this->mysqli->query("SELECT id, titulo, portada, link FROM juegos WHERE id >= " . $menor . " UNION SELECT id,titulo,portada,link FROM juegos WHERE id <= " . $mayor);
    }
    else{
        $res = $this->mysqli->query("SELECT id, titulo, portada, link FROM juegos WHERE id >= " . $menor  . " AND id <= " . $mayor );
    }   
    
    $row = array('id' => 'Not Found', 'titulo' => 'Not Found', 'portada' => 'Not Found', 'link' => 'Not Found');
    if ($res->num_rows > 0) {
        $rows = array();
        while ($row = $res->fetch_assoc()) {
            $rows[] = array('id' => $row['id'], 'titulo' => $row['titulo'], 'portada' => $row['portada'], 'link' => $row['link']);
        }
    }
    return $rows;
}

//Obtener el id de un juego por el nombre
public function getId($idEv){
    $res = $this->mysqli->query("SELECT id FROM juegos WHERE link = '$idEv'");
    $id = $res->fetch_assoc();
    $num = $id['id'];
    return $num;
}

//Obtener los comentarios de un juego
public function getComentarios($idEv)
{
    $res = $this->mysqli->prepare("SELECT * FROM comentarios WHERE juego_id=?");
    $com = $res->bind_param('i',$idEv);
    $res->execute();
    $res = $res->get_result();

    $row = array('titulo' => 'Not Found', 'nombreyapellidos' => 'Not Found', 'descripcion' => 'Not Found', 'fecha' => 'Not Found', 'img' => 'Not Found');
    if ($res->num_rows > 0) {
        $rows = array();
        while ($row = $res->fetch_assoc()) {
            $rows[] = array('titulo' => $row['titulo'], 'nombreyapellidos' => $row['nombreyapellidos'], 'descripcion' => $row['descripcion'], 'fecha' => $row['fecha'], 'img' => $row['img']);
        }
    }
    return $rows;
}

//Identificarse en la base de datos
public function identificarse()
{
    $this->mysqli = new mysqli("mysql", "sergiohc", "sergiosibw", "SIBW");
    if ($this->mysqli->connect_errno) {
        echo("Fallo al conectar: " . $this->mysqli->connect_error);
    }
}

//Obtener las palabras censuradas
public function getCensura(){
    $res = $this->mysqli->query("SELECT * FROM malaspalabras");
    $row = array('palabra' => 'Not Found');

    if ($res->num_rows > 0) {
        $rows = array();
        while ($row = $res->fetch_assoc()) {
            $rows[] = array('palabra' => $row['palabra']);
        }
    }
    return $rows;
}

//Obtener las imágenes de la galería de un producto
public function getGaleria($idEv){
    $res = $this->mysqli->prepare("SELECT * FROM imagenes WHERE id_juego=?");
    $res->bind_param('i',$idEv);
    $res->execute();
    $res = $res->get_result();
    
    $row = array('img' => 'Not Found', 'id_juego' => 'Not Found', 'descripcion' => 'Not Found');
    if ($res->num_rows > 0) {
        $rows = array();
        while ($row = $res->fetch_assoc()) {
            $rows[] = array('img' => $row['img'], 'id_juego' => $row['id_juego'], 'descripcion' => $row['descripcion']);
        }
    }
    return $rows;
}
}


?>

>>>>>>> a80124e (Ultimo)
