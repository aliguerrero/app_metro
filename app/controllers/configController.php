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

        // Definición de un array asociativo $user_datos_reg que contiene los datos del rol a registrar
        // Array para almacenar los permisos
        $rol_datos_reg = [
            [
                'campo_nombre' => 'nombre_rol',
                'campo_marcador' => ':nombre_rol',
                'campo_valor' => $rol_name =  mb_strtoupper($rol_name, 'UTF-8')
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
        $registrar_user = $this->guardarDatos( 'roles_permisos', $rol_datos_reg );

        if ( $registrar_user->rowCount() == 1 ) {
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
                <select class="form-select" id="opciones" name="rol" aria-label="Default select example">
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
    
}