<?php
// Incluir el archivo que contiene la definición de la clase mainModel
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();

$tipoBusqueda = $mainModel->limpiarCadena($_GET['tipoBusqueda']);


if ($tipoBusqueda != 'eliminar') {
    $userID = $mainModel->limpiarCadena($_GET['user']);
    if ($tipoBusqueda == 'id') {
        $id = $mainModel->limpiarCadena($_GET['id']);
        $consulta_datos = "
        SELECT u.*, r.nombre_rol 
        FROM user_system u 
        JOIN roles_permisos r ON u.tipo = r.id 
        WHERE u.id_user != '$userID' AND std_reg='1' AND (u.id_user LIKE '%$id%' OR u.user LIKE '%$id%') ORDER
        BY user ASC
        ";
    } else {
        $consulta_datos = "
        SELECT u.*, r.nombre_rol 
        FROM user_system u 
        JOIN roles_permisos r ON u.tipo = r.id 
        WHERE u.id_user != '$userID' AND std_reg='1' ORDER
        BY user ASC
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
            "campo_nombre" => "id_user",
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
        "condicion_campo" => "id_user",
        "condicion_marcador" => ":id_user",
        "condicion_valor" => $id
    ];

    $datos = $mainModel->ejecutarSqlUpdate("user_system", $datos_reg, $condicion);

    echo json_encode($datos, JSON_UNESCAPED_UNICODE);
}
