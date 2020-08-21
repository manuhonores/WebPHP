<?php
    class GenerosModel{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=movieplus;charset=utf8', 'root', '');
        }

        public function getGeneros(){
            $query = $this->db->prepare('SELECT * FROM Generos');
            $ok = $query->execute();
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
            $gens = $query->fetchAll(PDO::FETCH_OBJ);
            return $gens;
        }

        public function getGeneroId($id) {
            $query = $this->db->prepare('SELECT * FROM generos WHERE id_genero = ?');
            $query->execute(array($id));
            $genero = $query->fetch(PDO::FETCH_OBJ);
            return $genero;
        }

        public function insertarGenero($nombre) {
            $query = $this->db->prepare('INSERT INTO generos(nombre) VALUES(?)');
            $query->execute(array($nombre));
        }

        public function eliminarGeneroConPeliculas($id) {
            $query = $this->db->prepare('DELETE generos, peliculas FROM generos INNER JOIN peliculas ON peliculas.id_genero = generos.id_genero WHERE generos.id_genero = ?');
            $query->execute(array($id));
        }

        public function eliminarGenero($id) {
            $query = $this->db->prepare('DELETE FROM generos WHERE id_genero = ?');
            $query->execute(array($id));
        }

        public function actualizarGenero($id, $nombre){
            $query =  $this->db->prepare("UPDATE generos SET nombre = ? WHERE id_genero = ?");
            $query->execute(array($nombre, $id));
        }
    }