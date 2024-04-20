<div class="modal fade" id="ventanaModalModificarOt" tabindex=" -1" aria-labelledby="ventanaModalModificarOt"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?php echo APP_URL; ?>app/views/icons/edit.png" alt="icono" width="50" height="50">
                <h5 class="modal-title" id="tituloModal">Modificar Orden de trabajo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3">
                    <div class="row">
                        <div class="col-md-4"><br>
                            <label class="form-label" for="validationServer01">NRO O.T.</label>
                            <input class="form-control " id="validationServer01" type="text" value="" required=""
                                placeholder="Numero de O.T.">
                            <div class="valid-feedback">Disponible!</div>
                        </div>
                        <div class="col-md-4"><br>
                            <label for="exampleInputEmail1" class="form-label">Fecha Orden</label>
                            <input type="date" class="form-control" name="fecha" id="" aria-describedby="textHelp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label" for="validationServer02">Nombre del Trabajo</label>
                            <input class="form-control " id="validationServer02" type="text" value="" required=""
                                placeholder="Titulo del trabajo a registrar">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label" for="validationServerUsername">Semana:</label>
                            <input class="form-control " id="validationServerUsername" type="number"
                                aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required=""
                                placeholder="Numero de de semana">

                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="validationServer03">Mes:</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected="" disabled="">Seleccione el mes</option>
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
                            <div class="invalid-feedback" id="validationServer03Feedback">Por favor seleccione un estado
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="validationServer03">Sitio de Trabajo:</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected="" disabled="">Seleccione el sitio</option>
                                <option value="1">Linea</option>
                                <option value="2">Patio</option>
                            </select>
                            <div class="invalid-feedback" id="validationServer03Feedback">Por favor seleccione un estado
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="form-control" style="background-color: rgb(60, 75, 100); color:white ;"
                                type="button" data-coreui-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Guardar</button>
                        </div>

                        <div class="col-md-6">
                            <button class="form-control" style="background-color: rgb(60, 75, 100); color:white ;"
                                type="button" data-coreui-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>