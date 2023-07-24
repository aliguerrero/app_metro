<?php
// Aquí puedes incluir tu archivo de configuración de la base de datos si lo tienes
// require_once 'config.php';

// Realiza cualquier procesamiento necesario para obtener el nuevo contenido
$contenido = "<div class='row'>
<div class='col-md-6 mb-3'>
<h6>Nro O.T.</h6>
  <input type='text' class='form-control' name='nombre_trab' id='' aria-describedby='textHelp'>
</div>
<div class='col-md-3 mb-3'>
  <button type='button' class='btn btn-secondary btn-lg'>Buscar</button>
</div>";

// Devuelve el nuevo contenido como respuesta
echo $contenido;
