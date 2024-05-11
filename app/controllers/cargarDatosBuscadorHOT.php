<?php
// Incluir el archivo que contiene la definición de la clase mainModel
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();

$tipoBusqueda = $mainModel->limpiarCadena($_GET['tipoBusqueda']);

if ($tipoBusqueda != 'eliminar') {
    if ($tipoBusqueda == 'todoHer') {
        $consulta_datos = "SELECT h.*,(h.cantidad - COALESCE(SUM(hot.cantidadot), 0)) AS cantidad_disponible,
        COALESCE(SUM(hot.cantidadot), 0) AS herramienta_ocupada
        FROM 
        herramienta h
        LEFT JOIN 
        herramientaot hot ON h.id_herramienta = hot.id_herramienta WHERE std_reg='1'
        GROUP BY 
        h.id_herramienta ASC";
    }
    if ($tipoBusqueda == 'todoHerOt') {
        $id = $mainModel->limpiarCadena($_GET['id']);
        $consulta_datos = "SELECT
        hot.id_herramientaOT,
        hot.n_ot,
        hot.id_herramienta,
        h.nombre_herramienta,
        hot.cantidadot
        FROM
            herramientaot hot
        LEFT JOIN
            herramienta h ON hot.id_herramienta = h.id_herramienta
        WHERE hot.n_ot = '$id'
        ORDER BY 
        hot.id_herramientaOT  ASC";
    }
    if ($tipoBusqueda == 'her') {
        $campo = $mainModel->limpiarCadena($_GET['campo']);
        $consulta_datos = "SELECT h.*,(h.cantidad - COALESCE(SUM(hot.cantidadot), 0)) AS cantidad_disponible,
        COALESCE(SUM(hot.cantidadot), 0) AS herramienta_ocupada
        FROM 
        herramienta h
        LEFT JOIN 
        herramientaot hot ON h.id_herramienta = hot.id_herramienta 
        WHERE std_reg='1' AND h.id_herramienta LIKE '%$campo%' OR h.nombre_herramienta LIKE '%$campo%'
        GROUP BY 
        h.id_herramienta ASC";
    }
    if ($tipoBusqueda == 'herOt') {
        $campo = $mainModel->limpiarCadena($_GET['campo']);
        $id = $mainModel->limpiarCadena($_GET['id']);
        $consulta_datos = "SELECT
        hot.id_herramientaOT,
        hot.n_ot,
        hot.id_herramienta,
        h.nombre_herramienta,
        hot.cantidadot
        FROM
            herramientaot hot
        LEFT JOIN
            herramienta h ON hot.id_herramienta = h.id_herramienta
        WHERE hot.n_ot = '$id' AND  (hot.id_herramienta LIKE '%$campo%' OR h.nombre_herramienta LIKE '%$campo%')
        ORDER BY 
        hot.id_herramientaOT  ASC";
    }
    if ($tipoBusqueda == 'cargarTabla') {
        $id = $mainModel->limpiarCadena($_GET['id']);
        $consulta_datos = "SELECT
                hot.id_herramientaOT,
                hot.n_ot,
                hot.id_herramienta,
                h.nombre_herramienta,
                hot.cantidadot
                FROM
                    herramientaot hot
                LEFT JOIN
                    herramienta h ON hot.id_herramienta = h.id_herramienta
                    WHERE hot.n_ot = '$id'
                ORDER BY 
                hot.id_herramientaOT  ASC";
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
