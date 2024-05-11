<div class="modal fade" id="ventanaModalModificar" tabindex="-1" aria-labelledby="ventanaModalModificar"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?php echo APP_URL; ?>app/views/icons/edit.png" alt="icono" width="50" height="50">
                <h5 class="modal-title" id="tituloModal">Modificar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/userAjax.php" method="POST">
                    <input type="hidden" name="modulo_user" value="modificar">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">CEDULA:</label>
                            <input type="hidden" name="id" id="id">
                            <input class="form-control " name="cedula" id="cedula" type="text" value=""
                                placeholder="Ingresar cedula">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">NOMBRE COMPLETO:</label>
                            <input class="form-control " name="nombre" id="nombre" type="text" value=""
                                placeholder="Ingresar Nombre y Apellido">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">USERNAME:</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="text" value="" class="form-control" name="username" id="username"
                                    aria-describedby="inputGroupPrepend" placeholder="Ingresar Nombre de usuario">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <?php                                
                                // Listar roles
                                echo $insUsuario->listarComboRolesControlador ('tipo2');
                            ?>
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