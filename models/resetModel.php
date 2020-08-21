<?php
    class ResetModel{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=movieplus;charset=utf8', 'root', '');
        }

        public function ingresoReset($id_usuario, $nombre, $token) {
            date_default_timezone_set("America/Argentina/Buenos_Aires");
            $query = $this->db->prepare('INSERT INTO resetpass(id_usuario, nombre, token, creado) VALUES (?,?,?,?)');
            $ok = $query->execute(array($id_usuario, $nombre, $token, date("Y-m-d H:i:s")));
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
        }

        public function getToken($token) {
            $query = $this->db->prepare('SELECT * FROM resetpass WHERE token = ?');
            $ok = $query->execute(array($token));
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
            $usuario = $query->fetch(PDO::FETCH_OBJ);

            return $usuario;
        }

        public function eliminarToken($token) {
            $query = $this->db->prepare('DELETE FROM resetpass WHERE token = ?');
            $ok = $query->execute(array($token));
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
        }

    }
