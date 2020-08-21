<?php

    require_once('./models/imagenesModel.php');

    class ImagenesController {
        private $modelImagenes;
        private $viewImagenes;

        private $controllerUser;

        public function __construct(){
            $this->modelImagenes = new ImagenesModel();

            $this->controllerUser = new UserController();
        }

        public function agregarImagenes($images, $id_peli) {

            for ($i=0; $i < sizeof($images['name']); $i++) {  

                $extension = pathinfo($images['name'][$i], PATHINFO_EXTENSION);
                
                    if ($extension == "jpeg" || $extension == "jpg" || $extension == "png" || $extension == "gif") {
                        $nombre = $images['name'][$i];
                        $nombre_tmp = $images['tmp_name'][$i];
                        
                        $imagen = $this->moveFile($nombre, $nombre_tmp);

                        $this->modelImagenes->insertarImagenes($id_peli, $imagen);
                    }    
            }
            //header("Location: " . URL_PELIS);
        }

        private function moveFile($nombre, $tmp) {
            $filepath = "images_tmp/" . uniqid() . "." . strtolower(pathinfo($nombre, PATHINFO_EXTENSION));  
            move_uploaded_file($tmp, $filepath);
            return $filepath;
        }

        public function getImagenes() {
            $imagenes = $this->modelImagenes->getImagenes();
            return $imagenes;
        }

        public function deleteImagen($id, $id_peli){
            $imagen = $this->modelImagenes->getImagenId($id);
       
            $this->modelImagenes->delete($id);

            unlink($imagen->ruta);

            header('Location: ' . BASE_URL . 'vermas/' . $id_peli);
        }

        public function getImagenesIdPeli($id) {
            //session_start(); // ver lo del admin   
            $imagenes = $this->modelImagenes->getImagenesIdPeli($id);
            return $imagenes;
        }

        public function deleteImgPeli($id_peli){
            $this->controllerUser->checkLogin();
            //session_start(); // ver lo del admin
            $rutas = $this->getImagenesIdPeli($id_peli);
            foreach ($rutas as $ruta) {
                unlink($ruta->ruta);
            }
            $this->modelImagenes->deleteImgPeli($id_peli);
        }

        public function datosImagen(){
            session_start(); // ver admin

            $id_peli = $_POST["id_peli"];

            $this->agregarImagenes($_FILES['image'], $id_peli);

            header('Location: ' . BASE_URL . 'vermas/' . $id_peli);
        }
    }