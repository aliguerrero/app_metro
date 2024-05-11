<?php
// Incluir el archivo que contiene la definición de la clase mainModel
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();

$tipoBusqueda = $mainModel->limpiarCadena($_GET['tipoBusqueda']);

if ($tipoBusqueda != 'eliminar') {
    if ($tipoBusqueda == 'id') {
        $id = $mainModel->limpiarCadena($_GET['id']);
        $accion = $mainModel->limpiarCadena($_GET['accion']);
        $fecha_desde = $mainModel->limpiarCadena($_GET['fecha_desde']);
        $fecha_hasta = $mainModel->limpiarCadena($_GET['fecha_hasta']);
        if ($id == 'TODOS' && $accion == 'TODAS') {
            $consulta_datos = "
        SELECT log.*, user.user AS nombre_usuario
        FROM log_user AS log
        JOIN user_system AS user ON log.id_user = user.id_user
        WHERE  DATE(log.fecha_hora) BETWEEN '$fecha_desde' AND '$fecha_hasta';
        ";
        }
        if ($id != 'TODOS' && $accion == 'TODAS') {
            $consulta_datos = "
        SELECT log.*, user.user AS nombre_usuario
        FROM log_user AS log
        JOIN user_system AS user ON log.id_user = user.id_user
        WHERE  DATE(log.fecha_hora) BETWEEN '$fecha_desde' AND '$fecha_hasta'
        AND log.id_user = '$id';
        ";
        }
        if ($id != 'TODOS' && $accion != 'TODAS') {
            $consulta_datos = "
        SELECT log.*, user.user AS nombre_usuario
        FROM log_user AS log
        JOIN user_system AS user ON log.id_user = user.id_user
        WHERE  DATE(log.fecha_hora) BETWEEN '$fecha_desde' AND '$fecha_hasta'
        AND log.id_user = '$id' AND log.accion = '$accion';
        ";
        }
        if ($id == 'TODOS' && $accion != 'TODAS') {
            $consulta_datos = "
        SELECT log.*, user.user AS nombre_usuario
        FROM log_user AS log
        JOIN user_system AS user ON log.id_user = user.id_user
        WHERE  DATE(log.fecha_hora) BETWEEN '$fecha_desde' AND '$fecha_hasta'
        AND log.accion = '$accion';
        ";
        }
    } else {
        $consulta_datos = "
        SELECT log.*, user.user AS nombre_usuario
        FROM log_user AS log
        JOIN user_system AS user ON log.id_user = user.id_user
        ";
    }
    $datos = $mainModel->ejecutarConsultaDesdeCargarUser($consulta_datos);
    $total = $datos->rowCount();
    $tdatos = [];

    if ($total > 0) {
        $tdatos = $datos->fetchAll(PDO::FETCH_ASSOC); // Obtener todas las filas como un array asociativo
    }

    echo json_encode($tdatos, JSON_UNESCAPED_UNICODE);
} else {
    //seccion de eliminar
}
