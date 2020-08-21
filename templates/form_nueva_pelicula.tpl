{include file="header.tpl"}

<center>
    <form action="registerPelicula" method="POST" enctype="multipart/form-data"> <br><br>
        <select name="taskOption">
            {foreach from=$generos item=genero}
                <option value="{$genero->id_genero}" name="id_genero">{$genero->nombre}</option>
            {/foreach}
        </select>
        <input type="text" REQUIRED name="nombre" placeholder="Nombre:"> <br><br>
        <textarea name="descripcion" rows="10" cols="40" placeholder="Descripcion:"></textarea> <br><br>
        <input type="file" REQUIRED name="image[]" multiple> <br><br>
        <input type="submit" value="Aceptar">
    </form>
</center>
{include file="footer.tpl"}