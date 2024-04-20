<?php
// Incluir el archivo que contiene la definición de la clase mainModel
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();

$id = $mainModel->limpiarCadena($_POST['id']);

$consulta_datos = "SELECT detalle.*, usuario.user
FROM detalle_orden detalle
JOIN user_system usuario ON detalle.responsable_act = usuario.id_user
WHERE detalle.n_ot = '$id' LIMIT 1";

// Llamar al método ejecutarConsulta desde el contexto de mainModel
$datos = $mainModel->ejecutarConsultaDesdeCargarUser($consulta_datos);
$total = $datos->rowCount();

$tdatos = [];

if ($total > 0) {
    $tdatos = $datos->fetch(PDO::FETCH_ASSOC);
}

echo json_encode($tdatos, JSON_UNESCAPED_UNICODE);
?>