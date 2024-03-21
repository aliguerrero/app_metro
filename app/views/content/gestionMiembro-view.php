<div class='row'>
<div class='row pb-3'>
          <div class='header-divider'></div>
          <div class='container-fluid'>
            <nav aria-label='breadcrumb'>
              <ol class='breadcrumb my-0 ms-2'>
                <li class='breadcrumb-item'>
                  <!-- if breadcrumb is single--><span>Home</span>
                </li>
                <li class='breadcrumb-item active'><span>Panel</span></li>
              </ol>
            </nav>
          </div>
        </div>
<label class='form-label' for='validationServer02'>BUSCAR OPERADOR:</label>
<div class='col-md-4'>
    <input class='form-control is-valid' id='validationServer02' type='text' value='' required=''
        placeholder='Codigo/Nombre'>
    <div class='valid-feedback'>Bien Hecho</div>
</div>
<div class='col-md-1'>
    <button class='form-control' style='background-color: rgb(60, 75, 100); color:white ;' type='button'
        data-coreui-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Buscar</button>
</div>
</div>
<hr>

<div class='row'>
<div class='col-md-6'>
    <div class='row'>
        <label for=''>
            <h4>lISTADO DE OPERADORES</h4>
        </label>
        <div class='table-responsive'>
            <table class='table border mb-0'>
                <thead class='table-light fw-semibold'>
                    <tr class='align-middle'>
                        <th class='text-center'>
                            <svg class='icon'>
                                <use xlink:href='./app/views/icons/svg/free.svg#cil-people'></use>
                            </svg>
                        </th>
                        <th class='text-center'>Codigo</th>
                        <th>Nombre</th>
                        <th class='text-center'>Tipo de Operadores</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class='align-middle'>
                        <td class='text-center'>
                            <div class='avatar avatar-md'><img class='avatar-img'
                                    src='./app/views/img/avatars/1.jpg' alt='user@email.com'><span
                                    class='avatar-status bg-success'></span></div>
                        </td>
                        <td class='clearfix'>
                            <div class=''>H-002</div>
                        </td>
                        <td>
                            <div class='clearfix'>
                                <div class=''>MARTILLO</div>
                            </div>
                        </td>
                        <td class='text-center'>
                            <div class='clearfix'>
                                <div class=''>10</div>
                            </div>
                        </td>
                        <td>
                            <div class='dropdown'>
                                <button class='btn btn-transparent p-0' type='button'
                                    data-coreui-toggle='dropdown' aria-haspopup='true'
                                    aria-expanded='false'>
                                    <svg class='icon'>
                                        <use
                                            xlink:href='./app/views/icons/svg/free.svg#cil-options'>
                                        </use>
                                    </svg>
                                </button>
                                <div class='dropdown-menu dropdown-menu-end'>
                                    <a class='dropdown-item' href='#'>Ver</a>
                                    <a class='dropdown-item' href='#'>Editar</a>
                                    <a class='dropdown-item text-danger' href='#'>Eliminar</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class='align-middle'>
                        <td class='text-center'>
                            <div class='avatar avatar-md'><img class='avatar-img'
                                    src='./app/views/img/avatars/1.jpg' alt='user@email.com'><span
                                    class='avatar-status bg-success'></span></div>
                        </td>
                        <td class='clearfix'>
                            <div class=''>H-002</div>
                        </td>
                        <td>
                            <div class='clearfix'>
                                <div class=''>MARTILLO</div>
                            </div>
                        </td>
                        <td class='text-center'>
                            <div class='clearfix'>
                                <div class=''>10</div>
                            </div>
                        </td>

                        <td>
                            <div class='dropdown'>
                                <button class='btn btn-transparent p-0' type='button'
                                    data-coreui-toggle='dropdown' aria-haspopup='true'
                                    aria-expanded='false'>
                                    <svg class='icon'>
                                        <use
                                            xlink:href='./app/views/icons/svg/free.svg#cil-options'>
                                        </use>
                                    </svg>
                                </button>
                                <div class='dropdown-menu dropdown-menu-end'>
                                    <a class='dropdown-item' href='#'>Ver</a>
                                    <a class='dropdown-item' href='#'>Editar</a>
                                    <a class='dropdown-item text-danger' href='#'>Eliminar</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class='align-middle'>
                        <td class='text-center'>
                            <div class='avatar avatar-md'><img class='avatar-img'
                                    src='./app/views/img/avatars/1.jpg' alt='user@email.com'><span
                                    class='avatar-status bg-success'></span></div>
                        </td>
                        <td class='clearfix'>
                            <div class=''>H-002</div>
                        </td>
                        <td>
                            <div class='clearfix'>
                                <div class=''>MARTILLO</div>
                            </div>
                        </td>
                        <td class='text-center'>
                            <div class='clearfix'>
                                <div class=''>10</div>
                            </div>
                        </td>

                        <td>
                            <div class='dropdown'>
                                <button class='btn btn-transparent p-0' type='button'
                                    data-coreui-toggle='dropdown' aria-haspopup='true'
                                    aria-expanded='false'>
                                    <svg class='icon'>
                                        <use
                                            xlink:href='./app/views/icons/svg/free.svg#cil-options'>
                                        </use>
                                    </svg>
                                </button>
                                <div class='dropdown-menu dropdown-menu-end'>
                                    <a class='dropdown-item' href='#'>Ver</a>
                                    <a class='dropdown-item' href='#'>Editar</a>
                                    <a class='dropdown-item text-danger' href='#'>Eliminar</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><br>
</div>

<div class='col-md-4'>
    <form class='row g-3 FormularioAjax' action='<?php APP_URL ?>app/ajax/miembroAjax.php' method='POST'>
        <input type="hidden" name="modulo_miembro" value="registrar">
        <div class='row'>
            <div class='col-md-6'><br>
                <label class='form-label' for='validationServer01'>CODIGO:</label>
                <input class='form-control ' name='codigo' id='' type='text' value=''
                     placeholder='Ingrese Codigo'>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-6'>
                <label class='form-label' for='validationServer02'>NOMBRE DEL OPERADOR:</label>
                <input class='form-control ' name='nombre' id='' type='text' value=''
                    placeholder='Ingrese Nombre/Apellido'>
            </div>

            <div class='col-md-6'>
                <label class='form-label' for='validationServer03'>TIPO DE OPERADOR:</label>

                <select class='form-select' name='tipo' aria-label='Default select example'>
                    <option selected>Seleccionar</option>
                    <option value='1'>Op./Centro de Control de Falla</option>
                    <option value='2'>Op./Centro de Control de Operaciones</option>
                </select>                
            </div>
        </div>
        <div class='row offset-2 p-4'>
            <div class='col-md-4'>
                <button class='form-control' style='background-color: rgb(60, 75, 100); color:white ;'
                    type='submit'  aria-haspopup='true'
                    aria-expanded='false'>Guardar</button>
            </div>

            <div class='col-md-4'>
                <button class='form-control' style='background-color: rgb(60, 75, 100); color:white ;'
                    type='button'  aria-haspopup='true'
                    aria-expanded='false'>Cancelar</button>
            </div>
        </div>
    </form>    
</div>
 <!------------------------widgets-------------------------->

 <div class='col-md-2 p-4'>
    <div class='row'>
        <div class='card'>
            <div class='card-body'>
                <div class='text-medium-emphasis text-end mb-4'>
                    <svg class='icon icon-xxl'>
                        <use xlink:href='./app/views/icons/svg/free.svg#cil-people'></use>
                    </svg>
                </div>
                <div class='fs-4 fw-semibold'>87.500</div><small
                    class='text-medium-emphasis text-uppercase fw-semibold'>Responsable Ccf</small>
                <div class='progress progress-thin mt-3 mb-0'>
                    <div class='progress-bar bg-info' role='progressbar' style='width: 25%'
                        aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>
                </div>
            </div>
        </div>
    </div><br>

    <div class='row'>
        <div class='card'>
            <div class='card-body'>
                <div class='text-medium-emphasis text-end mb-4'>

                    <svg class='icon icon-xxl'>
                        <use xlink:href='./app/views/icons/svg/free.svg#cil-people'></use>
                    </svg>
                </div>
                <div class='fs-4 fw-semibold'>87.500</div><small
                    class='text-medium-emphasis text-uppercase fw-semibold'>Responsable Cco</small>
                <div class='progress progress-thin mt-3 mb-0'>
                    <div class='progress-bar bg-info' role='progressbar' style='width: 25%'
                        aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!------------------------ fin widgets-------------------------->
</div>