{include file="header.tpl"}
<br></br>
<br></br>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Recuperar contraseña</div>
                    <div class="card-body">
                        <form action="recuperarPass" method="POST">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>


{include file="footer.tpl"}