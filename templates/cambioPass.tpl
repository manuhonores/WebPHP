{include file="header.tpl"}

<br></br>
<br></br>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Recuperar Contraseña</div>
                    <div class="card-body">
                        <form action="cambioPass" method="POST">
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Nueva Contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password1" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Repetir Contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password2" required>
                                </div>
                            </div>
                            <input type="hidden" name="token" value="{$token}">
                            <input type="hidden" name="idUsuario" value="{$usuario->id_usuario}">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="cambiosPass">Enviar</button>
                            </div>
                            <div id="error"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>

<script src="./js/cambioPass.js"></script>

{include file="footer.tpl"}