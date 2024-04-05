<?php
    namespace app\controllers;
    use app\models\mainModel;

    class miembroController extends mainModel{
        public function registrarMiembroControlador(){
            #Se obtienen y limpian los datos del formulario
            $codigo = $this->limpiarCadena($_POST['codigo']);
            $nombre = $this->limpiarCadena($_POST['nombre']);
            $tipo   = $this->limpiarCadena($_POST['tipo']);

            # Verificación de campos obligatorios #
            if ($codigo == "" || $nombre == "" || $tipo == "Seleccionar") {
                #Si algún campo obligatorio está vacío, se devuelve una alerta de error
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
                #Si el formato del código no es válido, se devuelve una alerta de error
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
                #Si el formato del nombre no es válido, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El NOMBRE DEL OPERADOR no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }           

           # Definición de un array asociativo $miembro_datos_reg que contiene los datos del miembro a registrar
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

            #Llamada al método guardarDatos() para guardar los datos del miembro en la base de datos
            $registrar_miemnbro = $this->guardarDatos("miembro", $miembro_datos_reg);

            #Verificar si se registró correctamente el miembro
            if ($registrar_miemnbro->rowCount() == 1) {
                #Si se registró correctamente, se devuelve un mensaje de éxito
                $alerta = [
                    "tipo" => "limpiar",
                    "titulo" => "Miembro Registrado",
                    "texto" => "El miembro " . $nombre . " se ha registrado con éxito",
                    "icono" => "success"
                ];
            } else {               
                #Se devuelve un mensaje de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El miembro no se pudo registrar correctamente",
                    "icono" => "error"
                ];
            }

            #Se devuelve el mensaje de alerta en formato JSON
            return json_encode($alerta);

        }

        public function listarMiembroControlador ($pagina, $registros, $url, $busqueda){
            
            $pagina = $this->limpiarCadena($pagina);
            $registros = $this->limpiarCadena($registros);

            $url = $this->limpiarCadena($url);
            $url= APP_URL.$url."/";

            $busqueda = $this->limpiarCadena($busqueda);

            $tabla="";

            $pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
            $inicio = ($pagina>0) ? (($pagina*$registros)-$registros) : 0;
            
            if (isset($busqueda) && $busqueda!= "") {

                $consulta_datos="SELECT * FROM miembro WHERE 
                ((id_miembro  LIKE '%$busqueda%' OR nombre_miembro LIKE '%$busqueda%')) ORDER BY id_miembro ASC LIMIT $inicio, $registros";

                $consulta_total="SELECT COUNT(id_miembro) FROM miembro WHERE 
                ((id_miembro LIKE '%$busqueda%' OR nombre_miembro LIKE '%$busqueda%'))";
         
            } else {
                $consulta_datos="SELECT * FROM miembro ORDER
                BY id_miembro ASC LIMIT $inicio, $registros";

                $consulta_total="SELECT COUNT(id_miembro) FROM miembro";
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
                                <th class="clearfix">Nombre Completo </th>
                                <th class="text-center">Tipo de Operador</th>
                                <th class="text-center" colspan="3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
            ';
            if ($total >= 1 && $pagina <= $numeroPaginas) {
                $contador = $inicio + 1;
                $pag_inicio= $inicio + 1;
                $tipo_user="";
                foreach ($datos as $rows) {
                    if($rows['tipo_miembro']=='1'){
                        $tipo_user="C.C.F.";
                    }else{
                        $tipo_user="C.C.O.";
                    }
                    $tabla.='
                        <tr class="align-middle">
                            <td class="clearfix">
                                <div class=""><b>'.$contador.'</b></div>
                            </td>
                            <td class="text-center">
                                <div class="avatar avatar-md"><img class="avatar-img"
                                        src="'.APP_URL.'app/views/img/avatars/user.png" alt="user@email.com"><span
                                        class="avatar-status bg-success"></span></div>
                            </td>                            
                            <td>
                                <div class="clearfix">
                                    <div class=""><b>'.$rows['id_miembro'].'</b></div>
                                </div>
                            </td>
                            <td>
                                <div class="clearfix">
                                    <div class=""><b>'.$rows['nombre_miembro'].'</b></div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <div class=""><b>'.$tipo_user.'</b></div>
                                </div>
                            </td>
                            <td>
                                <button type="button" title="Ver" class="btn" style="background-color: #EBEDEF; color:white ;">
                                    <img src="'.APP_URL.'app/views/icons/ver.png" alt="icono" width="32" height="32">
                                </button>                       
                            </td>
                            <td>
                                <button type="button" title="Modificar" class="btn" style="background-color: #EBEDEF; color:white ;">
                                    <img src="'.APP_URL.'app/views/icons/modificar.png" alt="icono" width="32" height="32">
                                </button> 
                            </td>
                            <td>
                                <form class="FormularioAjax" action="'.APP_URL.'app/ajax/miembroAjax.php" method="POST" autocomplete="off" >

                                    <input type="hidden" name="modulo_usuario" value="eliminar">
                                    <input type="hidden" name="usuario_id" value="'.$rows['id_miembro'].'">
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
                    <p>Mostrando Miembros <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un 
                    <strong>total de '.$total.'</strong></p>
                ';

                $tabla .= $this->paginadorTablas($pagina, $numeroPaginas, $url, 5);
            }

            return $tabla;
        }
    }