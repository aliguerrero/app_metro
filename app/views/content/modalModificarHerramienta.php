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
                <form class='row g-3 FormularioAjax' action='<?php APP_URL ?>app/ajax/herramientaAjax.php'
                    method='POST'>
                    <input type="hidden" name="modulo_herramienta" value="registrar">
                    <div class='row'>
                        <div class='col-md-4'><br>
                            <input type="hidden" name="id" id="id">
                            <label class='form-label'>CODIGO:</label>
                            <input class='form-control ' name='codigo' id='codigo' type='text' value=''
                                placeholder='Ingrese codigo'>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <label class='form-label'>NOMBRE DE LA HERRAMIENTA:</label>
                            <input class='form-control ' name='nombre' id='nombre' type='text' value=''
                                placeholder='Ingrese Nombre de la herramienta'>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-4'>
                            <label class='form-label'>CANTIDAD:</label>
                            <input class='form-control' name='cant' id='cant' type='number' min="0"
                                placeholder='Ingrese cantidad'>
                        </div>
                        <div class='col-md-8'>
                            <label class='form-label'>ESTADO:</label>

                            <select class='form-select' name='estado' id="estado" aria-label='Default select example'>
                                <option selected>Seleccionar</option>
                                <option value='1'>Buen Estado</option>
                                <option value='2'>Regular</option>
                                <option value='3'>Mal Estado</option>
                            </select>
                        </div>
                    </div>
                    <div class='row offset-2 p-4'>
                        <div class='col-md-4'>
                            <button class='form-control' style='background-color: rgb(60, 75, 100); color:white ;'
                                type='submit' aria-haspopup='true' aria-expanded='false'>Guardar</button>
                        </div>

                        <div class='col-md-4'>
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