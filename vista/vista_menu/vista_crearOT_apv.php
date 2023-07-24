<?php
// Aquí puedes incluir tu archivo de configuración de la base de datos si lo tienes
// require_once 'config.php';

// Realiza cualquier procesamiento necesario para obtener el nuevo contenido
$contenido = "<div class='pagetitle'>
<h1>Creacion de Orden de Trabajo 'Aparato de Via'</h1>
<nav>
  <ol class='breadcrumb'>
    <li class='breadcrumb-item'><a href='index.html'>Aparato de Via</a></li>
    <li class='breadcrumb-item active'>Creacion O.T.</li>
  </ol>
</nav>
</div><!-- End Page Title -->

<section class='section dashboard' id=''>

<form action='index.php' method='POST'>
  <div class='container'>
    <div class='row'>
      <div class='col-md-2 mb-3'>
        <label for='exampleInputEmail1' class='form-label'>N° O.T.</label>
        <input type='text' class='form-control' name='num_ot' id='' aria-describedby='textHelp'>
        <div id='emailHelp' class='form-text'>Orden repetida</div>
      </div>
      <div class='col-md-3 mb-3 offset-7'>
        <label for='exampleInputEmail1' class='form-label'>Fecha Actual</label>
        <input type='date' class='form-control' name='fecha' id='' aria-describedby='textHelp'>
      </div>
    </div>
    <div class='row'>
      <div class='col-md-8 mb-3'>
        <label for='exampleInputEmail1' class='form-label'>Nombre de trabajo</label>
        <input type='text' class='form-control' name='nombre_trab' id='' aria-describedby='textHelp'>
      </div>
      <div class='col-md-4 mb-3'>
        <label for='exampleInputEmail1' class='form-label'>Sitio de trabajo</label>
        <select class='form-select' name='sitio_trab' aria-label='Default select example'>
          <option selected disabled>Seleccione...</option>
          <option value='1'>Línea</option>
          <option value='2'>Patio</option>
        </select>
      </div>
    </div>
    <div class='row'>
      <div class='col-md-4 mb-3'>
        <label for='exampleInputEmail1' class='form-label'>Semana</label>
        <input type='number' name='semana' class='form-control' id='' aria-describedby='textHelp'>
      </div>
      <div class='col-md-4 mb-3'>
        <label for='exampleInputEmail1' class='form-label'>Mes</label>
        <select class='form-select' name='mes' aria-label='Default select example'>
          <option selected disabled>Seleccione...</option>
          <option value='1'>Enero</option>
          <option value='2'>Febrero</option>
          <option value='3'>Marzo</option>
          <option value='4'>Abril</option>
          <option value='5'>Mayo</option>
          <option value='6'>Junio</option>
          <option value='7'>Julio</option>
          <option value='8'>Agosto</option>
          <option value='9'>Septiembre</option>
          <option value='10'>Octubre</option>
          <option value='11'>Noviembre</option>
          <option value='12'>Diciembre</option>
        </select>
      </div>
      <div class='col-md-4 mb-3'>
        <label for='exampleInputEmail1' class='form-label'>Estatus</label>
        <select class='form-select' name='estatus' aria-label='Default select example'>
          <option selected disabled>Seleccione...</option>
          <option value='1'>TRABAJO</option>
        </select>
      </div>
    </div>
    <div class='row'>
      <div class='col-md-4 mb-3'>
        <label for='exampleInputEmail1' class='form-label'>Resp. Cco</label>
        <input type='text' class='form-control' name='resp_cco' id='' aria-describedby='textHelp'>
      </div>
      <div class='col-md-4 mb-3'>
        <label for='exampleInputEmail1' class='form-label'>Resp. Ccf</label>
        <input type='text' class='form-control' name='resp_ccf' id='' aria-describedby='textHelp'>
      </div>
      <div class='col-md-4 mb-4'>
        <label for='exampleInputEmail1' class='form-label'>Tecníco Resp.</label>
        <input type='text' class='form-control' name='resp_tec' id='' aria-describedby='textHelp'>
      </div>


      <fieldset class='border p-3 mb-3'>
        <legend class='border-bottom pb-2'>Horas</legend>
        <!----------------------------------------horas hombre--------------------------------------->
        <div class='row'>

          <div class='card my-5 w-30' style='width: 15rem; margin-left:28px;'>
            <div class='card-header text-center'>
              Preparacion:
            </div>
            <div class='row'>
              <div class='hstack gap-1 p-1 mx-auto text-center'>
                <span class='input-group-text' id='inputGroup-sizing-sm'>Inicio</span>
                <input type='time' class='form-control' name='prep_ini' aria-label='Sizing example input'
                  aria-describedby='inputGroup-sizing-sm' name='hr_preparacion'>
              </div>

              <div class='hstack gap-1 p-1 mx-auto text-center'>
                <span class='input-group-text' id='inputGroup-sizing-sm'>Fin</span>
                <input type='time' class='form-control' name='prep_fin' aria-label='Sizing example input'
                  aria-describedby='inputGroup-sizing-sm' name='fin_prep'>
              </div>
            </div>
          </div>
          <!------------------------------------fin preparacion------------------------------->
          <div class='card my-5 w-30 offset-1' style='width: 15rem; margin-left:70px;'>
            <div class='card-header text-center'>
              Traslado:
            </div>
            <div class='row'>
              <div class='hstack gap-1 p-1 mx-auto text-center'>
                <span class='input-group-text' id='inputGroup-sizing-sm'>Inicio</span>
                <input type='time' class='form-control' name='tras_ini' aria-label='Sizing example input'
                  aria-describedby='inputGroup-sizing-sm' name='hr_traslado'>
              </div>

              <div class='hstack gap-1 p-1 mx-auto text-center'>
                <span class='input-group-text' id='inputGroup-sizing-sm'>Fin</span>
                <input type='time' class='form-control' name='tras_fin' aria-label='Sizing example input'
                  aria-describedby='inputGroup-sizing-sm' name='fin_tras'>
              </div>
            </div>
          </div>
          <!------------------------------------fin traslado------------------------------->
          <div class='card my-5 w-30 offset-1' style='width: 15rem;'>
            <div class='card-header text-center'>
              Ejecucion:
            </div>
            <div class='row'>
              <div class='hstack gap-1 p-1 mx-auto text-center'>
                <span class='input-group-text' id='inputGroup-sizing-sm'>Inicio</span>
                <input type='time' class='form-control' name='ejec_ini' aria-label='Sizing example input'
                  aria-describedby='inputGroup-sizing-sm' name='hr_ejecucion'>
              </div>

              <div class='hstack gap-1 p-1 mx-auto text-center'>
                <span class='input-group-text' id='inputGroup-sizing-sm'>Fin</span>
                <input type='time' class='form-control' name='ejec_fin' aria-label='Sizing example input'
                  aria-describedby='inputGroup-sizing-sm' name='fin_ejec'>
              </div>
            </div>
          </div>
          <!------------------------------------fin ejecucion------------------------------->

        </div><!--fin row-->
        <!---------------------------------fin horas hombre------------------------------------------>
      </fieldset>
    </div>
    <div class='col-md-7 offset-2'>
      <label id='hello-world'>Observacion</label>
      <textarea type='text' name='observacion' class='form-control' rows='4'
        required='Debe llenar este campo'></textarea>
    </div>
  </div>
  <button type='submit' class='btn btn-primary'>Submit</button>

  </div>
  </div>

</form>

</section>";
// Devuelve el nuevo contenido como respuesta
echo $contenido;
?>