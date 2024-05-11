<?php

namespace app\controllers;

use app\models\mainModel;

class otController extends mainModel
{

    public function registrarOtControlador()
    {
        #Se obtienen y limpian los datos del formulario
        $area = $this->limpiarCadena($_POST['area']);
        $codigo = $this->limpiarCadena($_POST['codigo']);
        $fecha   = $this->limpiarCadena($_POST['fecha']);
        $nombre = $this->limpiarCadena($_POST['nombre']);
        $semana = $this->limpiarCadena($_POST['semana']);
        $mes   = $this->limpiarCadena($_POST['mes']);
        $sitio = $this->limpiarCadena($_POST['sitio']);

        #variable codigof
        $codigof = '';

        # Verificación de campos obligatorios #
        if ($area == '' || $codigo == '' || $fecha == '' || $nombre == '' || $semana == '' || $mes == 'Seleccionar' || $sitio == 'Seleccionar') {
            // Si algún campo obligatorio está vacío, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'No has llenado todos los campos que son obligatorios',
                'icono' => 'error'
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificar la integridad de los datos de código #
        if ($this->verificarDatos('^[0-9]{1,10}$', $codigo)) {
            #Si el formato del código no es válido, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'El código no cumple con el formato solicitado',
                'icono' => 'error'
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificar la integridad de los datos de nombre #
        if ($this->verificarDatos('[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,60}', $nombre)) {
            #Si el formato del nombre no es válido, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'El nombre de trabajo no cumple con el formato solicitado',
                'icono' => 'error'
            ];
            return json_encode($alerta);
            exit();
        }

        $codigof = $area . $codigo;

        # Verificar el codigo #
        $check_codigo = $this->ejecutarConsulta("SELECT n_ot FROM orden_trabajo WHERE n_ot='$codigof'");
        if ($check_codigo->rowCount() > 0) {
            // Si la Cedula ya existe en la base de datos, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'El codigo ingresado ya existe en los registros',
                'icono' => 'error'
            ];
            return json_encode($alerta);
            exit();
        }

        # Definición de un array asociativo $miembro_datos_reg que contiene los datos del miembro a registrar
        $ot_datos_reg = [
            [
                'campo_nombre' => 'n_ot',
                'campo_marcador' => ':nrot',
                'campo_valor' => $codigof
            ],
            [
                'campo_nombre' => 'id_area',
                'campo_marcador' => ':id_area',
                'campo_valor' => $area
            ],
            [
                'campo_nombre' => 'id_user',
                'campo_marcador' => ':id',
                'campo_valor' => $_SESSION['id']
            ],
            [
                'campo_nombre' => 'nombre_trab',
                'campo_marcador' => ':trabajo',
                'campo_valor' => $nombre =  mb_strtoupper($nombre, 'UTF-8')
            ],
            [
                'campo_nombre' => 'id_sitio',
                'campo_marcador' => ':sitio',
                'campo_valor' => $sitio
            ],
            [
                'campo_nombre' => 'fecha',
                'campo_marcador' => ':fecha',
                'campo_valor' => $fecha
            ],
            [
                'campo_nombre' => 'semana',
                'campo_marcador' => ':semana',
                'campo_valor' => $semana
            ],
            [
                'campo_nombre' => 'mes',
                'campo_marcador' => ':mes',
                'campo_valor' => $mes
            ],
            [
                'campo_nombre' => 'std_reg',
                'campo_marcador' => ':std_reg',
                'campo_valor' => '1'
            ]
        ];

        #Llamada al método guardarDatos() para guardar los datos del miembro en la base de datos
        $registrar_ot = $this->guardarDatos('orden_trabajo', $ot_datos_reg);

        #Verificar si se registró correctamente el miembro
        if ($registrar_ot->rowCount() == 1) {
            $this->registrarLog($_SESSION['id'], 'REGISTRO OT', 'REGISTRO EXITOSO DE PARA LA OT ' . $codigof);
            #Si se registró correctamente, se devuelve un mensaje de éxito
            $alerta = [
                'tipo' => 'limpiar',
                'titulo' => 'Orden Registrada',
                'texto' => 'La orden de trabajo se ha registrado con éxito',
                'icono' => 'success'
            ];
        } else {

            $this->registrarLog($_SESSION['id'], 'REGISTRO OT', 'REGISTRO FALLIDO DE PARA LA OT ' . $codigof);

            #Se devuelve un mensaje de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'La orden de trabajo no se pudo registrar correctamente',
                'icono' => 'error'
            ];
        }

        #Se devuelve el mensaje de alerta en formato JSON
        return json_encode($alerta);
    }

    public function modificarOtControlador()
    {
        #Se obtienen y limpian los datos del formulario
        $id = $this->limpiarCadena($_POST['id']);

        $fecha   = $this->limpiarCadena($_POST['fecha1']);
        $nombre = $this->limpiarCadena($_POST['nombre']);
        $semana = $this->limpiarCadena($_POST['semana1']);
        $mes   = $this->limpiarCadena($_POST['mes1']);
        $sitio = $this->limpiarCadena($_POST['sitio']);

        #variable codigof
        $codigof = '';

        # Verificación de campos obligatorios #
        if ($fecha == '' || $nombre == '' || $semana == '' || $mes == 'Seleccionar' || $sitio == 'Seleccionar') {
            // Si algún campo obligatorio está vacío, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'No has llenado todos los campos que son obligatorios',
                'icono' => 'error'
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificar la integridad de los datos de nombre #
        if ($this->verificarDatos('[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,60}', $nombre)) {
            #Si el formato del nombre no es válido, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'El nombre de trabajo no cumple con el formato solicitado',
                'icono' => 'error'
            ];
            return json_encode($alerta);
            exit();
        }

        # Definición de un array asociativo $miembro_datos_reg que contiene los datos del miembro a registrar
        $ot_datos_reg = [
            [
                'campo_nombre' => 'nombre_trab',
                'campo_marcador' => ':trabajo',
                'campo_valor' => $nombre =  mb_strtoupper($nombre, 'UTF-8')
            ],
            [
                'campo_nombre' => 'id_sitio',
                'campo_marcador' => ':sitio',
                'campo_valor' => $sitio
            ],
            [
                'campo_nombre' => 'fecha',
                'campo_marcador' => ':fecha',
                'campo_valor' => $fecha
            ],
            [
                'campo_nombre' => 'semana',
                'campo_marcador' => ':semana',
                'campo_valor' => $semana
            ],
            [
                'campo_nombre' => 'mes',
                'campo_marcador' => ':mes',
                'campo_valor' => $mes
            ]
        ];
        $condicion = [
            'condicion_campo' => 'n_ot',
            'condicion_marcador' => ':ID',
            'condicion_valor' => $id
        ];

        if ($this->actualizarDatos('orden_trabajo', $ot_datos_reg, $condicion)) {
            $this->registrarLog($_SESSION['id'], 'MODIFICAR OT', 'MODIFICACION EXITOSA DE PARA LA OT ' . $id);
            $alerta = [
                'tipo' => 'limpiar',
                'titulo' => 'Datos Actualizados',
                'texto' => 'Se actualizo correctamente',
                'icono' => 'success'
            ];
        } else {
            $this->registrarLog($_SESSION['id'], 'MODIFICAR OT', 'MODIFICACION FALLIDA DE PARA LA OT ' . $id);
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => '¡Ha ocurrido un error durante el registro!',
                'icono' => 'error'
            ];
        }
        return json_encode($alerta);
    }

    public function registrarDetalleOtControlador()
    {
        #Se obtienen y limpian los datos del formulario
        $id = $this->limpiarCadena($_POST['id']);
        $cant = $this->limpiarCadena($_POST['cant']);
        $turno   = $this->limpiarCadena($_POST['turno']);
        $status = $this->limpiarCadena($_POST['status']);
        $cco = $this->limpiarCadena($_POST['cco']);
        $ccf   = $this->limpiarCadena($_POST['ccf']);
        $tecnico = $this->limpiarCadena($_POST['tec']);
        $prep_ini = $this->limpiarCadena($_POST['prep_ini']);
        $prep_fin = $this->limpiarCadena($_POST['prep_fin']);
        $tras_ini = $this->limpiarCadena($_POST['tras_ini']);
        $tras_fin = $this->limpiarCadena($_POST['tras_fin']);
        $ejec_ini = $this->limpiarCadena($_POST['ejec_ini']);
        $ejec_fin = $this->limpiarCadena($_POST['ejec_fin']);
        $observacion = $this->limpiarCadena($_POST['observacion']);
        # Verificación de campos obligatorios #
        if ($id == '' || $cant == 0 || $turno == 'Seleccionar' || $status == 'Seleccionar' || $cco == 'Seleccionar' || $ccf == 'Seleccionar' || $tecnico == 'Seleccionar' || $prep_ini == '' || $prep_fin == '' || $tras_ini == '' || $tras_fin == '' || $ejec_ini == '' || $ejec_fin == '') {
            // Si algún campo obligatorio está vacío, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'No has llenado todos los campos que son obligatorios',
                'icono' => 'error'
            ];
            return json_encode($alerta);
            exit();
        }

        # Definición de un array asociativo $miembro_datos_reg que contiene los datos del miembro a registrar
        $ot_datos_reg = [
            [
                'campo_nombre' => 'n_ot',
                'campo_marcador' => ':nrot',
                'campo_valor' => $id
            ],
            [
                'campo_nombre' => 'cant_tec',
                'campo_marcador' => ':cant',
                'campo_valor' => $cant
            ],
            [
                'campo_nombre' => 'id_turno',
                'campo_marcador' => ':id_turno',
                'campo_valor' => $turno
            ],
            [
                'campo_nombre' => 'id_miembro_cco ',
                'campo_marcador' => ':cco',
                'campo_valor' => $cco
            ],
            [
                'campo_nombre' => 'id_user_act',
                'campo_marcador' => ':responsable',
                'campo_valor' => $tecnico
            ],
            [
                'campo_nombre' => 'id_miembro_ccf ',
                'campo_marcador' => ':ccf',
                'campo_valor' => $ccf
            ],
            [
                'campo_nombre' => '	hora_ini_pre',
                'campo_marcador' => ':horapreini',
                'campo_valor' => $prep_ini
            ], [
                'campo_nombre' => '	hora_fin_pre',
                'campo_marcador' => ':horaprefin',
                'campo_valor' => $prep_fin
            ],
            [
                'campo_nombre' => 'hora_ini_tra',
                'campo_marcador' => ':horatraini',
                'campo_valor' => $tras_ini
            ],
            [
                'campo_nombre' => 'hora_fin_tra',
                'campo_marcador' => ':horatrafin',
                'campo_valor' => $tras_fin
            ],
            [
                'campo_nombre' => 'hora_ini_eje',
                'campo_marcador' => ':horainieje',
                'campo_valor' => $ejec_ini
            ], [
                'campo_nombre' => 'hora_fin_eje',
                'campo_marcador' => ':horafineje',
                'campo_valor' => $ejec_fin
            ], [
                'campo_nombre' => 'id_estado',
                'campo_marcador' => ':id_estado',
                'campo_valor' => $status
            ], [
                'campo_nombre' => 'observacion',
                'campo_marcador' => ':observacion',
                'campo_valor' => $observacion
            ]
        ];

        #Llamada al método guardarDatos() para guardar los datos del miembro en la base de datos
        $registrar_ot = $this->guardarDatos('detalle_orden', $ot_datos_reg);

        #Verificar si se registró correctamente el miembro
        if ($registrar_ot->rowCount() == 1) {
            $this->registrarLog($_SESSION['id'], 'REGISTRO DETALLES OT', 'REGISTRO EXITOSO DE PARA LA OT ' . $id);
            #Si se registró correctamente, se devuelve un mensaje de éxito
            $alerta = [
                'tipo' => 'limpiar',
                'titulo' => 'Detalles Registrados',
                'texto' => 'Los detalles de la orden de trabajo se ha registrado con éxito',
                'icono' => 'success'
            ];
        } else {

            $this->registrarLog($_SESSION['id'], 'REGISTRO DETALLES OT', 'REGISTRO FALLIDO DE PARA LA OT ' . $id);

            #Se devuelve un mensaje de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'Los detalles de la orden de trabajo no han podido registrarse',
                'icono' => 'error'
            ];
        }

        #Se devuelve el mensaje de alerta en formato JSON
        return json_encode($alerta);
    }

    public function modificarDetalleOtControlador()
    {
        #Se obtienen y limpian los datos del formulario
        $id = $this->limpiarCadena($_POST['id']);
        $cant = $this->limpiarCadena($_POST['cant']);
        $turno   = $this->limpiarCadena($_POST['turno']);
        $status = $this->limpiarCadena($_POST['status']);
        $cco = $this->limpiarCadena($_POST['cco']);
        $ccf   = $this->limpiarCadena($_POST['ccf']);
        $tecnico = $this->limpiarCadena($_POST['tec']);
        $prep_ini = $this->limpiarCadena($_POST['prep_ini']);
        $prep_fin = $this->limpiarCadena($_POST['prep_fin']);
        $tras_ini = $this->limpiarCadena($_POST['tras_ini']);
        $tras_fin = $this->limpiarCadena($_POST['tras_fin']);
        $ejec_ini = $this->limpiarCadena($_POST['ejec_ini']);
        $ejec_fin = $this->limpiarCadena($_POST['ejec_fin']);
        $observacion = $this->limpiarCadena($_POST['observacion']);

        # Verificación de campos obligatorios #
        if ($id == '' || $cant <= 0 || $turno == 'Seleccionar' || $status == 'Seleccionar' || $cco == 'Seleccionar' || $ccf == 'Seleccionar' || $tecnico == 'Seleccionar' || $prep_ini == '' || $prep_fin == '' || $tras_ini == '' || $tras_fin == '' || $ejec_ini == '' || $ejec_fin == '') {
            // Si algún campo obligatorio está vacío, se devuelve una alerta de error
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'No has llenado todos los campos que son obligatorios',
                'icono' => 'error'
            ];
            return json_encode($alerta);
            exit();
        }

        # Definición de un array asociativo $miembro_datos_reg que contiene los datos del miembro a registrar
        $ot_datos_reg = [
            [
                'campo_nombre' => 'cant_tec',
                'campo_marcador' => ':cant',
                'campo_valor' => $cant
            ],
            [
                'campo_nombre' => 'id_turno',
                'campo_marcador' => ':id_turno',
                'campo_valor' => $turno
            ],
            [
                'campo_nombre' => 'id_miembro_cco ',
                'campo_marcador' => ':cco',
                'campo_valor' => $cco
            ],
            [
                'campo_nombre' => 'id_user_act',
                'campo_marcador' => ':responsable',
                'campo_valor' => $tecnico
            ],
            [
                'campo_nombre' => 'id_miembro_ccf ',
                'campo_marcador' => ':ccf',
                'campo_valor' => $ccf
            ],
            [
                'campo_nombre' => '	hora_ini_pre',
                'campo_marcador' => ':horapreini',
                'campo_valor' => $prep_ini
            ], [
                'campo_nombre' => '	hora_fin_pre',
                'campo_marcador' => ':horaprefin',
                'campo_valor' => $prep_fin
            ],
            [
                'campo_nombre' => 'hora_ini_tra',
                'campo_marcador' => ':horatraini',
                'campo_valor' => $tras_ini
            ],
            [
                'campo_nombre' => 'hora_fin_tra',
                'campo_marcador' => ':horatrafin',
                'campo_valor' => $tras_fin
            ],
            [
                'campo_nombre' => 'hora_ini_eje',
                'campo_marcador' => ':horainieje',
                'campo_valor' => $ejec_ini
            ], [
                'campo_nombre' => 'hora_fin_eje',
                'campo_marcador' => ':horafineje',
                'campo_valor' => $ejec_fin
            ], [
                'campo_nombre' => 'id_estado',
                'campo_marcador' => ':id_estado',
                'campo_valor' => $status
            ], [
                'campo_nombre' => 'observacion',
                'campo_marcador' => ':observacion',
                'campo_valor' => $observacion
            ]
        ];

        $condicion = [
            'condicion_campo' => 'n_ot',
            'condicion_marcador' => ':ID',
            'condicion_valor' => $id
        ];

        if ($this->actualizarDatos('detalle_orden', $ot_datos_reg, $condicion)) {
            $this->registrarLog($_SESSION['id'], 'MODIFICAR DETALLES OT', 'MODIFICACION EXITOSA DE PARA LA OT ' . $id);
            $alerta = [
                'tipo' => 'limpiar',
                'titulo' => 'Datos Actualizados',
                'texto' => 'Se actualizo correctamente',
                'icono' => 'success'
            ];
        } else {
            $this->registrarLog($_SESSION['id'], 'MODIFICAR DETALLES OT', 'MODIFICACION FALLIDA DE PARA LA OT ' . $id);
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => '¡Ha ocurrido un error durante el registro!',
                'icono' => 'error'
            ];
        }
        return json_encode($alerta);
    }

    public function listarOtControlador()
    {
        $tabla = '';
        $consulta_datos = "SELECT ot.*, det_ord.id_estado, estado.nombre_estado, estado.color
            FROM orden_trabajo ot
            LEFT JOIN detalle_orden det_ord ON ot.n_ot = det_ord.n_ot
            LEFT JOIN estado_ot estado ON det_ord.id_estado = estado.id_estado
            WHERE ot.std_reg = '1' ORDER BY ot.n_ot ASC ";

        $consulta_total = "SELECT COUNT(ot.n_ot) FROM orden_trabajo ot
            LEFT JOIN detalle_orden det_ord ON ot.n_ot = det_ord.n_ot
            LEFT JOIN estado_ot estado ON det_ord.id_estado = estado.id_estado
            WHERE ot.std_reg = '1'";


        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta($consulta_total);
        $total = (int) $total->fetchColumn();

        $tabla .= '
                    <div class="table-responsive table-wrapper3" id="tabla-ot">
                        <table class="table border mb-0 table-hover table-sm table-striped" id="tablaDatosOt">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="clearfix">#</th>                                
                                <th class="clearfix">Estado O.T.</th>
                                <th class="clearfix">Fecha</th>
                                <th class="clearfix">Codigo</th>
                                <th class="clearfix">Nombre Trabajo</th>
                                <th class="text-center col-auto" colspan="6">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
            ';
        if ($total >= 1) {
            $contador =  1;
            foreach ($datos as $rows) {

                $tabla .= '
                        <tr class="align-middle">
                            <td class="clearfix col-auto">
                                <div class=""><b>' . $contador . '</b></div>
                            </td>
                            <td class="clearfix col-pE">
                                <div class="avatar avatar-md" title="' . $this->estado($rows['nombre_estado']) . '"><img class="avatar-img"
                                    src="' . APP_URL . 'app/views/icons/ot.png"><span
                                    style="position: absolute; bottom: 0; display: block; border: 1px solid #fff;
                                     border-radius: 50em; width: 0.7333333333rem; height: 0.7333333333rem; right: 0; 
                                     background-color: ' . $this->color($rows['color']) . ';" ></span>
                                </div>
                                <b>' . $this->estado($rows['nombre_estado']) . '</b>
                            </td>
                            <td class="col-p6">
                                <div class="clearfix">
                                    <div class=""><b>' . $this->ordenarFecha($rows['fecha']) . '</b></div>
                                </div>
                            </td>                           
                            <td class="col-p6">
                                <div class="clearfix">
                                    <div class=""><b>' . $rows['n_ot'] . '</b></div>
                                </div>
                            </td>
                            <td class="">
                                <div class="clearfix">
                                    <div class=""><b>' . $rows['nombre_trab'] . '</b></div>
                                </div>
                            </td>                                     
                            <td class="col-p">
                                <button type="button" title="Ver" class="btn btn-primary">
                                    <i class="bi bi-eye"></i>
                                </button>                       
                            </td>
                            <td class="col-p">
                                <button type="button" title="Generar Reporte" class="btn btn-primary">
                                    <i class="bi bi-file-earmark-text"></i>
                                </button>                       
                            </td>
                            <td class="col-p">
                                <a href="#" title="Detalles Orden" id="detalleot" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventanaModalDetalleOt" data-bs-id="' . $rows['n_ot'] . '">
                                    <i class="bi bi-card-list"></i>
                                </a> 
                            </td>
                            <td class="col-p">
                                <a href="#" title="Agregar Herramienta" id="herramientaOt" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModificarHerrOt" data-bs-id="' . $rows['n_ot'] . '">
                                    <i class="bi bi-tools"></i>
                                </a> 
                            </td>
                            <td class="col-p">
                                <a href="#" title="Modificar O.T." class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventanaModalModificarOt" data-bs-id="' . $rows['n_ot'] . '">
                                    <i class="bi bi-pencil"></i>
                                </a> 
                            </td>
                            <td class="col-p">
                                <form class="FormularioAjax" action="' . APP_URL . 'app/ajax/otAjax.php" method="POST">
                                    <input type="hidden" name="modulo_ot" value="eliminar">
                                    <input type="hidden" name="miembro_id" value="' . $rows['n_ot'] . '">
                                    <button type="submit" class="btn btn-primary" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button> 
                                </form>
                            </td>                                
                        </tr>
                    ';
                $contador++;
            }
            $pag_final = $contador - 1;
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
    /**
     * Genera un combo de opciones de miembros según el tipo especificado.
     *
     * @param int $tipo El tipo de miembro para el cual se generará el combo.
     * @return string El HTML del combo de opciones.
     */

    private function estado($estado)
    {
        $std = 'SIN DETALLE';
        if ($estado != '') {
            $std = $estado;
        }
        return $std;
    }

    private function color($estado)
    {
        $std = '';
        if ($estado != '') {
            $std = $estado;
        }
        return $std;
    }

    public function listarComboOtControlador($tipo)
    {

        // Variable para almacenar el HTML del combo
        $combo = '';

        // Consulta para obtener los datos de los miembros según el tipo especificado
        $consulta_datos = "SELECT * FROM miembro WHERE tipo_miembro = $tipo";

        // Ejecutar la consulta para obtener los datos de los miembros
        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        // Comprobar el tipo de miembro para determinar la etiqueta del combo
        if ($tipo == 1) {
            // Si el tipo es 1, el combo es para el responsable de control de falla
            $combo .= '
                    <label class="form-label">RESP. CCF:</label>
                    <select class="form-select" id="ccf" name="ccf" aria-label="Default select example">
                        <option selected>Seleccionar</option>
                ';
        } else {
            // Si el tipo no es 1, el combo es para el responsable de control de operaciones
            $combo .= '
                    <label class="form-label">RESP. CCO:</label>
                    <select class="form-select" id="cco" name="cco" aria-label="Default select example">
                        <option selected>Seleccionar</option>
                ';
        }

        // Comprobar si hay miembros disponibles para mostrar en el combo
        if (count($datos) > 0) {

            // Si hay miembros disponibles, iterar sobre ellos y agregar opciones al combo
            foreach ($datos as $rows) {
                $combo .= '
                        <option value="' . $rows['id_miembro'] . '">' . $rows['nombre_miembro'] . '</option>
                    ';
            }
        }

        // Cerrar el combo y devolver el HTML generado
        $combo .= '</select>';

        return $combo;
    }

    public function listarComboTecControlador()
    {

        // Variable para almacenar el HTML del combo
        $combo = '';

        // Consulta para obtener los datos de los miembros según el tipo especificado
        $consulta_datos = 'SELECT * FROM user_system WHERE std_reg=1';

        // Ejecutar la consulta para obtener los datos de los miembros
        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        // Comprobar el tipo de miembro para determinar la etiqueta del combo

        // Si el tipo no es 1, el combo es para el responsable de control de operaciones
        $combo .= '
                <label class="form-label">Tecnico Resp.:</label>
                <select class="form-select" id="tec" name="tec" aria-label="Default select example">
                    <option selected>Seleccionar</option>
            ';

        // Comprobar si hay miembros disponibles para mostrar en el combo
        if (count($datos) > 0) {

            // Si hay miembros disponibles, iterar sobre ellos y agregar opciones al combo
            foreach ($datos as $rows) {
                $combo .= '
                        <option value="' . $rows['id_user'] . '">' . $rows['user'] . '</option>
                    ';
            }
        }

        // Cerrar el combo y devolver el HTML generado
        $combo .= '</select>';

        return $combo;
    }

    public function listarComboTurnoControlador()
    {

        // Variable para almacenar el HTML del combo
        $combo = '';

        // Consulta para obtener los datos de los miembros según el tipo especificado
        $consulta_datos = 'SELECT * FROM turno_trabajo';

        // Ejecutar la consulta para obtener los datos de los miembros
        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        // Comprobar el tipo de miembro para determinar la etiqueta del combo

        // Si el tipo no es 1, el combo es para el responsable de control de operaciones
        $combo .= '
                <label class="form-label">Turno:</label>
                <select class="form-select" id="turno" name="turno" aria-label="Default select example">
                <option selected>Seleccionar</option>
            ';

        // Comprobar si hay miembros disponibles para mostrar en el combo
        if (count($datos) > 0) {

            // Si hay miembros disponibles, iterar sobre ellos y agregar opciones al combo
            foreach ($datos as $rows) {
                $combo .= '
                        <option value="' . $rows['id_turno'] . '">' . $rows['nombre_turno'] . '</option>
                    ';
            }
        }

        // Cerrar el combo y devolver el HTML generado
        $combo .= '</select>';

        return $combo;
    }

    public function listarComboEstadoControlador()
    {

        // Variable para almacenar el HTML del combo
        $combo = '';

        // Consulta para obtener los datos de los miembros según el tipo especificado
        $consulta_datos = 'SELECT * FROM estado_ot';

        // Ejecutar la consulta para obtener los datos de los miembros
        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        // Comprobar el tipo de miembro para determinar la etiqueta del combo

        // Si el tipo no es 1, el combo es para el responsable de control de operaciones
        $combo .= '                
                <select class="form-select" id="status" name="status" aria-label="Default select example">
                    <option selected>Seleccionar</option>
            ';

        // Comprobar si hay miembros disponibles para mostrar en el combo
        if (count($datos) > 0) {

            // Si hay miembros disponibles, iterar sobre ellos y agregar opciones al combo
            foreach ($datos as $rows) {
                $combo .= '
                        <option value="' . $rows['id_estado'] . '" >' . $rows['nombre_estado'] . '</option>
                    ';
            }
        }

        // Cerrar el combo y devolver el HTML generado
        $combo .= '</select>';

        return $combo;
    }

    public function listarComboAreaControlador()
    {

        // Variable para almacenar el HTML del combo
        $combo = '';

        // Consulta para obtener los datos de los miembros según el tipo especificado
        $consulta_datos = 'SELECT * FROM area_trabajo';

        // Ejecutar la consulta para obtener los datos de los miembros
        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        // Comprobar el tipo de miembro para determinar la etiqueta del combo

        // Si el tipo no es 1, el combo es para el responsable de control de operaciones
        $combo .= '
        <label class="form-label"><b>SELECCIONE AREA:</b></label>
        <select class="form-select" id="area" name="area" aria-label="Default select example">
        <option selected>Seleccionar</option>
            ';

        // Comprobar si hay miembros disponibles para mostrar en el combo
        if (count($datos) > 0) {

            // Si hay miembros disponibles, iterar sobre ellos y agregar opciones al combo
            foreach ($datos as $rows) {
                $combo .= '
                        <option value="' . $rows['nomeclatura'] . '">' . $rows['nombre_area'] . '</option>
                    ';
            }
        }

        // Cerrar el combo y devolver el HTML generado
        $combo .= '</select>';

        return $combo;
    }

    public function listarComboSitioControlador()
    {

        // Variable para almacenar el HTML del combo
        $combo = '';

        // Consulta para obtener los datos de los miembros según el tipo especificado
        $consulta_datos = 'SELECT * FROM sitio_trabajo';

        // Ejecutar la consulta para obtener los datos de los miembros
        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        // Comprobar el tipo de miembro para determinar la etiqueta del combo

        // Si el tipo no es 1, el combo es para el responsable de control de operaciones
        $combo .= '
        <label class="form-label">Sitio de Trabajo:</label>
        <select class="form-select" id="sitio" name="sitio" aria-label="Default select example">
                    <option selected>Seleccionar</option>
            ';

        // Comprobar si hay miembros disponibles para mostrar en el combo
        if (count($datos) > 0) {

            // Si hay miembros disponibles, iterar sobre ellos y agregar opciones al combo
            foreach ($datos as $rows) {
                $combo .= '
                        <option value="' . $rows['id_sitio'] . '">' . $rows['nombre_sitio'] . '</option>
                    ';
            }
        }

        // Cerrar el combo y devolver el HTML generado
        $combo .= '</select>';

        return $combo;
    }

    public function listarComboUserControlador()
    {

        // Variable para almacenar el HTML del combo
        $combo = '';

        // Consulta para obtener los datos de los miembros según el tipo especificado
        $consulta_datos = 'SELECT * FROM user_system WHERE std_reg=1';

        // Ejecutar la consulta para obtener los datos de los miembros
        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        // Comprobar el tipo de miembro para determinar la etiqueta del combo
        // Si el tipo es 1, el combo es para el responsable de control de falla
        $combo .= '
                <select class="form-select" id="user" name="user" aria-label="Default select example">
                    <option selected>Seleccionar</option>
            ';

        // Comprobar si hay miembros disponibles para mostrar en el combo
        if (count($datos) > 0) {

            // Si hay miembros disponibles, iterar sobre ellos y agregar opciones al combo
            foreach ($datos as $rows) {
                $combo .= '
                        <option value="' . $rows['id_user'] . '">' . $rows['id_user'] . ' - ' . $rows['user'] . '</option>
                    ';
            }
        }

        // Cerrar el combo y devolver el HTML generado
        $combo .= '</select>';

        return $combo;
    }

    public function eliminarOtControlador()
    {

        $id = $this->limpiarCadena($_POST['miembro_id']);

        if ($id == 1) {
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'No podemos eliminar este usuario',
                'icono' => 'error'
            ];
            return json_encode($alerta);
            exit();
        }
        # verificar el usuario
        $datos = $this->ejecutarConsulta("SELECT * FROM miembro WHERE n_ot='$id'");
        if ($datos->rowCount() <= 0) {
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'No hemos encontrado el usuario en el sistema',
                'icono' => 'error'
            ];
            return json_encode($alerta);
            exit();
        } else {
            $datos = $datos->fetch();
        }

        $eliminarUsuario = $this->eliminarRegistro('miembro', 'n_ot', $id);

        if ($eliminarUsuario->rowCount() == 1) {
            $alerta = [
                'tipo' => 'recargar',
                'titulo' => 'Miembro Eliminado',
                'texto' => 'El Miembro ' . $datos['nombre_trab'] . ' ha sido eliminado con exito',
                'icono' => 'success'
            ];
        } else {
            $alerta = [
                'tipo' => 'simple',
                'titulo' => 'Ocurrió un error inesperado',
                'texto' => 'No se pudo eliminar el Miembro, por favor intente nuevamente',
                'icono' => 'error'
            ];
        }
        return json_encode($alerta);
    }
}
