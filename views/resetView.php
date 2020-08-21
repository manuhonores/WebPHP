<?php

require_once("libs/Smarty.class.php");
require_once('libs/SmartyBC.class.php');

class ResetView {

    function __construct(){

    }

    public function displayCambioPass($usuario, $token){
        $smarty = new Smarty();
        $smarty->assign('titulo',"MoviePlus");
        $smarty->assign('BASE_URL',BASE_URL);
        $smarty->assign('usuario',$usuario);
        $smarty->assign('token',$token);
        $smarty->display('templates/cambioPass.tpl');
    }
}