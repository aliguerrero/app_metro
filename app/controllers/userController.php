<?php
    namespace app\controllers;
    use app\models\mainModel;

    class userController extends mainModel{

        public function registrarUserControlador(){
            // Se obtienen y limpian los datos del formulario
            $cedula = $this->limpiarCadena($_POST['cedula']);
            $nombre = $this->limpiarCadena($_POST['nombre']);
            $username = $this->limpiarCadena($_POST['username']);
            $clave1 = $this->limpiarCadena($_POST['clave1']);
            $clave2 = $this->limpiarCadena($_POST['clave2']);
            $tipo   = $this->limpiarCadena($_POST['tipo']);

            # Verificación de campos obligatorios #
            if ($cedula == "" || $nombre == "" || $username == ""|| $clave1 == ""|| $clave2 == ""|| $tipo == "Seleccionar") {
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
            if ($this->verificarDatos('^[0-9]{6,10}$', $cedula)) {
                // Si el formato del código no es válido, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "La CEDULA no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
            # Verificar el Cedula #
            $check_cedula = $this->ejecutarConsulta("SELECT id_user FROM user_system WHERE id_user='$cedula'");
            if ($check_cedula->rowCount() > 0) {
                // Si la Cedula ya existe en la base de datos, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "La Cedula ingresada ya existe en los registros",
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
                    "texto" => "El NOMBRE DEL USUARIO no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
            # Verificar la integridad de los datos de nombre #
            if ($this->verificarDatos('[a-zA-Z0-9]{4,20}', $username)) {
                // Si el formato del nombre no es válido, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El USERNAME no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
            # Verificar el username #
            $check_username = $this->ejecutarConsulta("SELECT username FROM user_system WHERE username='$username'");
            if ($check_username->rowCount() > 0) {
                // Si el username ya existe en la base de datos, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El USERNAME ingresado ya existe en los registros",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }

            # Verificar las claves #
            if ($clave1 != $clave2) {
                // Si las claves no coinciden, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "Las claves no coinciden",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            } else {
                // Si coinciden, se crea un hash de la clave
                $clave = password_hash($clave1,PASSWORD_BCRYPT,["cost="=> 10]);
            }
            # Verificar la integridad de los datos de clave #
            if ($this->verificarDatos('[a-zA-Z0-9$@.-]{7,100}', $clave1)) {
                // Si el formato del nombre no es válido, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "La clave no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }

            $user_datos_reg=[
                [
                    "campo_nombre"=>"id_user",
                    "campo_marcador"=>":Cedula",
                    "campo_valor"=> $cedula
                ],
                [
                    "campo_nombre"=>"user",
                    "campo_marcador"=>":Nombre",
                    "campo_valor"=> $nombre
                ],
                [
                    "campo_nombre"=>"username",
                    "campo_marcador"=>":Username",
                    "campo_valor"=> $username
                ],
                [
                    "campo_nombre"=>"password",
                    "campo_marcador"=>":Pass",
                    "campo_valor"=> $clave
                ],
                [
                    "campo_nombre"=>"tipo",
                    "campo_marcador"=>":Tipo",
                    "campo_valor"=> $tipo
                ]
            ];

            $registrar_user= $this->guardarDatos("user_system", $user_datos_reg);

            if ($registrar_user->rowCount()==1) {
                $alerta = [
                    "tipo" => "limpiar",
                    "titulo" => "Usuario Registrado",
                    "texto" => "El Usuario ".$nombre." se ha resgitrado con exito",
                    "icono" => "success"
                ];            
            }else{            
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El Usuario no se pudo registrar correctamente",
                    "icono" => "error"
                ];
            }
            return json_encode($alerta);
        }
    }