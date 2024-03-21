<?php
    namespace app\controllers;
    use app\models\mainModel;

    class herramientaController extends mainModel{
        public function registrarHerramientaControlador(){
            // Se obtienen y limpian los datos del formulario
            $codigo = $this->limpiarCadena($_POST['codigo']);
            $nombre = $this->limpiarCadena($_POST['nombre']);
            $cant = $this->limpiarCadena($_POST['cant']);
            $estado = $this->limpiarCadena($_POST['estado']);

            # Verificación de campos obligatorios #
            if ($codigo == "" || $nombre == "" || $cant == ""|| $estado == "Seleccionar") {
                // Si algún campo obligatorio está vacío, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "No has llenado todos los campos que son obligatorios",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }

            # Verificar la integridad de los datos de código #
            if ($this->verificarDatos('^[a-zA-Z0-9-]{1,10}$', $codigo)) {
                // Si el formato del código no es válido, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "La CODIGO no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
            # Verificar el Cedula #
            $check_codigo = $this->ejecutarConsulta("SELECT id_herramienta FROM herramienta WHERE id_herramienta='$codigo'");
            if ($check_codigo->rowCount() > 0) {
                // Si la Cedula ya existe en la base de datos, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El CODIGO ingresado ya existe en los registros",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }

            # Verificar la integridad de los datos de nombre #
            if ($this->verificarDatos('[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}', $nombre)) {
                // Si el formato del nombre no es válido, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El NOMBRE DE LA HERRAMIENTA no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }

            # Verificar la CANTIDAD #
            if ($cant < 0) {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "Cantidad ingresada no valida",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }

            $tools_datos_reg=[
                [
                    "campo_nombre"=>"id_herramienta",
                    "campo_marcador"=>":Codigo",
                    "campo_valor"=> $codigo
                ],
                [
                    "campo_nombre"=>"nombre_herramienta",
                    "campo_marcador"=>":Nombre",
                    "campo_valor"=> $nombre
                ],
                [
                    "campo_nombre"=>"cantidad",
                    "campo_marcador"=>":Cant",
                    "campo_valor"=> $cant
                ],
                [
                    "campo_nombre"=>"estado",
                    "campo_marcador"=>":Estado",
                    "campo_valor"=> $estado
                ]
            ];

            $registrar_tools= $this->guardarDatos("herramienta", $tools_datos_reg);

            if ($registrar_tools->rowCount()==1) {
                $alerta = [
                    "tipo" => "limpiar",
                    "titulo" => "Herramienta Registrada",
                    "texto" => "La herramienta se ha resgitrado con exito",
                    "icono" => "success"
                ];            
            }else{            
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "La Herramienta no se pudo registrar correctamente",
                    "icono" => "error"
                ];
            }
            return json_encode($alerta);
        }
    }