<?php
require_once '../modelo/modelo_registro_ot.php';

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los valores introducidos en los campos
  $not = $_POST['num_ot'];
  $nom_trab = $_POST['nombre_trab'];
  $sitio_trab = $_POST['sitio_trab'];
  $semana = $_POST['semana'];
  $mes = $_POST['mes'];
  $status = $_POST['estatus'];
  $obsv = $_POST['observacion'];
  $resp_cco = $_POST['resp_cco'];
  $resp_tec = $_POST['resp_tec'];
  $resp_ccf = $_POST['resp_ccf'];
  $hora_pre_ini = $_POST['prep_ini'];
  $hora_pre_fin = $_POST['prep_fin'];
  $hora_tra_ini = $_POST['tras_ini'];
  $hora_tra_fin = $_POST['tras_fin'];
  $hora_eje_ini = $_POST['ejec_ini'];
  $hora_eje_fin = $_POST['ejec_fin'];
  $fecha = $_POST['fecha'];
  $estado = '0';
  // Llamar al método del controlador para insertar los datos en la bSase de datos
  try {
    $model->insert_orden($not, $nom_trab, $sitio_trab, $semana, $mes, $status, $obsv, $resp_cco, $resp_tec, $resp_ccf, $hora_pre_ini, $hora_pre_fin, $hora_tra_ini, $hora_tra_fin, $hora_eje_ini, $hora_eje_fin, $fecha, $estado);
  } catch (mysqli_sql_exception $ex) {
    echo 'Excepción capturada: ',  $ex->getMessage(), "\n", $ex->getCode();
  }
} else {
  // Mostrar la vista para ingresar datos
  include '../../index.html';
}
