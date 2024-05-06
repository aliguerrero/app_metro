<?php
// Incluir el archivo que contiene la definición de la clase mainModel
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();


$consulta_datos = "SELECT e.nombre_estado, COUNT(ot.id_estado) AS total_registros
FROM detalle_orden ot
JOIN estado_ot e ON ot.id_estado = e.id_estado
GROUP BY ot.id_estado;";

// Llamar al método ejecutarConsulta desde el contexto de mainModel
$datos = $mainModel->ejecutarConsultaDesdeCargarUser($consulta_datos);
$total = $datos->rowCount();

$tdatos = [];

if ($total > 0) {
    // Mientras haya filas en los resultados, agregarlas al array $tdatos
    while ($fila = $datos->fetch(PDO::FETCH_ASSOC)) {
        $tdatos[] = $fila;
    }
}

echo json_encode($tdatos, JSON_UNESCAPED_UNICODE);
?>
