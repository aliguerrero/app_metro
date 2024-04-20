<div class="modal fade" id="ventanaModalModificarPass" tabindex="-1" aria-labelledby="ventanaModalModificarPass"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?php echo APP_URL; ?>app/views/icons/password.png" alt="icono" width="50" height="50">
                <h5 class="modal-title" id="tituloModal">Cambiar Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row offset-2">
                    <h3 id="nombreUser" name="nombreUser"></h3>
                </div><br>
                <form class="row g-3 FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/userAjax.php" method="POST">
                    <input type="hidden" name="modulo_user" value="clave">
                    <input type="hidden" name="id2" id="id2">

                    <div class="row offset-2">
                        <div class="col-md-8">
                            <label class="form-label">CONTRASEÑA:</label>
                            <div class="input-group">
                                <input class="form-control" name="clave1" id="clave1" type="password" value=""
                                    placeholder="Ingresar Contraseña">
                                <button class="btn password-toggle-btn btn-outline-secondary" type="button"
                                    id="togglePassword1">
                                    <img src="<?php echo APP_URL; ?>app/views/icons/eye.png" alt="Toggle Password"
                                        width="32" height="32">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row offset-2">
                        <div class="col-md-8">
                            <label class="form-label">REPETIR CONTRASEÑA:</label>
                            <div class="input-group">
                                <input class="form-control" name="clave2" id="clave2" type="password" value=""
                                    placeholder="Repetir Contraseña">
                                <button class="btn password-toggle-btn btn-outline-secondary" type="button"
                                    id="togglePassword2">
                                    <img src="<?php echo APP_URL; ?>app/views/icons/eye.png" alt="Toggle Password"
                                        width="32" height="32">
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="form-control" style="background-color: rgb(60, 75, 100); color:white ;"
                                type="submit" aria-haspopup="true" aria-expanded="false">Guardar</button>
                        </div>

                        <div class="col-md-6">
                            <button class="form-control" style="background-color: rgb(60, 75, 100); color:white ;"
                                type="button" data-bs-dismiss="modal">Cancelar
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>