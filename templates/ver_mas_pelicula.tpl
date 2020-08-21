{include file="header.tpl"}
    <input hidden id="cargaVerMas" value="{$pelicula->id_pelicula}">

    <div>
        <div class="container">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        {foreach from=$imagenes item=imagen name=cont}
                            {if ($smarty.foreach.cont.index) == 0}
                                <div class="carousel-item active">
                                    <img src="{BASE_URL}{$imagen->ruta}" alt="{$imagen->id_imagen}" height="400px" class="d-block w-100">
                                </div>
                            {else}
                                <div class="carousel-item">
                                    <img src="{BASE_URL}{$imagen->ruta}" alt="{$imagen->id_imagen}" height="400px" class="d-block w-100">
                                </div>
                            {/if}
                        {/foreach}
                    </div>
                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    {*  *}
    
    {if isset($smarty.session.adminId)}
        <input hidden id="admin">
        <label>Agregar una imagen</label>
        <form action="{BASE_URL}agregarImagen" method="POST" enctype="multipart/form-data">
            <input type="file" REQUIRED name="image[]">
            <input type="text" hidden name="id_peli" value="{$pelicula->id_pelicula}">
            <input type="submit" value="Aceptar">
        </form>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-image" id="centrar">
                        <thead>
                            <tr>
                            <th scope="col">Pelicula</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descipcion</th>
                            <th scope="col">Genero</th>
                            <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$imagenes item=imagen}
                                <tr>
                                    {if ($pelicula->id_pelicula) == ($imagen->id_pelicula)}
                                        <td width="400px"><img src="{BASE_URL}{$imagen->ruta}"></td>
                                    {/if}                   
                                    <td>{$pelicula->nombre}</td>
                                    <td>{$pelicula->descripcion}</td>
                                    <td>{$genero->nombre}</td>
                                    <td><a href="{BASE_URL}borrarImagen/{$imagen->id_imagen}/{$pelicula->id_pelicula}">Eliminar</td>
                                </tr>
                            {/foreach} 
                        </tbody>
                        </table>   
                    </div>
                </div>
            </div>
    {else}
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-image" id="centrar">
                    <thead>
                        <tr>
                        <th scope="col">Pelicula</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descipcion</th>
                        <th scope="col">Genero</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {foreach from=$imagenes item=imagen name="loop"}
                                {if ($pelicula->id_pelicula) == ($imagen->id_pelicula)}
                                    <td width="400px"><img src="{BASE_URL}{$imagen->ruta}"></td>
                                    {break}
                                {/if}
                            {/foreach}                    
                            <td>{$pelicula->nombre}</td>
                            <td>{$pelicula->descripcion}</td>
                            <td>{$genero->nombre}</td>
                        </tr>
                    </tbody>
                    </table>   
                </div>
            </div>
        </div>
    {/if}

    {if isset($smarty.session.userId)}
            <center>
                <form  id="form-comentarios" action="insertar" method="POST"> <br><br>
                    <textarea name="comentario" rows="10" cols="40" placeholder="Comentario:"></textarea> <br><br>
                    <label>Puntaje</label>
                    <select id="selec" name="opcion">
                        <option value="1" name="puntaje">1</option>
                        <option value="2" name="puntaje">2</option>
                        <option value="3" name="puntaje">3</option>
                        <option value="4" name="puntaje">4</option>
                        <option value="5" name="puntaje">5</option>
                    </select>
                    <input type="number" name="id_usuario" hidden value="{$smarty.session.userId}">
                    <input type="number" name="id_pelicula" hidden value="{$pelicula->id_pelicula}">
                    <input type="submit" value="Aceptar">
                </form>
            </center>
    {/if}

    {include file="vue/comentarios_list.tpl"}

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="../js/comentarios.js"></script>
{include file="footer.tpl"}