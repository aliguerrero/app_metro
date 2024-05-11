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
        SELECT *
        FROM miembro
        WHERE std_reg = '1'
        AND (id_miembro LIKE '%$id%' OR nombre_miembro LIKE '%$id%');
        ";
    } else {
        $consulta_datos = "
        SELECT * FROM miembro WHERE std_reg='1' ORDER BY id_miembro ASC
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
            "campo_nombre" => "id_miembro",
            "campo_marcador" => ":id",
            "campo_valor" => $id2
        ],
        [
            "campo_nombre" => "std_reg",
            "campo_marcador" => ":std_reg",
            "campo_valor" => 0
        ]
    ];
    $condicion = [
        "condicion_campo" => "id_miembro",
        "condicion_marcador" => ":id_miembro",
        "condicion_valor" => $id
    ];

    $datos = $mainModel->ejecutarSqlUpdate("miembro", $datos_reg, $condicion);

    echo json_encode($datos, JSON_UNESCAPED_UNICODE);
}