<?php
    require_once("./libs/Smarty.class.php");
    
    class UserView{
        
        public function displaySignUp(){
            $smarty = new Smarty();
            $smarty->assign('titulo',"Movieplus: registration");
            $smarty->display('./templates/form_signup.tpl');
        }

        public function displayLogIn(){
            $smarty = new Smarty();
            $smarty->assign('titulo',"Movieplus: login");
            $smarty->display('./templates/form_login.tpl');
        }

        public function displayUsuarios($usuarios){
            $smarty = new Smarty();
            $smarty->assign('titulo',"Usuarios");
            $smarty->assign('usuarios', $usuarios);
            $smarty->display('./templates/usuarios.tpl');
        }

        public function displayRecuperar(){
            $smarty = new Smarty();
            $smarty->assign('titulo',"Recuperar");
            $smarty->display('./templates/recuperar.tpl');
        }

    }