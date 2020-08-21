<?php
    require_once('./views/peliculasView.php');
    require_once('./models/peliculasModel.php');
    require_once('./controllers/userController.php');
    require_once('./controllers/imagenesController.php');

    class PeliculasController{
        private $viewPeliculas;
        private $modelPeliculas;

        //Lo uso para comparar los generos con los id_genero
        private $modelGeneros;

        //Tengo que crear variable para controlar el login
        private $controllerUser;

        //Variable del controller imagenes
        private $controllerImagenes;

        public function __construct(){
            $this->viewPeliculas = new PeliculasView();
            $this->modelPeliculas = new PeliculasModel();

            $this->modelGeneros = new GenerosModel();

            $this->controllerUser = new UserController();

            $this->controllerImagenes = new ImagenesController();
        }
    
        public function showPeliculas(){
            session_start();
            $ordenar = isset($_GET['ordenar']);

            $imagenes = $this->controllerImagenes->getImagenes();

            $pelis = $this->modelPeliculas->getPeliculas($ordenar);
            $generos = $this->modelGeneros->getGeneros();
            //Envío peliculas y generos y despues en el template, comparo id y muestro nombre
            $this->viewPeliculas->displayPeliculas($pelis, $generos, $imagenes);   
        }

        public function formularioNuevaPeli(){
            $this->controllerUser->checkLogIn();
            $generos = $this->modelGeneros->getGeneros();
            $this->viewPeliculas->DisplayFormularioPelis($generos);
        }

        public function registerPelicula() {
            $this->controllerUser->checkLogIn();
            $id_gen = $_POST['taskOption'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];

            $lastId = $this->modelPeliculas->InsertarPelicula($id_gen, $nombre, $descripcion);

            $this->controllerImagenes->agregarImagenes($_FILES['image'], $lastId);
            header("Location: " . URL_PELIS);
        }
    

        //Funcion para mostrar la info de vermas peli
        public function verMas($id) {

            $imagenes = $this->controllerImagenes->getImagenesIdPeli($id);

            session_start();
            if($id == 65) {
                //EasterEgg
                $this->viewPeliculas->displayEasterEgg();
            } else {
                $peli = $this->modelPeliculas->getPeliculaId($id);
                $genero = $this->modelGeneros->getGeneroId($peli->id_genero);
                $this->viewPeliculas->DisplayVerMas($peli, $genero, $imagenes);
            }
        }

        public function borrarPelicula($id){
            $this->controllerUser->checkLogIn();
            $this->modelPeliculas->borrarPelicula($id);
 
            $this->controllerImagenes->deleteImgPeli($id);

            header("Location: " . URL_PELIS);
        }

        public function displayFormularioModificar($id){
            $this->controllerUser->checkLogIn();

            $peli = $this->modelPeliculas->getPeliculaId($id);
            $generos = $this->modelGeneros->getGeneros();
            $this->viewPeliculas->displayModificarPelicula($peli, $generos);
        }

        public function modificarPelicula() {
            
            $this->controllerUser->checkLogIn();
            $id_peli = $_POST['id'];
            $id_gen = $_POST['taskOption'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
        
            $this->controllerImagenes->agregarImagenes($_FILES['image'], $id_peli);

            $this->modelPeliculas->actualizarPelicula($id_peli, $id_gen, $nombre, $descripcion);
            header("Location: " . URL_PELIS);
        }
    }