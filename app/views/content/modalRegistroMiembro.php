<div class="modal fade" id="ventanaModalRegistrarMiem" tabindex="-1" aria-labelledby="ventanaModalRegistrarMiem"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?php echo APP_URL; ?>app/views/icons/add.png" alt="icono" width="50" height="50">
                <h5 class="modal-title" id="tituloModal">Registrar Nuevo Miembro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class='row g-3 FormularioAjax' action='<?php echo APP_URL ?>app/ajax/miembroAjax.php'
                    method='POST'>
                    <input type="hidden" name="modulo_miembro" value="registrar">
                    <div class='row'>
                        <div class='col-md-6'><br>
                            <label class='form-label' for='validationServer01'>CODIGO:</label>
                            <input class='form-control ' name='codigo' id='codigo' type='text' value=''
                                placeholder='Ingrese Codigo'>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <label class='form-label' for='validationServer02'>NOMBRE DEL OPERADOR:</label>
                            <input class='form-control ' name='nombre' id='nombre' type='text' value=''
                                placeholder='Ingrese Nombre/Apellido'>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <label class='form-label' for='validationServer03'>TIPO DE OPERADOR:</label>

                            <select class='form-select' name='tipo' id="tipo" aria-label='Default select example'>
                                <option selected>Seleccionar</option>
                                <option value='1'>Op./Centro de Control de Falla</option>
                                <option value='2'>Op./Centro de Control de Operaciones</option>
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