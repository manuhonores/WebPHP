<?php

require_once("libs/Smarty.class.php");
require_once('libs/SmartyBC.class.php');

class PeliculasView {

    function __construct(){

    }

    public function displayPeliculas($peliculas, $generos, $imagenes){
        $smarty = new SmartyBC();
        $smarty->assign('titulo',"MoviePlus");
        $smarty->assign('BASE_URL',BASE_URL);
        $smarty->assign('peliculas',$peliculas);
        $smarty->assign('generos',$generos);
        $smarty->assign('imagenes',$imagenes);
        $smarty->display('templates/ver_peliculas.tpl');
    }

    public function DisplayFormularioPelis($generos){
        $smarty = new Smarty();
        $smarty->assign('titulo',"Ingreso de pelicula");
        $smarty->assign('URL_INSERT',URL_INSERT);
        $smarty->assign('generos',$generos);
        $smarty->display('templates/form_nueva_pelicula.tpl');
    }

    public function DisplayVerMas($pelicula, $genero, $imagenes) {
        $smarty = new SmartyBC();
        $smarty->assign('titulo', 'Info');
        $smarty->assign('BASE_URL',BASE_URL);
        $smarty->assign('pelicula', $pelicula);
        $smarty->assign('genero', $genero);
        $smarty->assign('imagenes', $imagenes);
        $smarty->display('templates/ver_mas_pelicula.tpl');
    }

    public function displayPeliculasAdmin($peliculas, $generos) {
        $smarty = new SmartyBC();
        $smarty->assign('titulo','MoviePlus_Admin');
        $smarty->assign('BASE_URL',BASE_URL);
        $smarty->assign('peliculas',$peliculas);
        $smarty->assign('generos',$generos);
        $smarty->display('templates/peliculas_admin.tpl');
    }

    public function displayModificarPelicula($peli, $generos) {
        $smarty = new Smarty();
        $smarty->assign('titulo','MoviePlus_Modificar');
        $smarty->assign('BASE_URL',BASE_URL);
        $smarty->assign('pelicula',$peli);
        $smarty->assign('generos',$generos);
        $smarty->display('templates/modificar_pelicula.tpl');
    }

    public function displayEasterEgg() {
        $smarty = new Smarty();
        $smarty->assign('titulo','EasterEgg');
        $smarty->display('templates/easterEgg.tpl');
    }
}

