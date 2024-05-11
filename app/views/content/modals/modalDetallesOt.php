<div class="modal fade" id="ventanaModalDetalleOt" tabindex="-1" aria-labelledby="ventanaModalDetalleOt" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?php echo APP_URL; ?>app/views/icons/detalle.png" alt="icono" width="50" height="50">
                <h5 class="modal-title" id="tituloModal">Detalles Orden de trabajo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/otAjax.php" method="POST">
                    <input type="hidden" id="detalle" name="modulo_ot" value="registrar_detalle">
                    <div class="row">
                        <div class="col-md-4"><br>
                            <input type="hidden" name="id" id="id" value="">
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
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Ini</span>
                                        <input type="time" class="form-control" id="prep_ini" name="prep_ini" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                    </div>

                                    <div class="hstack gap-1 p-1 mx-auto text-center">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Fin</span>
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
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Ini</span>
                                        <input type="time" class="form-control" id="tras_ini" name="tras_ini" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                    </div>

                                    <div class="hstack gap-1 p-1 mx-auto text-center">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Fin</span>
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
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Ini</span>
                                        <input type="time" class="form-control" id="ejec_ini" name="ejec_ini" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                    </div>

                                    <div class="hstack gap-1 p-1 mx-auto text-center">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Fin</span>
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
                        <div class="col-md-6">
                            <button class="form-control" style="background-color: rgb(60, 75, 100); color:white ;" type="submit" aria-haspopup="true" aria-expanded="false">Guardar</button>
                        </div>

                        <div class="col-md-6">
                            <button class="form-control" style="background-color: rgb(60, 75, 100); color:white ;" type="button" data-bs-dismiss="modal">Cancelar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>