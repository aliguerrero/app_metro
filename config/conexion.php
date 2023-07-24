<?php
class Conexion
{
  private $host = "localhost";
  private $usuario = "root";
  private $clave = "systembis";
  private $bd = "bdapp_metro";
  private $conexion;

  public function __construct()
  {
    try {
      $this->conexion = new mysqli($this->host, $this->usuario, $this->clave, $this->bd);
      
      if ($this->conexion->connect_error) {
        throw new Exception("Error de conexión: " . $this->conexion->connect_error);
      }
    } catch (Exception $e) {
      throw new Exception("Error al establecer la conexión: " . $e->getMessage());
    }
  }

  public function getConexion()
  {
    return $this->conexion;
  }
}
