{include file="header.tpl"}

<center>
    <form action="{BASE_URL}modificarGenero" method="POST"> <br><br>
        <input type="text" REQUIRED name="nombre" value="{$genero->nombre}">
        <input type="text" name="id" readonly="readonly" value="{$genero->id_genero}" hidden> <br><br>
        <input type="submit" value="Aceptar">
    </form>
</center>
{include file="footer.tpl"}