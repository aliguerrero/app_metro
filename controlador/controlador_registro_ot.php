<?php
class controlador_registro_ot {
  private $model;

  public function __construct($model) {
    $this->model = $model;
  }

  /**
   * Summary of insert_orden
   * @param mixed $not
   * @param mixed $nom_trab
   * @param mixed $sitio_trab
   * @param mixed $semana
   * @param mixed $mes
   * @param mixed $status
   * @param mixed $obsv
   * @param mixed $resp_cco
   * @param mixed $resp_tec
   * @param mixed $resp_ccf
   * @param mixed $hora_pre_ini
   * @param mixed $hora_pre_fin
   * @param mixed $hora_tra_ini
   * @param mixed $hora_tra_fin
   * @param mixed $hora_eje_ini
   * @param mixed $hora_eje_fin
   * @param mixed $fecha
   * @param mixed $estado
   * @return mixed
   */
  public function insert_orden($not, $nom_trab, $sitio_trab, $semana, $mes, $status, $obsv, $resp_cco, $resp_tec, $resp_ccf, $hora_pre_ini, $hora_pre_fin, $hora_tra_ini, $hora_tra_fin, $hora_eje_ini, $hora_eje_fin, $fecha, $estado) {
    return $this->model->insert_orden($not, $nom_trab, $sitio_trab, $semana, $mes, $status, $obsv, $resp_cco, $resp_tec, $resp_ccf, $hora_pre_ini, $hora_pre_fin, $hora_tra_ini, $hora_tra_fin, $hora_eje_ini, $hora_eje_fin, $fecha, $estado);
  }
}
?>
