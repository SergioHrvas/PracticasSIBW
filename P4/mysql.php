<?php
class Database
{
    private $mysqli;

    //Obtener información del producto
    public function getEvento($idEv)
    {
        $res = $this->mysqli->prepare("SELECT id,titulo, descripcion, portada, precio,video, fecha, genero, plataforma, desarrollador, puntuacion, web, masinfo, facebook, twitter, instagram, link FROM juegos WHERE id= ?");
        $com = $res->bind_param("i", $idEv);
        $res->execute();
        $res = $res->get_result();

        $evento = array('id' => 'Not Found', 'titulo' => 'Not Found', 'descripcion' => 'Not Found', 'portada' => 'Not Found', 'precio' => 0.00, 'video' => 'Not Found', 'fecha' => '1900-01-01', 'genero' => 'Not Found', 'plataforma' => 'Not Found', 'desarrollador' => 'Not Found', 'puntuacion' => -1, 'web' => 'Not Found', 'masinfo' => 'Not Found', 'facebook' => 'Not Found', 'twitter' => 'Not Found', 'instagram' => 'Not Found', 'link' => 'Not Found');
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $evento = array('id' => $row['id'], 'titulo' => $row['titulo'], 'descripcion' => $row['descripcion'], 'portada' => $row['portada'], 'precio' => $row['precio'], 'video' => $row['video'], 'fecha' => $row['fecha'], 'genero' => $row['genero'], 'plataforma' => $row['plataforma'], 'desarrollador' => $row['desarrollador'], 'puntuacion' => $row['puntuacion'], 'web' => $row['web'], 'masinfo' => $row['masinfo'], 'facebook' => $row['facebook'], 'twitter' => $row['twitter'], 'instagram' => $row['instagram'], 'link' => $row['link']);
        }
        return $evento;
    }

    //Obtener informacion de todos los juegos
    public function getTodosJuegos()
    {
        $res = $this->mysqli->prepare("SELECT * FROM juegos ORDER BY titulo");
        $res->execute();
        $res = $res->get_result();

        $juegos = array();

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $juegos[] = array('titulo' => $row['titulo'], 'descripcion' => $row['descripcion'], 'portada' => $row['portada'], 'precio' => $row['precio'], 'video' => $row['video'], 'fecha' => $row['fecha'], 'genero' => $row['genero'], 'plataforma' => $row['plataforma'], 'desarrollador' => $row['desarrollador'], 'puntuacion' => $row['puntuacion'], 'web' => $row['web'], 'masinfo' => $row['masinfo'], 'facebook' => $row['facebook'], 'twitter' => $row['twitter'], 'instagram' => $row['instagram'], 'link' => $row['link']);
            }
        }
        return $juegos;
    }

    //Get 9 next rows in juegos with offset
    public function getNextJuegos($idEv)
    {
        //Obtener número de filas totales de la tabla
        $res = $this->mysqli->prepare("SELECT COUNT(*) FROM juegos");
        $res->execute();
        $res = $res->get_result();
        $row = $res->fetch_row();
        $total = $row[0];

        $offset = (($idEv - 1) * 9) % $total;


        $res = $this->mysqli->prepare("SELECT * FROM juegos ORDER BY id LIMIT 9 OFFSET ?");

        $com = $res->bind_param("i", $offset);
        $res->execute();
        $res = $res->get_result();

        $juegos = array();

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $juegos[] = array('titulo' => $row['titulo'], 'descripcion' => $row['descripcion'], 'portada' => $row['portada'], 'precio' => $row['precio'], 'video' => $row['video'], 'fecha' => $row['fecha'], 'genero' => $row['genero'], 'plataforma' => $row['plataforma'], 'desarrollador' => $row['desarrollador'], 'puntuacion' => $row['puntuacion'], 'web' => $row['web'], 'masinfo' => $row['masinfo'], 'facebook' => $row['facebook'], 'twitter' => $row['twitter'], 'instagram' => $row['instagram'], 'link' => $row['link']);
            }
        }


        $tam = count($juegos);
        if ($tam < 9) {
            $num = 9 - $tam;
            $offset = 0;

            $res = $this->mysqli->prepare("SELECT * FROM juegos ORDER BY id LIMIT ? OFFSET ?");
            $com = $res->bind_param("ii", $num, $offset);
            $res->execute();
            $res = $res->get_result();

            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $juegos[] = array('titulo' => $row['titulo'], 'descripcion' => $row['descripcion'], 'portada' => $row['portada'], 'precio' => $row['precio'], 'video' => $row['video'], 'fecha' => $row['fecha'], 'genero' => $row['genero'], 'plataforma' => $row['plataforma'], 'desarrollador' => $row['desarrollador'], 'puntuacion' => $row['puntuacion'], 'web' => $row['web'], 'masinfo' => $row['masinfo'], 'facebook' => $row['facebook'], 'twitter' => $row['twitter'], 'instagram' => $row['instagram'], 'link' => $row['link']);
                }
            }
        }
        return $juegos;
    }



    //Obtener el id de un juego por el nombre
    public function getId($idEv)
    {
        $res = $this->mysqli->query("SELECT id FROM juegos WHERE link='$idEv'");
        $id = $res->fetch_assoc();
        $num = $id['id'];
        return $num;
    }

    //Identificarse en la base de datos
    public function identificarse()
    {
        $this->mysqli = new mysqli("mysql", "sergiohc", "sergiosibw", "SIBW");
        if ($this->mysqli->connect_errno) {
            echo ("Fallo al conectar: " . $this->mysqli->connect_error);
        }
    }

    //Obtener las palabras censuradas
    public function getCensura()
    {
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
    public function getGaleria($idEv)
    {
        $res = $this->mysqli->prepare("SELECT * FROM imagenes WHERE id_juego=?");
        $res->bind_param('i', $idEv);
        $res->execute();
        $res = $res->get_result();

        $row = array('id' => 'Not Found', 'img' => 'Not Found', 'id_juego' => 'Not Found', 'descripcion' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('id' => $row['id'], 'img' => $row['img'], 'id_juego' => $row['id_juego'], 'descripcion' => $row['descripcion']);
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
        $res->bind_param('ssssssi', $valores['user_name'], $valores['password'], $valores['nombre'], $valores['apellidos'], $valores['telefono'], $valores['correo'], $valores['pais']);
        $res->execute();
    }

    public function logearUsuario($valores)
    {
        $res = $this->mysqli->prepare('SELECT password FROM usuarios WHERE username=?');
        $res->bind_param('s', $valores['username']);
        $res->execute();
        $resultado = $res->get_result();
        $resultado = $resultado->fetch_assoc();

        if (password_verify($valores['password'], $resultado['password']))
            return true;
        else {
            return false;
        }
    }


    public function getDatosUsuario($nombreusuario)
    {
        $res = $this->mysqli->prepare('SELECT id,username,nombre, apellidos, telefono,correo, pais, imagen_perfil, twitter, facebook, instagram, moderador, gestor, super FROM usuarios WHERE username=?');
        $res->bind_param('s', $nombreusuario);
        $res->execute();
        $res = $res->get_result();
        $row = array('id' => 'Not Found', 'username' => 'Not Found', 'nombre' => 'Not Found', 'apellidos' => 'Not Found', 'telefono' => 'Not Found', 'correo' => 'Not Found', 'pais' => 'Not Found', 'imagen_perfil' => 'Not Found', 'twitter' => 'Not Found', 'facebook' => 'Not Found', 'instagram' => 'Not Found', 'moderador' => 'Not Found', 'gestor' => 'Not Found', 'super' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('id' => $row['id'], 'username' => $row['username'], 'nombre' => $row['nombre'], 'apellidos' => $row['apellidos'], 'telefono' => $row['telefono'], 'correo' => $row['correo'], 'pais' => $row['pais'], 'imagen_perfil' => $row['imagen_perfil'], 'twitter' => $row['twitter'], 'facebook' => $row['facebook'], 'instagram' => $row['instagram'], 'moderador' => $row['moderador'], 'gestor' => $row['gestor'], 'super' => $row['super']);
            }
        }
        return $rows;
    }

    public function getDatosUsuarioPorId($id)
    {
        $res = $this->mysqli->prepare('SELECT id,username,nombre, apellidos, telefono,correo, pais, imagen_perfil, twitter, facebook, instagram, moderador, gestor, super FROM usuarios WHERE id=?');
        $res->bind_param('i', $id);
        $res->execute();
        $res = $res->get_result();
        $row = array('id' => 'Not Found', 'username' => 'Not Found', 'nombre' => 'Not Found', 'apellidos' => 'Not Found', 'telefono' => 'Not Found', 'correo' => 'Not Found', 'pais' => 'Not Found', 'imagen_perfil' => 'Not Found', 'twitter' => 'Not Found', 'facebook' => 'Not Found', 'instagram' => 'Not Found', 'moderador' => 'Not Found', 'gestor' => 'Not Found', 'super' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('id' => $row['id'], 'username' => $row['username'], 'nombre' => $row['nombre'], 'apellidos' => $row['apellidos'], 'telefono' => $row['telefono'], 'correo' => $row['correo'], 'pais' => $row['pais'], 'imagen_perfil' => $row['imagen_perfil'], 'twitter' => $row['twitter'], 'facebook' => $row['facebook'], 'instagram' => $row['instagram'], 'moderador' => $row['moderador'], 'gestor' => $row['gestor'], 'super' => $row['super']);
            }
        }
        return $rows;
    }


    public function getDatosBasicos($nombreusuario)
    {
        $res = $this->mysqli->prepare('SELECT id, imagen_perfil, moderador, gestor, super FROM usuarios WHERE username=?');
        $res->bind_param('s', $nombreusuario);
        $res->execute();
        $res = $res->get_result();
        $row = array('id' => 'Not Found', 'imagen_perfil' => 'Not Found', 'moderador' => 'Not Found', 'gestor' => 'Not Found', 'super' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('id' => $row['id'], 'imagen_perfil' => $row['imagen_perfil'], 'moderador' => $row['moderador'], 'gestor' => $row['gestor'], 'super' => $row['super']);
            }
        }

        return $rows;
    }
    public function cambiarImagenPerfil($nombre, $usuario)
    {
        $res = $this->mysqli->prepare('UPDATE usuarios SET imagen_perfil=? WHERE username=?');
        $res->bind_param('ss', $nombre, $usuario);
        $res->execute();
    }

    public function getPais($numero)
    {
        $res = $this->mysqli->prepare('SELECT * FROM paises WHERE id=?');
        $res->bind_param('i', $numero);
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

    public function modificarPerfil($datos)
    {
        $res = $this->mysqli->prepare('UPDATE usuarios SET nombre=?, apellidos=?, imagen_perfil = ?, telefono=?, correo=?, pais=?, twitter=?, facebook=?, instagram=? WHERE username=?');
        $res->bind_param('sssssissss', $datos['nombre'], $datos['apellidos'], $datos['imagenperfil'], $datos['telefono'], $datos['correo'], $datos['pais'], $datos['twitter'], $datos['facebook'], $datos['instagram'], $datos['username']);
        $res->execute();
    }

    public function crearProducto($valores)
    {
        $res = $this->mysqli->prepare('INSERT INTO juegos(titulo, descripcion, portada, desarrollador, precio, video, fecha, genero, plataforma, puntuacion, web, masinfo, facebook, twitter, instagram, link) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $res->bind_param('ssssdssssissssss', $valores['titulojuego'], $valores['descripcion'], $valores['portada'], $valores['desarrollador'], $valores['preciojuego'], $valores['video'], date($valores['fecha']), $valores['genero'], $valores['plataforma'], $valores['puntuacion'], $valores['web'], $valores['masinfo'], $valores['facebook'], $valores['twitter'], $valores['instagram'], $valores['link']);
        $res->execute();
    }

    public function modificarProducto($valores)
    {
        $res = $this->mysqli->prepare('UPDATE juegos SET titulo=?, descripcion=?, portada=?, desarrollador=?, precio=?, video=?, fecha=?, genero=?, plataforma=?, puntuacion=?, web=?, masinfo=?, facebook=?, twitter=?, instagram=?, link=? WHERE id=?');
        $res->bind_param('ssssdssssissssssi', $valores['titulojuego'], $valores['descripcion'], $valores['portadajuego'], $valores['desarrollador'], $valores['preciojuego'], $valores['video'], $valores['fecha'], $valores['genero'], $valores['plataforma'], $valores['puntuacion'], $valores['web'], $valores['masinfo'], $valores['facebook'], $valores['twitter'], $valores['instagram'], $valores['link'], $valores['id']);
        $res->execute();
    }

    public function eliminarproducto($valores)
    {
        $res = $this->mysqli->prepare('DELETE FROM juegos WHERE id=?');
        $res->bind_param('i', $valores);
        $res->execute();
    }

    //Insertar comentario
    public function insertarComentario($valores)
    {
        $res = $this->mysqli->prepare('INSERT INTO comentarios(titulo, juego_id, usuario_id, descripcion, fecha) VALUES (?, ?, ?, ?, convert_tz(now(), "GMT","Europe/Paris"))');
        $res->bind_param('siis', $valores['titulocomentario'], $valores['id_juego'], $valores['id_usuario'], $valores['comentario']);
        $res->execute();
    }

    //Obtener comentarios
    public function getComentarios($idJuego)
    {
        $res = $this->mysqli->prepare('SELECT * FROM comentarios WHERE juego_id=?');
        $res->bind_param('i', $idJuego);
        $res->execute();
        $res = $res->get_result();
        $row = array('id' => 'Not Found', 'titulo' => 'Not Found', 'id_juego' => 'Not Found', 'id_usuario' => 'Not Found', 'comentario' => 'Not Found', 'fecha' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('id' => $row['id'], 'titulo' => $row['titulo'], 'id_juego' => $row['juego_id'], 'id_usuario' => $row['usuario_id'], 'comentario' => $row['descripcion'], 'fecha' => $row['fecha']);
            }
        }
        return $rows;
    }

    //Obtener comentario
    public function getComentario($idComentario)
    {
        $res = $this->mysqli->prepare('SELECT * FROM comentarios WHERE id=?');
        $res->bind_param('i', $idComentario);
        $res->execute();
        $res = $res->get_result();
        $row = array('id' => 'Not Found', 'titulo' => 'Not Found', 'id_juego' => 'Not Found', 'id_usuario' => 'Not Found', 'comentario' => 'Not Found', 'fecha' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('id' => $row['id'], 'titulo' => $row['titulo'], 'id_juego' => $row['juego_id'], 'id_usuario' => $row['usuario_id'], 'comentario' => $row['descripcion'], 'fecha' => $row['fecha']);
            }
        }
        return $rows;
    }

    //Eliminar comentario
    public function eliminarComentario($idComentario)
    {
        $res = $this->mysqli->prepare('DELETE FROM comentarios WHERE id=?');
        $res->bind_param('i', $idComentario);
        $res->execute();
    }

    //Modificar comentario
    public function modificarComentario($valores, $idComentario)
    {
        $res = $this->mysqli->prepare('UPDATE comentarios SET titulo=?, descripcion=? WHERE id=?');
        $res->bind_param('ssi', $valores['titulo'], $valores['descripcion'], $idComentario);
        $res->execute();
    }

    //Insertar imagen
    public function insertarImagen($valores)
    {
        $res = $this->mysqli->prepare('INSERT INTO imagenes(id_juego, img, descripcion) VALUES (?, ?, ?)');
        $res->bind_param('iss', $valores['id_juego'], $valores['imagen'], $valores['descripcion']);
        $res->execute();
    }

    ///Eliminar imagen
    public function eliminarImagen($idImagen)
    {
        $res = $this->mysqli->prepare('DELETE FROM imagenes WHERE id=?');
        $res->bind_param('i', $idImagen);
        $res->execute();
    }

    //Obtener todos los comentarios
    public function getTodosComentarios()
    {
        $res = $this->mysqli->prepare('SELECT * FROM comentarios ORDER BY fecha');
        $res->execute();
        $res = $res->get_result();
        $row = array('id' => 'Not Found', 'titulo' => 'Not Found', 'id_juego' => 'Not Found', 'id_usuario' => 'Not Found', 'comentario' => 'Not Found', 'fecha' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('id' => $row['id'], 'titulo' => $row['titulo'], 'id_juego' => $row['juego_id'], 'id_usuario' => $row['usuario_id'], 'comentario' => $row['descripcion'], 'fecha' => $row['fecha']);
            }
        }
        return $rows;
    }

    //Obtener id de usuario a partir del username
    public function getIdUsuario($username)
    {
        $res = $this->mysqli->prepare('SELECT id FROM usuarios WHERE username=?');
        $res->bind_param('s', $username);
        $res->execute();
        $res = $res->get_result();
        $row = array('id' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('id' => $row['id']);
            }
        }
        return $rows;
    }

    //Cambiar permisos usuario
    public function cambiarPermisos($valores, $idUsuario)
    {
        $res = $this->mysqli->prepare('UPDATE usuarios SET gestor=?, moderador=?, super=? WHERE id=?');
        $res->bind_param('iiii', $valores['gestor'], $valores['moderador'], $valores['super'], $idUsuario);
        $res->execute();
    }

    //Añadir etiquetas
    public function añadirEtiquetas($valor, $idJuego)
    {
        if (!$this->existeEtiqueta($valor, $idJuego)) {
            $res = $this->mysqli->prepare('INSERT INTO etiquetas(texto) VALUES (?)');
            $res->bind_param('s', $valor);
            $res->execute();
        }
        $idEtiqueta = $this->getIdEtiqueta($valor)[0]['id'];

        //Añadir ids a contiene
        $res = $this->mysqli->prepare('INSERT INTO contiene(id_juego, id_etiqueta) VALUES (?,?)');
        $res->bind_param('ii', $idJuego, $idEtiqueta);
        $res->execute();
    }

    public function getIdEtiqueta($valor)
    {
        $res = $this->mysqli->prepare('SELECT id FROM etiquetas WHERE texto=?');
        $res->bind_param('s', $valor);
        $res->execute();
        $res = $res->get_result();
        $row = array('id' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('id' => $row['id']);
            }
        }
        return $rows;
    }

    public function existeEtiqueta($valor, $idJuego)
    {
        $res = $this->mysqli->prepare('SELECT * FROM etiquetas WHERE texto=?');
        $res->bind_param('s', $valor);
        $res->execute();
        $res = $res->get_result();
        $row = array('id' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('id' => $row['id']);
            }
        }
        if ($rows != null) {
            if (count($rows) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Get Etiquetas
    public function getEtiquetas($idJuego)
    {
        $res = $this->mysqli->prepare('SELECT * FROM etiquetas WHERE id IN (SELECT id_etiqueta FROM contiene WHERE id_juego=?)');
        $res->bind_param('i', $idJuego);
        $res->execute();
        $res = $res->get_result();
        $row = array('id' => 'Not Found', 'texto' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('id' => $row['id'], 'texto' => $row['texto']);
            }
        }
        return $rows;
    }

    //get insert_id
    public function getInsertId()
    {
        return $this->mysqli->insert_id;
    }

    public function getEtiqueta($id)
    {
        $res = $this->mysqli->prepare('SELECT * FROM etiquetas WHERE id=?');
        $res->bind_param('i', $id);
        $res->execute();
        $res = $res->get_result();
        $row = array('id' => 'Not Found', 'texto' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('id' => $row['id'], 'texto' => $row['texto']);
            }
        }
        return $rows;
    }
    //Eliminar etiqueta
    public function eliminarEtiqueta($idEtiqueta)
    {
        $res = $this->mysqli->prepare('DELETE FROM etiquetas WHERE id=?');
        $res->bind_param('i', $idEtiqueta);
        $res->execute();
    }

    //Get comments that contain a string in the middle order by date
    public function getComentariosContiene($valor)
    {
        $res = $this->mysqli->prepare('SELECT * FROM comentarios WHERE (descripcion LIKE "%' . $valor . '%") OR (titulo LIKE "%' . $valor . '%") ORDER BY fecha');
        $res->execute();
        $res = $res->get_result();
        $row = array('id' => 'Not Found', 'titulo' => 'Not Found', 'id_juego' => 'Not Found', 'id_usuario' => 'Not Found', 'comentario' => 'Not Found', 'fecha' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('id' => $row['id'], 'titulo' => $row['titulo'], 'id_juego' => $row['juego_id'], 'id_usuario' => $row['usuario_id'], 'comentario' => $row['descripcion'], 'fecha' => $row['fecha']);
            }
        }
        return $rows;
    }

    //Get juegos that contain a string in the middle of a row order by date
    public function getJuegosContiene($valor)
    {
        $res = $this->mysqli->prepare('SELECT * FROM juegos WHERE (titulo LIKE "%' . $valor . '%") OR (descripcion LIKE "%' . $valor . '%") ORDER BY titulo');
        $res->execute();
        $res = $res->get_result();
        $row = array('id' => 'Not Found', 'titulo' => 'Not Found', 'descripcion' => 'Not Found', 'fecha' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('titulo' => $row['titulo'], 'descripcion' => $row['descripcion'], 'portada' => $row['portada'], 'precio' => $row['precio'], 'video' => $row['video'], 'fecha' => $row['fecha'], 'genero' => $row['genero'], 'plataforma' => $row['plataforma'], 'desarrollador' => $row['desarrollador'], 'puntuacion' => $row['puntuacion'], 'web' => $row['web'], 'masinfo' => $row['masinfo'], 'facebook' => $row['facebook'], 'twitter' => $row['twitter'], 'instagram' => $row['instagram'], 'link' => $row['link']);
            }
        }
        return $rows;
    }

    //Obtener autor de un comentario
    public function getAutor($idComentario)
    {
        $res = $this->mysqli->prepare('SELECT usuarios.username FROM usuarios, comentarios WHERE comentarios.id=? AND comentarios.usuario_id=usuarios.id');
        $res->bind_param('i', $idComentario);
        $res->execute();
        $res = $res->get_result();
        $row = array('username' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('username' => $row['username']);
            }
        }
        return $rows;
    }

    //obtener link del juego de un comentario
    public function getLinkJuegoFromComentario($idComentario)
    {
        $res = $this->mysqli->prepare('SELECT juegos.link FROM juegos, comentarios WHERE comentarios.id=? AND comentarios.juego_id=juegos.id');
        $res->bind_param('i', $idComentario);
        $res->execute();
        $res = $res->get_result();
        $row = array('link' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('link' => $row['link']);
            }
        }
        return $rows;
    }

    //obtener link del juego de una imagen
    public function getLinkJuegoFromImagen($idImagen)
    {
        $res = $this->mysqli->prepare('SELECT juegos.link FROM juegos, imagenes WHERE imagenes.id=? AND imagenes.id_juego=juegos.id');
        $res->bind_param('i', $idImagen);
        $res->execute();
        $res = $res->get_result();
        $row = array('link' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('link' => $row['link']);
            }
        }
        return $rows;
    }


    //OBtener el link de un juego
    public function getLinkJuego($idJuego)
    {
        $res = $this->mysqli->prepare('SELECT link FROM juegos WHERE id=?');
        $res->bind_param('i', $idJuego);
        $res->execute();
        $res = $res->get_result();
        $row = array('link' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('link' => $row['link']);
            }
        }
        return $rows;
    }

    //Get juegos of one etiqueta from table contiene
    public function getJuegosEtiqueta($etiqueta)
    {
        $res = $this->mysqli->prepare('SELECT * FROM juegos, contiene WHERE id_etiqueta=? AND juegos.id=contiene.id_juego');
        $res->bind_param('i', $etiqueta);
        $res->execute();
        $res = $res->get_result();
        $evento = array('id' => 'Not Found', 'titulo' => 'Not Found', 'descripcion' => 'Not Found', 'portada' => 'Not Found', 'precio' => 0.00, 'video' => 'Not Found', 'fecha' => '1900-01-01', 'genero' => 'Not Found', 'plataforma' => 'Not Found', 'desarrollador' => 'Not Found', 'puntuacion' => -1, 'web' => 'Not Found', 'masinfo' => 'Not Found', 'facebook' => 'Not Found', 'twitter' => 'Not Found', 'instagram' => 'Not Found', 'link' => 'Not Found');
        if ($res->num_rows > 0) {
            $rows = array();
            while ($row = $res->fetch_assoc()) {
                $rows[] = array('titulo' => $row['titulo'], 'descripcion' => $row['descripcion'], 'portada' => $row['portada'], 'precio' => $row['precio'], 'video' => $row['video'], 'fecha' => $row['fecha'], 'genero' => $row['genero'], 'plataforma' => $row['plataforma'], 'desarrollador' => $row['desarrollador'], 'puntuacion' => $row['puntuacion'], 'web' => $row['web'], 'masinfo' => $row['masinfo'], 'facebook' => $row['facebook'], 'twitter' => $row['twitter'], 'instagram' => $row['instagram'], 'link' => $row['link']);
            }
        }
        return $rows;
    }
}
?>