<div class="modal fade" id="ventanaModalRegistrar" tabindex="-1" aria-labelledby="ventanaModalRegistrar"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?php echo APP_URL; ?>app/views/icons/add.png" alt="icono" width="50" height="50">
                <h5 class="modal-title" id="tituloModal">Registrar Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/userAjax.php" method="POST">
                    <input type="hidden" name="modulo_user" value="registrar">
                    <div class="row">
                        <div class="col-md-6"><br>
                            <label class="form-label">CEDULA</label>
                            <a href="#" title="Intrucciones" onclick="mostrarAlertaCedula()"><img src="
                                <?php echo APP_URL; ?>app/views/icons/exclamacion.png" alt="icono" width="19"
                                    height="19"></a>
                            <input class="form-control " name="cedula" type="text" value=""
                                placeholder="Ingresar cedula">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">NOMBRE COMPLETO</label>
                            <input class="form-control " name="nombre" type="text" value=""
                                placeholder="Ingresar Nombre y Apellido">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">USERNAME</label>
                            <a href="#" title="Intrucciones" onclick="mostrarAlertaUsername()"><img src="
                                <?php echo APP_URL; ?>app/views/icons/exclamacion.png" alt="icono" width="19"
                                    height="19"></a>

                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="text" value="" class="form-control" name="username"
                                    aria-describedby="inputGroupPrepend" placeholder="Ingresar Nombre de usuario">
                            </div>
                        </div>
                    </div>
                    <br><br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">CONTRASEÑA</label>
                            <a href="#" title="Intrucciones" onclick="mostrarAlertaContrasena()"><img src="
                                <?php echo APP_URL; ?>app/views/icons/exclamacion.png" alt="icono" width="19"
                                    height="19"></a>
                            <input class="form-control " name="clave1" type="password" value=""
                                placeholder="Ingresar Contraseña">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">REPETIR CONTRASEÑA</label>
                            <input class="form-control " name="clave2" type="password" value=""
                                placeholder="Repetir Contraseña">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php                                
                                // Listar roles
                                echo $insUsuario->listarComboRolesControlador ('tipo1');
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="form-control" style="background-color: rgb(60, 75, 100); color: white ;"
                                type="submit" aria-haspopup="true" aria-expanded="false">Guardar</button>
                        </div>

                        <div class="col-md-6">
                            <button class="form-control" style="background-color: rgb(60, 75, 100); color: white ;"
                                type="button" aria-haspopup="true" aria-expanded="false"
                                data-bs-dismiss="modal">Cancelar
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>