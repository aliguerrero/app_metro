<?php

namespace app\controllers;

use app\models\mainModel;

class herramientaController extends mainModel
{
    public function registrarHerramientaControlador()
    {
        // Se obtienen y limpian los datos del formulario
        $codigo = $this->limpiarCadena($_POST['codigo']);
        $nombre = $this->limpiarCadena($_POST['nombre']);
        $cant = $this->limpiarCadena($_POST['cant']);
        $estado = $this->limpiarCadena($_POST['estado']);

        # Verificación de campos obligatorios #
        if ($codigo == "" || $nombre == "" || $cant == "" || $estado == "Seleccionar") {
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

        $tools_datos_reg = [
            [
                "campo_nombre" => "id_herramienta",
                "campo_marcador" => ":Codigo",
                "campo_valor" => $codigo
            ],
            [
                "campo_nombre" => "nombre_herramienta",
                "campo_marcador" => ":Nombre",
                "campo_valor" => $nombre
            ],
            [
                "campo_nombre" => "cantidad",
                "campo_marcador" => ":Cant",
                "campo_valor" => $cant
            ],
            [
                "campo_nombre" => "estado",
                "campo_marcador" => ":Estado",
                "campo_valor" => $estado
            ],
            [
                "campo_nombre" => "std_reg",
                "campo_marcador" => ":std_reg",
                "campo_valor" => "1"
            ]
        ];

        $registrar_tools = $this->guardarDatos("herramienta", $tools_datos_reg);

        if ($registrar_tools->rowCount() == 1) {
            $this->registrarLog($_SESSION['id'], "REGISTRAR HERRAMIENTA", "REGISTRO EXITOSO PARA LA HERRAMIENTA " . $codigo . ' ' . $nombre);
            $alerta = [
                "tipo" => "limpiar",
                "titulo" => "Herramienta Registrada",
                "texto" => "La herramienta se ha resgitrado con exito",
                "icono" => "success"
            ];
        } else {
            $this->registrarLog($_SESSION['id'], "REGISTRAR HERRAMIENTA", "REGISTRO FALLIDO PARA LA HERRAMIENTA " . $codigo . ' ' . $nombre);
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "La Herramienta no se pudo registrar correctamente",
                "icono" => "error"
            ];
        }
        return json_encode($alerta);
    }

    public function listarHerramientaControlador()
    {

        $tabla = "";


        $consulta_datos = "SELECT h.*,(h.cantidad - COALESCE(SUM(hot.cantidadot), 0)) AS cantidad_disponible,
                COALESCE(SUM(hot.cantidadot), 0) AS herramienta_ocupada
                FROM 
                herramienta h
                LEFT JOIN 
                herramientaot hot ON h.id_herramienta = hot.id_herramienta WHERE std_reg='1'
                GROUP BY 
                h.id_herramienta ASC";

        $consulta_total = "SELECT COUNT(h.id_herramienta ) 
                FROM 
                herramienta h
                LEFT JOIN 
                herramientaot hot ON h.id_herramienta = hot.id_herramienta WHERE std_reg='1'";


        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta($consulta_total);
        $total = (int) $total->fetchColumn();

        $tabla .= '
            <div class="table-responsive table-wrapper3" id="tabla-ot">
            <table class="table border mb-0 table-hover table-sm table-striped" id="tablaDatosTools">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="clearfix">#</th>
                                <th class="text-center">
                                    <svg class="icon">
                                        <use xlink:href="' . APP_URL . 'app/views/icons/svg/free.svg#cil-settings"></use>
                                    </svg>
                                </th>
                                <th class="clearfix">Codigo</th>
                                <th class="clearfix">Nombre</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Cant. Disp.</th>
                                <th class="text-center">Cant. Ocup.</th>
                                <th class="text-center" colspan="3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
            ';
        if ($total >= 1) {
            $contador = 1;
            foreach ($datos as $rows) {
                $tabla .= '
                        <tr class="align-middle">
                            <td class="clearfix col-p">
                                <div class=""><b>' . $contador . '</b></div>
                            </td>
                            <td class="text-center col-p">
                                <div class="avatar avatar-md"><img class="avatar-img"
                                        src="' . APP_URL . 'app/views/img/tools.png" alt="user@email.com"><span
                            </td>                            
                            <td class="col-1">
                                <div class="clearfix">
                                    <div class=""><b>' . $rows['id_herramienta'] . '</b></div>
                                </div>
                            </td>
                            <td class="">
                                <div class="clearfix">
                                    <div class=""><b>' . $rows['nombre_herramienta'] . '</b></div>
                                </div>
                            </td>
                            <td class="col-1">
                                <div class="text-center">
                                    <div class=""><b>' . $rows['cantidad'] . '</b></div>
                                </div>
                            </td>
                            <td class="col-1">
                                <div class="text-center">
                                    <div class=""><b>' . $rows['cantidad_disponible'] . '</b></div>
                                </div>
                            </td>
                            <td class="col-1">
                                <div class="text-center ">
                                    <div class=""><b>' . $rows['herramienta_ocupada'] . '</b></div>
                                </div>
                            </td>
                            <td class="col-p">
                                <button type="button" title="Ver" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                    <i class="bi bi-eye"></i>
                                </button>                       
                            </td>
                            <td class="col-p">
                                <a href="#" title="Modificar" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventanaModalModificarHerr" data-bs-id="' . $rows['id_herramienta'] . '">
                                    <i class="bi bi-pencil"></i>
                                </a> 
                            </td>
                            <td class="col-p">
                                <form class="FormularioAjax" action="' . APP_URL . 'app/ajax/herramientaAjax.php" method="POST">
                                    <input type="hidden" name="modulo_herramienta" value="eliminar">
                                    <input type="hidden" name="herramienta_id" value="' . $rows['id_herramienta'] . '">
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
    public function listarHerramienta()
    {

        $tabla = "";


        $consulta_datos = "SELECT h.*,(h.cantidad - COALESCE(SUM(hot.cantidadot), 0)) AS cantidad_disponible,
                COALESCE(SUM(hot.cantidadot), 0) AS herramienta_ocupada
                FROM 
                herramienta h
                LEFT JOIN 
                herramientaot hot ON h.id_herramienta = hot.id_herramienta WHERE std_reg='1'
                GROUP BY 
                h.id_herramienta ASC";

        $consulta_total = "SELECT COUNT(h.id_herramienta ) 
                FROM 
                herramienta h
                LEFT JOIN 
                herramientaot hot ON h.id_herramienta = hot.id_herramienta WHERE std_reg='1'";


        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta($consulta_total);
        $total = (int) $total->fetchColumn();


        $tabla .= '
        <div class="table-responsive table-wrapper4" id="tabla-ot">
        <table class="table border mb-0 table-hover table-sm table-striped" id="tablaHerramienta">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="clearfix">#</th>
                                <th class="text-center">
                                    <svg class="icon">
                                        <use xlink:href="' . APP_URL . 'app/views/icons/svg/free.svg#cil-settings"></use>
                                    </svg>
                                </th>
                                <th class="clearfix">Codigo</th>
                                <th class="clearfix">Nombre</th>
                                <th class="text-center">Cant. Disp.</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
            ';
        if ($total >= 1) {
            $contador = 1;
            foreach ($datos as $rows) {
                $tabla .= '
                <tr class="align-middle">
                <td class="text-center">
                    No hay registros en el sistema
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

    public function listarHerramientaOT()
    {

        $tabla = "";


        $consulta_datos = "SELECT
                hot.id_herramientaOT,
                hot.n_ot,
                hot.id_herramienta,
                h.nombre_herramienta,
                hot.cantidadot
                FROM
                    herramientaot hot
                LEFT JOIN
                    herramienta h ON hot.id_herramienta = h.id_herramienta
                ORDER BY 
                hot.id_herramientaOT  ASC";

        $consulta_total = "SELECT COUNT(hot.n_ot) 
                FROM
                    herramientaot hot
                LEFT JOIN
                herramienta h ON hot.id_herramienta = h.id_herramienta
                ";


        $datos = $this->ejecutarConsulta($consulta_datos);
        $datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta($consulta_total);
        $total = (int) $total->fetchColumn();


        $tabla .= '
        <div class="table-responsive table-wrapper4" id="tabla-ot">
        <table class="table border mb-0 table-hover table-sm table-striped" id="tablaHerramientaOt">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                            <th class="clearfix">#</th>
                            <th class="text-center">
                                    <svg class="icon">
                                        <use xlink:href="' . APP_URL . 'app/views/icons/svg/free.svg#cil-settings"></use>
                                    </svg>
                                </th>
                                <th class="clearfix">Codigo</th>
                                <th class="clearfix">Nombre</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
            ';
        if ($total >= 1) {
            $contador = 1;
            foreach ($datos as $rows) {
                $tabla .= '
                <tr class="align-middle">
                <td class="text-center">
                    No hay registros en el sistema
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
    public function eliminarHerramientaControlador()
    {

        $id = $this->limpiarCadena($_POST['herramienta_id']);
        $id2 = "E-" . $id;
        # verificar el usuario
        $datos = $this->ejecutarConsulta("SELECT * FROM herramienta WHERE id_herramienta='$id'");
        if ($datos->rowCount() <= 0) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "No hemos encontrado la herramienta en el sistema",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        } else {
            $datos = $datos->fetch();
        }

        $datos_reg = [
            [
                "campo_nombre" => "id_herramienta",
                "campo_marcador" => ":id_herr",
                "campo_valor" => $id2
            ],
            [
                "campo_nombre" => "std_reg",
                "campo_marcador" => ":std_reg",
                "campo_valor" => 0
            ]
        ];

        $condicion = [
            "condicion_campo" => "id_herramienta",
            "condicion_marcador" => ":id_herramienta",
            "condicion_valor" => $id
        ];

        if ($this->actualizarDatos("herramienta", $datos_reg, $condicion)) {
            $this->registrarLog($_SESSION['id'], "ELIMINAR HERRAMIENTA", "ELIMINADA EXITOSAMENTE PARA LA HERRAMIENTA " . $id . ' ' . $datos['nombre_herramienta']);
            $alerta = [
                "tipo" => "recargar",
                "titulo" => "Miembro Eliminado",
                "texto" => "La Herramienta " . $datos['nombre_herramienta'] . " ha sido eliminada con exito",
                "icono" => "success"
            ];
        } else {
            $this->registrarLog($_SESSION['id'], "ELIMINAR HERRAMIENTA", "ELIMINACIÓN FALLIDA PARA LA HERRAMIENTA " . $id . ' ' . $datos['nombre_herramienta']);
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "No se pudo eliminar la herramienta, por favor intente nuevamente",
                "icono" => "error"
            ];
        }
        return json_encode($alerta);
    }

    public function actualizarDatosHeramienta()
    {
        $id = $this->limpiarCadena($_POST['id']);

        $codigo = $this->limpiarCadena($_POST['codigo']);
        $nombre = $this->limpiarCadena($_POST['nombre']);
        $cant = $this->limpiarCadena($_POST['cant']);
        $estado = $this->limpiarCadena($_POST['estado']);

        # Verificación de campos obligatorios #
        if ($codigo == "" || $nombre == "" || $cant == "" || $estado == "Seleccionar") {
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
        #VERIFICAR LA codigo NO EXISTA        
        $check_codigo = $this->ejecutarConsulta("SELECT id_herramienta FROM herramienta WHERE id_herramienta='$codigo' AND id_herramienta !='$id'");
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

        $herr_datos = [
            [
                "campo_nombre" => "id_herramienta",
                "campo_marcador" => ":Codigo",
                "campo_valor" => $codigo
            ],
            [
                "campo_nombre" => "nombre_herramienta",
                "campo_marcador" => ":Nombre",
                "campo_valor" => $nombre
            ],
            [
                "campo_nombre" => "cantidad",
                "campo_marcador" => ":Cant",
                "campo_valor" => $cant
            ],
            [
                "campo_nombre" => "estado",
                "campo_marcador" => ":Estado",
                "campo_valor" => $estado
            ]
        ];

        $condicion = [
            "condicion_campo" => "id_herramienta",
            "condicion_marcador" => ":ID",
            "condicion_valor" => $id
        ];

        if ($this->actualizarDatos("herramienta", $herr_datos, $condicion)) {
            $this->registrarLog($_SESSION['id'], "MODIFICAR HERRAMIENTA", "MODIFICADA EXITOSAMENTE PARA LA HERRAMIENTA " . $id . ' ' . $nombre);
            $alerta = [
                "tipo" => "limpiar",
                "titulo" => "Datos Actualizados",
                "texto" => "Se actualizo correctamente",
                "icono" => "success"
            ];
        } else {
            $this->registrarLog($_SESSION['id'], "MODIFICAR HERRAMIENTA", "MODIFICACIÓN FALLIDA PARA LA HERRAMIENTA " . $id . ' ' . $nombre);
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "¡Ha ocurrido un error durante el registro!",
                "icono" => "error"
            ];
        }
        return json_encode($alerta);
    }
}
