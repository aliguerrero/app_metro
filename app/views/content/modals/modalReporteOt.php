<div class="modal fade" id="reporteOt" tabindex="-1" aria-labelledby="reporteOt" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?php echo APP_URL; ?>app/views/icons/ot.png" alt="icono" width="50" height="50">
                <h1 class="modal-title" id="tituloModal">Detalles de Orden de Trabajo</h1>
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal" title="Cerrar" onclick="cerrarVentana()">
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
                    <div class="col-md-5">
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-9">
                                        <button type="button" class="btn btn-sm btn-primary ms-auto" id="btnRecargarDetalle" title="Recargar Tabla">
                                            <i class="bi bi-arrow-clockwise"></i> <!-- Icono de actualización -->
                                        </button>
                                        <strong>Lista Detalles</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-sm btn-success ms-auto" id="btnCrear" title="Crear" onclick="limpiarDetalles()">
                                            <i class="bi bi-plus"></i>Nuevo Registro <!-- Icono de crear -->
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                // cargar tabla
                                echo $insOt->listarDetalles();
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card mb-4">
                            <div class="card-header">
                                <strong>Detalles de Orden de Trabajo</strong>
                            </div>
                            <div class="card-body">
                                <div class="row detalle">
                                    <form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/otAjax.php" method="POST">
                                        <input type="hidden" id="detalle" name="modulo_ot" value="registrar_detalle">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="exampleInputEmail1" class="form-label">Fecha:</label>
                                                <input type="date" class="form-control" id="fecha" name="fecha" aria-describedby="textHelp" onchange="">
                                            </div>
                                            <div class="col-md-10">
                                                <label class="form-label">Descripción:</label>
                                                <input class="form-control " id="desc" name="desc" type="text" value="" placeholder="Descripción del trabajo realizado">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><br>
                                                <input type="hidden" name="id" id="id" value="">
                                                <input type="hidden" name="id2" id="id2" value="">
                                                <label class="form-label">Cant. Operador(es):</label>
                                                <input class="form-control " id="cant" name="cant" type="number" placeholder="Cantidad de Operadores">

                                            </div>
                                            <div class="col-md-4"><br>
                                                <?php
                                                // cargar turno
                                                echo $insOt->listarComboTurnoControlador();
                                                ?> </div>
                                            <div class="col-md-4"><br>
                                                <label class="form-label">Estado O.T.:</label>
                                                <?php
                                                // cargar estado
                                                echo $insOt->listarComboEstadoControlador();
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><br>
                                                <?php
                                                // cargar combo
                                                echo $insOt->listarComboOtControlador(2);
                                                ?>
                                            </div>
                                            <div class="col-md-4"><br>
                                                <?php
                                                // cargar combo
                                                echo $insOt->listarComboOtControlador(1);
                                                ?>
                                            </div>
                                            <div class="col-md-4"><br>
                                                <?php
                                                // cargar tecnico
                                                echo $insOt->listarComboTecControlador();
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <legend class="border-bottom pb-2">Horas</legend>
                                            <div class="col-md-4">
                                                <div class="card my-5">
                                                    <div class="card-header text-center">
                                                        Preparación:
                                                    </div>
                                                    <div class="row">
                                                        <div class="hstack gap-1 p-1 mx-auto text-center">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm">Hora Ini</span>
                                                            <input type="time" class="form-control" id="prep_ini" name="prep_ini" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                        </div>

                                                        <div class="hstack gap-1 p-1 mx-auto text-center">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm">Hora Fin</span>
                                                            <input type="time" class="form-control" id="prep_fin" name="prep_fin" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card my-5">
                                                    <div class="card-header text-center">
                                                        Traslado:
                                                    </div>
                                                    <div class="row">
                                                        <div class="hstack gap-1 p-1 mx-auto text-center">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm">Hora Ini</span>
                                                            <input type="time" class="form-control" id="tras_ini" name="tras_ini" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                        </div>

                                                        <div class="hstack gap-1 p-1 mx-auto text-center">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm">Hora Fin</span>
                                                            <input type="time" class="form-control" id="tras_fin" name="tras_fin" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card my-5">
                                                    <div class="card-header text-center">
                                                        Ejecucion:
                                                    </div>
                                                    <div class="row">
                                                        <div class="hstack gap-1 p-1 mx-auto text-center">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm">Hora Ini</span>
                                                            <input type="time" class="form-control" id="ejec_ini" name="ejec_ini" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                        </div>

                                                        <div class="hstack gap-1 p-1 mx-auto text-center">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm">Hora Fin</span>
                                                            <input type="time" class="form-control" id="ejec_fin" name="ejec_fin">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label id="hello-world">Observacion</label>
                                            <textarea id="observacion" name="observacion" class="form-control" rows="5" maxlength="250"></textarea>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="form-control" style="background-color: rgb(60, 75, 100); color:white ;" type="submit" aria-haspopup="true" aria-expanded="false">Guardar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>