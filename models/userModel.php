<?php
    class UserModel{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=movieplus;charset=utf8', 'root', '');
        }

        public function insertUser($nombre, $mail, $password){
            $bool = 0;
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $query = $this->db->prepare('INSERT INTO usuarios(nombre, email, password, admin) VALUES (?,?,?,?)');
            $ok = $query->execute(array($nombre, $mail, $hash, $bool));
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }

            return $this->db->lastInsertId();
        }

        public function getUsers(){

            $query = $this->db->prepare('SELECT * FROM usuarios');
            $ok = $query->execute();
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
            $users = $query->fetchALL(PDO::FETCH_OBJ);
            return $users;
        }

        public function getUser($mail){
            
            $sentencia = $this->db->prepare( "SELECT * FROM usuarios WHERE email = ?");
            $sentencia->execute(array($mail));
        
            $user = $sentencia->fetch(PDO::FETCH_OBJ);
        
            return $user;
        }

        public function delete($id) {
            $query = $this->db->prepare('DELETE FROM usuarios WHERE id_usuario = ?');
            $ok = $query->execute(array($id));
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
        }

        public function changeAttribute($id, $bool) {
            $query = $this->db->prepare('UPDATE usuarios SET admin = ? WHERE id_usuario = ?');
            $ok = $query->execute(array($bool, $id));

            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
        }

        public function updatePass($password, $id_usuario) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $query = $this->db->prepare('UPDATE usuarios SET password = ? WHERE id_usuario = ?');
            $ok = $query->execute(array($hash, $id_usuario));
            if (!$ok){
                var_dump($query->errorInfo());
                die();
            }
        }
    }