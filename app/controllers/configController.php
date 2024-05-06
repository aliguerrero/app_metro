<?php
namespace app\controllers;
use app\models\mainModel;

class configController extends mainModel {

    public function registrarRolControlador() {
        // Se obtienen y limpian los datos del formulario
        // Permisos para Usuarios
        $rol_name = $this->limpiarCadena( $_POST[ 'rol_name' ] );

        // Permisos para Usuarios
        $permisoUsuarios0 = $this->limpiarCadena( $_POST[ 'permisoUsuarios0' ] ?? '' );
        $permisoUsuarios1 = $this->limpiarCadena( $_POST[ 'permisoUsuarios1' ] ?? '' );
        $permisoUsuarios2 = $this->limpiarCadena( $_POST[ 'permisoUsuarios2' ] ?? '' );
        $permisoUsuarios3 = $this->limpiarCadena( $_POST[ 'permisoUsuarios3' ] ?? '' );

        // Permisos para Herramienta
        $permisoHerramienta0 = $this->limpiarCadena( $_POST[ 'permisoHerramienta0' ] ?? '' );
        $permisoHerramienta1 = $this->limpiarCadena( $_POST[ 'permisoHerramienta1' ] ?? '' );
        $permisoHerramienta2 = $this->limpiarCadena( $_POST[ 'permisoHerramienta2' ] ?? '' );
        $permisoHerramienta3 = $this->limpiarCadena( $_POST[ 'permisoHerramienta3' ] ?? '' );

        // Permisos para Miembro
        $permisoMiembro0 = $this->limpiarCadena( $_POST[ 'permisoMiembro0' ] ?? '' );
        $permisoMiembro1 = $this->limpiarCadena( $_POST[ 'permisoMiembro1' ] ?? '' );
        $permisoMiembro2 = $this->limpiarCadena( $_POST[ 'permisoMiembro2' ] ?? '' );
        $permisoMiembro3 = $this->limpiarCadena( $_POST[ 'permisoMiembro3' ] ?? '' );

        // Permisos para Orden Trabajo
        $permisoOrdenTrabajo0 = $this->limpiarCadena( $_POST[ 'permisoOrdenTrabajo0' ] ?? '' );
        $permisoOrdenTrabajo1 = $this->limpiarCadena( $_POST[ 'permisoOrdenTrabajo1' ] ?? '' );
        $permisoOrdenTrabajo2 = $this->limpiarCadena( $_POST[ 'permisoOrdenTrabajo2' ] ?? '' );
        $permisoOrdenTrabajo3 = $this->limpiarCadena( $_POST[ 'permisoOrdenTrabajo3' ] ?? '' );
        $permisoOrdenTrabajo4 = $this->limpiarCadena( $_POST[ 'permisoOrdenTrabajo4' ] ?? '' );
        $permisoOrdenTrabajo5 = $this->limpiarCadena( $_POST[ 'permisoOrdenTrabajo5' ] ?? '' );
        $permisoOrdenTrabajo6 = $this->limpiarCadena( $_POST[ 'permisoOrdenTrabajo6' ] ?? '' );

        # Verificación de campos obligatorios #
        if ( $rol_name == '' ) {
            // Si algún campo obligatorio está vacío, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'No has llenado todos los campos que son obligatorios',
                'icono' => 'error'
            ];
            return json_encode( $alerta );
            exit();
        }
        if ( $this->verificarDatos( '[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 -]{3,40}', $rol_name ) ) {
            // Si el formato del nombre no es válido, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'El nombre rol no cumple con el formato solicitado',
                'icono' => 'error'
            ];
            return json_encode( $alerta );
        }
        // Definición de un array asociativo $user_datos_reg que contiene los datos del rol a registrar
        // Array para almacenar los permisos
        $rol_datos_reg = [
            [
                'campo_nombre' => 'nombre_rol',
                'campo_marcador' => ':nombre_rol',
                'campo_valor' => $rol_name =  mb_strtoupper( $rol_name, 'UTF-8' )
            ],
            [
                'campo_nombre' => 'perm_usuarios_view',
                'campo_marcador' => ':PermUsuariosView',
                'campo_valor' => $this->respuestaCheck( $permisoUsuarios0 )
            ],
            [
                'campo_nombre' => 'perm_usuarios_add',
                'campo_marcador' => ':PermUsuariosAdd',
                'campo_valor' => $this->respuestaCheck( $permisoUsuarios1 )
            ],
            [
                'campo_nombre' => 'perm_usuarios_edit',
                'campo_marcador' => ':PermUsuariosEdit',
                'campo_valor' => $this->respuestaCheck( $permisoUsuarios2 )
            ],
            [
                'campo_nombre' => 'perm_usuarios_delete',
                'campo_marcador' => ':PermUsuariosDelete',
                'campo_valor' => $this->respuestaCheck( $permisoUsuarios3 )
            ],
            [
                'campo_nombre' => 'perm_herramienta_view',
                'campo_marcador' => ':PermHerramientaView',
                'campo_valor' => $this->respuestaCheck( $permisoHerramienta0 )
            ],
            [
                'campo_nombre' => 'perm_herramienta_add',
                'campo_marcador' => ':PermHerramientaAdd',
                'campo_valor' => $this->respuestaCheck( $permisoHerramienta1 )
            ],
            [
                'campo_nombre' => 'perm_herramienta_edit',
                'campo_marcador' => ':PermHerramientaEdit',
                'campo_valor' => $this->respuestaCheck( $permisoHerramienta2 )
            ],
            [
                'campo_nombre' => 'perm_herramienta_delete',
                'campo_marcador' => ':PermHerramientaDelete',
                'campo_valor' => $this->respuestaCheck( $permisoHerramienta3 )
            ],
            [
                'campo_nombre' => 'perm_miembro_view',
                'campo_marcador' => ':PermMiembroView',
                'campo_valor' => $this->respuestaCheck( $permisoMiembro0 )
            ],
            [
                'campo_nombre' => 'perm_miembro_add',
                'campo_marcador' => ':PermMiembroAdd',
                'campo_valor' => $this->respuestaCheck( $permisoMiembro1 )
            ],
            [
                'campo_nombre' => 'perm_miembro_edit',
                'campo_marcador' => ':PermMiembroEdit',
                'campo_valor' => $this->respuestaCheck( $permisoMiembro2 )
            ],
            [
                'campo_nombre' => 'perm_miembro_delete',
                'campo_marcador' => ':PermMiembroDelete',
                'campo_valor' => $this->respuestaCheck( $permisoMiembro3 )
            ],
            [
                'campo_nombre' => 'perm_ot_view',
                'campo_marcador' => ':PermOTView',
                'campo_valor' => $this->respuestaCheck( $permisoOrdenTrabajo0 )
            ],
            [
                'campo_nombre' => 'perm_ot_add',
                'campo_marcador' => ':PermOTAdd',
                'campo_valor' => $this->respuestaCheck( $permisoOrdenTrabajo1 )
            ],
            [
                'campo_nombre' => 'perm_ot_edit',
                'campo_marcador' => ':PermOTEdit',
                'campo_valor' => $this->respuestaCheck( $permisoOrdenTrabajo2 )
            ],
            [
                'campo_nombre' => 'perm_ot_delete',
                'campo_marcador' => ':PermOTDelete',
                'campo_valor' => $this->respuestaCheck( $permisoOrdenTrabajo4 )
            ],
            [
                'campo_nombre' => 'perm_ot_add_detalle',
                'campo_marcador' => ':PermOTAddDetalle',
                'campo_valor' => $this->respuestaCheck( $permisoOrdenTrabajo3 )
            ],
            [
                'campo_nombre' => 'perm_ot_generar_reporte',
                'campo_marcador' => ':PermOTGenerarReporte',
                'campo_valor' => $this->respuestaCheck( $permisoOrdenTrabajo5 )
            ],
            [
                'campo_nombre' => 'perm_ot_add_herramienta',
                'campo_marcador' => ':PermOTAddHerramienta',
                'campo_valor' => $this->respuestaCheck( $permisoOrdenTrabajo6 )
            ]
        ];

        // Llamada al método guardarDatos() para guardar los datos del usuario en la base de datos
        $registrar_dts = $this->guardarDatos( 'roles_permisos', $rol_datos_reg );

        if ( $registrar_dts->rowCount() == 1 ) {
            $this->registrarLog( $_SESSION[ 'id' ], 'REGISTRO DE ROL', 'REGISTRO EXITOSO DEL ROL '.$rol_name );
            // Si se registró correctamente, se devuelve un mensaje de éxito
            $alerta = [
                'tipo' => 'limpiar',
                'titulo' => 'Rol Registrado',
                'texto' => 'El Rol '.$rol_name.' se ha registrado con éxito',
                'icono' => 'success'
            ];

        } else {

            $this->registrarLog( $_SESSION[ 'id' ], 'REGISTRO DE ROL', 'REGISTRO FALLIDO DEL ROL '.$rol_name );

            // Si no se pudo registrar, se devuelve un mensaje de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'El Rol no se pudo registrar correctamente',
                'icono' => 'error'
            ];
        }
        return json_encode( $alerta );
    }

    public function ModificarRolControlador() {
        // Se obtienen y limpian los datos del formulario
        // Permisos para Usuarios
        $id = $this->limpiarCadena( $_POST[ 'opciones' ] );

        // Permisos para Usuarios
        $permisoUsuarios0 = $this->limpiarCadena( $_POST[ 'permisoUsuarios0' ] ?? '' );
        $permisoUsuarios1 = $this->limpiarCadena( $_POST[ 'permisoUsuarios1' ] ?? '' );
        $permisoUsuarios2 = $this->limpiarCadena( $_POST[ 'permisoUsuarios2' ] ?? '' );
        $permisoUsuarios3 = $this->limpiarCadena( $_POST[ 'permisoUsuarios3' ] ?? '' );

        // Permisos para Herramienta
        $permisoHerramienta0 = $this->limpiarCadena( $_POST[ 'permisoHerramienta0' ] ?? '' );
        $permisoHerramienta1 = $this->limpiarCadena( $_POST[ 'permisoHerramienta1' ] ?? '' );
        $permisoHerramienta2 = $this->limpiarCadena( $_POST[ 'permisoHerramienta2' ] ?? '' );
        $permisoHerramienta3 = $this->limpiarCadena( $_POST[ 'permisoHerramienta3' ] ?? '' );

        // Permisos para Miembro
        $permisoMiembro0 = $this->limpiarCadena( $_POST[ 'permisoMiembro0' ] ?? '' );
        $permisoMiembro1 = $this->limpiarCadena( $_POST[ 'permisoMiembro1' ] ?? '' );
        $permisoMiembro2 = $this->limpiarCadena( $_POST[ 'permisoMiembro2' ] ?? '' );
        $permisoMiembro3 = $this->limpiarCadena( $_POST[ 'permisoMiembro3' ] ?? '' );

        // Permisos para Orden Trabajo
        $permisoOrdenTrabajo0 = $this->limpiarCadena( $_POST[ 'permisoOrdenTrabajo0' ] ?? '' );
        $permisoOrdenTrabajo1 = $this->limpiarCadena( $_POST[ 'permisoOrdenTrabajo1' ] ?? '' );
        $permisoOrdenTrabajo2 = $this->limpiarCadena( $_POST[ 'permisoOrdenTrabajo2' ] ?? '' );
        $permisoOrdenTrabajo3 = $this->limpiarCadena( $_POST[ 'permisoOrdenTrabajo3' ] ?? '' );
        $permisoOrdenTrabajo4 = $this->limpiarCadena( $_POST[ 'permisoOrdenTrabajo4' ] ?? '' );
        $permisoOrdenTrabajo5 = $this->limpiarCadena( $_POST[ 'permisoOrdenTrabajo5' ] ?? '' );
        $permisoOrdenTrabajo6 = $this->limpiarCadena( $_POST[ 'permisoOrdenTrabajo6' ] ?? '' );

        # Verificación de campos obligatorios #
        if ( $id == 'Seleccionar' ) {
            // Si algún campo obligatorio está vacío, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'Primero selecciona el rol que deseas modificar',
                'icono' => 'info'
            ];
            return json_encode( $alerta );
            exit();
        }

        // Definición de un array asociativo $user_datos_reg que contiene los datos del rol a registrar
        // Array para almacenar los permisos
        $rol_datos_reg = [
            [
                'campo_nombre' => 'perm_usuarios_view',
                'campo_marcador' => ':PermUsuariosView',
                'campo_valor' => $this->respuestaCheck( $permisoUsuarios0 )
            ],
            [
                'campo_nombre' => 'perm_usuarios_add',
                'campo_marcador' => ':PermUsuariosAdd',
                'campo_valor' => $this->respuestaCheck( $permisoUsuarios1 )
            ],
            [
                'campo_nombre' => 'perm_usuarios_edit',
                'campo_marcador' => ':PermUsuariosEdit',
                'campo_valor' => $this->respuestaCheck( $permisoUsuarios2 )
            ],
            [
                'campo_nombre' => 'perm_usuarios_delete',
                'campo_marcador' => ':PermUsuariosDelete',
                'campo_valor' => $this->respuestaCheck( $permisoUsuarios3 )
            ],
            [
                'campo_nombre' => 'perm_herramienta_view',
                'campo_marcador' => ':PermHerramientaView',
                'campo_valor' => $this->respuestaCheck( $permisoHerramienta0 )
            ],
            [
                'campo_nombre' => 'perm_herramienta_add',
                'campo_marcador' => ':PermHerramientaAdd',
                'campo_valor' => $this->respuestaCheck( $permisoHerramienta1 )
            ],
            [
                'campo_nombre' => 'perm_herramienta_edit',
                'campo_marcador' => ':PermHerramientaEdit',
                'campo_valor' => $this->respuestaCheck( $permisoHerramienta2 )
            ],
            [
                'campo_nombre' => 'perm_herramienta_delete',
                'campo_marcador' => ':PermHerramientaDelete',
                'campo_valor' => $this->respuestaCheck( $permisoHerramienta3 )
            ],
            [
                'campo_nombre' => 'perm_miembro_view',
                'campo_marcador' => ':PermMiembroView',
                'campo_valor' => $this->respuestaCheck( $permisoMiembro0 )
            ],
            [
                'campo_nombre' => 'perm_miembro_add',
                'campo_marcador' => ':PermMiembroAdd',
                'campo_valor' => $this->respuestaCheck( $permisoMiembro1 )
            ],
            [
                'campo_nombre' => 'perm_miembro_edit',
                'campo_marcador' => ':PermMiembroEdit',
                'campo_valor' => $this->respuestaCheck( $permisoMiembro2 )
            ],
            [
                'campo_nombre' => 'perm_miembro_delete',
                'campo_marcador' => ':PermMiembroDelete',
                'campo_valor' => $this->respuestaCheck( $permisoMiembro3 )
            ],
            [
                'campo_nombre' => 'perm_ot_view',
                'campo_marcador' => ':PermOTView',
                'campo_valor' => $this->respuestaCheck( $permisoOrdenTrabajo0 )
            ],
            [
                'campo_nombre' => 'perm_ot_add',
                'campo_marcador' => ':PermOTAdd',
                'campo_valor' => $this->respuestaCheck( $permisoOrdenTrabajo1 )
            ],
            [
                'campo_nombre' => 'perm_ot_edit',
                'campo_marcador' => ':PermOTEdit',
                'campo_valor' => $this->respuestaCheck( $permisoOrdenTrabajo2 )
            ],
            [
                'campo_nombre' => 'perm_ot_delete',
                'campo_marcador' => ':PermOTDelete',
                'campo_valor' => $this->respuestaCheck( $permisoOrdenTrabajo4 )
            ],
            [
                'campo_nombre' => 'perm_ot_add_detalle',
                'campo_marcador' => ':PermOTAddDetalle',
                'campo_valor' => $this->respuestaCheck( $permisoOrdenTrabajo3 )
            ],
            [
                'campo_nombre' => 'perm_ot_generar_reporte',
                'campo_marcador' => ':PermOTGenerarReporte',
                'campo_valor' => $this->respuestaCheck( $permisoOrdenTrabajo5 )
            ],
            [
                'campo_nombre' => 'perm_ot_add_herramienta',
                'campo_marcador' => ':PermOTAddHerramienta',
                'campo_valor' => $this->respuestaCheck( $permisoOrdenTrabajo6 )
            ]
        ];
        $condicion = [
            'condicion_campo'=>'id',
            'condicion_marcador'=>':ID',
            'condicion_valor'=>$id
        ];

        if ( $this->actualizarDatos( 'roles_permisos', $rol_datos_reg, $condicion ) ) {
            $this->registrarLog( $_SESSION[ 'id' ], 'MODIFICACIÓN DE ROL', 'MODIFICACIÓN EXITOSA DEL ROL ' );
            // Si se registró correctamente, se devuelve un mensaje de éxito
            $alerta = [
                'tipo' => 'limpiar',
                'titulo' => 'Rol Modificado',
                'texto' => 'El Rol se ha modificado con éxito',
                'icono' => 'success'
            ];

        } else {

            $this->registrarLog( $_SESSION[ 'id' ], 'MODIFICACIÓN DE ROL', 'MODIFICACIÓN FALLIDA DEL ROL ' );

            // Si no se pudo registrar, se devuelve un mensaje de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'El Rol no se pudo modificar correctamente',
                'icono' => 'error'
            ];
        }
        return json_encode( $alerta );
    }

    public function eliminarRolControlador() {

        $id = $this->limpiarCadena( $_POST[ 'opciones' ] );

        $datosC = $this->ejecutarConsulta( "SELECT * FROM roles_permisos WHERE id='$id'" );
        $datosC = $datosC->fetch();
        if ( $id == 'Seleccionar' ) {
            // Si algún campo obligatorio está vacío, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'Primero selecciona el rol que deseas eliminar',
                'icono' => 'info'
            ];
            return json_encode( $alerta );
            exit();
        }

        # verificar si el rol esta asignado algun usuario
        $datos = $this->ejecutarConsulta( "SELECT * FROM user_system WHERE tipo='$id'" );
        if ( $datos->rowCount() > 0 ) {
            $alerta = [
                'tipo' => 'simple',
                'titulo' => '¡Ups! No podemos realizar esta acción.',
                'texto' => 'Este rol esta asignado a '.$datos->rowCount().' Usuario(s), primero debe reasignarle un nuevo rol a los usuarios asociados al rol que desea eliminar para poder realizar esta acción.',
                'icono' => 'warning'
            ];
            return json_encode( $alerta );
            exit();
        } else {
            $datos = $datos->fetch();
        }

        $eliminar_reg = $this->eliminarRegistro( 'roles_permisos', 'id', $id );

        if ( $eliminar_reg->rowCount() == 1 ) {
            $this->registrarLog( $_SESSION[ 'id' ], 'ELIMINACION DE ROL', 'ELIMINACIÓN EXITOSO DEL ROL '.$datosC[ 'nombre_rol' ] );
            $alerta = [
                'tipo' => 'recargar',
                'titulo' => 'Rol Eliminado',
                'texto' => 'El Rol ha sido eliminado con exito',
                'icono' => 'success'
            ];

        } else {
            $this->registrarLog( $_SESSION[ 'id' ], 'ELIMINACION DE ROL', 'ELIMINACIÓN FALLIDA DEL ROL '.$datosC[ 'nombre_rol' ] );
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'No se pudo eliminar el Rol, por favor intente nuevamente',
                'icono' => 'error'
            ];

        }
        return json_encode( $alerta );
    }

    public function listarComboRolControlador () {

        // Variable para almacenar el HTML del combo
        $combo = '';

        // Consulta para obtener los datos de los miembros según el tipo especificado
        $consulta_datos = 'SELECT * FROM roles_permisos';

        // Ejecutar la consulta para obtener los datos de los miembros
        $datos = $this->ejecutarConsulta( $consulta_datos );
        $datos = $datos->fetchAll();

        // Comprobar el tipo de miembro para determinar la etiqueta del combo

        // Si el tipo no es 1, el combo es para el responsable de control de operaciones
        $combo .= '
                <select class="form-select" id="opciones" name="opciones" aria-label="Default select example">
                    <option selected>Seleccionar</option>
            ';

        // Comprobar si hay miembros disponibles para mostrar en el combo
        if ( count( $datos ) > 0 ) {

            // Si hay miembros disponibles, iterar sobre ellos y agregar opciones al combo
            foreach ( $datos as $rows ) {
                $combo .= '
                    <option value="'.$rows[ 'id' ].'">'.$rows[ 'nombre_rol' ].'</option>
                ';
            }
        }

        // Cerrar el combo y devolver el HTML generado
        $combo .= '</select>';

        return $combo;
    }

    public function registrarAreaControlador() {

        // Se obtienen y limpian los datos del formulario

        // Permisos para Usuarios
        $nombre_area = $this->limpiarCadena( $_POST[ 'nombre_area' ] );
        $nomeclatura = $this->limpiarCadena( $_POST[ 'nome' ] );

        # Verificación de campos obligatorios #
        if ( $nombre_area == '' || $nomeclatura == '' ) {
            // Si algún campo obligatorio está vacío, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'No has llenado todos los campos que son obligatorios',
                'icono' => 'error'
            ];
            return json_encode( $alerta );
            exit();
        }
        if ( $this->verificarDatos( '[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 -]{3,40}', $nombre_area ) ) {
            // Si el formato del nombre no es válido, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'El nombre del area no cumple con el formato solicitado',
                'icono' => 'error'
            ];
            return json_encode( $alerta );
            exit();
        }
        // Definición de un array asociativo $user_datos_reg que contiene los datos del rol a registrar
        // Array para almacenar los permisos
        $area_datos_reg = [
            [
                'campo_nombre' => 'nombre_area',
                'campo_marcador' => ':nombre_area',
                'campo_valor' => $nombre_area =  mb_strtoupper( $nombre_area, 'UTF-8' )
            ],
            [
                'campo_nombre' => 'nomeclatura',
                'campo_marcador' => ':nomeclatura',
                'campo_valor' => $nomeclatura =  mb_strtoupper( $nomeclatura, 'UTF-8' )
            ]
        ];

        // Llamada al método guardarDatos() para guardar los datos del usuario en la base de datos
        $registrar_dts = $this->guardarDatos( 'area_trabajo', $area_datos_reg );

        if ( $registrar_dts->rowCount() == 1 ) {
            $this->registrarLog( $_SESSION[ 'id' ], 'REGISTRO DE AREA', 'REGISTRO EXITOSO DEL AREA '.$nombre_area );
            // Si se registró correctamente, se devuelve un mensaje de éxito
            $alerta = [
                'tipo' => 'limpiar',
                'titulo' => 'Area Registrado',
                'texto' => 'El Area '.$nombre_area.' se ha registrado con éxito',
                'icono' => 'success'
            ];

        } else {

            $this->registrarLog( $_SESSION[ 'id' ], 'REGISTRO DE AREA', 'REGISTRO FALLIDO DEL AREA '.$nombre_area );

            // Si no se pudo registrar, se devuelve un mensaje de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'El Area no se pudo registrar correctamente',
                'icono' => 'error'
            ];
        }
        return json_encode( $alerta );
    }
    
    public function eliminarAreaControlador() {

        $id = $this->limpiarCadena( $_POST[ 'id_area' ] );

        # verificar si el rol esta asignado algun usuario
        $datosC = $this->ejecutarConsulta( "SELECT * FROM area_trabajo WHERE id_area='$id'" );
        $datosC = $datosC->fetch();

        $datos = $this->ejecutarConsulta( "SELECT * FROM orden_trabajo WHERE id_area='$id'" );
        if ( $datos->rowCount() > 0 ) {
            $alerta = [
                'tipo' => 'simple',
                'titulo' => '¡Ups! No podemos realizar esta acción.',
                'texto' => 'Esta Area esta asignada a '.$datos->rowCount().' O.T.(s), primero debe reasignarle una nueva area a las O.T. asociadas al area que desea eliminar para poder realizar esta acción.',
                'icono' => 'warning'
            ];
            return json_encode( $alerta );
            exit();
        } else {
            $datos = $datos->fetch();
        }

        $eliminar_reg = $this->eliminarRegistro( 'area_trabajo', 'id_area', $id );

        if ( $eliminar_reg->rowCount() == 1 ) {
            $this->registrarLog( $_SESSION[ 'id' ], 'ELIMINACION DE AREA', 'ELIMINACIÓN EXITOSA DEL AREA '.$datosC[ 'nombre_area' ] );
            $alerta = [
                'tipo' => 'recargar',
                'titulo' => 'Area Eliminado',
                'texto' => 'El Area '.$datosC[ 'nombre_area' ].' ha sido eliminado con exito',
                'icono' => 'success'
            ];
        } else {
            $this->registrarLog( $_SESSION[ 'id' ], 'ELIMINACION DE AREA', 'ELIMINACIÓN FALLIDA DEL AREA '.$datosC[ 'nombre_area' ] );
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'No se pudo eliminar el Area, por favor intente nuevamente',
                'icono' => 'error'
            ];
        }
        return json_encode( $alerta );
    }

    public function listarAreaControlador ( $busqueda ) {

        $busqueda = $this->limpiarCadena( $busqueda );

        $tabla = '';

        if ( isset( $busqueda ) && $busqueda != '' ) {

        } else {
            $consulta_datos = "SELECT * FROM area_trabajo ORDER
            BY id_area";

            $consulta_total = 'SELECT COUNT(id_area) FROM area_trabajo';
        }

        $datos = $this->ejecutarConsulta( $consulta_datos );
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta( $consulta_total );
        $total = ( int ) $total->fetchColumn();

        $tabla .= '
        <div class="table-responsive table-wrapper">
                <table class="table border mb-0 table-info table-hover table-sm table-striped">
                    <thead class="table-light fw-semibold">
                        <tr class="align-middle">
                            <th class="clearfix">#</th>                            
                            <th class="clearfix">Nombre</th>
                            <th class="text-center">Nomeclatura</th>
                            <th class="text-center" colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
        ';
        $contador = 0;
        if ( $total >= 1 ) {
            $contador = $contador + 1;
            foreach ( $datos as $rows ) {

                $tabla .= '
                    <tr class="align-middle">
                        <td class="clearfix col-p">
                            <div class=""><b>'.$contador.'</b></div>
                        </td>                                               
                       
                        <td class="">
                            <div class="clearfix">
                                <div class=""><b>'.$rows[ 'nombre_area' ].'</b></div>
                            </div>
                        </td>
                        <td class="col-2">
                            <div class="text-center">
                            <div class=""><b>'.$rows[ 'nomeclatura' ].'</b></div>
                            </div>
                        </td>
                        
                        <td class="col-p">
                        <a href="#" title="Modificar" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventanaModalModificarMiem" data-bs-id="'.$rows[ 'id_area' ].'">
                        <span class="bi bi-pencil"></span>
                    </a>
                    
                        </td>
                        <td class="col-p">
                            <form class="FormularioAjax" action="'.APP_URL.'app/ajax/configAjax.php" method="POST">
                                <input type="hidden" name="modulo_rol" value="eliminar_area">
                                <input type="hidden" name="id_area" value="'.$rows[ 'id_area' ].'">
                                <button type="submit" class="btn btn-primary" title="Eliminar">
                                    <span class="bi bi-trash"></span>
                                </button>

                            </form>
                        </td>    
                    </tr>
                ';
                $contador++;
            }
        } else {
            if ( $total >= 1 ) {

            } else {
                $tabla .= '
                    <tr class="align-middle">
                        <td class="text-center">
                            No hay registros en el sistema
                        </td>
                    </tr>
                ';
            }

        }

        $tabla .= '</tbody> </table> </div> <label class="form-label">Total registros: <strong>'.$total.'</strong></label>';

        return $tabla;
    }

    public function registrarEstadoControlador() {
        // Se obtienen y limpian los datos del formulario

        // Permisos para Usuarios
        $nombre_estado = $this->limpiarCadena( $_POST[ 'nombre_estado' ] );
        $color = $this->limpiarCadena( $_POST[ 'color' ] );

        # Verificación de campos obligatorios #
        if ( $nombre_estado == '' ) {
            // Si algún campo obligatorio está vacío, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'No has llenado todos los campos que son obligatorios',
                'icono' => 'error'
            ];
            return json_encode( $alerta );
            exit();
        }
        if ( $this->verificarDatos( '[a-zA-ZáéíóúÁÉÍÓÚñÑ -]{3,40}', $nombre_estado ) ) {
            // Si el formato del nombre no es válido, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'El nombre no cumple con el formato solicitado',
                'icono' => 'error'
            ];
            return json_encode( $alerta );
            exit();
        }
        // Definición de un array asociativo $user_datos_reg que contiene los datos del rol a registrar
        // Array para almacenar los permisos
        $estado_datos_reg = [
            [
                'campo_nombre' => 'nombre_estado',
                'campo_marcador' => ':nombre_estado',
                'campo_valor' => $nombre_estado =  mb_strtoupper( $nombre_estado, 'UTF-8' )
            ],
            [
                'campo_nombre' => 'color',
                'campo_marcador' => ':color',
                'campo_valor' => $color
            ]
        ];

        // Llamada al método guardarDatos() para guardar los datos del usuario en la base de datos
        $registrar_dts = $this->guardarDatos( 'estado_ot', $estado_datos_reg );

        if ( $registrar_dts->rowCount() == 1 ) {
            $this->registrarLog( $_SESSION[ 'id' ], 'REGISTRO DE ESTADO', 'REGISTRO EXITOSO DEL ESTADO '.$nombre_estado );
            // Si se registró correctamente, se devuelve un mensaje de éxito
            $alerta = [
                'tipo' => 'limpiar',
                'titulo' => 'Estado Registrado',
                'texto' => 'El Estado '.$nombre_estado.' se ha registrado con éxito',
                'icono' => 'success'
            ];

        } else {

            $this->registrarLog( $_SESSION[ 'id' ], 'REGISTRO DE ESTADO', 'REGISTRO FALLIDO DEL ESTADO '.$nombre_estado );

            // Si no se pudo registrar, se devuelve un mensaje de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'El Rol no se pudo registrar correctamente',
                'icono' => 'error'
            ];
        }
        return json_encode( $alerta );
    }

    public function eliminarEstadoControlador() {

        $id = $this->limpiarCadena( $_POST[ 'id_estado' ] );

        # verificar si el rol esta asignado algun usuario
        $datosC = $this->ejecutarConsulta( "SELECT * FROM estado_ot WHERE id_estado='$id'" );
        $datosC = $datosC->fetch();

        $datos = $this->ejecutarConsulta( "SELECT * FROM detalle_orden WHERE status='$id'" );
        if ( $datos->rowCount() > 0 ) {
            $alerta = [
                'tipo' => 'simple',
                'titulo' => '¡Ups! No podemos realizar esta acción.',
                'texto' => 'Este Estado esta asignado a '.$datos->rowCount().' O.T.(s), primero debe reasignarle un nuevo estado a las O.T. asociadas al estado que desea eliminar para poder realizar esta acción.',
                'icono' => 'warning'
            ];
            return json_encode( $alerta );
            exit();
        } else {
            $datos = $datos->fetch();
        }

        $eliminar_reg = $this->eliminarRegistro( 'estado_ot', 'id_estado', $id );

        if ( $eliminar_reg->rowCount() == 1 ) {
            $this->registrarLog( $_SESSION[ 'id' ], 'ELIMINACION DE ESTADO', 'ELIMINACIÓN EXITOSO DEL ESTADO '.$datosC[ 'nombre_estado' ] );
            $alerta = [
                'tipo' => 'recargar',
                'titulo' => 'Estado Eliminado',
                'texto' => 'El Estado '.$datosC[ 'nombre_estado' ].' ha sido eliminado con exito',
                'icono' => 'success'
            ];

        } else {
            $this->registrarLog( $_SESSION[ 'id' ], 'ELIMINACION DE ESTADO', 'ELIMINACIÓN FALLIDA DEL ESTADO '.$datosC[ 'nombre_estado' ] );
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'No se pudo eliminar el Estado, por favor intente nuevamente',
                'icono' => 'error'
            ];

        }
        return json_encode( $alerta );
    }

    public function listarEstadoControlador ( $busqueda ) {

        $busqueda = $this->limpiarCadena( $busqueda );

        $tabla = '';

        if ( isset( $busqueda ) && $busqueda != '' ) {

        } else {
            $consulta_datos = "SELECT * FROM estado_ot ORDER
            BY id_estado";

            $consulta_total = 'SELECT COUNT(id_estado) FROM estado_ot';
        }

        $datos = $this->ejecutarConsulta( $consulta_datos );
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta( $consulta_total );
        $total = ( int ) $total->fetchColumn();

        $tabla .= '
            <div class="table-responsive table-wrapper">
                <table class="table border mb-0 table-info table-hover table-striped table-sm">                
                    <thead class="table-light fw-semibold">
                        <tr class="align-middle">
                            <th class="clearfix">#</th>                            
                            <th class="clearfix">Nombre</th>
                            <th class="">Indicador</th>
                            <th class="text-center" colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
        ';
        $contador = 0;
        if ( $total >= 1 ) {
            $contador = $contador + 1;

            foreach ( $datos as $rows ) {

                $tabla .= '
                    <tr class="align-middle">
                        <td class="clearfix col-p">
                            <div class=""><b>'.$contador.'</b></div>
                        </td>                                               
                       
                        <td class="">
                            <div class="clearfix">
                                <div class=""><b>'.$rows[ 'nombre_estado' ].'</b></div>
                            </div>
                        </td>
                        <td class="col-2">
                            <div>                                
                                <span
                                    style="bottom: 0; display: block; border: 1px solid #fff;
                                     border-radius: 50em; width: 1.7333333333rem; height: 1.7333333333rem; 
                                     background-color:'.$rows[ 'color' ].';" ></span>
                               
                            </div>
                        </td>
                        
                        <td class="col-p">
                        <a href="#" title="Modificar" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventanaModalModificarMiem" data-bs-id="'.$rows[ 'id_estado' ].'">
                        <span class="bi bi-pencil"></span>
                    </a>
                    
                        </td>
                        <td class="col-p">
                            <form class="FormularioAjax" action="'.APP_URL.'app/ajax/configAjax.php" method="POST">
                                <input type="hidden" name="modulo_rol" value="eliminar_estado">
                                <input type="hidden" name="id_estado" value="'.$rows[ 'id_estado' ].'">
                                <button type="submit" class="btn btn-primary" title="Eliminar">
                                    <span class="bi bi-trash"></span>
                                </button>

                            </form>
                        </td>    
                    </tr>
                ';
                $contador++;
            }

        } else {
            if ( $total >= 1 ) {

            } else {
                $tabla .= '
                    <tr class="align-middle">
                        <td class="text-center">
                            No hay registros en el sistema
                        </td>
                    </tr>
                ';
            }
        }
        $tabla .= '</tbody> </table> </div> <label class="form-label">Total registros: <strong>'.$total.'</strong></label>';
        return $tabla;
    }

    public function registrarSitioControlador() {
        // Se obtienen y limpian los datos del formulario

        // Permisos para Usuarios
        $nombre_sitio = $this->limpiarCadena( $_POST[ 'sitio' ] );

        # Verificación de campos obligatorios #
        if ( $nombre_sitio == '' ) {
            // Si algún campo obligatorio está vacío, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'No has llenado todos los campos que son obligatorios',
                'icono' => 'error'
            ];
            return json_encode( $alerta );
            exit();
        }
        if ( $this->verificarDatos( '[a-zA-ZáéíóúÁÉÍÓÚñÑ -]{3,40}', $nombre_sitio ) ) {
            // Si el formato del nombre no es válido, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'El nombre del sitio no cumple con el formato solicitado',
                'icono' => 'error'
            ];
            return json_encode( $alerta );
            exit();
        }
        // Definición de un array asociativo $user_datos_reg que contiene los datos del rol a registrar
        // Array para almacenar los permisos
        $datos_reg = [
            [
                'campo_nombre' => 'nombre_sitio',
                'campo_marcador' => ':nombre_sitio',
                'campo_valor' => $nombre_sitio =  mb_strtoupper( $nombre_sitio, 'UTF-8' )
            ]
        ];

        // Llamada al método guardarDatos() para guardar los datos del usuario en la base de datos
        $registrar_dts = $this->guardarDatos( 'sitio_trabajo', $datos_reg );

        if ( $registrar_dts->rowCount() == 1 ) {
            $this->registrarLog( $_SESSION[ 'id' ], 'REGISTRO DE SITIO', 'REGISTRO EXITOSO DEL SITIO '.$nombre_sitio );
            // Si se registró correctamente, se devuelve un mensaje de éxito
            $alerta = [
                'tipo' => 'limpiar',
                'titulo' => 'Sitio Registrado',
                'texto' => 'El Sitio '.$nombre_sitio.' se ha registrado con éxito',
                'icono' => 'success'
            ];

        } else {
            $this->registrarLog( $_SESSION[ 'id' ], 'REGISTRO DE SITIO', 'REGISTRO FALLIDO DEL SITIO '.$nombre_sitio );
            // Si no se pudo registrar, se devuelve un mensaje de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'El Sitio no se pudo registrar correctamente',
                'icono' => 'error'
            ];
        }
        return json_encode( $alerta );
    }

    public function eliminarSitioControlador() {

        $id = $this->limpiarCadena( $_POST[ 'id_sitio' ] );

        # verificar si el rol esta asignado algun usuario
        $datosC = $this->ejecutarConsulta( "SELECT * FROM sitio_trabajo WHERE id_sitio='$id'" );
        $datosC = $datosC->fetch();

        $datos = $this->ejecutarConsulta( "SELECT * FROM orden_trabajo WHERE sitio_trab='$id'" );
        if ( $datos->rowCount() > 0 ) {
            $alerta = [
                'tipo' => 'simple',
                'titulo' => '¡Ups! No podemos realizar esta acción.',
                'texto' => 'Este Sitio esta asignado a '.$datos->rowCount().' O.T.(s), primero debe reasignarle un nuevo sitio a las O.T. asociadas al sitio que desea eliminar para poder realizar esta acción.',
                'icono' => 'warning'
            ];
            return json_encode( $alerta );
            exit();
        } else {
            $datos = $datos->fetch();
        }

        $eliminar_reg = $this->eliminarRegistro( 'sitio_trabajo', 'id_sitio', $id );

        if ( $eliminar_reg->rowCount() == 1 ) {
            $this->registrarLog( $_SESSION[ 'id' ], 'ELIMINACION DE SITIO', 'ELIMINACIÓN EXITOSO DEL SITIO '.$datosC[ 'nombre_sitio' ] );
            $alerta = [
                'tipo' => 'recargar',
                'titulo' => 'Sitio Eliminado',
                'texto' => 'El sitio '.$datosC[ 'nombre_sitio' ].' ha sido eliminado con exito',
                'icono' => 'success'
            ];

        } else {
            $this->registrarLog( $_SESSION[ 'id' ], 'ELIMINACION DE SITIO', 'ELIMINACIÓN FALLIDA DEL SITIO '.$datosC[ 'nombre_sitio' ] );
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'No se pudo eliminar el Sitio, por favor intente nuevamente',
                'icono' => 'error'
            ];

        }
        return json_encode( $alerta );
    }

    public function listarSitioControlador ( $busqueda ) {

        $busqueda = $this->limpiarCadena( $busqueda );

        $tabla = '';

        if ( isset( $busqueda ) && $busqueda != '' ) {

        } else {
            $consulta_datos = "SELECT * FROM sitio_trabajo ORDER
            BY id_sitio";

            $consulta_total = 'SELECT COUNT(id_sitio) FROM sitio_trabajo';
        }

        $datos = $this->ejecutarConsulta( $consulta_datos );
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta( $consulta_total );
        $total = ( int ) $total->fetchColumn();

        $tabla .= '
        <div class="table-responsive table-wrapper">
                <table class="table border mb-0 table-info table-hover table-sm table-striped">
                    <thead class="table-light fw-semibold">
                        <tr class="align-middle">
                            <th class="clearfix">#</th>                            
                            <th class="clearfix">Nombre</th>
                            <th class="text-center" colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
        ';
        $contador = 0;
        if ( $total >= 1 ) {
            $contador = $contador + 1;
            foreach ( $datos as $rows ) {

                $tabla .= '
                    <tr class="align-middle">
                        <td class="clearfix col-p">
                            <div class=""><b>'.$contador.'</b></div>
                        </td>                                               
                       
                        <td class="">
                            <div class="clearfix">
                                <div class=""><b>'.$rows[ 'nombre_sitio' ].'</b></div>
                            </div>
                        </td>                       
                        
                        <td class="col-p">
                        <a href="#" title="Modificar" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventanaModalModificarMiem" data-bs-id="'.$rows[ 'id_sitio' ].'">
                        <span class="bi bi-pencil"></span>
                    </a>
                    
                        </td>
                        <td class="col-p">
                            <form class="FormularioAjax" action="'.APP_URL.'app/ajax/configAjax.php" method="POST">
                                <input type="hidden" name="modulo_rol" value="eliminar_sitio">
                                <input type="hidden" name="id_sitio" value="'.$rows[ 'id_sitio' ].'">
                                <button type="submit" class="btn btn-primary" title="Eliminar">
                                    <span class="bi bi-trash"></span>
                                </button>
                            </form>
                        </td>    
                    </tr>
                ';
                $contador++;
            }
        } else {
            if ( $total >= 1 ) {

            } else {
                $tabla .= '
                    <tr class="align-middle">
                        <td class="text-center">
                            No hay registros en el sistema
                        </td>
                    </tr>
                ';
            }

        }

        $tabla .= '</tbody> </table> </div> <label class="form-label">Total registros: <strong>'.$total.'</strong></label>';

        return $tabla;
    }

    public function registrarTurnoControlador() {

        // Se obtienen y limpian los datos del formulario

        // Permisos para Usuarios
        $nombre_turno = $this->limpiarCadena( $_POST[ 'turno' ] );

        # Verificación de campos obligatorios #
        if ( $nombre_turno == '' ) {
            // Si algún campo obligatorio está vacío, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'No has llenado todos los campos que son obligatorios',
                'icono' => 'error'
            ];
            return json_encode( $alerta );
            exit();
        }
        if ( $this->verificarDatos( '[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 -]{3,40}', $nombre_turno ) ) {
            // Si el formato del nombre no es válido, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'El nombre del turno no cumple con el formato solicitado',
                'icono' => 'error'
            ];
            return json_encode( $alerta );
            exit();
        }
        // Definición de un array asociativo $user_datos_reg que contiene los datos del rol a registrar
        // Array para almacenar los permisos
        $datos_reg = [
            [
                'campo_nombre' => 'nombre_turno',
                'campo_marcador' => ':nombre_turno',
                'campo_valor' => $nombre_turno =  mb_strtoupper( $nombre_turno, 'UTF-8' )
            ]
        ];

        // Llamada al método guardarDatos() para guardar los datos del usuario en la base de datos
        $registrar_dts = $this->guardarDatos( 'turno_trabajo', $datos_reg );

        if ( $registrar_dts->rowCount() == 1 ) {
            $this->registrarLog( $_SESSION[ 'id' ], 'REGISTRO DE TURNO', 'REGISTRO EXITOSO DEL TURNO '.$nombre_turno );
            // Si se registró correctamente, se devuelve un mensaje de éxito
            $alerta = [
                'tipo' => 'limpiar',
                'titulo' => 'Turno Registrado',
                'texto' => 'El Turno '.$nombre_turno.' se ha registrado con éxito',
                'icono' => 'success'
            ];

        } else {

            $this->registrarLog( $_SESSION[ 'id' ], 'REGISTRO DE TURNO', 'REGISTRO FALLIDO DEL TURNO '.$nombre_turno );

            // Si no se pudo registrar, se devuelve un mensaje de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'El Turno no se pudo registrar correctamente',
                'icono' => 'error'
            ];
        }
        return json_encode( $alerta );
    }

    public function listarTurnoControlador ( $busqueda ) {

        $busqueda = $this->limpiarCadena( $busqueda );

        $tabla = '';

        if ( isset( $busqueda ) && $busqueda != '' ) {

        } else {
            $consulta_datos = "SELECT * FROM turno_trabajo ORDER
            BY id_turno";

            $consulta_total = 'SELECT COUNT(id_turno) FROM turno_trabajo';
        }

        $datos = $this->ejecutarConsulta( $consulta_datos );
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta( $consulta_total );
        $total = ( int ) $total->fetchColumn();

        $tabla .= '
        <div class="table-responsive table-wrapper" id="contenidoCargado">
                <table class="table border mb-0 table-info table-hover table-sm table-striped">
                    <thead class="table-light fw-semibold">
                        <tr class="align-middle">
                            <th class="clearfix">#</th>                            
                            <th class="clearfix">Nombre</th>
                            <th class="text-center" colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
        ';
        $contador = 0;
        if ( $total >= 1 ) {
            $contador = $contador + 1;
            foreach ( $datos as $rows ) {

                $tabla .= '
                    <tr class="align-middle">
                        <td class="clearfix col-p">
                            <div class=""><b>'.$contador.'</b></div>
                        </td>                                               
                       
                        <td class="">
                            <div class="clearfix">
                                <div class=""><b>'.$rows[ 'nombre_turno' ].'</b></div>
                            </div>
                        </td>                       
                        
                        <td class="col-p">
                        <a href="#" title="Modificar" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventanaModalModificarMiem" data-bs-id="'.$rows[ 'id_turno' ].'">
                        <span class="bi bi-pencil"></span>
                    </a>
                    
                        </td>
                        <td class="col-p">
                            <form class="FormularioAjax" action="'.APP_URL.'app/ajax/miembroAjax.php" method="POST">
                                <input type="hidden" name="modulo_miembro" value="eliminar">
                                <input type="hidden" name="miembro_id" value="'.$rows[ 'id_turno' ].'">
                                <button type="submit" class="btn btn-primary" title="Eliminar">
                                    <span class="bi bi-trash"></span>
                                </button>

                            </form>
                        </td>    
                    </tr>
                ';
                $contador++;
            }
        } else {
            if ( $total >= 1 ) {

            } else {
                $tabla .= '
                    <tr class="align-middle">
                        <td class="text-center">
                            No hay registros en el sistema
                        </td>
                    </tr>
                ';
            }

        }

        $tabla .= '</tbody> </table> </div> <label class="form-label">Total registros: <strong>'.$total.'</strong></label>';

        return $tabla;
    }

    private function respuestaCheck( $check ) {
        $resp = '1';
        if ( $check != 'on' ) {
            $resp = '0';
        }
        return $resp;
    }

    private function respuestaCheckOnOff( $check ) {
        $resp = 'checked';
        if ( $check != '1' ) {
            $resp = '';
        }
        return $resp;
    }
}