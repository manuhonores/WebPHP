{include file="header.tpl"}

    {if isset($smarty.session.adminId)}
        <a href="{BASE_URL}insertarGenero">Nuevo Genero</a>
    {/if}
    <div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-image" id="centrar">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    {if isset($smarty.session.adminId)}
                        <th scope="col">Eliminar</th>
                        <th scope="col">Modificar</th>
                    {/if}
                </tr>
            </thead>
            <tbody>
                {foreach from=$generos item=genero}
                    <tr>
                        <td>{$genero->id_genero}</td>
                        <td>{$genero->nombre}</td>
                        {if isset($smarty.session.adminId)}
                            <td><a href="borrarGenero/{$genero->id_genero}">Eliminar</th>
                            <td><a href="modificarForm/{$genero->id_genero}">Modificar</th>
                        {/if}
                    </tr>
                {/foreach}
            </tbody>
            </table>   
        </div>
    </div>
    </div>
</body>
</html>