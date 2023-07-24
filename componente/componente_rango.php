<?php
// Aquí puedes incluir tu archivo de configuración de la base de datos si lo tienes
// require_once 'config.php';

// Realiza cualquier procesamiento necesario para obtener el nuevo contenido
$contenido = "<div class='row'>
<div class='col-md-4 mb-3 '>
  <h6>Desde:</h6>
  <input type='date' class='form-control' name='fecha' id='' aria-describedby='textHelp'>
</div>
<div class='col-md-4 mb-3 '>
  <h6>Hasta:</h6>
  <input type='date' class='form-control' name='fecha' id='' aria-describedby='textHelp'>
</div>               
<div class='col-md-4 mb-3'>
  <button type='button' class='btn btn-secondary btn-lg'>Buscar</button>
</div>
</div>";

// Devuelve el nuevo contenido como respuesta
echo $contenido;
?>