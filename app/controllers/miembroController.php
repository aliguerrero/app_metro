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
            if ($this->verificarDatos('[a-zA-Z0-9-]{1,10}', $codigo)) {
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
                ],
                [
                    "campo_nombre"=>"std_reg",
                    "campo_marcador"=>":std_reg",
                    "campo_valor"=> "1"
                ]
            ];

            #Llamada al método guardarDatos() para guardar los datos del miembro en la base de datos
            $registrar_miemnbro = $this->guardarDatos("miembro", $miembro_datos_reg);

            #Verificar si se registró correctamente el miembro
            if ($registrar_miemnbro->rowCount() == 1) {
                $this->registrarLog($_SESSION['id'],"REGISTRAR MIEMBRO","REGISTRO EXITOSO PARA EL MIEMBRO ".$nombre); 
                #Si se registró correctamente, se devuelve un mensaje de éxito
                $alerta = [
                    "tipo" => "limpiar",
                    "titulo" => "Miembro Registrado",
                    "texto" => "El miembro " . $nombre . " se ha registrado con éxito",
                    "icono" => "success"
                ];
            } else {      
                $this->registrarLog($_SESSION['id'],"REGISTRAR MIEMBRO","REGISTRO FALLIDO PARA EL MIEMBRO ".$nombre);          
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
                ((id_miembro  LIKE '%$busqueda%' OR nombre_miembro LIKE '%$busqueda%' AND std_reg='1')) ORDER BY id_miembro ASC LIMIT $inicio, $registros";

                $consulta_total="SELECT COUNT(id_miembro) FROM miembro WHERE 
                ((id_miembro LIKE '%$busqueda%' OR nombre_miembro LIKE '%$busqueda%' AND std_reg='1'))";
         
            } else {
                $consulta_datos="SELECT * FROM miembro WHERE std_reg='1' ORDER
                BY id_miembro ASC LIMIT $inicio, $registros";

                $consulta_total="SELECT COUNT(id_miembro) FROM miembro WHERE std_reg='1'";
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
                            <td class="clearfix col-p">
                                <div class=""><b>'.$contador.'</b></div>
                            </td>
                            <td class="text-center col-p">
                                <div class="avatar avatar-md"><img class="avatar-img"
                                        src="'.APP_URL.'app/views/img/avatars/user.png" alt="user@email.com"><span
                                        class="avatar-status bg-success"></span></div>
                            </td>                            
                            <td class="col-p">
                                <div class="clearfix">
                                    <div class=""><b>'.$rows['id_miembro'].'</b></div>
                                </div>
                            </td>
                            <td class="">
                                <div class="clearfix">
                                    <div class=""><b>'.$rows['nombre_miembro'].'</b></div>
                                </div>
                            </td>
                            <td class="col-2">
                                <div class="text-center">
                                    <div class=""><b>'.$tipo_user.'</b></div>
                                </div>
                            </td>
                            <td class="col-p">
                                <button type="button" title="Ver" class="btn" style="background-color: #EBEDEF; color:white ;">
                                    <img src="'.APP_URL.'app/views/icons/view.png" alt="icono" width="28" height="28">
                                </button>                       
                            </td>
                            <td class="col-p">
                                <a href="#" title="Modificar" class="btn" data-bs-toggle="modal" data-bs-target="#ventanaModalModificarMiem" data-bs-id="'.$rows['id_miembro'].'" style="background-color: #EBEDEF; color:white ;">
                                    <img src="'.APP_URL.'app/views/icons/edit.png" alt="icono" width="28" height="28" >
                                </a> 
                            </td>
                            <td class="col-p">
                                <form class="FormularioAjax" action="'.APP_URL.'app/ajax/miembroAjax.php" method="POST">
                                    <input type="hidden" name="modulo_miembro" value="eliminar">
                                    <input type="hidden" name="miembro_id" value="'.$rows['id_miembro'].'">
                                    <button type="submit" class="btn" title="Eliminar" style="background-color: #EBEDEF; color:white ;">
                                        <img src="'.APP_URL.'app/views/icons/delete.png" alt="icono" width="28" height="28">
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

        public function eliminarMiembroControlador(){
            
            $id = $this->limpiarCadena($_POST['miembro_id']);
            $id2 = "E-".$id;        

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
            $datos = $this->ejecutarConsulta("SELECT * FROM miembro WHERE id_miembro='$id'");
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
            
            $datos_reg=[
                [
                    "campo_nombre" => "id_miembro",
                    "campo_marcador" => ":id",
                    "campo_valor" => $id2
                ]
                ,
                [
                    "campo_nombre"=>"std_reg",
                    "campo_marcador"=>":std_reg",
                    "campo_valor"=> 0
                ]
            ];

            $condicion=[
				"condicion_campo"=>"id_miembro",
				"condicion_marcador"=>":id_miembro",
				"condicion_valor"=>$id
			];

            if($this->actualizarDatos("miembro",$datos_reg,$condicion)){
                $this->registrarLog($_SESSION['id'],"ELIMINAR MIEMBRO","ELIMINACION EXITOSA PARA EL MIEMBRO ".$datos['nombre_miembro']); 
                $alerta = [
                    "tipo" => "recargar",
                    "titulo" => "Miembro Eliminado",
                    "texto" => "El Miembro ".$datos['nombre_miembro']." ha sido eliminado con exito",
                    "icono" => "success"                    
                ];                
            } else {
                $this->registrarLog($_SESSION['id'],"ELIMINAR MIEMBRO","ELIMINACION FALLIDA PARA EL MIEMBRO ".$datos['nombre_miembro']); 
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "No se pudo eliminar el Miembro, por favor intente nuevamente",
                    "icono" => "error"
                ];                
            }
            return json_encode($alerta);
        }

        public function actualizarDatosMiembro(){
            $id = $this->limpiarCadena($_POST['id']);

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
            #VERIFICAR LA codigo NO EXISTA        
            $check_codigo = $this->ejecutarConsulta("SELECT * FROM miembro WHERE id_miembro ='$codigo' AND id_miembro !='$id'");
            if ($check_codigo->rowCount() > 0) {
                // Si el username ya existe en la base de datos, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "La codigo ingresado ya existe en los registros",
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

            $user_datos=[
                [
                    "campo_nombre"=>"id_miembro",
                    "campo_marcador"=>":codigo",
                    "campo_valor"=> $codigo
                ],
                [
                    "campo_nombre"=>"nombre_miembro",
                    "campo_marcador"=>":Nombre",
                    "campo_valor"=> $nombre
                ],
                [
                    "campo_nombre"=>"tipo_miembro",
                    "campo_marcador"=>":Tipo",
                    "campo_valor"=> $tipo
                ]
            ];

            $condicion=[
				"condicion_campo"=>"id_miembro",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

            if($this->actualizarDatos("miembro",$user_datos,$condicion)){
                $this->registrarLog($_SESSION['id'],"ACTUALIZAR MIEMBRO","MODIFICACIÓN EXITOSA PARA EL MIEMBRO ".$nombre); 
				$alerta=[
					"tipo"=>"limpiar",
					"titulo"=>"Datos Actualizados",
					"texto"=>"Se actualizo correctamente",
					"icono"=>"success"
				];
			}else{
                $this->registrarLog($_SESSION['id'],"ACTUALIZAR MIEMBRO","MODIFICACIÓN FALLIDA PARA EL MIEMBRO ".$nombre); 
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