<?php

namespace app\controllers;

use app\models\mainModel;

class userController extends mainModel
{

    public function registrarUserControlador()
    {
        // Se obtienen y limpian los datos del formulario
        $cedula = $this->limpiarCadena($_POST['cedula']);
        $nombre = $this->limpiarCadena($_POST['nombre']);
        $username = $this->limpiarCadena($_POST['username']);
        $clave1 = $this->limpiarCadena($_POST['clave1']);
        $clave2 = $this->limpiarCadena($_POST['clave2']);
        $tipo   = $this->limpiarCadena($_POST['tipo1']);

        # Verificación de campos obligatorios #
        if ($cedula == "" || $nombre == "" || $username == "" || $clave1 == "" || $clave2 == "" || $tipo == "Seleccionar") {
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

        # Verificar la integridad de los datos de cédula #
        if ($this->verificarDatos('^[0-9]{6,10}$', $cedula)) {
            // Si el formato de la cédula no es válido, se devuelve una alerta de error
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "La cédula no cumple con el formato solicitado",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificar el Cedula #
        $check_cedula = $this->ejecutarConsulta("SELECT id_user FROM user_system WHERE id_user='$cedula' AND std_reg=1");
        if ($check_cedula->rowCount() > 0) {
            // Si la Cédula ya existe en la base de datos, se devuelve una alerta de error
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "La Cédula ingresada ya existe en los registros",
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
                "texto" => "El nombre de usuario no cumple con el formato solicitado",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificar la integridad de los datos de nombre de usuario #
        if ($this->verificarDatos('[a-zA-Z0-9]{4,20}', $username)) {
            // Si el formato del nombre de usuario no es válido, se devuelve una alerta de error
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "El username no cumple con el formato solicitado",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificar el username #
        $check_username = $this->ejecutarConsulta("SELECT username FROM user_system WHERE username='$username' and std_reg=1");
        if ($check_username->rowCount() > 0) {
            // Si el username ya existe en la base de datos, se devuelve una alerta de error
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "El username ingresado ya existe en los registros",
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
            $clave = password_hash($clave1, PASSWORD_BCRYPT, ["cost=" => 10]);
        }

        # Verificar la integridad de los datos de la clave #
        if ($this->verificarDatos('[a-zA-Z0-9$@.-]{8,15}', $clave1)) {
            // Si el formato de la clave no es válido, se devuelve una alerta de error
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "La clave no cumple con el formato solicitado",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        // Definición de un array asociativo $user_datos_reg que contiene los datos del usuario a registrar
        $user_datos_reg = [
            [
                "campo_nombre" => "id_user",
                "campo_marcador" => ":Cedula",
                "campo_valor" => $cedula
            ],
            [
                "campo_nombre" => "user",
                "campo_marcador" => ":Nombre",
                "campo_valor" => $nombre
            ],
            [
                "campo_nombre" => "username",
                "campo_marcador" => ":Username",
                "campo_valor" => $username
            ],
            [
                "campo_nombre" => "password",
                "campo_marcador" => ":Pass",
                "campo_valor" => $clave
            ],
            [
                "campo_nombre" => "tipo",
                "campo_marcador" => ":Tipo",
                "campo_valor" => $tipo
            ],
            [
                "campo_nombre" => "std_reg",
                "campo_marcador" => ":std_reg",
                "campo_valor" => "1"
            ]
        ];

        // Llamada al método guardarDatos() para guardar los datos del usuario en la base de datos
        $registrar_user = $this->guardarDatos("user_system", $user_datos_reg);

        if ($registrar_user->rowCount() == 1) {
            $this->registrarLog($_SESSION['id'], "REGISTRO DE USUARIO", "REGISTRO EXITOSO DEL USUARIO " . $nombre);
            // Si se registró correctamente, se devuelve un mensaje de éxito
            $alerta = [
                "tipo" => "limpiar",
                "titulo" => "Usuario Registrado",
                "texto" => "El Usuario " . $nombre . " se ha registrado con éxito",
                "icono" => "success"
            ];
        } else {
            $this->registrarLog($_SESSION['id'], "REGISTRO DE USUARIO", "REGISTRO FALLIDO DEL USUARIO " . $nombre);
            // Si no se pudo registrar, se devuelve un mensaje de error
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "El Usuario no se pudo registrar correctamente",
                "icono" => "error"
            ];
        }
        return json_encode($alerta);
    }


    # controlador listar usuarios # 
    public function listarUsuarioControlador()
    {

        $tabla = "";
        $consulta_datos = "SELECT u.*, r.nombre_rol 
                FROM user_system u 
                JOIN roles_permisos r ON u.tipo = r.id 
                WHERE u.id_user != '" . $_SESSION['id'] . "' AND std_reg='1' ORDER
                BY user ASC";

        $consulta_total = "SELECT COUNT(id_user) FROM user_system u 
                JOIN roles_permisos r ON u.tipo = r.id 
                WHERE u.id_user != '" . $_SESSION['id'] . "' AND 	std_reg='1'";

        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta($consulta_total);
        $total = (int) $total->fetchColumn();

        $tabla .= '
        <div class="table-responsive table-wrapper3" id="tabla-ot">
        <table class="table border mb-0 table-hover table-sm table-striped" id="tablaDatosUser">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="clearfix">#</th>
                                <th class="clearfix">
                                    <svg class="icon">
                                        <use xlink:href="' . APP_URL . 'app/views/icons/svg/free.svg#cil-people"></use>
                                    </svg>
                                </th>
                                <th class="clearfix">Cedula</th>
                                <th class="clearfix">Nombre Completo </th>
                                <th class="text-center">Tipo de Cuenta</th>
                                <th class="text-center" colspan="4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
            ';
        if ($total >= 1) {
            $contador =  1;
            foreach ($datos as $rows) {
                $tabla .= '
                        <tr class="align-middle">
                            <td class="clearfix col-p">
                                <div class=""><b>' . $contador . '</b></div>
                            </td>
                            <td class="clearfix col-p">
                                <div class="avatar avatar-md"><img class="avatar-img"
                                        src="' . APP_URL . 'app/views/img/avatars/user.png" alt="user@email.com"><span
                            </td>                            
                            <td class="col-p">
                                <div class="clearfix">
                                    <div class=""><b>' . $rows['id_user'] . '</b></div>
                                </div>
                            </td>
                            <td>
                                <div class="clearfix">
                                    <div class=""><b>' . $rows['user'] . '</b></div>
                                </div>
                            </td>
                            <td class="col-2">
                                <div class="text-center">
                                    <div class=""><b>' . $rows['nombre_rol'] . '</b></div>
                                </div>
                            </td>
                            <td class="col-p">
                                <button type="button" title="Ver" class="btn btn-primary">
                                    <i class="bi bi-eye"></i>
                                </button>                       
                            </td>
                            <td class="col-p">                              
                                <a href="#" title="Cambiar Clave" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventanaModalModificarPass" data-bs-id="' . $rows['id_user'] . '">
                                    <i class="bi bi-lock"></i>
                                </a> 
                            </td>
                            <td class="col-p">                              
                                <a href="#" title="Modificar" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventanaModalModificar" data-bs-id="' . $rows['id_user'] . '">
                                    <i class="bi bi-pencil"></i>
                                </a> 
                            </td>
                            <td class="col-p">
                                <form class="FormularioAjax" action="' . APP_URL . 'app/ajax/userAjax.php" method="POST">
                                    <input type="hidden" name="modulo_user" value="eliminar">
                                    <input type="hidden" name="id_user" value="' . $rows['id_user'] . '">
                                    <button type="submit" class="btn btn-primary" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button> 
                                </form>
                            </td>    
                        </tr>
                    ';
                $contador++;
            }
        } else {

            $tabla .= '
                        <tr class="align-middle">
                            <td class="text-center">
                                No hay registros en el sistema
                            </td>
                        </tr>
                    ';
        }
        $tabla .= '</tbody> </table> </div> ';
        return $tabla;
    }
    public function listarComboRolesControlador($tipo)
    {

        // Variable para almacenar el HTML del combo
        $combo = '';

        // Consulta para obtener los datos de los miembros según el tipo especificado
        $consulta_datos = 'SELECT * FROM roles_permisos';

        // Ejecutar la consulta para obtener los datos de los miembros
        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        // Comprobar el tipo de miembro para determinar la etiqueta del combo

        // Si el tipo no es 1, el combo es para el responsable de control de operaciones
        $combo .= '
                <label class="form-label">TIPO DE USUARIO</label>
                <select class="form-select" name="'.$tipo.'" id="'.$tipo.'" aria-label="Default select example">
                    <option selected>Seleccionar</option>
                ';

        // Comprobar si hay miembros disponibles para mostrar en el combo
        if (count($datos) > 0) {

            // Si hay miembros disponibles, iterar sobre ellos y agregar opciones al combo
            foreach ($datos as $rows) {
                $combo .= '
                            <option value="' . $rows['id'] . '">' . $rows['nombre_rol'] . '</option>
                        ';
            }
        }

        // Cerrar el combo y devolver el HTML generado
        $combo .= '</select>';

        return $combo;
    }
    # eliminar usuario 
    public function eliminarUserControlador()
    {

        $id = $this->limpiarCadena($_POST['id_user']);
        $id2 = "E-" . $id;

        if ($id == 1) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "No podemos eliminar este usuario",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
        # verificar el usuario
        $datos = $this->ejecutarConsulta("SELECT * FROM user_system WHERE id_user='$id'");
        if ($datos->rowCount() <= 0) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "No hemos encontrado el usuario en el sistema",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        } else {
            $datos = $datos->fetch();
        }

        $datos_reg = [
            [
                "campo_nombre" => "id_user",
                "campo_marcador" => ":id",
                "campo_valor" => $id2
            ],
            [
                "campo_nombre" => "std_reg",
                "campo_marcador" => ":std_reg",
                "campo_valor" => 0
            ]
        ];

        $condicion = [
            "condicion_campo" => "id_user",
            "condicion_marcador" => ":id_user",
            "condicion_valor" => $id
        ];

        if ($this->actualizarDatos("user_system", $datos_reg, $condicion)) {
            $this->registrarLog($_SESSION['id'], "ELIMINACION DE USUARIO", "ELIMINACION EXITOSA DEL USUARIO " . $datos['user']);
            $alerta = [
                "tipo" => "recargar",
                "titulo" => "Usuario Eliminador",
                "texto" => "El Usuario ha sido eliminado con exito",
                "icono" => "success"
            ];
        } else {
            $this->registrarLog($_SESSION['id'], "ELIMINACION DE USUARIO", "ELIMINACION FALLIDA DEL USUARIO " . $datos['user']);
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "No se pudo eliminar el Usuario, por favor intente nuevamente",
                "icono" => "error"
            ];
        }
        return json_encode($alerta);
    }

    public function actualizarDatosUser()
    {
        $id = $this->limpiarCadena($_POST['id']);

        $cedula = $this->limpiarCadena($_POST['cedula']);
        $nombre = $this->limpiarCadena($_POST['nombre']);
        $username = $this->limpiarCadena($_POST['username']);
        $tipo   = $this->limpiarCadena($_POST['tipo2']);

        # Verificación de campos obligatorios #
        if ($cedula == "" || $nombre == "" || $username == "" || $tipo == "Seleccionar") {
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
        if ($this->verificarDatos('^[0-9]{6,8}$', $cedula)) {
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
        #VERIFICAR LA CEDULA NO EXISTA        
        $check_cedula = $this->ejecutarConsulta("SELECT * FROM user_system WHERE id_user='$cedula' AND id_user!='$id'");
        if ($check_cedula->rowCount() > 0) {
            // Si el username ya existe en la base de datos, se devuelve una alerta de error
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "La CEDULA ingresado ya existe en los registros",
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
        $check_username = $this->ejecutarConsulta("SELECT username FROM user_system WHERE username='$username' AND id_user!='$id'");
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

        $user_datos = [
            [
                "campo_nombre" => "id_user",
                "campo_marcador" => ":Cedula",
                "campo_valor" => $cedula
            ],
            [
                "campo_nombre" => "user",
                "campo_marcador" => ":Nombre",
                "campo_valor" => $nombre
            ],
            [
                "campo_nombre" => "username",
                "campo_marcador" => ":Username",
                "campo_valor" => $username
            ],
            [
                "campo_nombre" => "tipo",
                "campo_marcador" => ":Tipo",
                "campo_valor" => $tipo
            ]
        ];

        $condicion = [
            "condicion_campo" => "id_user",
            "condicion_marcador" => ":ID",
            "condicion_valor" => $id
        ];

        if ($this->actualizarDatos("user_system", $user_datos, $condicion)) {
            $this->registrarLog($_SESSION['id'], "ACTUALIZACION DE DATOS", "ACTUALIZACION EXITOSA");
            $alerta = [
                "tipo" => "limpiar",
                "titulo" => "Datos Actualizados",
                "texto" => "Se actualizo correctamente",
                "icono" => "success"
            ];
        } else {
            $this->registrarLog($_SESSION['id'], "ACTUALIZACION DE DATOS", "ERROR EN LA ACTUALIZACION");
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "¡Ha ocurrido un error durante el registro!",
                "icono" => "error"
            ];
        }
        return json_encode($alerta);
    }
    public function actualizarDatosUserSesion()
    {
        $claveD = "0";

        $id = $this->limpiarCadena($_POST['id']);

        $cedula = $this->limpiarCadena($_POST['cedula']);
        $nombre = $this->limpiarCadena($_POST['nombre']);
        $username = $this->limpiarCadena($_POST['username']);
        $clave1 = $this->limpiarCadena($_POST['clave1']);
        $clave2 = $this->limpiarCadena($_POST['clave2']);

        # Verificación de campos obligatorios #
        if ($cedula == "" || $nombre == "" || $username == "") {
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
        # Verificación de campos obligatorios #
        if ($clave1 != "") {
            if ($clave2 != "") {
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
                    # Verificar la integridad de los datos de clave #
                    if ($this->verificarDatos('[a-zA-Z0-9$@.-]{8,15}', $clave1)) {
                        // Si el formato del nombre no es válido, se devuelve una alerta de error
                        $alerta = [
                            "tipo" => "simple",
                            "titulo" => "Ocurrió un error inesperado",
                            "texto" => "La clave no cumple con el formato solicitado",
                            "icono" => "error"
                        ];
                        return json_encode($alerta);
                        exit();
                    } else {
                        $claveD = "1";
                        $clave = password_hash($clave1, PASSWORD_BCRYPT, ["cost=" => 10]);
                    }
                }
            } else {
                // Si la clave 2 está vacía, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "No has ingresado la segunda clave",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
        }




        # Verificar la integridad de los datos de código #
        if ($this->verificarDatos('^[0-9]{6,8}$', $cedula)) {
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
        #VERIFICAR LA CEDULA NO EXISTA        
        $check_cedula = $this->ejecutarConsulta("SELECT * FROM user_system WHERE id_user='$cedula' AND id_user!='$id'");
        if ($check_cedula->rowCount() > 0) {
            // Si el username ya existe en la base de datos, se devuelve una alerta de error
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "La CEDULA ingresado ya existe en los registros",
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
        $check_username = $this->ejecutarConsulta("SELECT username FROM user_system WHERE username='$username' AND id_user!='$id'");
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
        if ($claveD == 1) {
            $user_datos = [
                [
                    "campo_nombre" => "id_user",
                    "campo_marcador" => ":Cedula",
                    "campo_valor" => $cedula
                ],
                [
                    "campo_nombre" => "user",
                    "campo_marcador" => ":Nombre",
                    "campo_valor" => $nombre
                ],
                [
                    "campo_nombre" => "username",
                    "campo_marcador" => ":Username",
                    "campo_valor" => $username
                ],
                [
                    "campo_nombre" => "password",
                    "campo_marcador" => ":Pass",
                    "campo_valor" => $clave
                ]
            ];
        } else {
            $user_datos = [
                [
                    "campo_nombre" => "id_user",
                    "campo_marcador" => ":Cedula",
                    "campo_valor" => $cedula
                ],
                [
                    "campo_nombre" => "user",
                    "campo_marcador" => ":Nombre",
                    "campo_valor" => $nombre
                ],
                [
                    "campo_nombre" => "username",
                    "campo_marcador" => ":Username",
                    "campo_valor" => $username
                ]
            ];
        }

        $condicion = [
            "condicion_campo" => "id_user",
            "condicion_marcador" => ":ID",
            "condicion_valor" => $id
        ];
        if ($this->actualizarDatos("user_system", $user_datos, $condicion)) {
            $this->registrarLog($cedula, "ACTUALIZACION DE DATOS SESION", "ACTUALIZACION EXITOSA");
            $alerta = [
                "tipo" => "cerrar",
                "titulo" => "Datos Actualizados",
                "texto" => "Datos actualizados correctamente, la sesion debe ser cerrada para que los cambios sean aplicados.",
                "icono" => "success"
            ];
        } else {
            $this->registrarLog($cedula, "ACTUALIZACION DE DATOS SESION", "ERROR EN LA ACTUALIZACION");
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "¡Ha ocurrido un error durante el registro!",
                "icono" => "error"
            ];
        }
        return json_encode($alerta);
    }

    /**
     * Método para actualizar la clave de un usuario en la base de datos.
     * 
     * Este método recibe los datos de la nueva clave desde un formulario y realiza
     * las validaciones necesarias antes de actualizar la clave en la base de datos.
     * 
     * @return string JSON con un mensaje de éxito o error según el resultado de la operación.
     */
    public function actualizarClaveUser()
    {
        // Obtener el ID del usuario desde el formulario y limpiar los datos
        $id = $this->limpiarCadena($_POST['id2']);

        // Obtener y limpiar las claves proporcionadas desde el formulario
        $clave1 = $this->limpiarCadena($_POST['clave1']);
        $clave2 = $this->limpiarCadena($_POST['clave2']);

        # Verificación de campos obligatorios #
        if ($clave1 == "" || $clave2 == "") {
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
            $clave = password_hash($clave1, PASSWORD_BCRYPT, ["cost=" => 10]);
        }

        # Verificar la integridad de los datos de clave #
        if ($this->verificarDatos('[a-zA-Z0-9$@.-]{8,15}', $clave1)) {
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

        // Definir los datos a actualizar en la base de datos
        $user_datos = [
            [
                "campo_nombre" => "password",
                "campo_marcador" => ":Pass",
                "campo_valor" => $clave
            ]
        ];

        // Definir la condición para identificar al usuario cuya clave se actualizará
        $condicion = [
            "condicion_campo" => "id_user",
            "condicion_marcador" => ":ID",
            "condicion_valor" => $id
        ];

        // Intentar actualizar la clave en la base de datos
        if ($this->actualizarDatos("user_system", $user_datos, $condicion)) {
            $this->registrarLog($_SESSION['id'], "CAMBIO DE CLAVE", "CLAVE MODIFICADA EXITOSAMENTE");
            // Si se actualiza correctamente, se devuelve un mensaje de éxito
            $alerta = [
                "tipo" => "limpiar",
                "titulo" => "Contraseña Actualizada",
                "texto" => "Se actualizó correctamente",
                "icono" => "success"
            ];
        } else {
            $this->registrarLog($_SESSION['id'], "CAMBIO DE CLAVE", "ERROR AL MODIFICAR LA CLAVE");
            // Si ocurre algún error durante la actualización, se devuelve una alerta de error
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "¡Ha ocurrido un error durante la actualización!",
                "icono" => "error"
            ];
        }

        // Devolver el mensaje resultante en formato JSON
        return json_encode($alerta);
    }

    public function cerrarSesionControlador()
    {
        // Destruir todas las variables de sesión
        session_destroy();
        // Verificar si se han enviado encabezados HTTP al navegador
        if (headers_sent()) {
            // Si los encabezados ya se han enviado, redirigir mediante JavaScript
            echo "
                    <script>
                        // Redirigir a la página de inicio de sesión
                        window.location.href='" . APP_URL . "login/';
                    </script> 
                ";
        } else {
            // Si los encabezados no se han enviado, redirigir mediante encabezados de PHP
            header("Location: " . APP_URL . "login/");
        }
    }
}
