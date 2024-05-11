<?php
// Incluir el archivo que contiene la definición de la clase mainModel
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();

$tipoBusqueda = $mainModel->limpiarCadena($_GET['tipoBusqueda']);

if ($tipoBusqueda != 'eliminar') {
    if ($tipoBusqueda == 'id') {
        $id = $mainModel->limpiarCadena($_GET['id']);
        $consulta_datos = "
        SELECT h.*,(h.cantidad - COALESCE(SUM(hot.cantidadot), 0)) 
        AS cantidad_disponible, COALESCE(SUM(hot.cantidadot), 0) 
        AS herramienta_ocupada FROM herramienta h 
        LEFT JOIN herramientaot hot ON h.id_herramienta = hot.id_herramienta 
        WHERE std_reg='1' AND (h.id_herramienta LIKE '%$id%' OR h.nombre_herramienta LIKE '%$id%')
        GROUP BY 
        h.id_herramienta ASC;
        ";
    } else {
        $consulta_datos = "
            SELECT h.*,(h.cantidad - COALESCE(SUM(hot.cantidadot), 0)) AS cantidad_disponible,
            COALESCE(SUM(hot.cantidadot), 0) AS herramienta_ocupada
            FROM 
            herramienta h
            LEFT JOIN 
            herramientaot hot ON h.id_herramienta = hot.id_herramienta WHERE std_reg='1'
            GROUP BY 
            h.id_herramienta ASC
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
    $id = $mainModel->limpiarCadena($_GET['id']);
    $id2 = "E-" . $id;
    $datos_reg = [
        [
            "campo_nombre" => "id_herramienta",
            "campo_marcador" => ":id_herr",
            "campo_valor" => $id2
        ],
        [
            "campo_nombre" => "std_reg",
            "campo_marcador" => ":std_reg",
            "campo_valor" => 0
        ]
    ];

    $condicion = [
        "condicion_campo" => "id_herramienta",
        "condicion_marcador" => ":id_herramienta",
        "condicion_valor" => $id
    ];

    $datos = $mainModel->ejecutarSqlUpdate("herramienta", $datos_reg, $condicion);

    echo json_encode($datos, JSON_UNESCAPED_UNICODE);
}
