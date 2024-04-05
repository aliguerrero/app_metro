<div class="row">
        <div class="row pb-3">
          <div class="header-divider"></div>
          <div class="container-fluid">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                  <!-- if breadcrumb is single--><span>Home</span>
                </li>
                <li class="breadcrumb-item active"><span>Panel</span></li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label class="form-label" for="validationServer03"><b>SELECCIONE AREA:</b></label>
            <select class="form-select" aria-label="Default select example">
              <option value="1">SEÑALIZACIÓN</option>
              <option value="2">INFRAESTRUCTURA</option>
              <option value="">APARATO DE VIA</option>
              <option value="">NO PROGRAMADA</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label class="form-label" for="validationServer03">TIPO DE BUSQUEDA:</label>
            <select class="form-select" aria-label="Default select example">
              <option value="1">NRO O.T.</option>
              <option value="2">RANGO DE FECHA</option>
              <option value="">ESTADO</option>
              <option value="">OPERADOR</option>
            </select>
          </div>
          <div class="col-md-3">
            <label class="form-label" for="validationServer03">NUMERO DE ORDEN DE TRABAJO:</label>
            <input class="form-control " id="validationServer02" type="text" value="" required=""
              placeholder="Numero de O.T.">
            
          </div>
          <div class="col-md-1">
            <label class="form-label" for="validationServer03" style="color: rgb(235, 237, 239);">.</label>
            <button class="form-control" style="background-color: rgb(60, 75, 100); color:white ;" type="button"
              data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Buscar</button>
          </div>
        </div>

      </div>
      <hr>
      <div class="row">
        <!-- inicio tablas -->
        <div class="col-md-6">
          <div class="row">
            <label for="">
              <h4>Lista de O.T.</h4>
            </label>
            <div class="table-responsive">
              <table class="table border mb-0">
                <thead class="table-light fw-semibold">
                  <tr class="align-middle">
                    <th class="text-center">
                      <svg class="icon">
                        <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-people"></use>
                      </svg>
                    </th>
                    <th class="text-center">Codigo</th>
                    <th>Nombre trabajo</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="align-middle">
                    <td class="text-center">
                      <div class="avatar avatar-md"><img class="avatar-img" src="<?php echo APP_URL; ?>app/views/img/avatars/1.jpg"
                          alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </td>
                    <td class="clearfix">
                      <div class="">SE-001</div>
                    </td>
                    <td>
                      <div class="clearfix">
                        <div class="">MANTENIMIENTO VIAL</div>
                      </div>
                    </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                          <svg class="icon">
                            <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-options"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="#">Ver</a>
                          <a class="dropdown-item" href="#">Editar</a>
                          <a class="dropdown-item text-danger" href="#">Eliminar</a>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr class="align-middle">
                    <td class="text-center">
                      <div class="avatar avatar-md"><img class="avatar-img" src="<?php echo APP_URL; ?>app/views/img/avatars/1.jpg"
                          alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </td>
                    <td class="clearfix">
                      <div class="">H-002</div>
                    </td>
                    <td>
                      <div class="clearfix">
                        <div class="">MARTILLO</div>
                      </div>
                    </td>


                    <td>
                      <div class="dropdown">
                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                          <svg class="icon">
                            <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-options"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="#">Ver</a>
                          <a class="dropdown-item" href="#">Editar</a>
                          <a class="dropdown-item text-danger" href="#">Eliminar</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div><br>

          <div class="row">
            <label for="">
              <h4>Herramientas O.T</h4>
            </label>
            <div class="table-responsive">
              <table class="table border mb-0">
                <thead class="table-light fw-semibold">
                  <tr class="align-middle">
                    <th class="text-center">
                      <svg class="icon">
                        <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-people"></use>
                      </svg>
                    </th>

                    <th class="text-center">Codigo</th>
                    <th>Nombre</th>
                    <th>Cant. Ocup. </th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="align-middle">
                    <td class="text-center">
                      <div class="avatar avatar-md"><img class="avatar-img" src="<?php echo APP_URL; ?>app/views/img/avatars/1.jpg"
                          alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </td>
                    <td class="clearfix">
                      <div class="">H-002</div>
                    </td>
                    <td>
                      <div class="clearfix">
                        <div class="">MARTILLO</div>
                      </div>
                    </td>
                    <td>
                      <div class="clearfix">
                        <div class="">5</div>
                      </div>
                    </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                          <svg class="icon">
                            <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-options"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="#">Ver</a>
                          <a class="dropdown-item" href="#">Editar</a>
                          <a class="dropdown-item text-danger" href="#">Eliminar</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr class="align-middle">
                    <td class="text-center">
                      <div class="avatar avatar-md"><img class="avatar-img" src="<?php echo APP_URL; ?>app/views/img/avatars/1.jpg"
                          alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </td>
                    <td class="clearfix">
                      <div class="">H-002</div>
                    </td>
                    <td>
                      <div class="clearfix">
                        <div class="">MARTILLO</div>
                      </div>
                    </td>
                    <td>
                      <div class="clearfix">
                        <div class="">10</div>
                      </div>
                    </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                          <svg class="icon">
                            <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-options"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="#">Ver</a>
                          <a class="dropdown-item" href="#">Editar</a>
                          <a class="dropdown-item text-danger" href="#">Eliminar</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr class="align-middle">
                    <td class="text-center">
                      <div class="avatar avatar-md"><img class="avatar-img" src="<?php echo APP_URL; ?>app/views/img/avatars/1.jpg"
                          alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </td>
                    <td class="clearfix">
                      <div class="">H-002</div>
                    </td>
                    <td>
                      <div class="clearfix">
                        <div class="">MARTILLO</div>
                      </div>
                    </td>
                    <td>
                      <div class="clearfix">
                        <div class="">7</div>
                      </div>
                    </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                          <svg class="icon">
                            <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-options"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="#">Ver</a>
                          <a class="dropdown-item" href="#">Editar</a>
                          <a class="dropdown-item text-danger" href="#">Eliminar</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- fin tablas -->

        <!-- inicio Formulario -->
        <div class="col-md-6">
          <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <button class="nav-link active" id="v-pills-home-tab" data-coreui-toggle="pill"
                data-coreui-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                aria-selected="true">O.T.</button>
              <button class="nav-link" id="v-pills-profile-tab" data-coreui-toggle="pill"
                data-coreui-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                aria-selected="false">Detalle</button>
              <button class="nav-link" id="v-pills-messages-tab" data-coreui-toggle="pill"
                data-coreui-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages"
                aria-selected="false">Herramienta</button>
            </div>
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                aria-labelledby="v-pills-home-tab" tabindex="0">
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
                      <input class="form-control " id="validationServer02" type="text" value="" required="" placeholder="Titulo del trabajo a registrar">
                      
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <label class="form-label" for="validationServerUsername">Semana:</label>
                      <input class="form-control " id="validationServerUsername" type="number"
                        aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required="" placeholder="Numero de de semana">
                      
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
                      <div class="invalid-feedback" id="validationServer03Feedback">Por favor seleccione un estado</div>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label" for="validationServer03">Sitio de Trabajo:</label>
                      <select class="form-select" aria-label="Default select example">
                        <option selected="" disabled="">Seleccione el sitio</option>
                        <option value="1">Linea</option>
                        <option value="2">Patio</option>
                      </select>
                      <div class="invalid-feedback" id="validationServer03Feedback">Por favor seleccione un estado</div>
                    </div>
                  </div>
                  <div class="row p-3">
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
              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"
                tabindex="0">
                <form class="row g-3">
                  <div class="row">
                    <div class="col-md-4"><br>
                      <label class="form-label" for="validationServerUsername">Cant. Operador(es):</label>
                      <input class="form-control " id="validationServerUsername" type="number"
                        aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required="" placeholder="Cantidad de Operadores">
                      
                    </div>
                    <div class="col-md-4"><br>
                      <label class="form-label" for="validationServer03">Turno:</label>
                      <select class="form-select" aria-label="Default select example">
                        <option selected="" disabled="">Seleccione el Turno</option>
                        <option value="1">Mañana (M1)</option>
                        <option value="2">Mañana (M2)</option>
                        <option value="3">Tarde (T1)</option>
                        <option value="4">Tarde (T2)</option>
                        <option value="5">Noche (N1)</option>
                        <option value="6">Noche (N2)</option>
                      </select>
                      <div class="invalid-feedback" id="validationServer03Feedback">Por favor seleccione un estado</div>
                    </div>
                    <div class="col-md-4"><br>
                      <label class="form-label" for="validationServer03">Status:</label>
                      <select class="form-select" aria-label="Default select example">
                        <option selected="" disabled="">Seleccione el Estatus</option>
                        <option value="1">EJECUTADA</option>
                        <option value="2">NO EJECUTADA</option>
                        <option value="3">EXTEMPORANEA</option>
                        <option value="4">REPROGRAMADA</option>
                        <option value="5">SUSPENDIDA</option>
                      </select>
                      <div class="invalid-feedback" id="validationServer03Feedback">Por favor seleccione un estado</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4"><br>
                      <label class="form-label" for="validationServer03">RESP. CCO:</label>
                      <select class="form-select" aria-label="Default select example">
                        <option selected="" disabled="">Seleccione resp.</option>
                        <option value="1">CCO001 - JUAN GUERRA</option>
                      </select>
                      <div class="invalid-feedback" id="validationServer03Feedback">Por favor seleccione un estado</div>
                    </div>
                    <div class="col-md-4"><br>
                      <label class="form-label" for="validationServer03">RESP. CCF:</label>
                      <select class="form-select" aria-label="Default select example">
                        <option selected="" disabled="">Seleccione resp.</option>
                        <option value="1">CCF001 - PEDRO PEREZ</option>
                      </select>
                      <div class="invalid-feedback" id="validationServer03Feedback">Por favor seleccione un estado</div>
                    </div>
                    <div class="col-md-4"><br>
                      <label class="form-label" for="validationServer02">Tecnico Resp.</label>
                      <input class="form-control " id="validationServer02" type="text" value="" required=""
                        placeholder="Nombre del tecnico">
                      
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
                            <input type="time" class="form-control" name="prep_ini" aria-label="Sizing example input"
                              aria-describedby="inputGroup-sizing-sm">
                          </div>

                          <div class="hstack gap-1 p-1 mx-auto text-center">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Fin</span>
                            <input type="time" class="form-control" name="prep_fin" aria-label="Sizing example input"
                              aria-describedby="inputGroup-sizing-sm">
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
                            <input type="time" class="form-control" name="tras_ini" aria-label="Sizing example input"
                              aria-describedby="inputGroup-sizing-sm">
                          </div>

                          <div class="hstack gap-1 p-1 mx-auto text-center">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Fin</span>
                            <input type="time" class="form-control" name="tras_fin" aria-label="Sizing example input"
                              aria-describedby="inputGroup-sizing-sm">
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
                            <input type="time" class="form-control" name="ejec_ini" aria-label="Sizing example input"
                              aria-describedby="inputGroup-sizing-sm">
                          </div>

                          <div class="hstack gap-1 p-1 mx-auto text-center">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Fin</span>
                            <input type="time" class="form-control" name="ejec_fin" aria-label="Sizing example input"
                              aria-describedby="inputGroup-sizing-sm">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label id="hello-world">Observacion</label>
                    <textarea type="text" name="observacion" class="form-control" rows="5"
                      required="Debe llenar este campo"></textarea>
                  </div>
                  <div class="row p-3">
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
              <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"
                tabindex="0"><br>

                <div class="row">
                  <div class="row">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ventanaModal">
                      Añadir Herrameinta
                    </button>
                  </div>
                  <div class="modal fade modal-xl" id="ventanaModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Herramientas</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="row">
                              <div class="col-md-12">
                                <label class="form-label" for="validationServer02">Buscar herramienta por codigo /
                                  Nombre</label>
                                <input class="form-control " id="validationServer02" type="text" value=""
                                  required="" placeholder="Ingrese Codigo / Nombre de la herramienta">
                                
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">

                                <label for="">
                                  <h4>Herramientas</h4>
                                </label>
                                <div class="table-responsive">
                                  <table class="table border mb-0">
                                    <thead class="table-light fw-semibold">
                                      <tr class="align-middle">
                                        <th class="text-center">
                                          <svg class="icon">
                                            <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-people"></use>
                                          </svg>
                                        </th>

                                        <th class="text-center">Codigo</th>
                                        <th>Nombre</th>
                                        <th>Cant. Ocup. </th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr class="align-middle">
                                        <td class="text-center">
                                          <div class="avatar avatar-md"><img class="avatar-img"
                                              src="<?php echo APP_URL; ?>app/views/img/avatars/1.jpg" alt="user@email.com"><span
                                              class="avatar-status bg-success"></span></div>
                                        </td>
                                        <td class="clearfix">
                                          <div class="">H-002</div>
                                        </td>
                                        <td>
                                          <div class="clearfix">
                                            <div class="">MARTILLO</div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="clearfix">
                                            <div class="">5</div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="dropdown">
                                            <button class="btn btn-transparent p-0" type="button"
                                              data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <svg class="icon">
                                                <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-options"></use>
                                              </svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                              <a class="dropdown-item" href="#">Ver</a>
                                              <a class="dropdown-item" href="#">Editar</a>
                                              <a class="dropdown-item text-danger" href="#">Eliminar</a>
                                            </div>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr class="align-middle">
                                        <td class="text-center">
                                          <div class="avatar avatar-md"><img class="avatar-img"
                                              src="<?php echo APP_URL; ?>app/views/img/avatars/1.jpg" alt="user@email.com"><span
                                              class="avatar-status bg-success"></span></div>
                                        </td>
                                        <td class="clearfix">
                                          <div class="">H-002</div>
                                        </td>
                                        <td>
                                          <div class="clearfix">
                                            <div class="">MARTILLO</div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="clearfix">
                                            <div class="">10</div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="dropdown">
                                            <button class="btn btn-transparent p-0" type="button"
                                              data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <svg class="icon">
                                                <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-options"></use>
                                              </svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                              <a class="dropdown-item" href="#">Ver</a>
                                              <a class="dropdown-item" href="#">Editar</a>
                                              <a class="dropdown-item text-danger" href="#">Eliminar</a>
                                            </div>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr class="align-middle">
                                        <td class="text-center">
                                          <div class="avatar avatar-md"><img class="avatar-img"
                                              src="<?php echo APP_URL; ?>app/views/img/avatars/1.jpg" alt="user@email.com"><span
                                              class="avatar-status bg-success"></span></div>
                                        </td>
                                        <td class="clearfix">
                                          <div class="">H-002</div>
                                        </td>
                                        <td>
                                          <div class="clearfix">
                                            <div class="">MARTILLO</div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="clearfix">
                                            <div class="">7</div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="dropdown">
                                            <button class="btn btn-transparent p-0" type="button"
                                              data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <svg class="icon">
                                                <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-options"></use>
                                              </svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                              <a class="dropdown-item" href="#">Ver</a>
                                              <a class="dropdown-item" href="#">Editar</a>
                                              <a class="dropdown-item text-danger" href="#">Eliminar</a>
                                            </div>
                                          </div>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-6">

                                <label for="">
                                  <h4>Herramienta(s) cargadas O.T.</h4>
                                </label>
                                <div class="table-responsive">
                                  <table class="table border mb-0">
                                    <thead class="table-light fw-semibold">
                                      <tr class="align-middle">
                                        <th class="text-center">
                                          <svg class="icon">
                                            <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-people"></use>
                                          </svg>
                                        </th>

                                        <th class="text-center">Codigo</th>
                                        <th>Nombre</th>
                                        <th>Cant. Ocup. </th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr class="align-middle">
                                        <td class="text-center">
                                          <div class="avatar avatar-md"><img class="avatar-img"
                                              src="<?php echo APP_URL; ?>app/views/img/avatars/1.jpg" alt="user@email.com"><span
                                              class="avatar-status bg-success"></span></div>
                                        </td>
                                        <td class="clearfix">
                                          <div class="">H-002</div>
                                        </td>
                                        <td>
                                          <div class="clearfix">
                                            <div class="">MARTILLO</div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="clearfix">
                                            <div class="">5</div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="dropdown">
                                            <button class="btn btn-transparent p-0" type="button"
                                              data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <svg class="icon">
                                                <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-options"></use>
                                              </svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                              <a class="dropdown-item" href="#">Ver</a>
                                              <a class="dropdown-item" href="#">Editar</a>
                                              <a class="dropdown-item text-danger" href="#">Eliminar</a>
                                            </div>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr class="align-middle">
                                        <td class="text-center">
                                          <div class="avatar avatar-md"><img class="avatar-img"
                                              src="<?php echo APP_URL; ?>app/views/img/avatars/1.jpg" alt="user@email.com"><span
                                              class="avatar-status bg-success"></span></div>
                                        </td>
                                        <td class="clearfix">
                                          <div class="">H-002</div>
                                        </td>
                                        <td>
                                          <div class="clearfix">
                                            <div class="">MARTILLO</div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="clearfix">
                                            <div class="">10</div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="dropdown">
                                            <button class="btn btn-transparent p-0" type="button"
                                              data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <svg class="icon">
                                                <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-options"></use>
                                              </svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                              <a class="dropdown-item" href="#">Ver</a>
                                              <a class="dropdown-item" href="#">Editar</a>
                                              <a class="dropdown-item text-danger" href="#">Eliminar</a>
                                            </div>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr class="align-middle">
                                        <td class="text-center">
                                          <div class="avatar avatar-md"><img class="avatar-img"
                                              src="<?php echo APP_URL; ?>app/views/img/avatars/1.jpg" alt="user@email.com"><span
                                              class="avatar-status bg-success"></span></div>
                                        </td>
                                        <td class="clearfix">
                                          <div class="">H-002</div>
                                        </td>
                                        <td>
                                          <div class="clearfix">
                                            <div class="">MARTILLO</div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="clearfix">
                                            <div class="">7</div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="dropdown">
                                            <button class="btn btn-transparent p-0" type="button"
                                              data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <svg class="icon">
                                                <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-options"></use>
                                              </svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                              <a class="dropdown-item" href="#">Ver</a>
                                              <a class="dropdown-item" href="#">Editar</a>
                                              <a class="dropdown-item text-danger" href="#">Eliminar</a>
                                            </div>
                                          </div>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <div class="row">
                            <div class="col-md-8">
                              <button type="button" class="btn btn-primary" data-dismiss="modal">Cargar
                                Herramientas</button>
                            </div>
                            <div class="col-md-2">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label for="">
                      <h4>Herramientas O.T</h4>
                    </label>
                    <div class="table-responsive">
                      <table class="table border mb-0">
                        <thead class="table-light fw-semibold">
                          <tr class="align-middle">
                            <th class="text-center">
                              <svg class="icon">
                                <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-people"></use>
                              </svg>
                            </th>

                            <th class="text-center">Codigo</th>
                            <th>Nombre</th>
                            <th>Cant. Ocup. </th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="align-middle">
                            <td class="text-center">
                              <div class="avatar avatar-md"><img class="avatar-img" src="<?php echo APP_URL; ?>app/views/img/avatars/1.jpg"
                                  alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                            </td>
                            <td class="clearfix">
                              <div class="">H-002</div>
                            </td>
                            <td>
                              <div class="clearfix">
                                <div class="">MARTILLO</div>
                              </div>
                            </td>
                            <td>
                              <div class="clearfix">
                                <div class="">5</div>
                              </div>
                            </td>
                            <td>
                              <div class="dropdown">
                                <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown"
                                  aria-haspopup="true" aria-expanded="false">
                                  <svg class="icon">
                                    <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-options"></use>
                                  </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                  <a class="dropdown-item" href="#">Ver</a>
                                  <a class="dropdown-item" href="#">Editar</a>
                                  <a class="dropdown-item text-danger" href="#">Eliminar</a>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr class="align-middle">
                            <td class="text-center">
                              <div class="avatar avatar-md"><img class="avatar-img" src="<?php echo APP_URL; ?>app/views/img/avatars/1.jpg"
                                  alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                            </td>
                            <td class="clearfix">
                              <div class="">H-002</div>
                            </td>
                            <td>
                              <div class="clearfix">
                                <div class="">MARTILLO</div>
                              </div>
                            </td>
                            <td>
                              <div class="clearfix">
                                <div class="">10</div>
                              </div>
                            </td>
                            <td>
                              <div class="dropdown">
                                <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown"
                                  aria-haspopup="true" aria-expanded="false">
                                  <svg class="icon">
                                    <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-options"></use>
                                  </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                  <a class="dropdown-item" href="#">Ver</a>
                                  <a class="dropdown-item" href="#">Editar</a>
                                  <a class="dropdown-item text-danger" href="#">Eliminar</a>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr class="align-middle">
                            <td class="text-center">
                              <div class="avatar avatar-md"><img class="avatar-img" src="<?php echo APP_URL; ?>app/views/img/avatars/1.jpg"
                                  alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                            </td>
                            <td class="clearfix">
                              <div class="">H-002</div>
                            </td>
                            <td>
                              <div class="clearfix">
                                <div class="">MARTILLO</div>
                              </div>
                            </td>
                            <td>
                              <div class="clearfix">
                                <div class="">7</div>
                              </div>
                            </td>
                            <td>
                              <div class="dropdown">
                                <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown"
                                  aria-haspopup="true" aria-expanded="false">
                                  <svg class="icon">
                                    <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-options"></use>
                                  </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                  <a class="dropdown-item" href="#">Ver</a>
                                  <a class="dropdown-item" href="#">Editar</a>
                                  <a class="dropdown-item text-danger" href="#">Eliminar</a>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- fin formulario -->

        <!-- inicio widgets 
        <div class="col-md-2 p-4">
          <div class="row">
            <div class="card">
              <div class="card-body">
                <div class="text-medium-emphasis text-end mb-4">
                  <svg class="icon icon-xxl">
                    <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-people"></use>
                  </svg>
                </div>
                <div class="fs-4 fw-semibold">100</div><small
                  class="text-medium-emphasis text-uppercase fw-semibold">Total O.T</small>
                <div class="progress progress-thin mt-3 mb-0">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div><br>

          <div class="row">
            <div class="card">
              <div class="card-body">
                <div class="text-medium-emphasis text-end mb-4">

                  <svg class="icon icon-xxl">
                    <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-people"></use>
                  </svg>
                </div>
                <div class="fs-4 fw-semibold">60</div><small
                  class="text-medium-emphasis text-uppercase fw-semibold">Total Herramienta O.T.</small>
                <div class="progress progress-thin mt-3 mb-0">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        ---->
      </div>