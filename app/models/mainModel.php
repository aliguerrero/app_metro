<?php
    // Declarar el namespace
    namespace app\models;
    use \PDO;

    // Verificar si existe el archivo server.php en la ruta especificada
    if (file_exists(__DIR__."/../../config/server.php")) {
        require_once __DIR__."/../../config/server.php";
    }

    class mainModel{
        // Propiedades para la conexión a la base de datos
        private $server = DB_SERVER;
        private $db     = DB_NAME;
        private $user   = DB_USER;
        private $pass   = DB_PASS;

        // Método protegido para establecer la conexión a la base de datos
        protected function conectar (){
            $conexion = new PDO("mysql:host=".$this->server.";dbname=".$this->db.";charset=utf8",$this->user,$this->pass);
            $conexion->exec("SET CHARACTER SET utf8");
            return $conexion;
        }

        // Método protegido para ejecutar una consulta SQL
        protected function ejecutarConsulta($consulta){
            $sql = $this->conectar()->prepare($consulta);
            $sql->execute();
            return $sql;
        }

        // Función pública para limpiar una cadena de posibles inyecciones de código
        public function limpiarCadena($cadena){
            // Array que contiene palabras clave o secuencias de caracteres que podrían indicar intentos de inyección de código.
            $palabras = [
                "<script>",
                "</script>",
                "<script src",
                "<script type=",
                "SELECT * FROM",
                "SELECT ",
                " SELECT ",
                "DELETE FROM",
                "INSERT INTO",
                "DROP TABLE",
                "DROP DATABASE",
                "TRUNCATE TABLE",
                "SHOW TABLES",
                "SHOW DATABASES",
                "<?php",
                "?>",
                "--",
                "^",
                "<",
                ">",
                "==",
                "=",
                ";",
                "::"
            ];

            // Elimina espacios en blanco al principio y al final de la cadena.
            $cadena = trim($cadena);
            // Elimina las barras invertidas añadidas por la función stripslashes.
            $cadena = stripslashes($cadena);
            
            // Itera sobre el array de palabras clave y las elimina de la cadena.
            foreach($palabras as $palabra){
                $cadena = str_ireplace($palabra, "", $cadena);
            }        

            // Convierte caracteres especiales en entidades HTML para prevenir ataques XSS.
            $cadena = htmlspecialchars($cadena);
            
            // Elimina nuevamente espacios en blanco al principio y al final de la cadena.
            $cadena = trim($cadena);
            // Elimina nuevamente las barras invertidas añadidas por la función stripslashes.
            $cadena = stripslashes($cadena);
            
            // Devuelve la cadena de texto limpia.
            return $cadena;
        }

        protected function verificarDatos($filtro, $cadena){
            // Utiliza una expresión regular para verificar si la cadena coincide exactamente con el filtro proporcionado
            // La función preg_match devuelve 1 si hay coincidencia y 0 si no hay coincidencia
            // Si la cadena coincide exactamente con el filtro, devuelve false; de lo contrario, devuelve true
            if (preg_match("/^".$filtro."$/", $cadena)) {
                return false;
            } else {
                return true;
            }
        }
        
        //Este método se utiliza para guardar datos en una tabla de la base de datos. 
        //Construye una consulta de inserción dinámica basada en los datos 
        //proporcionados y luego ejecuta esa consulta.
        protected function guardarDatos($tabla, $datos){
            // Construir la consulta de inserción con los nombres de los campos
            $query = "INSERT INTO $tabla (";
            $count=0;
            foreach($datos as $clave){
                if ($count >=1) {
                    $query.=",";
                }
                $query.=$clave["campo_nombre"];
                $count++;                
            }
            $query.=") VALUES ("; 
            // Construir la consulta de inserción con los marcadores de posición
            $count=0;
            foreach($datos as $clave){
                if ($count >=1) {
                    $query.=",";
                }
                $query.=$clave["campo_marcador"];
                $count++;                
            }
            $query.=")";
        
            // Preparar la consulta
            $sql = $this->conectar()->prepare($query);
            // Vincular los valores de los campos a los marcadores de posición
            foreach($datos as $clave){
                $sql->bindParam($clave["campo_marcador"],$clave["campo_valor"]);
            }
            // Ejecutar la consulta
            $sql->execute();        
            return $sql;
        }
        /**
         * Función para seleccionar datos de una tabla en la base de datos.
         * 
         * @param string $tipo Tipo de consulta ("Unico" o "Normal").
         * @param string $tabla Nombre de la tabla en la base de datos.
         * @param string $campo Campo o campos a seleccionar.
         * @param string $id Identificador para la consulta tipo "Unico".
         * @return PDOStatement Resultado de la consulta SQL.
         */
        public function seleccionarDatos($tipo, $tabla, $campo, $id){
            // Limpiar los parámetros recibidos para evitar inyección SQL
            $tipo = $this->limpiarCadena($tipo);
            $tabla = $this->limpiarCadena($tabla);
            $campo = $this->limpiarCadena($campo);
            $id = $this->limpiarCadena($id);
        
            // Construir la consulta SQL según el tipo especificado
            if ($tipo == "Unico") {
                $sql = $this->conectar()->prepare("SELECT * FROM $tabla WHERE $campo = :ID");
                $sql->bindParam(":ID", $id);
            } elseif ($tipo == "Normal") {
                $sql = $this->conectar()->prepare("SELECT $campo FROM $tabla");
            }
        
            // Ejecutar la consulta SQL
            $sql->execute();
        
            // Devolver el resultado de la consulta
            return $sql;
        }

        /**
         * Función para actualizar datos en una tabla de la base de datos.
         * 
         * @param string $tabla Nombre de la tabla en la base de datos.
         * @param array $datos Arreglo asociativo con los datos a actualizar.
         * @param array $condicion Arreglo asociativo con la condición para la actualización.
         * @return PDOStatement Resultado de la consulta SQL.
         */
        protected function actualizarDatos($tabla, $datos, $condicion){
            // Construir la consulta SQL para actualizar los datos
            $query = "UPDATE $tabla SET ";
            $count = 0;
            foreach($datos as $clave){
                if ($count >= 1) {
                    $query .= ",";
                }
                $query .= $clave["campo_nombre"] . "=" . $clave["campo_marcador"];
                $count++;
            }
            $query .= " WHERE " . $condicion["condicion_campo"] . "=" . $condicion["condicion_marcador"];

            // Preparar la consulta SQL
            $sql = $this->conectar()->prepare($query);
            // Vincular los valores de los campos a los marcadores de posición
            foreach($datos as $clave){
                $sql->bindParam($clave["campo_marcador"], $clave["campo_valor"]);
            }
            $sql->bindParam($condicion["condicion_marcador"], $condicion["condicion_valor"]);
            // Ejecutar la consulta
            $sql->execute();

            // Devolver el resultado de la consulta
            return $sql;
        }

        /**
         * Función para eliminar un registro de una tabla en la base de datos.
         * 
         * @param string $tabla Nombre de la tabla en la base de datos.
         * @param string $campo Campo utilizado como condición para eliminar el registro.
         * @param mixed $id Valor del campo utilizado como condición para eliminar el registro.
         * @return PDOStatement Resultado de la consulta SQL.
         */
        protected function eliminarRegistro($tabla, $campo, $id){
            // Preparar la consulta SQL para eliminar el registro
            $sql = $this->conectar()->prepare("DELETE FROM $tabla WHERE $campo = :id");
            // Vincular el valor del ID al marcador de posición
            $sql->bindParam(":id", $id);
            // Ejecutar la consulta
            $sql->execute();

            // Devolver el resultado de la consulta
            return $sql;
        }

        /**
         * Este método genera un paginador para tablas HTML utilizando Bootstrap 5
         */
        protected function paginadorTablas($pagina, $numeroPagina, $url, $botones){
            $tabla = '<nav aria-label="...">'; // Abre el contenedor de navegación
        
            // Comprueba si es la primera página y configura el enlace "Anterior"
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
        
            // Itera para generar los botones de página
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
        
            // Comprueba si es la última página y configura el enlace "Siguiente"
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
        
            $tabla .= '</ul> </nav>'; // Cierra el contenedor de navegación
        
            return $tabla; // Retorna el paginador generado
        }       
        
    }
?>
