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
<label class='form-label' for='validationServer02'>BUSCADOR HERRAMIENTA:</label>
<div class='col-md-4'>
  <input class='form-control ' id='validationServer02' type='text' value='' 
    placeholder='Codigo/Nombre'>
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
      <h4>Herramientas</h4>
    </label>
    <div class='table-responsive'>
      <table class='table border mb-0 table-striped table-hover'>
        <thead class='table-light fw-semibold'>
          <tr class='align-middle'>
            <th class='text-center'>
              <svg class='icon'>
                <use xlink:href='<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-people'></use>
              </svg>
            </th>
            <th class='text-center'>Codigo</th>
            <th>Nombre</th>
            <th class='text-center'>Cant. Disp.</th>
            <th class='text-center'>estado</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          
          <tr class='align-middle'>
            <td class='text-center'>
              <div class='avatar avatar-md'><img class='avatar-img' src='<?php echo APP_URL; ?>app/views/img/avatars/1.jpg'
                  alt='user@email.com'><span class='avatar-status bg-success'></span></div>
            </td>
            <td class='clearfix'>
              <div class=''></div>
            </td>
            <td>
              <div class='clearfix'>
                <div class=''></div>
              </div>
            </td>
            <td class='text-center'>
              <div class='clearfix'>
                <div class=''></div>
              </div>
            </td>  
            <td class='text-center'>
              <div class='clearfix'>
                <div class=''></div>
              </div>
            </td>        
            <td>
              <div class='dropdown'>
                <button class='btn btn-transparent p-0' type='button' data-coreui-toggle='dropdown'
                  aria-haspopup='true' aria-expanded='false'>
                  <svg class='icon'>
                    <use xlink:href='<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-options'></use>
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

  <div class='row'>
    <label for=''>
      <h4>Herramientas O.T</h4>
    </label>
    <div class='table-responsive'>
      <table class='table border mb-0 table-striped table-hover' >
        <thead class='table-light fw-semibold'>
          <tr class='align-middle'>
            <th class='text-center'>
              <svg class='icon'>
                <use xlink:href='<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-people'></use>
              </svg>
            </th>

            <th class='text-center'>Codigo</th>
            <th>Nombre</th>
            <th class='text-center'>Cant. Disp.</th>
            <th>Cant. Ocup. </th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr class='align-middle'>
            <td class='text-center'>
              <div class='avatar avatar-md'><img class='avatar-img' src='<?php echo APP_URL; ?>app/views/img/avatars/1.jpg'
                  alt='user@email.com'><span class='avatar-status bg-success'></span></div>
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
              <div class='clearfix'>
                <div class=''>5</div>
              </div>
            </td>
            <td>
              <div class='dropdown'>
                <button class='btn btn-transparent p-0' type='button' data-coreui-toggle='dropdown'
                  aria-haspopup='true' aria-expanded='false'>
                  <svg class='icon'>
                    <use xlink:href='<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-options'></use>
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
  </div>
</div>

<div class='col-md-4'>
<form class='row g-3 FormularioAjax' action='<?php APP_URL ?>app/ajax/herramientaAjax.php' method='POST'>
    <input type="hidden" name="modulo_herramienta" value="registrar">
    <div class='row'>
      <div class='col-md-5'><br>
        <label class='form-label' for='validationServer01'>CODIGO:</label>
        <input class='form-control ' name='codigo' id='validationServer01' type='text' value='' >
      </div>
    </div>
    <div class='row'>
      <div class='col-md-12'>
        <label class='form-label' for='validationServer02'>NOMBRE DE LA HERRAMIENTA:</label>
        <input class='form-control ' name='nombre' id='validationServer02' type='text' value='' >
      </div>
    </div>
    <div class='row'>
      <div class='col-md-6'>
        <label class='form-label' for='validationServerUsername'>CANTIDAD:</label>
        <input class='form-control' name='cant' id='validationServerUsername' type='number'
          aria-describedby='inputGroupPrepend3 validationServerUsernameFeedback' >

      </div>
      <div class='col-md-6'>
        <label class='form-label' for='validationServer03'>ESTADO:</label>

        <select class='form-select' name='estado' aria-label='Default select example'>
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


<div class='col-md-2 p-4'>
  <div class='row'>
    <div class='card'>
      <div class='card-body'>
        <div class='text-medium-emphasis text-end mb-4'>
          <svg class='icon icon-xxl'>
            <use xlink:href='<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-people'></use>
          </svg>
        </div>
        <div class='fs-4 fw-semibold'>87.500</div><small
          class='text-medium-emphasis text-uppercase fw-semibold'>Responsable Ccf</small>
        <div class='progress progress-thin mt-3 mb-0'>
          <div class='progress-bar bg-info' role='progressbar' style='width: 25%' aria-valuenow='25'
            aria-valuemin='0' aria-valuemax='100'></div>
        </div>
      </div>
    </div>
  </div><br>

  <div class='row'>
    <div class='card'>
      <div class='card-body'>
        <div class='text-medium-emphasis text-end mb-4'>

          <svg class='icon icon-xxl'>
            <use xlink:href='<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-people'></use>
          </svg>
        </div>
        <div class='fs-4 fw-semibold'>87.500</div><small
          class='text-medium-emphasis text-uppercase fw-semibold'>Responsable Cco</small>
        <div class='progress progress-thin mt-3 mb-0'>
          <div class='progress-bar bg-info' role='progressbar' style='width: 25%' aria-valuenow='25'
            aria-valuemin='0' aria-valuemax='100'></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!------------------------ fin widgets-------------------------->
</div>