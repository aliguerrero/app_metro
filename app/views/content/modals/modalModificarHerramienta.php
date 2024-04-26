<div class="modal fade" id="ventanaModalModificarHerr" tabindex="-1" aria-labelledby="ventanaModalModificarHerr"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?php echo APP_URL; ?>app/views/icons/edit.png" alt="icono" width="50" height="50">
                <h5 class="modal-title" id="tituloModal">Modificar Herramienta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class='row g-3 FormularioAjax' action='<?php echo APP_URL; ?>app/ajax/herramientaAjax.php'
                    method='POST'>
                    <div class="col-md-9">
                        <label class="form-label"><b>SELECCIONAR HERRAMIENTA:</b></label>
                        <div class="input-group">
                            <select class="form-select" id="herramienta" name="herramienta" aria-label="Seleccionar herramienta">
                                <option value="1">SEÑALIZACIÓN</option>
                                <option value="2">INFRAESTRUCTURA</option>
                                <option value="3">APARATO DE VIA</option>
                                <option value="4">NO PROGRAMADA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><b>CANTIDAD:</b></label>
                        <div class="input-group">
                            <input class="form-control form-control-sm" id="cant" name="cant" type="number" placeholder="Cantidad">
                            <button class="btn btn-primary" type="submit" id="" title="Agregar">
                                <img src="<?php echo APP_URL; ?>app/views/icons/add.png" width="20" height="20">
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class='col-md-6'>
                            <button class='form-control' style='background-color: rgb(60, 75, 100); color:white ;'
                                type='submit' aria-haspopup='true' aria-expanded='false'>Guardar</button>
                        </div>

                        <div class='col-md-6'>
                            <button class='form-control' style='background-color: rgb(60, 75, 100); color:white ;'
                                type='button' aria-haspopup='true' aria-expanded='false'
                                data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>