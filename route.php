<?php
    require_once('controllers/peliculasController.php');
    require_once('controllers/generosController.php');
    require_once('controllers/userController.php');
    require_once('controllers/imagenesController.php');
    require_once('controllers/resetController.php');
    
    $action = $_GET["action"];

    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
    define("URL_PELIS", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/peliculas');
    define("URL_LOGIN", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/login');
    define("URL_LOGOUT", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/logout');
    define("URL_INSERT", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/insertar');
    define("URL_GENEROS", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/generos');
    define("URL_USUARIOS", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/usuarios');

    $peliculasController = new PeliculasController();
    $generosController = new GenerosController();
    $userController = new UserController();
    $imagenesController = new ImagenesController();
    $resetController = new ResetController();

    if($action == ''){
        $peliculasController->showPeliculas();
    }else {
        if (isset($action)){
            $partesURL = explode("/", $action); 

            if ($partesURL[0]=='peliculas'){
                $peliculasController->showPeliculas();
            }else if($partesURL[0]=='generos'){
                $generosController->showGeneros();
            }else if ($partesURL[0]=='login'){
                $userController->displayLogIn();
            }else if ($partesURL[0]=='logout'){
                $userController->logOut();
            }else if ($partesURL[0]=='identificar'){
                $userController->logIn();
            }else if ($partesURL[0]=='registrar'){
                $userController->registerUser();
            }else if ($partesURL[0]=='signUp'){
                $userController->displaySignUp();
            }else if ($partesURL[0]=='registerPelicula') {
                $peliculasController->registerPelicula();
            }else if ($partesURL[0]=='insertar') {
                $peliculasController->formularioNuevaPeli();
            }else if ($partesURL[0]=='vermas') {
                $peliculasController->verMas($partesURL[1]);
            }else if ($partesURL[0]=='peliculas_admin') {
                $peliculasController->showPeliculasAdmin();
            }else if ($partesURL[0]=='borrar') {
                $peliculasController->borrarPelicula($partesURL[1]);
            }else if ($partesURL[0]=='modificar') {
                $peliculasController->displayFormularioModificar($partesURL[1]);
            }else if ($partesURL[0]=='modificarPelicula') {
                $peliculasController->modificarPelicula();
            }else if ($partesURL[0]=='cantidad') {
                $peliculasController->cantidad();
            }else if ($partesURL[0]=='insertarGenero') {
                $generosController->formularioNuevoGenero();
            }else if ($partesURL[0]=='registerGenero') {
                $generosController->registerGenero();
            }else if ($partesURL[0]=='generos_admin') {
                $generosController->showGenerosAdmin();
            }else if ($partesURL[0]=='modificarForm') {
                $generosController->displayFormularioModificar($partesURL[1]);
            }else if ($partesURL[0]=='modificarGenero') {
                $generosController->modificarGenero();
            }else if ($partesURL[0]=='borrarGenero') {
                $generosController->borrarGenero($partesURL[1]);
            }else if ($partesURL[0]=='borrar_usuario') {
                $userController->eliminar($partesURL[1]);
            }else if ($partesURL[0]=='modificar_usuario') {
                $userController->changeAttribute($partesURL[1], $partesURL[2]);
            }else if ($partesURL[0]=='usuarios') {
                $userController->displayUsuarios();
            }else if ($partesURL[0]=='recuperar') {
                $userController->displayRecuperar();
            }else if ($partesURL[0]=='recuperarPass') {
                $userController->userRecuperar();
            }else if ($partesURL[0]=='borrarImagen') {
                $imagenesController->deleteImagen($partesURL[1], $partesURL[2]);
            }else if ($partesURL[0]=='agregarImagen') {
                $imagenesController->datosImagen();
            }else if ($partesURL[0]=='restablecer') {
                $resetController->restablecer();
            }else if ($partesURL[0]=='cambioPass') {
                $userController->cambiarPass();
            }
        }   
    }    
