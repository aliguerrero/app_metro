<?php
// Incluir el archivo que contiene la definición de la clase mainModel
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();

$tipoBusqueda = $mainModel->limpiarCadena($_GET['tipoBusqueda']);

if ($tipoBusqueda != 'eliminar') {    
    if ($tipoBusqueda == 'cargarTabla') {
        $id = $mainModel->limpiarCadena($_GET['id']);
        $consulta_datos = "SELECT detalle.*, usuario.user,estado.*
        FROM detalle_orden detalle
        JOIN user_system usuario ON detalle.id_user_act = usuario.id_user
        JOIN estado_ot estado ON detalle.id_estado = estado.id_estado
        WHERE detalle.n_ot = '$id'";
    }    
    $datos = $mainModel->ejecutarConsultaDesdeCargarUser($consulta_datos);
    $total = $datos->rowCount();
    $tdatos = [];

    if ($total > 0) {
        $tdatos = $datos->fetchAll(PDO::FETCH_ASSOC); // Obtener todas las filas como un array asociativo
    }

    echo json_encode($tdatos, JSON_UNESCAPED_UNICODE);
} else {
    $tipo = $mainModel->limpiarCadena($_GET['tipo']);
    $id = $mainModel->limpiarCadena($_GET['id']);
    $codigoHer = $mainModel->limpiarCadena($_GET['codigoHer']);

    $consulta_datos = "SELECT * FROM herramientaot WHERE n_ot = '$id' AND id_herramienta = '$codigoHer'";
    $datos2 = $mainModel->ejecutarConsultaDesdeCargarUser($consulta_datos);

    if ($datos2) {
        $total = $datos2->rowCount();

        if ($total > 0) {
            $tdatos = $datos2->fetchAll(PDO::FETCH_ASSOC); // Obtener todas las filas como un array asociativo
        }
    }
    $consulta_datos = "SELECT h.*,(h.cantidad - COALESCE(SUM(hot.cantidadot), 0)) AS cantidad_disponible,
    COALESCE(SUM(hot.cantidadot), 0) AS herramienta_ocupada
    FROM 
    herramienta h
    LEFT JOIN 
    herramientaot hot ON h.id_herramienta = hot.id_herramienta 
    WHERE std_reg='1' AND h.id_herramienta = '$codigoHer'
    GROUP BY 
    h.id_herramienta ASC";
    $datos1 = $mainModel->ejecutarConsultaDesdeCargarUser($consulta_datos);

    if ($datos1) {
        $total1 = $datos1->rowCount();

        if ($total1 > 0) {
            $tdatos1 = $datos1->fetchAll(PDO::FETCH_ASSOC); // Obtener todas las filas como un array asociativo
        }
    }

    $datosr = array(
        ':not' => $id,
        ':idher' => $codigoHer
    );

    if ($total > 0) {
        if ($tipo == 'mas') {
            if ($tdatos1[0]['cantidad_disponible'] > 0) {
                $consulta = "UPDATE herramientaot SET cantidadot = cantidadot + 1 WHERE n_ot = :not AND id_herramienta = :idher";
                $datos = $mainModel->ejecutarSqlUpdateOT($consulta, $datosr);

                echo json_encode($datos, JSON_UNESCAPED_UNICODE);
            } else {

                echo json_encode("nohay", JSON_UNESCAPED_UNICODE);
            }
        } else {
            if ($tdatos[0]['cantidadot'] == 1) {
                $consulta = "DELETE FROM herramientaot WHERE n_ot = :not AND id_herramienta = :idher";
                $datos = $mainModel->ejecutarSqlUpdateOT($consulta, $datosr);

                echo json_encode($datos, JSON_UNESCAPED_UNICODE);
            } else {
                $consulta = "UPDATE herramientaot SET cantidadot = cantidadot - 1 WHERE n_ot = :not AND id_herramienta = :idher";
                $datos = $mainModel->ejecutarSqlUpdateOT($consulta, $datosr);

                echo json_encode($datos, JSON_UNESCAPED_UNICODE);
            }
        }
    } else {
        $consulta = "INSERT INTO herramientaot (n_ot, id_herramienta, cantidadot) VALUES (:not, :idher, 1)";
        $datos = $mainModel->ejecutarSqlUpdateOT($consulta, $datosr);

        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    }
}
