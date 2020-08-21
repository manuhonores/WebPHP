{include file="header.tpl"}

 <div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-image" id="centrar">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Modificar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$usuarios item=usuario}
                    {if {$usuario->email}!=$smarty.session.admin}
                        <tr>
                            <td>{$usuario->nombre}</td>
                            <td>{$usuario->email}</td>
                            {if $usuario->admin == 0}
                                <td><a href="modificar_usuario/{$usuario->id_usuario}/1">Otorgar Permisos</td>
                            {else}
                                <td><a href="modificar_usuario/{$usuario->id_usuario}/0">Quitar Permisos</td>
                            {/if}
                            <td><a href="borrar_usuario/{$usuario->id_usuario}">Eliminar</td>
                        </tr>
                    {/if}
                {/foreach}
            </tbody>
            </table>   
        </div>
    </div>
</div>