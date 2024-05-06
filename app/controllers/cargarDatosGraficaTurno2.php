<?php
// Incluir el archivo que contiene la definición de la clase mainModel
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();

$id = $mainModel->limpiarCadena($_GET['id']);

$consulta_datos = "SELECT e.nombre_estado, COUNT(dord.id_estado) AS total_ordenes, 
ROUND(COUNT(dord.id_estado) * 100.0 / (SELECT COUNT(*) FROM detalle_orden WHERE id_turno = $id), 2)
 AS porcentaje_total 
 FROM detalle_orden dord 
 JOIN turno_trabajo tu ON dord.id_turno = tu.id_turno 
 JOIN estado_ot e ON dord.id_estado = e.id_estado 
 WHERE dord.id_turno = $id GROUP BY dord.id_estado;
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
