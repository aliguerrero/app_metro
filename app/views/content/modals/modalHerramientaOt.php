<div class="modal fade" id="ModificarHerrOt" tabindex="-1" aria-labelledby="ModificarHerrOt" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?php echo APP_URL; ?>app/views/icons/add.png" alt="icono" width="50" height="50">
                <h5 class="modal-title" id="tituloModal">Agregar Herramienta para Orden de Trabajo</h5>
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal" title="Cerrar">
                    <i class="bi bi-x-lg"></i> Cerrar ventana
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>Orden de Trabajo</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-1">
                                <h5 class="text-uppercase" id="codigoOt"></h5>
                            </div>
                            <div class="col">
                                <h5 class="text-uppercase" id="nombreOt"></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <strong>Buscador</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12" id="nrot_field">
                                        <label class="form-label"><b>BUSCAR HERRAMIENTA</b></label>
                                        <div class="input-group">
                                            <input class="form-control" name="campoHe" id="campoHe" type="text" placeholder="Busqueda por codigo o nombre">
                                            <button class="btn btn-primary" type="button" id="btnBuscarHerramienta" title="Buscar">
                                                <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" width="20" height="20">
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-sm btn-primary ms-auto" id="btnRecargarHer" title="Recargar Tabla">
                                    <i class="bi bi-arrow-clockwise"></i> <!-- Icono de actualización -->
                                </button>
                                <strong>Inventario de herramientas</strong>
                            </div>
                            <div class="card-body">
                                <?php

                                use app\controllers\herramientaController;

                                $insHerramienta = new herramientaController();

                                echo $insHerramienta->listarHerramienta();

                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <strong>Buscador</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12" id="nrot_field">
                                        <label class="form-label"><b>BUSCAR HERRAMIENTA</b></label>
                                        <div class="input-group">
                                            <input class="form-control" name="campoOt" id="campoOt" type="text" placeholder="Busqueda por codigo o nombre">
                                            <button class="btn btn-primary" type="button" id="btnBuscarHerramientaOt" title="Buscar">
                                                <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" width="20" height="20">
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-sm btn-primary ms-auto" id="btnRecargarOt" title="Recargar Tabla">
                                    <i class="bi bi-arrow-clockwise"></i> <!-- Icono de actualización -->
                                </button>
                                <strong>Herramientas para Orden de trabajo</strong>
                            </div>
                            <div class="card-body">
                                <?php
                                echo $insHerramienta->listarHerramientaOT();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>