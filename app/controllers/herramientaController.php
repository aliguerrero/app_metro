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
        
        public function listarHerramientaControlador ($pagina, $registros, $url, $busqueda){
            
            $pagina = $this->limpiarCadena($pagina);
            $registros = $this->limpiarCadena($registros);

            $url = $this->limpiarCadena($url);
            $url= APP_URL.$url."/";

            $busqueda = $this->limpiarCadena($busqueda);

            $tabla="";

            $pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
            $inicio = ($pagina>0) ? (($pagina*$registros)-$registros) : 0;
            
            if (isset($busqueda) && $busqueda!= "") {

                $consulta_datos="SELECT h.*,(h.cantidad - COALESCE(SUM(hot.cantidadot), 0)) AS cantidad_disponible,
                COALESCE(SUM(hot.cantidadot), 0) AS herramienta_ocupada
                FROM 
                herramienta h
                LEFT JOIN 
                herramientaot hot ON h.id_herramienta = hot.id_herramienta
                WHERE 
                ((h.id_herramienta   LIKE '%$busqueda%' OR h.nombre_herramienta LIKE '%$busqueda%')) ORDER BY h.id_herramienta  ASC LIMIT $inicio, $registros";

                $consulta_total="SELECT COUNT(h.id_herramienta) 
                FROM 
                herramienta h
                LEFT JOIN 
                herramientaot hot ON h.id_herramienta = hot.id_herramienta 
                WHERE 
                ((h.id_herramienta  LIKE '%$busqueda%' OR h.nombre_herramienta LIKE '%$busqueda%'))";
         
            } else {
                $consulta_datos="SELECT h.*,(h.cantidad - COALESCE(SUM(hot.cantidadot), 0)) AS cantidad_disponible,
                COALESCE(SUM(hot.cantidadot), 0) AS herramienta_ocupada
                FROM 
                herramienta h
                LEFT JOIN 
                herramientaot hot ON h.id_herramienta = hot.id_herramienta
                GROUP BY 
                h.id_herramienta ASC LIMIT $inicio, $registros";

                $consulta_total="SELECT COUNT(h.id_herramienta ) 
                FROM 
                herramienta h
                LEFT JOIN 
                herramientaot hot ON h.id_herramienta = hot.id_herramienta";
            }
            
            $datos = $this->ejecutarConsulta($consulta_datos);
            $datos = $datos->fetchAll();

            $total = $this->ejecutarConsulta($consulta_total);
            $total = (int) $total->fetchColumn();

            $numeroPaginas = ceil($total/$registros);

            $tabla .='
                <div class="table-responsive">
                    <table class="table border mb-0 table-info table-hover table-striped">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="clearfix">#</th>
                                <th class="text-center">
                                    <svg class="icon">
                                        <use xlink:href="'.APP_URL.'app/views/icons/svg/free.svg#cil-people"></use>
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
            if ($total >= 1 && $pagina <= $numeroPaginas) {
                $contador = $inicio + 1;
                $pag_inicio= $inicio + 1;
                foreach ($datos as $rows) {               
                    $tabla.='
                        <tr class="align-middle">
                            <td class="clearfix col-1">
                                <div class=""><b>'.$contador.'</b></div>
                            </td>
                            <td class="text-center col-1">
                                <div class="avatar avatar-md"><img class="avatar-img"
                                        src="'.APP_URL.'app/views/img/tools.png" alt="user@email.com"><span
                                        class="avatar-status bg-success"></span></div>
                            </td>                            
                            <td class="col-1">
                                <div class="clearfix">
                                    <div class=""><b>'.$rows['id_herramienta'].'</b></div>
                                </div>
                            </td>
                            <td class="">
                                <div class="clearfix">
                                    <div class=""><b>'.$rows['nombre_herramienta'].'</b></div>
                                </div>
                            </td>
                            <td class="col-1">
                                <div class="text-center">
                                    <div class=""><b>'.$rows['cantidad'].'</b></div>
                                </div>
                            </td>
                            <td class="col-1">
                                <div class="text-center">
                                    <div class=""><b>'.$rows['cantidad_disponible'].'</b></div>
                                </div>
                            </td>
                            <td class="col-1">
                                <div class="text-center ">
                                    <div class=""><b>'.$rows['herramienta_ocupada'].'</b></div>
                                </div>
                            </td>
                            <td class="col-1">
                                <button type="button" title="Ver" class="btn" style="background-color: #EBEDEF; color:white ;">
                                    <img src="'.APP_URL.'app/views/icons/ver.png" alt="icono" width="32" height="32">
                                </button>                       
                            </td>
                            <td class="col-1">
                                <button type="button" title="Modificar" class="btn" style="background-color: #EBEDEF; color:white ;">
                                    <img src="'.APP_URL.'app/views/icons/modificar.png" alt="icono" width="32" height="32">
                                </button> 
                            </td>
                            <td class="col-1">
                                <form class="FormularioAjax" action="'.APP_URL.'app/ajax/herramientaAjax.php" method="POST" autocomplete="off" >

                                    <input type="hidden" name="modulo_usuario" value="eliminar">
                                    <input type="hidden" name="usuario_id" value="'.$rows['id_herramienta'].'">
                                    <button type="button" class="btn" title="Eliminar" style="background-color: #EBEDEF; color:white ;">
                                        <img src="'.APP_URL.'app/views/icons/eliminar.png" alt="icono" width="32" height="32">
                                    </button> 
                                </form>
                            </td>    
                        </tr>
                    ';
                    $contador++;
                }
                $pag_final = $contador-1;
            } else {
                if ($total >= 1) {
                    $tabla.='
                        <tr class="align-middle">
                            <td class="text-center">
                                <a style="background-color: #EBEDEF; color:white ;" href="'.$url.'1/" role="button">Haga clic para recargar la tabla</a>
                            </td>
                        </tr>
                    ';
                } else {
                    $tabla.='
                        <tr class="align-middle">
                            <td class="text-center">
                                No hay registros en el sistema
                            </td>
                        </tr>
                    ';
                }
                
            }
            
            $tabla .='</tbody> </table> </div> ';

            if ($total > 0 && $pagina <= $numeroPaginas) {
                $tabla .='
                    <p>Mostrando Herramientas <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un 
                    <strong>total de '.$total.'</strong></p>
                ';

                $tabla .= $this->paginadorTablas($pagina, $numeroPaginas, $url, 5);
            }

            return $tabla;
        }

        public function listarHerramientaOTControlador ($pagina, $registros, $url, $busqueda){
            
            $pagina = $this->limpiarCadena($pagina);
            $registros = $this->limpiarCadena($registros);

            $url = $this->limpiarCadena($url);
            $url= APP_URL.$url."/";

            $busqueda = $this->limpiarCadena($busqueda);

            $tabla="";

            $pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
            $inicio = ($pagina>0) ? (($pagina*$registros)-$registros) : 0;
            
            if (isset($busqueda) && $busqueda!= "") {

                $consulta_datos="SELECT
                hot.id_herramientaOT,
                hot.n_ot,
                h.nombre_herramienta,
                hot.cantidadot
                FROM
                    herramientaot hot
                LEFT JOIN
                    herramienta h ON hot.id_herramienta = h.id_herramienta
                WHERE 
                ((hot.id_herramientaOT   LIKE '%$busqueda%' OR h.nombre_herramienta LIKE '%$busqueda%')) ORDER BY hot.id_herramientaOT  ASC LIMIT $inicio, $registros";

                $consulta_total="SELECT COUNT(hot.n_ot) 
                FROM
                    herramientaot hot
                LEFT JOIN
                    herramienta h ON hot.id_herramienta = h.id_herramienta
                WHERE 
                ((hot.id_herramientaOT   LIKE '%$busqueda%' OR h.nombre_herramienta LIKE '%$busqueda%'))";
         
            } else {
                $consulta_datos="SELECT
                hot.id_herramientaOT,
                hot.n_ot,
                h.nombre_herramienta,
                hot.cantidadot
                FROM
                    herramientaot hot
                LEFT JOIN
                    herramienta h ON hot.id_herramienta = h.id_herramienta
                ORDER BY 
                hot.id_herramientaOT  ASC LIMIT $inicio, $registros";

                $consulta_total="SELECT COUNT(hot.n_ot) 
                FROM
                    herramientaot hot
                LEFT JOIN
                herramienta h ON hot.id_herramienta = h.id_herramienta";
            }
            
            $datos = $this->ejecutarConsulta($consulta_datos);
            $datos = $datos->fetchAll();

            $total = $this->ejecutarConsulta($consulta_total);
            $total = (int) $total->fetchColumn();

            $numeroPaginas = ceil($total/$registros);

            $tabla .='
                <div class="table-responsive">
                    <table class="table border mb-0 table-info table-hover table-striped">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="clearfix">#</th>
                                <th class="text-center">
                                    <svg class="icon">
                                        <use xlink:href="'.APP_URL.'app/views/icons/svg/free.svg#cil-people"></use>
                                    </svg>
                                </th>
                                <th class="clearfix">N° O.T.</th>
                                <th class="clearfix">Nombre</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center" colspan="3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
            ';
            if ($total >= 1 && $pagina <= $numeroPaginas) {
                $contador = $inicio + 1;
                $pag_inicio= $inicio + 1;
                foreach ($datos as $rows) {                 
                    $tabla.='
                        <tr class="align-middle">
                            <td class="clearfix col-1">
                                <div class=""><b>'.$contador.'</b></div>
                            </td>
                            <td class="text-center col-1">
                                <div class="avatar avatar-md"><img class="avatar-img"
                                        src="'.APP_URL.'app/views/img/tools.png" alt="user@email.com"><span
                                        class="avatar-status bg-success"></span></div>
                            </td>                            
                            <td class="col-1">
                                <div class="clearfix">
                                    <div class=""><b>'.$rows['n_ot'].'</b></div>
                                </div>
                            </td>
                            <td class="col-5">
                                <div class="clearfix">
                                    <div class=""><b>'.$rows['nombre_herramienta'].'</b></div>
                                </div>
                            </td>
                            <td class="col-1">
                                <div class="text-center">
                                    <div class=""><b>'.$rows['cantidadot'].'</b></div>
                                </div>
                            </td>
                            <td class="col-1">
                                <button type="button" title="Ver" class="btn" style="background-color: #EBEDEF; color:white ;">
                                    <img src="'.APP_URL.'app/views/icons/ver.png" alt="icono" width="32" height="32">
                                </button>                       
                            </td>
                            <td class="col-1">
                                <button type="button" title="Modificar" class="btn" style="background-color: #EBEDEF; color:white ;">
                                    <img src="'.APP_URL.'app/views/icons/modificar.png" alt="icono" width="32" height="32">
                                </button> 
                            </td>
                            <td class="col-1">
                                <form class="FormularioAjax" action="'.APP_URL.'app/ajax/herramientaAjax.php" method="POST" autocomplete="off" >

                                    <input type="hidden" name="modulo_usuario" value="eliminar">
                                    <input type="hidden" name="usuario_id" value="'.$rows['id_herramientaOT'].'">
                                    <button type="button" class="btn" title="Eliminar" style="background-color: #EBEDEF; color:white ;">
                                        <img src="'.APP_URL.'app/views/icons/eliminar.png" alt="icono" width="32" height="32">
                                    </button> 
                                </form>
                            </td>    
                        </tr>
                    ';
                    $contador++;
                }
                $pag_final = $contador-1;
            } else {
                if ($total >= 1) {
                    $tabla.='
                        <tr class="align-middle">
                            <td class="text-center">
                                <a style="background-color: #EBEDEF; color:white ;" href="'.$url.'1/" role="button">Haga clic para recargar la tabla</a>
                            </td>
                        </tr>
                    ';
                } else {
                    $tabla.='
                        <tr class="align-middle">
                            <td class="text-center">
                                No hay registros en el sistema
                            </td>
                        </tr>
                    ';
                }
                
            }
            
            $tabla .='</tbody> </table> </div> ';

            if ($total > 0 && $pagina <= $numeroPaginas) {
                $tabla .='
                    <p>Mostrando Herramientas en uso <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un 
                    <strong>total de '.$total.'</strong></p>
                ';

                $tabla .= $this->paginadorTablas($pagina, $numeroPaginas, $url, 5);
            }

            return $tabla;
        }
    }