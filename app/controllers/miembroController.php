<?php
    namespace app\controllers;
    use app\models\mainModel;

    class miembroController extends mainModel{
        public function registrarMiembroControlador(){
            // Se obtienen y limpian los datos del formulario
            $codigo = $this->limpiarCadena($_POST['codigo']);
            $nombre = $this->limpiarCadena($_POST['nombre']);
            $tipo   = $this->limpiarCadena($_POST['tipo']);

            # Verificación de campos obligatorios #
            if ($codigo == "" || $nombre == "" || $tipo == "Seleccionar") {
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
                    "texto" => "El CÓDIGO no cumple con el formato solicitado",
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
                    "texto" => "El NOMBRE DEL OPERADOR no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }

            /*# Verificar el EMAIL #
            if ($email != "") {
                if (filter_var($email.FILTER_VALIDATE_EMAIL)) {
                    // Si el formato del email no es válido, se devuelve una alerta de error
                    $alerta = [
                        "tipo" => "simple",
                        "titulo" => "Ocurrió un error inesperado",
                        "texto" => "El EMAIL ingresado ya existe en los registros",
                        "icono" => "error"
                    ];
                    return json_encode($alerta);
                    exit();
                } else {
                    // Si el email no es válido, se devuelve una alerta de error
                    $alerta = [
                        "tipo" => "simple",
                        "titulo" => "Ocurrió un error inesperado",
                        "texto" => "Ha ingresado un EMAIL no válido",
                        "icono" => "error"
                    ];
                    return json_encode($alerta);
                    exit();
                }
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

            # Verificar el usuario #
            $check_usuario = $this->ejecutarConsulta("SELECT usuario FROM tabla_consulta WHERE usuario='$usuario'");
            if ($check_usuario->rowCount() > 0) {
                // Si el usuario ya existe en la base de datos, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El USUARIO ingresado ya existe en los registros",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }

            # DIRECTORIO DE IMÁGENES #
            $img_dir = "../views/photos/";

            # Comprobar si se ha seleccionado una imagen #
            if ($_FILES['name_form']['name']!= "" && $_FILES['name_form']['size'] > 0) {
                if (!file_exists($img_dir)) {
                    // Si el directorio de imágenes no existe, se intenta crear
                    if (!mkdir($img_dir, 0777)) {
                        // Si hay un error al crear el directorio, se devuelve una alerta de error
                        $alerta = [
                            "tipo" => "simple",
                            "titulo" => "Ocurrió un error inesperado",
                            "texto" => "Error al crear el directorio",
                            "icono" => "error"
                        ];
                        return json_encode($alerta);
                        exit();     
                    }  
                }

                // Verificar el tipo y tamaño de la imagen
                if (mime_content_type($_FILES['name_form']['tmp_name'])!= "image/jpeg" && mime_content_type($_FILES['name_form']['tmp_name'])!= "image/png" ) {
                    // Si el formato de la imagen no es válido, se devuelve una alerta de error
                    $alerta = [
                        "tipo" => "simple",
                        "titulo" => "Ocurrió un error inesperado",
                        "texto" => "La imagen seleccionada tiene un formato no permitido",
                        "icono" => "error"
                    ];
                    return json_encode($alerta);
                    exit(); 
                }

                if (($_FILES['name_form']['size']/1024)>5120) {
                    // Si la imagen es muy pesada, se devuelve una alerta de error
                    $alerta = [
                        "tipo" => "simple",
                        "titulo" => "Ocurrió un error inesperado",
                        "texto" => "La imagen seleccionada es muy pesada",
                        "icono" => "error"
                    ];
                    return json_encode($alerta);
                    exit(); 
                }
                
                // Generar un nombre único para la imagen
                $foto = str_ireplace(" ","_",$nombre);
                $foto = $foto."_".rand(0,100);

                switch (mime_content_type($_FILES['name_form']['tmp_name'])) {
                    case "image/jpeg":
                        $foto = $foto.".jpg";
                    break;
                    case "image/png":
                        $foto = $foto.".png";
                    break;                    
                }

                // Cambiar los permisos del directorio
                chmod($img_dir,0777);

                // Mover la imagen al directorio de imágenes
                if (!move_uploaded_file($_FILES['name_form']['tmp_name'],$img_dir.$foto)) {
                    // Si hay un error al subir la imagen, se devuelve una alerta de error
                    $alerta = [
                        "tipo" => "simple",
                        "titulo" => "Ocurrió un error inesperado",
                        "texto" => "Error al subir la imagen",
                        "icono" => "error"
                    ];
                    return json_encode($alerta);
                    exit();
                }
            } else {
                // Si no se ha seleccionado una imagen, se asigna una cadena vacía a $foto
                $foto="";
            }*/

           // Definición de un array asociativo $miembro_datos_reg que contiene los datos del miembro a registrar
            $miembro_datos_reg = [
                [
                    "campo_nombre" => "id_miembro",
                    "campo_marcador" => ":Codigo",
                    "campo_valor" => $codigo
                ],
                [
                    "campo_nombre" => "nombre_miembro",
                    "campo_marcador" => ":Nombre",
                    "campo_valor" => $nombre
                ],
                [
                    "campo_nombre" => "tipo_miembro",
                    "campo_marcador" => ":Tipo",
                    "campo_valor" => $tipo
                ]
            ];

            // Llamada al método guardarDatos() para guardar los datos del miembro en la base de datos
            $registrar_miemnbro = $this->guardarDatos("miembro", $miembro_datos_reg);

            // Verificar si se registró correctamente el miembro
            if ($registrar_miemnbro->rowCount() == 1) {
                // Si se registró correctamente, se devuelve un mensaje de éxito
                $alerta = [
                    "tipo" => "limpiar",
                    "titulo" => "Miembro Registrado",
                    "texto" => "El miembro " . $nombre . " se ha registrado con éxito",
                    "icono" => "success"
                ];
            } else {
                /*
                Si no se registró correctamente, se elimina la imagen si se había subido previamente
                if (is_file($img_dir . $foto)) {
                    chmod($img_dir . $foto, 0777);
                    unlink($img_dir . $foto);
                }*/
                // Se devuelve un mensaje de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El miembro no se pudo registrar correctamente",
                    "icono" => "error"
                ];
            }

            // Se devuelve el mensaje de alerta en formato JSON
            return json_encode($alerta);

        }
    }