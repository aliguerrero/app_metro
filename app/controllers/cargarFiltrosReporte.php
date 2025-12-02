<?php
// controllers/cargarFiltrosReporte.php
require_once __DIR__ . '../../models/mainModel.php';

use app\models\mainModel;

$mainModel = new mainModel();

// ÁREAS
$sql_area = "SELECT id_area AS id, nombre_area AS nombre 
             FROM area_trabajo 
             ORDER BY nombre_area ASC";
$area = $mainModel->ejecutarConsultaDesdeCargarUser($sql_area)->fetchAll(PDO::FETCH_ASSOC);

// SITIOS
$sql_sitio = "SELECT id_sitio AS id, nombre_sitio AS nombre 
              FROM sitio_trabajo 
              ORDER BY nombre_sitio ASC";
$sitio = $mainModel->ejecutarConsultaDesdeCargarUser($sql_sitio)->fetchAll(PDO::FETCH_ASSOC);

// ESTADOS
$sql_estado = "SELECT id_estado AS id, nombre_estado AS nombre 
               FROM estado_ot 
               ORDER BY nombre_estado ASC";
$estado = $mainModel->ejecutarConsultaDesdeCargarUser($sql_estado)->fetchAll(PDO::FETCH_ASSOC);

// TURNOS
$sql_turno = "SELECT id_turno AS id, nombre_turno AS nombre 
              FROM turno_trabajo 
              ORDER BY id_turno ASC";
$turno = $mainModel->ejecutarConsultaDesdeCargarUser($sql_turno)->fetchAll(PDO::FETCH_ASSOC);

// TÉCNICOS (usuarios activos)
$sql_tec = "SELECT id_user AS id, user AS nombre 
            FROM user_system 
            WHERE std_reg = 1 
            ORDER BY user ASC";
$tecnicos = $mainModel->ejecutarConsultaDesdeCargarUser($sql_tec)->fetchAll(PDO::FETCH_ASSOC);

// MIEMBROS (CCO / CCF activos)
$sql_miembros = "SELECT id_miembro AS id, nombre_miembro AS nombre 
                 FROM miembro 
                 WHERE std_reg = 1 
                 ORDER BY nombre_miembro ASC";
$miembros = $mainModel->ejecutarConsultaDesdeCargarUser($sql_miembros)->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(
    [
        "area"      => $area,
        "sitio"     => $sitio,
        "estado"    => $estado,
        "turno"     => $turno,
        "tecnicos"  => $tecnicos,
        "miembros"  => $miembros
    ],
    JSON_UNESCAPED_UNICODE
);
