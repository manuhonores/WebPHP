<?php
    require_once("Router.php");
    require_once("./api/ComentariosApiController.php");

    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

    // recurso solicitado
    $resource = $_GET["resource"];

    // método utilizado
    $method = $_SERVER["REQUEST_METHOD"];

    // instancia el router
    $router = new Router();

    // arma la tabla de ruteo

    $router->addRoute("comentarios", "GET", "ComentariosApiController", "getComentarios");
    $router->addRoute("comentarios/:ID", "GET", "ComentariosApiController", "getComentario"); //Ver ESTE!
    $router->addRoute("peliculas/:ID/comentarios", "GET", "ComentariosApiController", "getComentariosPelicula"); //Comentarios de una peli especifica
    $router->addRoute("comentarios/:ID", "DELETE", "ComentariosApiController", "deleteComentario");
    $router->addRoute("comentarios", "POST", "ComentariosApiController", "addComentario");
    $router->addRoute("peliculas/:ID/promedio", "GET", "ComentariosApiController", "getPromedio");
    $router->addRoute("peliculas/:ID/comentarios", "DELETE", "ComentariosApiController", "deleteComentarioIdPeli");


    // rutea
    $router->route($resource, $method);

