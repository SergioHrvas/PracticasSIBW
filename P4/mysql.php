<?php
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
public function getJuegos($idEv, $num)
{   
    $numproductos = $this->mysqli->query("SELECT COUNT(*) FROM juegos");
    $num = $numproductos->fetch_assoc();

    //Rotacion de juegos
    $num =  $num["COUNT(*)"];
    $menor = (($idEv - 1)*$num + 1);
    if($menor > $num){
        $menor=$menor%$num+1;
    }
    $mayor = ($menor+$num-1);
    if($mayor > $num){
         $mayor = $mayor%$num;
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
    $res = $this->mysqli->query("SELECT id FROM juegos WHERE link='$idEv'");
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


public function getPaises()
{
    $res = $this->mysqli->query("SELECT * FROM paises");

    $row = array('id' => 'Not Found', 'nombre' => 'Not Found');
    if ($res->num_rows > 0) {
        $rows = array();
        while ($row = $res->fetch_assoc()) {
            $rows[] = array('id' => $row['id'], 'nombre' => $row['name']);
        }
    }
    return $rows;
}

public function nuevoUsuario($valores)
{   
    $res = $this->mysqli->prepare('INSERT INTO usuarios(username, password, nombre, apellidos, telefono, correo, pais) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $valores['password'] = password_hash($valores['password'], PASSWORD_DEFAULT);
    $res->bind_param('ssssssi',$valores['user_name'],$valores['password'],$valores['nombre'],$valores['apellidos'],$valores['telefono'],$valores['correo'],$valores['pais']);
    $res->execute(); 
}

public function logearUsuario($valores)
{
    $res = $this->mysqli->prepare('SELECT password FROM usuarios WHERE username=?');
    $res->bind_param('s',$valores['username']);
    $res->execute();   
    $resultado = $res->get_result();
    $resultado = $resultado->fetch_assoc();

    if(password_verify($valores['password'], $resultado['password']))
        return true;
    else{
        return false;
        }

}


public function getDatosUsuario($nombreusuario){
    $res = $this->mysqli->prepare('SELECT username,nombre, apellidos, telefono,correo, pais, imagen_perfil, twitter, facebook, instagram, moderador, gestor, super FROM usuarios WHERE username=?');
    $res->bind_param('s', $nombreusuario);
    $res->execute();
    $res = $res->get_result();
    $row = array('username' => 'Not Found', 'nombre' => 'Not Found', 'apellidos' => 'Not Found', 'telefono' => 'Not Found', 'correo' => 'Not Found', 'pais' => 'Not Found', 'imagen_perfil' => 'Not Found', 'twitter' => 'Not Found', 'facebook' => 'Not Found', 'instagram' => 'Not Found', 'moderador' => 'Not Found', 'gestor' => 'Not Found', 'super' => 'Not Found');
    if ($res->num_rows > 0) {
        $rows = array();
        while ($row = $res->fetch_assoc()) {
            $rows[] = array('username' => $row['username'], 'nombre' => $row['nombre'], 'apellidos' => $row['apellidos'], 'telefono' => $row['telefono'], 'correo' => $row['correo'], 'pais' => $row['pais'], 'imagen_perfil' => $row['imagen_perfil'], 'twitter'=>$row['twitter'], 'facebook' => $row['facebook'], 'instagram' => $row['instagram'], 'moderador' => $row['moderador'], 'gestor' => $row['gestor'], 'super'=> $row['super']);
        }
    }
    return $rows;
}


public function getDatosBasicos($nombreusuario){
    $res = $this->mysqli->prepare('SELECT imagen_perfil, moderador, gestor, super FROM usuarios WHERE username=?');
    $res->bind_param('s', $nombreusuario);
    $res->execute();
    $res = $res->get_result();
    $row = array('imagen_perfil' => 'Not Found','moderador' => 'Not Found', 'gestor' => 'Not Found', 'super' => 'Not Found');
    if ($res->num_rows > 0) {
        $rows = array();
        while ($row = $res->fetch_assoc()) {
            $rows[] = array('imagen_perfil' => $row['imagen_perfil'], 'moderador' => $row['moderador'], 'gestor' => $row['gestor'], 'super'=> $row['super']);
        }
    }

    return $rows;
}
public function cambiarImagenPerfil($nombre, $usuario){
    $res = $this->mysqli->prepare('UPDATE usuarios SET imagen_perfil=? WHERE username=?');
    $res->bind_param('ss',$nombre, $usuario);
    $res->execute();
}

public function getPais($numero){
    $res = $this->mysqli->prepare('SELECT * FROM paises WHERE id=?');
    $res->bind_param('i',$numero);
    $res->execute();
    $res = $res->get_result();
    $row = array('id' => 'Not Found', 'alpha_2' => 'Not Found', 'alpha_3' => 'Not Found', 'name' => 'Not Found');
    if ($res->num_rows > 0) {
        $rows = array();
        while ($row = $res->fetch_assoc()) {
            $rows[] = array('id' => $row['id'], 'alpha_2' => $row['alpha_2'], 'alpha_3' => $row['alpha_3'], 'name' => $row['name']);
        }
    }
    return $rows;
}

public function modificarPerfil($datos){
    $res = $this->mysqli->prepare('UPDATE usuarios SET nombre=?, apellidos=?, imagen_perfil = ?, telefono=?, correo=?, pais=?, twitter=?, facebook=?, instagram=? WHERE username=?');
    $res->bind_param('sssssissss', $datos['nombre'], $datos['apellidos'], $datos['imagenperfil'], $datos['telefono'], $datos['correo'], $datos['pais'], $datos['twitter'], $datos['facebook'], $datos['instagram'], $datos['username']);
    $res->execute();

}

public function crearProducto($valores)
{   
    $res = $this->mysqli->prepare('INSERT INTO juegos(titulo, descripcion, portada, desarrollador, precio, video, fecha, genero, plataforma, puntuacion, web, masinfo, facebook, twitter, instagram, link) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $res->bind_param('ssssdssssissssss',$valores['titulojuego'],$valores['descripcion'],$valores['portada'],$valores['desarrollador'],$valores['preciojuego'],$valores['video'],date($valores['fecha']),$valores['genero'],$valores['plataforma'],$valores['puntuacion'],$valores['web'],$valores['masinfo'],$valores['facebook'],$valores['twitter'],$valores['instagram'],$valores['link']);
    $res->execute(); 
}

public function modificarProducto($valores)
{   
    $res = $this->mysqli->prepare('UPDATE juegos SET titulo=?, descripcion=?, portada=?, desarrollador=?, precio=?, video=?, fecha=?, genero=?, plataforma=?, puntuacion=?, web=?, masinfo=?, facebook=?, twitter=?, instagram=?, link=? WHERE id=?');
    $res->bind_param('ssssdssssissssssi',$valores['titulojuego'],$valores['descripcion'],$valores['portadajuego'],$valores['desarrollador'],$valores['preciojuego'],$valores['video'],$valores['fecha'],$valores['genero'],$valores['plataforma'],$valores['puntuacion'],$valores['web'],$valores['masinfo'],$valores['facebook'],$valores['twitter'],$valores['instagram'],$valores['link'],$valores['id']);
    $res->execute(); 
}

public function eliminarproducto($valores){
    print($valores);
    $res = $this->mysqli->prepare('DELETE FROM juegos WHERE id=?');
    $res->bind_param('i',$valores);
    $res->execute(); 
}

}


?>