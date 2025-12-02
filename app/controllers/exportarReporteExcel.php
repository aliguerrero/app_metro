<?php
// controllers/exportarReporteExcel.php

require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();

$tipo    = $mainModel->limpiarCadena($_GET['tipo'] ?? '');
$area    = $mainModel->limpiarCadena($_GET['area'] ?? '');
$sitio   = $mainModel->limpiarCadena($_GET['sitio'] ?? '');
$estado  = $mainModel->limpiarCadena($_GET['estado'] ?? '');
$turno   = $mainModel->limpiarCadena($_GET['turno'] ?? '');
$tec     = $mainModel->limpiarCadena($_GET['tec'] ?? '');
$ot      = $mainModel->limpiarCadena($_GET['ot'] ?? '');
$miembro = $mainModel->limpiarCadena($_GET['miembro'] ?? '');
$ini     = $mainModel->limpiarCadena($_GET['ini'] ?? '');
$fin     = $mainModel->limpiarCadena($_GET['fin'] ?? '');

$whereFechas = "";
if ($ini != "") $whereFechas .= " AND ot.fecha >= '$ini' ";
if ($fin != "") $whereFechas .= " AND ot.fecha <= '$fin' ";

switch ($tipo) {
    case 'reporte_ot':
        $sql = "SELECT 
                    ot.n_ot,
                    ot.nombre_trab,
                    ot.fecha,
                    a.nombre_area,
                    s.nombre_sitio,
                    est.nombre_estado
                FROM orden_trabajo ot
                LEFT JOIN detalle_orden d ON d.n_ot = ot.n_ot
                LEFT JOIN area_trabajo a  ON a.id_area = ot.id_area
                LEFT JOIN sitio_trabajo s ON s.id_sitio = ot.id_sitio
                LEFT JOIN estado_ot est   ON est.id_estado = d.id_estado
                WHERE 1=1";

        if ($area != "")    $sql .= " AND ot.id_area = '$area'";
        if ($sitio != "")   $sql .= " AND ot.id_sitio = '$sitio'";
        if ($estado != "")  $sql .= " AND d.id_estado = '$estado'";
        if ($turno != "")   $sql .= " AND d.id_turno = '$turno'";
        if ($tec != "")     $sql .= " AND d.id_user_act = '$tec'";
        if ($ot != "")      $sql .= " AND ot.n_ot LIKE '%$ot%'";
        if ($miembro != "") $sql .= " AND (d.id_miembro_ccf='$miembro' OR d.id_miembro_cco='$miembro') ";

        $sql .= $whereFechas;
        break;

    case 'reporte_usuarios':
        $sql = "SELECT 
                    u.id_user,
                    u.user,
                    u.username,
                    r.nombre_rol,
                    u.std_reg
                FROM user_system u
                LEFT JOIN roles_permisos r ON r.id = u.tipo
                ORDER BY u.username ASC";
        break;

    case 'reporte_herramientas':
        $sql = "SELECT 
                    id_herramienta,
                    nombre_herramienta,
                    cantidad,
                    estado,
                    std_reg
                FROM herramienta
                ORDER BY nombre_herramienta ASC";
        break;

    default:
        die("Tipo de reporte no soportado para Excel");
}

$stmt = $mainModel->ejecutarConsultaDesdeCargarUser($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Cabeceras para Excel
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=reporte_$tipo.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Tabla HTML
echo "<table border='1'>";
echo "<tr><th colspan='20'>Reporte: $tipo</th></tr>";

if (!empty($rows)) {
    $cols = array_keys($rows[0]);
    echo "<tr>";
    foreach ($cols as $c) {
        echo "<th>".htmlspecialchars($c)."</th>";
    }
    echo "</tr>";

    foreach ($rows as $r) {
        echo "<tr>";
        foreach ($cols as $c) {
            echo "<td>".htmlspecialchars($r[$c])."</td>";
        }
        echo "</tr>";
    }
} else {
    echo "<tr><td>No hay datos</td></tr>";
}
echo "</table>";