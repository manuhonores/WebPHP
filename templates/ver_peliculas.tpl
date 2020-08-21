{include file="header.tpl"}

{if isset($smarty.session.adminId)}
    <a href="{BASE_URL}insertar">Nueva Pelicula</a>
{/if}

    <div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-image" id="centrar">
            <thead>
                <tr>
                <th scope="col">Pelicula</th>
                <th scope="col">Nombre</th>
                <th scope="col"><a href="{BASE_URL}?ordenar">Genero</a></th>
                <th scope="col">Info</th>
                {if isset($smarty.session.adminId)}
                    <th scope="col">Modificar</th>
                    <th scope="col">Eliminar</th>
                {/if}
                </tr>
            </thead>
            <tbody>
                {foreach from=$peliculas item=pelicula}
                    {foreach from=$generos item=genero}
                        {if ($pelicula->id_genero) == ($genero->id_genero)}
                            <tr>
                                {foreach from=$imagenes item=imagen name="loop"}
                                    {if ($pelicula->id_pelicula) == ($imagen->id_pelicula)}
                                        <td width="400px"><img height="100px" width="200px" src="{$imagen->ruta}"></td>
                                        {break}
                                    {/if}
                                {/foreach}
                                <td>{$pelicula->nombre}</td>
                                <td>{$genero->nombre}</td>
                                <td><a href="vermas/{$pelicula->id_pelicula}">Ver Mas</td>
                                {if isset($smarty.session.adminId)}
                                    <td><a href="modificar/{$pelicula->id_pelicula}">Modificar</td>
                                    <td><a class="btn-eliminar" id="{$pelicula->id_pelicula}"href="borrar/{$pelicula->id_pelicula}">Eliminar</td>
                                {/if}
                            </tr>
                        {/if}
                    {/foreach}
                {/foreach}
            </tbody>
            </table>   
        </div>
    </div>
    </div>

<script src="js/otro.js"></script>
{include file="footer.tpl"}