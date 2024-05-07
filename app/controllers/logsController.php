<?php

namespace app\controllers;

use app\models\mainModel;

class logsController extends mainModel
{
    public function listarLogsControlador()
    {
        $tabla = '';


        $consulta_datos = "SELECT log.*, user.user AS nombre_usuario
        FROM log_user AS log
        JOIN user_system AS user ON log.id_user = user.id_user";

        $consulta_total = "SELECT COUNT(*) FROM log_user AS log
        JOIN user_system AS user ON log.id_user = user.id_user";


        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta($consulta_total);
        $total = (int) $total->fetchColumn();

        $tabla .= '
                    <div class="table-responsive table-wrapper2">
                        <table class="table border mb-0 table-hover table-sm table-striped">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="clearfix">#</th>
                                <th class="clearfix">Nombre usuario</th>
                                <th class="clearfix">Acción</th>
                                <th class="clearfix">Respuesta</th>
                                <th class="clearfix">Fecha / Hora</th>
                                <th class="text-center col-auto">Acciones</th>
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
                            <td class="clearfix col-p">
                                <div class=""><b>' . $contador . '</b></div>
                            </td>
                            <td class="clearfix col-auto">
                                <div class="clearfix">
                                    <div class=""><b>' . $rows['nombre_usuario'] . '</b></div>
                                </div>
                            </td>                            
                            <td class="col-2">
                                <div class="clearfix">
                                    <div class=""><b>' . $rows['accion'] . '</b></div>
                                </div>
                            </td>
                            <td class="col-auto">
                                <div class="clearfix">
                                    <div class=""><b>' . $rows['resp_system'] . '</b></div>
                                </div>
                            </td>
                            <td class="col-2">
                                <div class="clearfix">
                                    <div class=""><b>' . $rows['fecha_hora'] . '</b></div>
                                </div>
                            </td>                                     
                            <td class="col-p">
                                <button type="button" title="Ver" class="btn btn-primary">
                                    <i class="bi bi-eye"></i>
                                </button>                       
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

    public function listarComboAccionControlador()
    {

        // Variable para almacenar el HTML del combo
        $combo = '';

        // Consulta para obtener los datos de los miembros según el tipo especificado
        $consulta_datos = 'SELECT accion, COUNT(*) AS cantidad
        FROM log_user
        GROUP BY accion;';

        // Ejecutar la consulta para obtener los datos de los miembros
        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        // Comprobar el tipo de miembro para determinar la etiqueta del combo
        // Si el tipo es 1, el combo es para el responsable de control de falla
        $combo .= '
                <select class="form-select" id="user" name="user" aria-label="Default select example">
                    <option selected>TODAS</option>
            ';

        // Comprobar si hay miembros disponibles para mostrar en el combo
        if (count($datos) > 0) {

            // Si hay miembros disponibles, iterar sobre ellos y agregar opciones al combo
            foreach ($datos as $rows) {
                $combo .= '
                    <option value="' . $rows['accion'] . '">' . $rows['accion'] . '</option>
                ';
            }
            
        }

        // Cerrar el combo y devolver el HTML generado
        $combo .= '</select>';

        return $combo;
    }
}
