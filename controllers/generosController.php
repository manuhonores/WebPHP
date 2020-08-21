<?php
    require_once('./models/generosModel.php');
    require_once('./views/generosView.php');
    require_once('./controllers/userController.php');
    require_once('./models/peliculasModel.php');

    class GenerosController{
        
        private $viewGeneros;
        private $modelGeneros;

        private $controllerUser;

        private $modelPeliculas;

        public function __construct(){
            $this->viewGeneros = new GenerosView();
            $this->modelGeneros = new GenerosModel();

            $this->controllerUser = new UserController();

            $this->modelPeliculas = new peliculasModel();
        }

        public function showGeneros(){
            session_start();
            $gens = $this->modelGeneros->getGeneros();
            $this->viewGeneros->displayGeneros($gens);
        }

        public function formularioNuevoGenero(){
            $this->controllerUser->checkLogIn();
            $this->viewGeneros->displayFormularioGeneros();
        }

        public function registerGenero() {
            $this->controllerUser->checkLogIn();
            $nombre = $_POST['nombre'];

            $this->modelGeneros->insertarGenero($nombre);
            //Ver si lo redirijo a los generos o lo envio a pelis
            header("Location: " . URL_GENEROS);
        }

        public function borrarGenero($id){
            session_start();
            $cont = 0;
            $this->controllerUser->checkLogIn();

            $peliculas = $this->modelPeliculas->getPeliculas();
            
            foreach ($peliculas as $pelicula) {
                if($pelicula->id_genero == $id) {
                    $cont++;
                }
            }
            if($cont != 0) { //Si el genero tiene vinculadas peliculas, se ejecuta el eliminar genero que elimina tambien las peliculas
                $this->modelGeneros->eliminarGeneroConPeliculas($id);
            } else { //Si no tiene ninguna pelicula vinculada, ejecuto eliminarGenero que me elimina sólo eso
                $this->modelGeneros->eliminarGenero($id);
            }
            header("Location: " . URL_GENEROS);
        }

        public function displayFormularioModificar($id){
            $this->controllerUser->checkLogIn();

            $genero = $this->modelGeneros->getGeneroId($id);
            $this->viewGeneros->displayModificarGenero($genero);
        }

        public function modificarGenero() { 
            session_start();
            $this->controllerUser->checkLogIn();
            $id_gen = $_POST['id'];
            $nombre = $_POST['nombre'];

            $this->modelGeneros->actualizarGenero($id_gen, $nombre);
            header("Location: " . URL_GENEROS);
        }

        public function showGenerosAdmin(){
            $this->controllerUser->checkLogIn();
            $generos = $this->modelGeneros->getGeneros();
            $this->viewGeneros->displayGenerosAdmin($generos);
        }
    }