<?php
// Incluir el archivo que contiene la definición de la clase mainModel
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();

$tipoBusqueda = $mainModel->limpiarCadena($_GET['tipoBusqueda']);


if ($tipoBusqueda == 'todo') {
    $consulta_datos = "
    SELECT ot.*, det_ord.id_estado, estado.nombre_estado, estado.color
    FROM orden_trabajo ot
    LEFT JOIN (
        SELECT n_ot, MAX(id_estado) AS id_estado
        FROM detalle_orden
        GROUP BY n_ot
    ) det_ord ON ot.n_ot = det_ord.n_ot
    LEFT JOIN estado_ot estado ON det_ord.id_estado = estado.id_estado
    WHERE ot.std_reg = '1'
    ORDER BY ot.n_ot ASC;
    ";
}

if ($tipoBusqueda == 'ot') {
    $id = $mainModel->limpiarCadena($_GET['id']);
    $consulta_datos = "
    SELECT ot.*, eo.nombre_estado, eo.color
    FROM orden_trabajo ot
    LEFT JOIN (
        SELECT n_ot, MAX(id_estado) AS id_estado
        FROM detalle_orden
        GROUP BY n_ot
    ) det ON ot.n_ot = det.n_ot
    LEFT JOIN estado_ot eo ON det.id_estado = eo.id_estado
    WHERE ot.n_ot = '$id' AND ot.std_reg = '1';
    ";
}

if ($tipoBusqueda == 'fecha') {
    $area = $mainModel->limpiarCadena($_GET['area']);
    $fechaI = $mainModel->limpiarCadena($_GET['fechaI']);
    $fechaF = $mainModel->limpiarCadena($_GET['fechaF']);
    if ($area == "Seleccionar") {
        $consulta_datos = "
        SELECT ot.*, eo.nombre_estado, eo.color
        FROM orden_trabajo ot
        LEFT JOIN (
            SELECT n_ot, MAX(id_estado) AS id_estado
            FROM detalle_orden
            GROUP BY n_ot
        ) det ON ot.n_ot = det.n_ot
        LEFT JOIN estado_ot eo ON det.id_estado = eo.id_estado
        LEFT JOIN area_trabajo ae ON ot.id_area = ae.id_area
        WHERE ot.fecha BETWEEN '$fechaI' AND '$fechaF' AND ot.std_reg = '1';
        ";
    } else {
        $consulta_datos = "
        SELECT ot.*, eo.nombre_estado, eo.color
        FROM orden_trabajo ot
        LEFT JOIN (
            SELECT n_ot, MAX(id_estado) AS id_estado
            FROM detalle_orden
            GROUP BY n_ot
        ) det ON ot.n_ot = det.n_ot
        LEFT JOIN estado_ot eo ON det.id_estado = eo.id_estado
        LEFT JOIN area_trabajo ae ON ot.id_area = ae.id_area
        WHERE ot.fecha BETWEEN '$fechaI' AND '$fechaF' AND ae.nomeclatura='$area' AND ot.std_reg = '1';
        ";
    }
}

if ($tipoBusqueda == 'estado') {
    $area = $mainModel->limpiarCadena($_GET['area']);
    $estado = $mainModel->limpiarCadena($_GET['estado']);
    if ($area == "Seleccionar") {
        $consulta_datos = "
        SELECT ot.*, eo.nombre_estado, eo.color
        FROM orden_trabajo ot
        LEFT JOIN (
            SELECT n_ot, MAX(id_estado) AS id_estado
            FROM detalle_orden
            GROUP BY n_ot
        ) det ON ot.n_ot = det.n_ot
        LEFT JOIN estado_ot eo ON det.id_estado = eo.id_estado
        LEFT JOIN area_trabajo ae ON ot.id_area = ae.id_area
        WHERE det.id_estado = $estado AND ot.std_reg = '1';
        ";
    } else {
        $consulta_datos = "
        SELECT ot.*, eo.nombre_estado, eo.color
        FROM orden_trabajo ot
        LEFT JOIN (
            SELECT n_ot, MAX(id_estado) AS id_estado
            FROM detalle_orden
            GROUP BY n_ot
        ) det ON ot.n_ot = det.n_ot
        LEFT JOIN estado_ot eo ON det.id_estado = eo.id_estado
        LEFT JOIN area_trabajo ae ON ot.id_area = ae.id_area
        WHERE det.id_estado = $estado AND ae.nomeclatura='$area' AND ot.std_reg = '1';
        ";
    }
}

if ($tipoBusqueda == 'user') {
    $area = $mainModel->limpiarCadena($_GET['area']);
    $user = $mainModel->limpiarCadena($_GET['user']);
    if ($area == "Seleccionar") {
        $consulta_datos = "
        SELECT ot.*, eo.nombre_estado, eo.color
        FROM orden_trabajo ot
        LEFT JOIN (
            SELECT n_ot, MAX(id_estado) AS id_estado
            FROM detalle_orden
            GROUP BY n_ot
        ) det ON ot.n_ot = det.n_ot
        LEFT JOIN estado_ot eo ON det.id_estado = eo.id_estado
        LEFT JOIN area_trabajo ae ON ot.id_area = ae.id_area
        WHERE det.id_user_act = $user AND ot.std_reg = '1';
        ";
    } else {
        $consulta_datos = "
        SELECT ot.*, eo.nombre_estado, eo.color
        FROM orden_trabajo ot
        LEFT JOIN (
            SELECT n_ot, MAX(id_estado) AS id_estado
            FROM detalle_orden
            GROUP BY n_ot
        ) det ON ot.n_ot = det.n_ot
        LEFT JOIN estado_ot eo ON det.id_estado = eo.id_estado
        LEFT JOIN area_trabajo ae ON ot.id_area = ae.id_area
        WHERE det.id_user_act = $user AND ae.nomeclatura='$area' AND ot.std_reg = '1';
        ";
    }
}

// Llamar al método ejecutarConsulta desde el contexto de mainModel
$datos = $mainModel->ejecutarConsultaDesdeCargarUser($consulta_datos);
$total = $datos->rowCount();

$tdatos = [];

if ($total > 0) {
    $tdatos = $datos->fetchAll(PDO::FETCH_ASSOC); // Obtener todas las filas como un array asociativo
}

echo json_encode($tdatos, JSON_UNESCAPED_UNICODE);
