<?php
require_once '../../config/conexion.php';

class modelo_registro_ot {
  private $db;

  public function __construct() {
    $this->db = new Conexion();
  }

  public function insert_orden($not, $nom_trab, $sitio_trab, $semana, $mes, $status, $obsv, $resp_cco, $resp_tec, $resp_ccf, $hora_pre_ini, $hora_pre_fin, $hora_tra_ini, $hora_tra_fin, $hora_eje_ini, $hora_eje_fin, $fecha, $estado) {
    // Preparar la consulta SQL
    $query = "INSERT INTO orden (n_ot, nombre_trab, sitio_trab, semana, mes, status, observacion, responsable_cco, responsable_act, responsable_ccf, hora_ini_pre, hora_fin_pre, hora_ini_tra, hora_fin_tra, hora_ini_eje, hora_fin_eje, fecha, estado) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
    // Obtener la conexión a la base de datos
    $conexion = $this->db->getConexion();
    
    // Preparar la sentencia
    $stmt = $conexion->prepare($query);
    
    // Vincular los valores a la sentencia
    $stmt->bind_param("sssssisssssssssssi", $not, $nom_trab, $sitio_trab, $semana, $mes, $status, $obsv, $resp_cco, $resp_tec, $resp_ccf, $hora_pre_ini, $hora_pre_fin, $hora_tra_ini, $hora_tra_fin, $hora_eje_ini, $hora_eje_fin, $fecha, $estado);

    // Ejecutar la consulta
    if ($stmt->execute()) {
      echo "Insert exitoso.";
      return true;
    } else {
      echo "Error al insertar: " . $stmt->error;
      return false;
    }
  }
}

// Crear una instancia de la clase Modelo pasando la conexión a la base de datos
$model = new modelo_registro_ot();
