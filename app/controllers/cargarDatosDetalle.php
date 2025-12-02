<?php
// Incluir el archivo que contiene la definición de la clase mainModel
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();

$id = $mainModel->limpiarCadena($_POST['id']);
$fecha = $mainModel->limpiarCadena($_POST['fecha']);
$codigo = $mainModel->limpiarCadena($_POST['codigo']);
$tipo = $mainModel->limpiarCadena($_POST['tipo']);

if ($tipo != 'eliminar') {
    $consulta_datos = "SELECT detalle.*, usuario.user
    FROM detalle_orden detalle
    JOIN user_system usuario ON detalle.id_user_act = usuario.id_user
    WHERE detalle.n_ot = '$codigo' and detalle.fecha = '$fecha' and detalle.id = '$id'";
    // Llamar al método ejecutarConsulta desde el contexto de mainModel
    $datos = $mainModel->ejecutarConsultaDesdeCargarUser($consulta_datos);
    $total = $datos->rowCount();

    $tdatos = [];

    if ($total > 0) {
        $tdatos = $datos->fetch(PDO::FETCH_ASSOC);
    }

    echo json_encode($tdatos, JSON_UNESCAPED_UNICODE);
} else {
    $datosr = array(
        ':id' => $id,
        ':not' => $codigo,
        ':fecha' => $fecha
    );
    $consulta = "DELETE FROM detalle_orden WHERE n_ot = :not AND id = :id AND fecha = :fecha";
    $datos = $mainModel->ejecutarSqlUpdateOT($consulta, $datosr);
    echo json_encode($datos, JSON_UNESCAPED_UNICODE);
}
