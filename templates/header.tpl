<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    {if (($titulo == "Info") || ($titulo == "MoviePlus_Modificar") || ($titulo == "MoviePlus_Modificar_Genero") || ($titulo == EasterEgg))}
        <link rel="stylesheet" href="../css/estilo.css">
        {else}
            <link rel="stylesheet" href="./css/estilo.css">
    {/if}

    <title>{$titulo}</title>
</head>
<body>

   <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{BASE_URL}">MoviePlus</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{BASE_URL}">Home</a>
                </li>
                <li class="nav-item active" class="generos">
                    <a class="nav-link" href="{BASE_URL}generos">Generos</a>
                </li>
                {if isset($smarty.session.adminId)}
                    <li class="nav-item active" class="generos">
                        <a class="nav-link" href="{BASE_URL}usuarios">Usuarios</a>
                    </li>
                {/if}
            </ul>
            <ul class="navbar-nav ml-auto">
                {if isset($smarty.session.userId) || isset($smarty.session.adminId)}
                    <li class="nav-item active">
                        {* <a class="nav-link" href="{BASE_URL}logout">LogOut</a> *}
                        <a href="{BASE_URL}logout"><button class="btn btn-outline-primary my-2 my-sm-0">LogOut</button></a>
                    </li> 
                {/if}
                {if (!isset($smarty.session.userId)) && (!isset($smarty.session.adminId))}
                    <li class="nav-item active" >
                        {* <a class="nav-link" href="{BASE_URL}login">LogIn</a> *}
                        <a href="{BASE_URL}login"><button class="btn btn-outline-primary my-2 my-sm-0">LogIn</button></a>
                    </li>
                {else}
                    <li class="nav-item disable" >
                        {if isset($smarty.session.userId)}
                            <span class="nav-link">{$smarty.session.user}</span>
                        {elseif isset($smarty.session.adminId)}
                            <span class="nav-link">{$smarty.session.admin}</span>
                        {/if}
                    </li>
                {/if}
            </ul>
        </div>
    </nav>  


    