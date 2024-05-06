<?php
// Incluir el archivo que contiene la definición de la clase mainModel
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();


$consulta_datos = "SELECT * FROM turno_trabajo";

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
