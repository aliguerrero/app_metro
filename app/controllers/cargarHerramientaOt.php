<?php
// Incluir el archivo que contiene la definición de la clase mainModel
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();


$consulta_datos = "SELECT
hot.id_herramientaOT,
hot.n_ot,
h.nombre_herramienta,
hot.cantidadot
FROM
    herramientaot hot
LEFT JOIN
    herramienta h ON hot.id_herramienta = h.id_herramienta
ORDER BY 
hot.id_herramientaOT";

// Llamar al método ejecutarConsulta desde el contexto de mainModel
$datos = $mainModel->ejecutarConsultaDesdeCargarUser($consulta_datos);
$total = $datos->rowCount();

$tdatos = [];

if ($total > 0) {
    $tdatos = $datos->fetch(PDO::FETCH_ASSOC);
}

echo json_encode($tdatos, JSON_UNESCAPED_UNICODE);
?>