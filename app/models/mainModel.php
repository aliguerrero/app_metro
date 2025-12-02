<?php

namespace app\models;

use \PDO;

if (file_exists(__DIR__ . '/../../config/server.php')) {
    require_once __DIR__ . '/../../config/server.php';
}

class mainModel
{
    /* Propiedades para la conexión a la base de datos */
    private $server = DB_SERVER;
    private $db     = DB_NAME;
    private $user   = DB_USER;
    private $pass   = DB_PASS;

    /* Método protegido para establecer la conexión a la base de datos */
    protected function conectar()
    {
        try {
            /* Intenta establecer una conexión PDO con la base de datos */
            $conexion = new PDO("mysql:host={$this->server};dbname={$this->db};charset=utf8", $this->user, $this->pass);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec('SET CHARACTER SET utf8');

            return $conexion;
        } catch (PDOException $e) {
            /* Si ocurre un error al establecer la conexión, lanza una excepción PDOException */
            throw new PDOException('Error al conectar con la base de datos: ' . $e->getMessage());
        }
    }

    protected function ordenarFecha($fecha)
    {
        $fecha_formateada = date('d/m/Y', strtotime($fecha));
        return $fecha_formateada;
    }
    /* Método protegido para ejecutar una consulta SQL en la base de datos */
    protected function ejecutarConsulta($consulta)
    {
        try {
            /* Prepara la consulta SQL utilizando la conexión PDO establecida */
            $sql = $this->conectar()->prepare($consulta);

            /* Ejecuta la consulta SQL */
            if ($sql->execute()) {
                /* Si la consulta se ejecuta correctamente, devuelve el objeto PDOStatement */
                return $sql;
            } else {
                /* Si ocurre un error al ejecutar la consulta, devuelve false */
                return false;
            }
        } catch (PDOException $e) {
            /* Captura cualquier excepción de PDO ( por ejemplo, error de sintaxis SQL ) y maneja el error */
            /* Aquí puedes registrar el error en un archivo de registro, enviar un correo electrónico de notificación, etc. */
            /* En este ejemplo, simplemente lanzamos una nueva excepción con el mensaje de error original */
            throw new Exception('Error al ejecutar la consulta SQL: ' . $e->getMessage());
        }
    }

    /* Método PROTEGIDO para registrar un log de usuario */
    protected function registrarLog($id_user, $accion, $respuesta)
    {
        $fecha_hora_actual = new \DateTime();
        $fecha_hora_actual_str = $fecha_hora_actual->format('Y-m-d H:i:s');

        $user_log = [
            [
                'campo_nombre' => 'id_user',
                'campo_marcador' => ':user',
                'campo_valor' => $id_user
            ],
            [
                'campo_nombre' => 'accion',
                'campo_marcador' => ':accion',
                'campo_valor' => $accion
            ],
            [
                'campo_nombre' => 'resp_system',
                'campo_marcador' => ':respuesta',
                'campo_valor' => $respuesta
            ],
            [
                'campo_nombre' => 'fecha_hora',
                'campo_marcador' => ':fecha_hora',
                'campo_valor' => $fecha_hora_actual_str
            ]
        ];

        $this->guardarDatos('log_user', $user_log);
    }

    /* Método público para ejecutar una consulta desde otro controlador */

    public function ejecutarConsultaDesdeCargarUser($consulta)
    {
        return $this->ejecutarConsulta($consulta);
    }

    public function ejecutarSqlUpdate($tabla, $datos, $condicion)
    {
        return $this->actualizarDatos($tabla, $datos, $condicion);
    }
    public function ejecutarSqlUpdateOT($consulta, $datos)
    {
        return $this->actualizarDatosHerramientaOt($consulta, $datos);
    }
    /* Función pública para limpiar una cadena de posibles inyecciones de código */

    public function limpiarCadena($cadena)
    {
        $palabras = [
            '<script>',
            '</script>',
            '<script src',
            '<script type=',
            'SELECT * FROM',
            'SELECT ',
            ' SELECT ',
            'DELETE FROM',
            'INSERT INTO',
            'DROP TABLE',
            'DROP DATABASE',
            'TRUNCATE TABLE',
            'SHOW TABLES',
            'SHOW DATABASES',
            '<?php',
            '?>',
            '--',
            '^',
            '<', '>', '==', '=', ';', '::'
        ];
        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        foreach ($palabras as
            $palabra) {
            $cadena = str_ireplace($palabra, '', $cadena);
        }
        $cadena = htmlspecialchars($cadena);
        $cadena = trim(
            $cadena
        );
        $cadena = stripslashes($cadena);
        return $cadena;
    } /* Método protegido para verificar datos */
    protected
    function verificarDatos($filtro, $cadena)
    {
        if (preg_match('/^' . $filtro . "$/", $cadena)) {
            return false;
        } else {
            return true;
        }
    } /* Método protegido para guardar datos en una tabla de la base de datos */
    protected
    function guardarDatos($tabla, $datos)
    {
        $query = "INSERT INTO $tabla (";
        $count = 0;
        foreach ($datos as $clave) {
            if ($count >= 1) {
                $query .= ',';
            }
            $query .= $clave['campo_nombre'];
            $count++;
        }
        $query .= ') VALUES (';
        $count = 0;
        foreach ($datos as $clave) {
            if ($count >= 1) {
                $query .= ',';
            }
            $query .= $clave['campo_marcador'];
            $count++;
        }
        $query .= ')';

        $sql = $this->conectar()->prepare($query);
        foreach ($datos as $clave) {
            $sql->bindParam($clave['campo_marcador'], $clave['campo_valor']);
        }
        $sql->execute();
        return $sql;
    }

    /* Método público para seleccionar datos de una tabla en la base de datos */

    public function seleccionarDatos($tipo, $tabla, $campo, $id)
    {
        $tipo = $this->limpiarCadena($tipo);
        $tabla = $this->limpiarCadena($tabla);
        $campo = $this->limpiarCadena($campo);
        $id = $this->limpiarCadena($id);

        if ($tipo == 'Unico') {
            $sql = $this->conectar()->prepare("SELECT * FROM $tabla WHERE $campo = :ID");
            $sql->bindParam(':ID', $id);
        } elseif ($tipo == 'Normal') {
            $sql = $this->conectar()->prepare("SELECT $campo FROM $tabla");
        }

        $sql->execute();
        return $sql;
    }

    /* Método protegido para actualizar datos en una tabla de la base de datos */
    protected function actualizarDatos($tabla, $datos, $condicion)
    {
        $query = "UPDATE $tabla SET ";
        $count = 0;
        foreach ($datos as $clave) {
            if ($count >= 1) {
                $query .= ',';
            }
            $query .= $clave['campo_nombre'] . '=' . $clave['campo_marcador'];
            $count++;
        }
        $query .= ' WHERE ' . $condicion['condicion_campo'] . '=' . $condicion['condicion_marcador'];

        $sql = $this->conectar()->prepare($query);
        foreach ($datos as $clave) {
            $sql->bindParam($clave['campo_marcador'], $clave['campo_valor']);
        }
        $sql->bindParam($condicion['condicion_marcador'], $condicion['condicion_valor']);
        $sql->execute();

        return $sql;
    }
    protected function actualizarDatosMas($tabla, $datos, $condiciones)
{
    // Construir la parte de la consulta para actualizar los campos
    $query = "UPDATE $tabla SET ";
    $count = 0;
    foreach ($datos as $clave) {
        if ($count >= 1) {
            $query .= ', ';
        }
        $query .= $clave['campo_nombre'] . ' = ' . $clave['campo_marcador'];
        $count++;
    }

    // Construir la parte de la consulta para las condiciones
    $query .= ' WHERE ';
    $count = 0;
    foreach ($condiciones as $condicion) {
        if ($count >= 1) {
            $query .= ' AND ';
        }
        $query .= $condicion['condicion_campo'] . ' = ' . $condicion['condicion_marcador'];
        $count++;
    }

    // Preparar la consulta
    $sql = $this->conectar()->prepare($query);

    // Vincular los parámetros para los datos
    foreach ($datos as $clave) {
        $sql->bindParam($clave['campo_marcador'], $clave['campo_valor']);
    }

    // Vincular los parámetros para las condiciones
    foreach ($condiciones as $condicion) {
        $sql->bindParam($condicion['condicion_marcador'], $condicion['condicion_valor']);
    }

    // Ejecutar la consulta
    $sql->execute();

    return $sql;
}

    protected function actualizarDatosHerramientaOt($consulta, $datos)
    {
        try {
            /* Prepara la consulta SQL utilizando la conexión PDO establecida */
            $sql = $this->conectar()->prepare($consulta);

            /* Ejecuta la consulta SQL */
            if ($sql->execute($datos)) {
                /* Si la consulta se ejecuta correctamente, devuelve el objeto PDOStatement */
                return $sql;
            } else {
                /* Si ocurre un error al ejecutar la consulta, devuelve false */
                return false;
            }
        } catch (PDOException $e) {
            /* Captura cualquier excepción de PDO ( por ejemplo, error de sintaxis SQL ) y maneja el error */
            /* Aquí puedes registrar el error en un archivo de registro, enviar un correo electrónico de notificación, etc. */
            /* En este ejemplo, simplemente lanzamos una nueva excepción con el mensaje de error original */
            throw new Exception('Error al ejecutar la consulta SQL: ' . $e->getMessage());
        }
    }
    /*---------- Funcion eliminar registro ----------*/
    protected function eliminarRegistro($tabla, $campo, $id)
    {
        $sql = $this->conectar()->prepare("DELETE FROM $tabla WHERE $campo=:id");
        $sql->bindParam(':id', $id);
        $sql->execute();

        return $sql;
    }

    /* Método protegido para generar un paginador para tablas HTML utilizando Bootstrap 5 */
    protected function paginadorTablas($pagina, $numeroPagina, $url, $botones)
    {
        $tabla = '<nav aria-label="...">';

        if ($pagina <= 1) {
            $tabla .= ' 
                    <ul class="pagination"> 
                        <li class="page-item disabled"> 
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a> 
                        </li> 
                ';
        } else {
            $tabla .= ' 
                    <ul class="pagination"> 
                        <li class="page-item"> 
                            <a class="page-link" href="' . $url . ($pagina - 1) . '/" tabindex="-1" aria-disabled="true">Anterior</a> 
                        </li> 
                        <li class="page-item"><a class="page-link" href="' . $url . '1/">1</a></li> 
                ';
        }
        $ci = 0;
        for ($i = $pagina; $i <= $numeroPagina; $i++) {
            if ($ci >= $botones) {
                break;
            }
            if ($pagina == $i) {
                $tabla .= '
            <li class="page-item active" aria-current="page">
                <a class="page-link" href="' . $url . $i . '/">' . $i . '</a>
            </li>
            ';
            } else {
                $tabla .= '
            <li class="page-item">
                <a class="page-link" href="' . $url . $i . '/">' . $i . '</a>
            </li>
            ';
            }
            $ci++;
        }
        if ($pagina == $numeroPagina) {
            $tabla .= '
            <li class="page-item disabled">
                <a class="page-link" href="#">Siguiente</a>
            </li>
            ';
        } else {
            $tabla .= '
            <li class="page-item">
                <a class="page-link" href="' . $url . ($pagina + 1) . '/">Siguiente</a>
            </li>
            ';
        }
        $tabla .= '</ul>
    </nav>';

        return $tabla;
    }
}
