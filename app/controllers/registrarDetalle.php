<?php
// Incluir el archivo que contiene la definición de la clase mainModel
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();

$id = $mainModel->limpiarCadena($_POST['id']);
$fecha = $mainModel->limpiarCadena($_POST['fecha']);
$desc = $mainModel->limpiarCadena($_POST['desc']);
$cant = $mainModel->limpiarCadena($_POST['cant']);
$turno = $mainModel->limpiarCadena($_POST['turno']);
$status = $mainModel->limpiarCadena($_POST['status']);
$cco = $mainModel->limpiarCadena($_POST['cco']);
$ccf = $mainModel->limpiarCadena($_POST['ccf']);
$tecnico = $mainModel->limpiarCadena($_POST['tecnico']);
$prep_ini = $mainModel->limpiarCadena($_POST['prep_ini']);
$prep_fin = $mainModel->limpiarCadena($_POST['prep_fin']);
$tras_ini = $mainModel->limpiarCadena($_POST['tras_ini']);
$tras_fin = $mainModel->limpiarCadena($_POST['tras_fin']);
$ejec_ini = $mainModel->limpiarCadena($_POST['ejec_ini']);
$ejec_fin = $mainModel->limpiarCadena($_POST['ejec_fin']);
$observacion = $mainModel->limpiarCadena($_POST['observacion']);

$consulta_datos = "
    INSERT INTO `detalle_orden`(
        `id`, `n_ot`, `fecha`, `descripcion`, `id_turno`, `id_miembro_cco`, 
        `id_user_act`, `id_miembro_ccf`, `id_estado`, `cant_tec`, `hora_ini_pre`, 
        `hora_fin_pre`, `hora_ini_tra`, `hora_fin_tra`, `hora_ini_eje`, `hora_fin_eje`, 
        `observacion`
    ) VALUES (
        NULL, '$id', '$fecha', '$desc', '$turno', '$cco', 
        '$tecnico', '$ccf', '$status', '$cant', '$prep_ini', 
        '$prep_fin', '$tras_ini', '$tras_fin', '$ejec_ini', '$ejec_fin', 
        '$observacion'
    )
";

// Llamar al método ejecutarConsulta desde el contexto de mainModel
$datos = $mainModel->ejecutarConsultaDesdeCargarUser($consulta_datos);
$total = $datos->rowCount();

$tdatos = [];

if ($total > 0) {
    $tdatos = $datos->fetch(PDO::FETCH_ASSOC);
}

echo json_encode($tdatos, JSON_UNESCAPED_UNICODE);
