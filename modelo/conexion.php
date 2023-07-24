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
    $this->conexion = new mysqli($this->host, $this->usuario, $this->clave, $this->bd);
    if ($this->conexion->connect_error) {
      die("Error de conexión: " . $this->conexion->connect_error);
    }
  }

  public function query($sent)
  {
    $resultado = $this->conexion->query($sent);

    if ($resultado) {
      echo "Exito.";
      return true; // Insert exitoso
    } else {
      echo "Error.";

      return false; // Error al insertar
    }
  }
}
