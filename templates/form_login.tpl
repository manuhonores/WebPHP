{include file="header.tpl"}

<br></br>
<br></br>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Iniciar Sesion</div>
                    <div class="card-body">
                        <form action="identificar" method="POST">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Log In</button>
                                <a href="recuperar">Olvidé mi contraseña</a>
                            </div>
                            <br></br>
                            <div class="col-md-6 offset-md-4">
                                <label>¿No tienes cuenta?</label>
                                <a href="signUp"><input type="button" class="btn btn-primary" value="Registrarse" name="register"></a>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>


{include file="footer.tpl"}