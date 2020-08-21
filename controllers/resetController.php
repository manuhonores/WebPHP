<?php
    require_once ("./views/resetView.php");
    require_once ("./models/resetModel.php");

    //Libreria mail

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';

    class ResetController{
        private $viewReset;
        private $modelReset;

        public function __construct(){
            $this->viewReset = new ResetView();
            $this->modelReset = new ResetModel();
        }

        public function generarLinkTemporal($id_usuario, $userName){
            // Se genera una cadena para validar el cambio de contraseña
            $cadena = $id_usuario.$userName.rand(1,9999999).date('Y-m-d');
            $token = password_hash($cadena, PASSWORD_DEFAULT);
            $hash_id = password_hash($id_usuario, PASSWORD_DEFAULT);

            $this->modelReset->ingresoReset($id_usuario, $userName, $token);

            $enlace = BASE_URL . 'restablecer?id_usuario=' . $hash_id . '&token=' . $token;

            return $enlace;
        }

        public function enviarMail($email, $linkTemporal) {
            $mensaje = '<html>
                <head>
                <title>Restablece tu contraseña</title>
                </head>
                <body>
                Hemos recibido una petición para restablecer la contraseña de tu cuenta.</p>
                <p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
                <hr><br>
                    <a href="'.$linkTemporal.'"> Restablecer contraseña </a>
                <hr>
                </body>
                </html>';

            $email_user = "pruebaenviomail1@gmail.com";
            $email_password = "pruebaenviomail1234";
            $the_subject = "Recuperar contraseña";
            $address_to = $email;
            $from_name = "MoviePlus";
            $phpmailer = new PHPMailer();
            
            try{

                // ---------- datos de la cuenta de Gmail -------------------------------
                $phpmailer->Username = $email_user;
                $phpmailer->Password = $email_password; 
                //-----------------------------------------------------------------------
                // $phpmailer->SMTPDebug = 1;
                $phpmailer->SMTPSecure = 'ssl';
                $phpmailer->Host = "smtp.gmail.com"; // GMail
                $phpmailer->Port = 465;
                $phpmailer->IsSMTP(); // use SMTP
                $phpmailer->SMTPAuth = true;
                $phpmailer->setFrom($phpmailer->Username,$from_name);
                $phpmailer->AddAddress($address_to); // recipients email
                $phpmailer->Subject = $the_subject;	
                $phpmailer->Body .= $mensaje;
                $phpmailer->Body .= "<p>Fecha y Hora: ".date("d-m-Y h:i:s")."</p>";
                $phpmailer->CharSet = 'UTF-8';
                $phpmailer->IsHTML(true);
                $phpmailer->Send();
            }
            catch (phpmailerException $e) {
                echo $e->errorMessage();
              } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function restablecer() {
            $token = $_GET['token'];
            $id_usuario = $_GET['id_usuario'];
            
            $usuario = $this->modelReset->getToken($token);

            if($usuario != "") {
                $verify = password_verify($usuario->id_usuario, $id_usuario);
                if($verify) {
                    $this->viewReset->displayCambioPass($usuario, $token);          
                }
            }
        }

        public function eliminarToken($token) {
            $this->modelReset->eliminarToken($token);
        }
    }