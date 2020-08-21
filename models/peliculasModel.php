<?php
    class PeliculasModel{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=movieplus;charset=utf8', 'root', ''); //dbname = movieplus
        }

        public function getPeliculas($ordenar = false){
            $query = $this->db->prepare('SELECT * FROM peliculas');
            if($ordenar)
            {
                $query = $this->db->prepare('SELECT peliculas.id_pelicula, peliculas.id_genero, peliculas.nombre, peliculas.descripcion FROM peliculas, generos WHERE peliculas.id_genero = generos.id_genero order by generos.nombre');
            }
            $ok = $query->execute();
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
            $pelis = $query->fetchAll(PDO::FETCH_OBJ);
            return $pelis;
        }

        public function insertarPelicula($id_genero, $nombre, $descripcion) {
            $query = $this->db->prepare('INSERT INTO peliculas(id_genero, nombre, descripcion) VALUES(?,?,?)');
            $ok = $query->execute(array($id_genero,$nombre, $descripcion));

            return $this->db->lastInsertId();
        }

        public function getPeliculaId($id) {
            $query = $this->db->prepare('SELECT * FROM peliculas WHERE id_pelicula = ?');
            $query->execute(array($id));
            $peli = $query->fetch(PDO::FETCH_OBJ);
            return $peli;
        }

        public function borrarPelicula($id){
            $query = $this->db->prepare("DELETE FROM peliculas WHERE id_pelicula = ?");
            $query->execute(array($id));
        }

        public function actualizarPelicula($id, $id_genero, $nombre, $descripcion){
            $query =  $this->db->prepare("UPDATE peliculas SET id_genero = ?, nombre = ?, descripcion = ? WHERE id_pelicula=?");
            $query->execute(array($id_genero, $nombre, $descripcion, $id));
        }
    }