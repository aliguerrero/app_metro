<?php

namespace app\controllers;

use app\models\mainModel;

class mainController extends mainModel
{

    # controlador listar actividades #

    public function listarActividadesControlador(){
        $tabla = '';
        if ($_SESSION['tipo'] == 1) {
            $consulta_datos = "SELECT 
                u.user AS nombre_usuario,
                ROUND(((SELECT COUNT(*) FROM log_user WHERE id_user = u.id_user) / (SELECT COUNT(*) FROM log_user)) * 100, 2) AS porcentaje_participacion,
                MIN(l.fecha_hora) AS primera_fecha_registro,
                MAX(l.fecha_hora) AS ultima_fecha_registro
                FROM 
                    log_user l
                JOIN 
                    user_system u ON l.id_user = u.id_user
                GROUP BY
                    u.user;
                ";
            $consulta_total = "SELECT COUNT(l.id_user) FROM 
                log_user l
                JOIN 
                    user_system u ON l.id_user = u.id_user
                GROUP BY
                    u.user;";
        } else {
            $consulta_datos = "SELECT 
                u.user AS nombre_usuario,
                ROUND(((SELECT COUNT(*) FROM log_user WHERE id_user = '" . $_SESSION['id'] . "') / (SELECT COUNT(*) FROM log_user)) * 100, 2) AS porcentaje_participacion,
                MIN(l.fecha_hora) AS primera_fecha_registro,
                MAX(l.fecha_hora) AS ultima_fecha_registro
                FROM 
                    log_user l
                JOIN 
                    user_system u ON l.id_user = u.id_user
                WHERE 
                l.id_user = '" . $_SESSION['id'] . "';";

            $consulta_total = "SELECT COUNT(l.id_user) FROM 
                log_user l
                JOIN 
                    user_system u ON l.id_user = u.id_user
                WHERE 
                l.id_user = '" . $_SESSION['id'] . "';";
        }

        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta($consulta_total);
        $total = (int) $total->fetchColumn();


        $tabla .= '
            <div class="table-responsive">
                <table class="table border mb-0 table-sm table-hover table-sm table-striped">
                    <thead class="table-light fw-semibold">
                        <tr class="align-middle">
                            <th class="text-center">
                                <svg class="icon">
                                    <use
                                        xlink:href="' . APP_URL . 'app/views/icons/svg/free.svg#cil-people">
                                    </use>
                                </svg>
                            </th>
                                <th>Usuario</th>
                                <th>% Interacción Sistema</th>
                                <th>Ultima Actividad</th>
                            </tr>
                    </thead>
                    <tbody>
        ';
        $contador = 0;
        if ($total >= 1) {
            $contador = $contador + 1;
            foreach ($datos as $rows) {
                $tabla .= '
                    <tr class="align-middle">
                        <td class="text-center">
                            <div class="avatar avatar-md">
                                <img class="avatar-img" src="' . APP_URL . 'app/views/img/avatars/user.png" alt="user@email.com">                                
                            </div>
                        </td>
                        <td>
                            <div>' . $rows['nombre_usuario'] . '</div>                            
                        </td>
                        <td>
                            <div class="clearfix">
                                <div class="float-start">
                                    <div class="fw-semibold">' . $rows['porcentaje_participacion'] . '%</div>
                                </div>
                                <div class="float-end">
                                    <small class="text-medium-emphasis">' . $rows['primera_fecha_registro'] . ' - ' . $rows['ultima_fecha_registro'] . '</small>
                                </div>
                            </div>
                            <div class="progress progress-thin">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: ' . $rows['porcentaje_participacion'] . '%" aria-valuenow="' . $rows['porcentaje_participacion'] . '" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small text-medium-emphasis">Ultimo inicio de sesion</div>
                            <div class="fw-semibold">' . $rows['ultima_fecha_registro'] . '</div>
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

        $tabla .= '</tbody></table></div>';

        return $tabla;
    }

    public function listarCardEstadoControlador(){
        $tabla = '';
        
        $consulta_datos = "SELECT 
            e.nombre_estado, 
            COUNT(ot.id_estado) AS total_registros,
                ROUND((COUNT(ot.id_estado) * 100.0) / SUM(COUNT(ot.id_estado)) OVER (), 2) AS porcentaje_total
            FROM 
                detalle_orden ot
            JOIN 
                estado_ot e ON ot.id_estado = e.id_estado
            GROUP BY 
            ot.id_estado, e.nombre_estado;
        ";

        $consulta_total = "SELECT COUNT(ot.id_estado) FROM 
                detalle_orden ot
            JOIN 
                estado_ot e ON ot.id_estado = e.id_estado
            GROUP BY 
            ot.id_estado, e.nombre_estado;"
        ;
        

        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta($consulta_total);
        $total = (int) $total->fetchColumn();


        $contador = 0;
        if ($total >= 1) {
            $contador = $contador + 1;
            foreach ($datos as $rows) {
                $tabla .= '
                <div class="col mb-sm-2 mb-0">
                    <div class="text-medium-emphasis">' . $rows['nombre_estado'] . '</div>
                        <div class="fw-semibold">Total O.T. = ' . $rows['total_registros'] . ' (' . $rows['porcentaje_total'] . '%)</div>
                        <div class="progress progress-thin mt-2">
                        <div class="progress-bar bg-success" role="progressbar" style="width: ' . $rows['porcentaje_total'] . '%" aria-valuenow="' . $rows['porcentaje_total'] . '" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                ';
                $contador++;
            }
        } else {
            $tabla .= '
            <div class="col mb-sm-2 mb-0">
                <div class="text-medium-emphasis">Sin detalles registrados</div>
                    <div class="fw-semibold">Total 0 (0%)</div>
                    <div class="progress progress-thin mt-2">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            ';
        }
        return $tabla;
    }

    public function listarCardTurnoControlador(){
        $tabla = '';
        
        $consulta_datos = "SELECT 
            e.nombre_turno, 
            COUNT(ot.id_turno) AS total_registros,
                ROUND((COUNT(ot.id_turno) * 100.0) / SUM(COUNT(ot.id_turno)) OVER (), 2) AS porcentaje_total
            FROM 
                detalle_orden ot
            JOIN 
                turno_trabajo e ON ot.id_turno = e.id_turno
            GROUP BY 
            ot.id_turno, e.nombre_turno;
        ";

        $consulta_total = "SELECT COUNT(ot.id_estado) FROM 
                detalle_orden ot
            JOIN 
                turno_trabajo e ON ot.id_turno = e.id_turno
            GROUP BY 
            ot.id_turno, e.nombre_turno;"
        ;
        

        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta($consulta_total);
        $total = (int) $total->fetchColumn();


        $contador = 0;
        if ($total >= 1) {
            $contador = $contador + 1;
            foreach ($datos as $rows) {
                $tabla .= '
                <div class="col mb-sm-2 mb-0">
                    <div class="text-medium-emphasis">' . $rows['nombre_turno'] . '</div>
                        <div class="fw-semibold">Total O.T. = ' . $rows['total_registros'] . ' (' . $rows['porcentaje_total'] . '%)</div>
                        <div class="progress progress-thin mt-2">
                        <div class="progress-bar bg-success" role="progressbar" style="width: ' . $rows['porcentaje_total'] . '%" aria-valuenow="' . $rows['porcentaje_total'] . '" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                ';
                $contador++;
            }
        } else {
            $tabla .= '
            <div class="col mb-sm-2 mb-0">
                <div class="text-medium-emphasis">Sin detalles registrados</div>
                    <div class="fw-semibold">Total 0 (0%)</div>
                    <div class="progress progress-thin mt-2">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            ';
        }
        return $tabla;
    }
}
