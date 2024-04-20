<div class="modal fade" id="ventanaModalRegistroOt" tabindex="-1" aria-labelledby="ventanaModalRegistroOt"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?php echo APP_URL; ?>app/views/icons/add.png" alt="icono" width="50" height="50">
                <h5 class="modal-title" id="tituloModal">Registrar Orden de Trabajo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/otAjax.php" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" name="modulo_ot" value="registrar_ot">
                            <label class="form-label"><b>SELECCIONE AREA:</b></label>
                            <select class="form-select" id="area" name="area" aria-label="Default select example">
                                <option value="1">SEÑALIZACIÓN</option>
                                <option value="2">INFRAESTRUCTURA</option>
                                <option value="3">APARATO DE VIA</option>
                                <option value="4">NO PROGRAMADA</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">NRO O.T.:</label>
                            <input class="form-control " id="codigo" name="codigo" type="text" value=""
                                placeholder="Numero de O.T.">
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1" class="form-label">Fecha O.T.:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" aria-describedby="textHelp"
                                onchange="calcularSemanaYMes()">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Nombre del Trabajo:</label>
                            <input class="form-control " id="nombre" name="nombre" type="text" value=""
                                placeholder="Titulo del trabajo a registrar">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Semana:</label>
                            <input class="form-control " id="semana" name="semana" type="number"
                                aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback"
                                placeholder="Numero de de semana">

                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Mes:</label>
                            <select class="form-select" id="mes" name="mes" aria-label="Default select example">
                                <option selected>Seleccionar</option>
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4">Abril</option>
                                <option value="5">Mayo</option>
                                <option value="6">Junio</option>
                                <option value="7">Julio</option>
                                <option value="8">Agosto</option>
                                <option value="9">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sitio de Trabajo:</label>
                            <select class="form-select" id="sitio" name="sitio" aria-label="Default select example">
                                <option selected>Seleccionar</option>
                                <option value="1">Linea</option>
                                <option value="2">Patio</option>
                            </select>
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