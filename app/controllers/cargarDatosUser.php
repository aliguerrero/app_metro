<?php
// Incluir el archivo que contiene la definición de la clase mainModel
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();

$id = $mainModel->limpiarCadena($_POST['id']);

$consulta_datos = "SELECT * FROM user_system WHERE id_user='$id' LIMIT 1";

// Llamar al método ejecutarConsulta desde el contexto de mainModel
$datos = $mainModel->ejecutarConsultaDesdeCargarUser($consulta_datos);
$total = $datos->rowCount();

$tdatos = [];

if ($total > 0) {
    $tdatos = $datos->fetch(PDO::FETCH_ASSOC);
}

echo json_encode($tdatos, JSON_UNESCAPED_UNICODE);
?>
