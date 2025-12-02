<?php
// =============================================================
//  Cargar Reportes del Sistema (con filtros + paginación + export)
// =============================================================

// Incluir modelo principal
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();

// ----------------------------------------
//   Obtener parámetros generales
// ----------------------------------------
$tipo = $mainModel->limpiarCadena($_GET['tipo'] ?? $_POST['tipo'] ?? '');

// Filtros generales
$area     = $mainModel->limpiarCadena($_GET['area'] ?? $_POST['area'] ?? '');
$sitio    = $mainModel->limpiarCadena($_GET['sitio'] ?? $_POST['sitio'] ?? '');
$estado   = $mainModel->limpiarCadena($_GET['estado'] ?? $_POST['estado'] ?? '');
$turno    = $mainModel->limpiarCadena($_GET['turno'] ?? $_POST['turno'] ?? '');
$tec      = $mainModel->limpiarCadena($_GET['tec'] ?? $_POST['tec'] ?? '');
$miembro  = $mainModel->limpiarCadena($_GET['miembro'] ?? $_POST['miembro'] ?? '');
$ot       = $mainModel->limpiarCadena($_GET['ot'] ?? $_POST['ot'] ?? '');
$ini      = $mainModel->limpiarCadena($_GET['ini'] ?? $_POST['ini'] ?? '');
$fin      = $mainModel->limpiarCadena($_GET['fin'] ?? $_POST['fin'] ?? '');

// ----------------------------------------
//   PAGINACIÓN
// ----------------------------------------
$page     = intval($_GET['page'] ?? $_POST['page'] ?? 1);
$per_page = intval($_GET['per_page'] ?? $_POST['per_page'] ?? 20);

if ($page < 1) $page = 1;
if ($per_page < 1) $per_page = 20;

$offset = ($page - 1) * $per_page;

// ----------------------------------------
//   MODO EXPORTACIÓN (PDF / EXCEL)
// ----------------------------------------
$export = $mainModel->limpiarCadena($_GET['export'] ?? '');

if ($export != "") {
    // si exporta, desactivar paginación
    $page = 1;
    $per_page = 999999;
    $offset = 0;
}

// ----------------------------------------
//   Filtros de fechas
// ----------------------------------------
$whereFechas = "";
if ($ini != "") $whereFechas .= " AND ot.fecha >= '$ini' ";
if ($fin != "") $whereFechas .= " AND ot.fecha <= '$fin' ";

// ----------------------------------------
//   Selección del reporte
// ----------------------------------------
$sql = "";

switch ($tipo) {

    // ============================================================
    // REPORTE: ÓRDENES DE TRABAJO
    // ============================================================
    case 'reporte_ot':

        $sql = "SELECT 
                    ot.n_ot,
                    ot.nombre_trab,
                    ot.fecha,
                    a.nombre_area,
                    s.nombre_sitio,
                    est.nombre_estado,
                    est.color
                FROM orden_trabajo ot
                LEFT JOIN detalle_orden d ON d.n_ot = ot.n_ot
                LEFT JOIN area_trabajo a  ON a.id_area = ot.id_area
                LEFT JOIN sitio_trabajo s ON s.id_sitio = ot.id_sitio
                LEFT JOIN estado_ot est   ON est.id_estado = d.id_estado
                WHERE 1=1";

        if ($area != "")    $sql .= " AND ot.id_area = '$area' ";
        if ($sitio != "")   $sql .= " AND ot.id_sitio = '$sitio' ";
        if ($estado != "")  $sql .= " AND d.id_estado = '$estado' ";
        if ($turno != "")   $sql .= " AND d.id_turno = '$turno' ";
        if ($tec != "")     $sql .= " AND d.id_user_act = '$tec' ";
        if ($ot != "")      $sql .= " AND ot.n_ot LIKE '%$ot%' ";
        if ($miembro != "") $sql .= " AND (d.id_miembro_ccf='$miembro' OR d.id_miembro_cco='$miembro') ";

        $sql .= $whereFechas;

        break;

    // ============================================================
    // REPORTE: DETALLE DE OT
    // ============================================================
    case 'reporte_detalle_ot':
        $sql = "SELECT 
                    d.*, 
                    est.nombre_estado,
                    t.nombre_turno,
                    u.user AS tecnico,
                    m1.nombre_miembro AS cco,
                    m2.nombre_miembro AS ccf
                FROM detalle_orden d
                LEFT JOIN estado_ot est   ON est.id_estado = d.id_estado
                LEFT JOIN turno_trabajo t ON t.id_turno = d.id_turno
                LEFT JOIN user_system u   ON u.id_user = d.id_user_act
                LEFT JOIN miembro m1      ON m1.id_miembro = d.id_miembro_cco
                LEFT JOIN miembro m2      ON m2.id_miembro = d.id_miembro_ccf
                WHERE 1=1";

        if ($ot != "")      $sql .= " AND d.n_ot = '$ot' ";
        if ($estado != "")  $sql .= " AND d.id_estado = '$estado' ";
        if ($turno != "")   $sql .= " AND d.id_turno = '$turno' ";
        if ($tec != "")     $sql .= " AND d.id_user_act = '$tec' ";
        if ($miembro != "") $sql .= " AND (d.id_miembro_ccf='$miembro' OR d.id_miembro_cco='$miembro') ";

        break;

    // ============================================================
    // REPORTE: HERRAMIENTAS
    // ============================================================
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

    // ============================================================
    // REPORTE: HERRAMIENTAS ASIGNADAS A OT
    // ============================================================
    case 'reporte_herramienta_ot':
        $sql = "SELECT 
                    hot.id_herramientaOT,
                    hot.n_ot,
                    hot.cantidadot,
                    h.nombre_herramienta,
                    ot.nombre_trab
                FROM herramientaot hot
                LEFT JOIN herramienta h  ON h.id_herramienta = hot.id_herramienta
                LEFT JOIN orden_trabajo ot ON ot.n_ot = hot.n_ot
                ORDER BY hot.n_ot ASC";
        break;

    // ============================================================
    // REPORTE: USUARIOS DEL SISTEMA
    // ============================================================
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

    // ============================================================
    // REPORTE: LOGS DEL SISTEMA
    // ============================================================
    case 'reporte_logs':
        $sql = "SELECT 
                    l.id_log,
                    l.id_user,
                    u.username,
                    l.accion,
                    l.resp_system,
                    l.fecha_hora
                FROM log_user l
                LEFT JOIN user_system u ON u.id_user = l.id_user
                ORDER BY l.fecha_hora DESC";
        break;

    // ============================================================
    // REPORTE: MIEMBROS
    // ============================================================
    case 'reporte_miembros':
        $sql = "SELECT id_miembro, nombre_miembro, tipo_miembro, std_reg
                FROM miembro
                ORDER BY nombre_miembro ASC";
        break;

    // ============================================================
    // REPORTE: TURNOS
    // ============================================================
    case 'reporte_turnos':
        $sql = "SELECT id_turno, nombre_turno
                FROM turno_trabajo
                ORDER BY id_turno ASC";
        break;

    // ============================================================
    // REPORTE: ESTADOS
    // ============================================================
    case 'reporte_estados':
        $sql = "SELECT id_estado, nombre_estado, color
                FROM estado_ot
                ORDER BY id_estado ASC";
        break;

    // ============================================================
    // REPORTE: SITIOS
    // ============================================================
    case 'reporte_sitios':
        $sql = "SELECT id_sitio, nombre_sitio
                FROM sitio_trabajo
                ORDER BY nombre_sitio ASC";
        break;

    default:
        echo json_encode(["error" => "Tipo de reporte no válido"], JSON_UNESCAPED_UNICODE);
        exit;
}

// =============================================================
//       PAGINACIÓN (Conteo total de registros)
// =============================================================
$sqlCount = "SELECT COUNT(*) AS total FROM ( $sql ) AS t";
$contar = $mainModel->ejecutarConsultaDesdeCargarUser($sqlCount)
    ->fetch(PDO::FETCH_ASSOC);

$total = intval($contar["total"] ?? 0);

// Aplicar límite y offset para paginación
$sql .= " LIMIT $offset, $per_page";

$resultado = $mainModel->ejecutarConsultaDesdeCargarUser($sql);
$rows = $resultado->fetchAll(PDO::FETCH_ASSOC);

// =============================================================
//       RESPUESTA JSON PARA JS / PDF / EXCEL
// =============================================================
echo json_encode([
    "data"      => $rows,
    "total"     => $total,
    "page"      => $page,
    "per_page"  => $per_page
], JSON_UNESCAPED_UNICODE);
