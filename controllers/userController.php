<?php
    require_once ("./views/userView.php");
    require_once ("./models/userModel.php");

    require_once ("./controllers/resetController.php");

    class UserController{
        private $viewUser;
        private $modelUser;

        private $resetController;

        public function __construct(){
            $this->viewUser = new UserView();
            $this->modelUser = new UserModel();

            $this->resetController = new ResetController();
        }

        public function displaySignUp(){
            $this->viewUser->displaySignUp();
        }

        public function registerUser(){
            $name = $_POST['nombre'];
            $mail = $_POST['email'];
            $password = $_POST['password'];
            $users = $this->modelUser->getUsers();
            if ((isset($users))&&($users!=null)){
                foreach ($users as $user) {
                    if ($mail==$user->email){
                        $this->viewUser->displaySignUp();
                        die();
                    }
                }
            }

            $id_usuario = $this->modelUser->insertUser($name, $mail, $password);

            //Inicio Sesion luego de registrarme
            
            session_start();
            $_SESSION['user'] = $mail;
            $_SESSION['userId'] = $id_usuario;
            header("Location: " . BASE_URL);     
        }

        public function logIn(){
            
            $password = $_POST['password'];

            $usuario = $this->modelUser->getUser($_POST['email']);

            if (isset($usuario) && $usuario != null && password_verify($password, $usuario->password) && $usuario->admin == 0){
                session_start();
                $_SESSION['user'] = $usuario->email;
                $_SESSION['userId'] = $usuario->id_usuario;
                header("Location: " . BASE_URL);
            }elseif (isset($usuario) && $usuario != null && password_verify($password, $usuario->password) && $usuario->admin != 0) {
                session_start();
                $_SESSION['admin'] = $usuario->email;
                $_SESSION['adminId'] = $usuario->id_usuario;
                header("Location: " . BASE_URL);
            }else{
                $message = "Usuario o contraseña incorrectos"; //Preguntar como mandar alerta
                echo "<script type='text/javascript'>alert('$message');</script>";
                header("Location: " . URL_LOGIN);
            }
        }

        public function logOut(){
            session_start();
            session_destroy();
            header("Location: ". BASE_URL);
        }

        public function displayLogIn(){
            $this->viewUser->displayLogIn();
        }


        public function checkLogIn(){
            session_start();
            
            if(!isset($_SESSION['userId']) && !isset($_SESSION['adminId'])){
                header("Location: " . BASE_URL);
                die();
            }
            if ( isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 5000)) { 
                header("Location: " . URL_LOGOUT);
                die(); // destruye la sesión, y vuelve al login
            } 
            $_SESSION['LAST_ACTIVITY'] = time();
        }

        public function eliminar($id) {
            $this->checkLogIn();

            $this->modelUser->delete($id);
            
            header('Location: ' . URL_USUARIOS);
        }

        public function changeAttribute($id, $bool) {

            $this->checkLogIn();

            if(isset($_SESSION['admin'])){
                $this->modelUser->changeAttribute($id, $bool);
            }

            header('Location: ' . URL_USUARIOS);
        }

        public function displayUsuarios() {
            session_start();
            if (isset($_SESSION['admin'])) {
                $this->viewUser->displayUsuarios($this->modelUser->getUsers());
            }
            else {
                header('Location: ' . BASE_URL);
            }
        }

        public function displayRecuperar() {
            $this->viewUser->displayRecuperar();
        }

        
        // Funciones para recupero de contraseña
        
        public function userRecuperar() {
            //session_start();
                if(isset($_POST['email'])) {
                    $email = $_POST['email'];
    
                    $mail = $this->modelUser->getUser($email);
                    
                    if($mail->email == $email) {
                        $enlaceTemporal = $this->resetController->generarLinkTemporal($mail->id_usuario, $mail->nombre);
                        $this->resetController->enviarMail($email, $enlaceTemporal);
                        header('Location: ' . BASE_URL);
                    
                    }else {
                        echo "No es un mail valido";
                    }
                }
        }

        public function cambiarPass() {
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];
            $token = $_POST['token'];
            $id_usuario = $_POST['idUsuario'];

            if($password1 == $password2) {
                //Actualizo la nueva contraseña
                $this->modelUser->updatePass($password1, $id_usuario);

                //Elimino de la tabla donde se genero el token
                $this->resetController->eliminarToken($token);

                header('Location: ' . URL_LOGIN);
            }
        }
    }      