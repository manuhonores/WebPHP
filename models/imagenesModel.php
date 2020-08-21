<?php
    class ImagenesModel{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=movieplus;charset=utf8', 'root', ''); 
        }

        public function insertarImagenes($id, $ruta) {
            $query = $this->db->prepare('INSERT INTO imagenes(id_pelicula, ruta) VALUES(?,?)');
            $ok = $query->execute(array($id, $ruta));

            return $this->db->lastInsertId();
        }

        public function getImagenes(){
            $query = $this->db->prepare('SELECT * FROM imagenes');
         
            $ok = $query->execute();
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
            $imagenes = $query->fetchAll(PDO::FETCH_OBJ);
            return $imagenes;
        }

        public function getImagenesIdPeli($id_peli){
            $query = $this->db->prepare('SELECT * FROM imagenes WHERE id_pelicula = ?');
         
            $ok = $query->execute(array($id_peli));
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
            $imagenes = $query->fetchAll(PDO::FETCH_OBJ);
            return $imagenes;
        }

        public function getImagenId($id){
            $query = $this->db->prepare('SELECT * FROM imagenes WHERE id_imagen = ?');
         
            $ok = $query->execute(array($id));
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
            $imagen = $query->fetch(PDO::FETCH_OBJ);
            return $imagen;
        }

        public function delete($id){
            $query = $this->db->prepare("DELETE FROM imagenes WHERE id_imagen = ?");
            $ok = $query->execute(array($id));
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
        }

        public function deleteImgPeli($id_peli){
            $query = $this->db->prepare("DELETE FROM imagenes WHERE id_pelicula = ?");
            $ok = $query->execute(array($id_peli));
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
        }
    }