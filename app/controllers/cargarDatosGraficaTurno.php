<?php
// Incluir el archivo que contiene la definición de la clase mainModel
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();

$consulta_datos = "SELECT 
e.nombre_turno, 
COUNT(ot.id_turno) AS total_registros,
    ROUND((COUNT(ot.id_turno) * 100.0) / SUM(COUNT(ot.id_turno)) OVER (), 2) AS porcentaje_total
FROM 
    detalle_orden ot
JOIN 
    turno_trabajo e ON ot.id_turno = e.id_turno
GROUP BY 
ot.id_turno, e.nombre_turno;
";

// Llamar al método ejecutarConsulta desde el contexto de mainModel
$datos = $mainModel->ejecutarConsultaDesdeCargarUser($consulta_datos);
$total = $datos->rowCount();

$tdatos = [];

if ($total > 0) {
    $tdatos = $datos->fetchAll(PDO::FETCH_ASSOC); // Obtener todas las filas como un array asociativo
}

echo json_encode($tdatos, JSON_UNESCAPED_UNICODE);
?>
