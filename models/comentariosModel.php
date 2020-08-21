<?php
    class ComentariosModel{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=movieplus;charset=utf8', 'root', '');
        }

        public function getComentarios() {
            $query = $this->db->prepare('SELECT * FROM comentarios');
            $ok = $query->execute();
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
            $comentarios = $query->fetchAll(PDO::FETCH_OBJ);
            return $comentarios;
        }

        public function deleteComentarioPeli($id){
            $query = $this->db->prepare('DELETE FROM comentarios WHERE id_pelicula = ?');
            $ok = $query->execute(array($id));
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
        }

        public function getComentariosPelicula($id, $order) {
            // var_dump()
            if (isset($order)&&$order!='default'){
                if ($order == 'puntuacion' || $order == 'id_comentario'){
                    $query = $this->db->prepare('SELECT comentarios.id_usuario, comentarios.id_pelicula, comentarios.comentario, comentarios.puntuacion, comentarios.id_comentario, usuarios.nombre FROM comentarios INNER JOIN usuarios ON usuarios.id_usuario = comentarios.id_usuario WHERE comentarios.id_pelicula = ? ORDER BY '.$order.' DESC');
                    $ok = $query->execute(array($id));
                }else{
                    $query = $this->db->prepare('SELECT comentarios.id_usuario, comentarios.id_pelicula, comentarios.comentario, comentarios.puntuacion, comentarios.id_comentario, usuarios.nombre FROM comentarios INNER JOIN usuarios ON usuarios.id_usuario = comentarios.id_usuario WHERE comentarios.id_pelicula = ? ORDER BY '.$order.' ASC');
                    $ok = $query->execute(array($id));
                }
            }else{
                $query = $this->db->prepare('SELECT comentarios.id_usuario, comentarios.id_pelicula, comentarios.comentario, comentarios.puntuacion, comentarios.id_comentario, usuarios.nombre FROM comentarios INNER JOIN usuarios ON usuarios.id_usuario = comentarios.id_usuario WHERE comentarios.id_pelicula = ?');
                $ok = $query->execute(array($id));
            }
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
            $comentarios = $query->fetchAll(PDO::FETCH_OBJ);
            return $comentarios;
        }

        public function getComentarioId($id) {
            $query = $this->db->prepare('SELECT * FROM comentarios WHERE id_comentario = ?');
            $query->execute(array($id));
            $comentario = $query->fetch(PDO::FETCH_OBJ);
            return $comentario;
        }

        public function borrarComentario($id) {
            $query = $this->db->prepare('DELETE FROM comentarios WHERE id_comentario = ?');
            $query->execute(array($id));
        }

        public function insertarComentario($id_usuario, $id_pelicula, $comentario, $puntuacion){
            $query = $this->db->prepare('INSERT INTO comentarios(id_usuario, id_pelicula, comentario, puntuacion) VALUES(?,?,?,?)');
            $query->execute(array($id_usuario, $id_pelicula, $comentario, $puntuacion));
            return $this->db->lastInsertId();
        }

        public function getPromedio($id_peli) {
            $query = $this->db->prepare('SELECT ROUND(AVG(comentarios.puntuacion),2) AS promedio FROM comentarios WHERE comentarios.id_pelicula = ?');
            $ok = $query->execute(array($id_peli));
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
            $prom = $query->fetch(PDO::FETCH_ASSOC);
            return $prom;
        }

    }