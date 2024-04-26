<?php
    namespace app\controllers;
    use app\models\mainModel;

    class otController extends mainModel{
        
        public function registrarOtControlador(){
            #Se obtienen y limpian los datos del formulario
            $area = $this->limpiarCadena($_POST['area']);
            $codigo = $this->limpiarCadena($_POST['codigo']);
            $fecha   = $this->limpiarCadena($_POST['fecha']);
            $nombre = $this->limpiarCadena($_POST['nombre']);
            $semana = $this->limpiarCadena($_POST['semana']);
            $mes   = $this->limpiarCadena($_POST['mes']);
            $sitio = $this->limpiarCadena($_POST['sitio']);

            #variable codigof
            $codigof="";
            
            # Verificación de campos obligatorios #
            if ($area == "" || $codigo == "" || $fecha == ""|| $nombre == ""|| $semana == ""|| $mes == "Seleccionar"|| $sitio == "Seleccionar") {
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
            if ($this->verificarDatos('^[0-9]{1,10}$', $codigo)) {
                #Si el formato del código no es válido, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El código no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
            #construir codigo 
            switch ($area) {
                case '1':
                    $codigof = "VF-SEÑ-".$codigo;
                    break;
                case '2':
                    $codigof = "VF-INF-".$codigo;
                    break;
                case '3':
                    $codigof = "VF-APV-".$codigo;
                    break;
                case '4':
                    $codigof = "VF-NP-".$codigo;
                    break;                
            }
            
            # Verificar el codigo #
            $check_codigo = $this->ejecutarConsulta("SELECT n_ot FROM orden_trabajo WHERE n_ot='$codigof'");
            if ($check_codigo->rowCount() > 0) {
                // Si la Cedula ya existe en la base de datos, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El codigo ingresado ya existe en los registros",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
            # Verificar la integridad de los datos de nombre #
            if ($this->verificarDatos('[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,60}', $nombre)) {
                #Si el formato del nombre no es válido, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El nombre de trabajo no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }           

           # Definición de un array asociativo $miembro_datos_reg que contiene los datos del miembro a registrar
            $ot_datos_reg = [
                [
                    "campo_nombre" => "n_ot",
                    "campo_marcador" => ":nrot",
                    "campo_valor" => $codigof
                ],
                [
                    "campo_nombre" => "id_user",
                    "campo_marcador" => ":id",
                    "campo_valor" => $_SESSION['id']
                ],
                [
                    "campo_nombre" => "nombre_trab",
                    "campo_marcador" => ":trabajo",
                    "campo_valor" => $nombre =  mb_strtoupper($nombre, 'UTF-8')
                ],
                [
                    "campo_nombre" => "sitio_trab",
                    "campo_marcador" => ":sitio",
                    "campo_valor" => $sitio
                ],
                [
                    "campo_nombre" => "fecha",
                    "campo_marcador" => ":fecha",
                    "campo_valor" => $fecha
                ],
                [
                    "campo_nombre" => "semana",
                    "campo_marcador" => ":semana",
                    "campo_valor" => $semana
                ], 
                [
                    "campo_nombre" => "mes",
                    "campo_marcador" => ":mes",
                    "campo_valor" => $mes
                ],
                [
                    "campo_nombre"=>"std_reg",
                    "campo_marcador"=>":std_reg",
                    "campo_valor"=> "1"
                ]
            ];

            #Llamada al método guardarDatos() para guardar los datos del miembro en la base de datos
            $registrar_ot = $this->guardarDatos("orden_trabajo", $ot_datos_reg);

            #Verificar si se registró correctamente el miembro
            if ($registrar_ot->rowCount() == 1) {
                $this->registrarLog($_SESSION['id'],"REGISTRO OT","REGISTRO EXITOSO DE PARA LA OT ".$codigof);
                #Si se registró correctamente, se devuelve un mensaje de éxito
                $alerta = [
                    "tipo" => "limpiar",
                    "titulo" => "Miembro Registrado",
                    "texto" => "La orden de trabajo se ha registrado con éxito",
                    "icono" => "success"
                ];
            } else {        
                $this->registrarLog($_SESSION['id'],"REGISTRO OT","REGISTRO FALLIDO DE PARA LA OT ".$codigof);       
                #Se devuelve un mensaje de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "La orden de trabajo no se pudo registrar correctamente",
                    "icono" => "error"
                ];
            }

            #Se devuelve el mensaje de alerta en formato JSON
            return json_encode($alerta);

        }
        public function modificarOtControlador(){
            #Se obtienen y limpian los datos del formulario
            $id = $this->limpiarCadena($_POST['id']);

            $fecha   = $this->limpiarCadena($_POST['fecha1']);
            $nombre = $this->limpiarCadena($_POST['nombre']);
            $semana = $this->limpiarCadena($_POST['semana1']);
            $mes   = $this->limpiarCadena($_POST['mes1']);
            $sitio = $this->limpiarCadena($_POST['sitio']);

            #variable codigof
            $codigof="";
            
            # Verificación de campos obligatorios #
            if ($fecha == ""|| $nombre == ""|| $semana == ""|| $mes == "Seleccionar"|| $sitio == "Seleccionar") {
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

            # Verificar la integridad de los datos de nombre #
            if ($this->verificarDatos('[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,60}', $nombre)) {
                #Si el formato del nombre no es válido, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El nombre de trabajo no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }           

           # Definición de un array asociativo $miembro_datos_reg que contiene los datos del miembro a registrar
            $ot_datos_reg = [                
                [
                    "campo_nombre" => "nombre_trab",
                    "campo_marcador" => ":trabajo",
                    "campo_valor" => $nombre =  mb_strtoupper($nombre, 'UTF-8')
                ],
                [
                    "campo_nombre" => "sitio_trab",
                    "campo_marcador" => ":sitio",
                    "campo_valor" => $sitio
                ],
                [
                    "campo_nombre" => "fecha",
                    "campo_marcador" => ":fecha",
                    "campo_valor" => $fecha
                ],
                [
                    "campo_nombre" => "semana",
                    "campo_marcador" => ":semana",
                    "campo_valor" => $semana
                ], 
                [
                    "campo_nombre" => "mes",
                    "campo_marcador" => ":mes",
                    "campo_valor" => $mes
                ]
            ];
            $condicion=[
				"condicion_campo"=>"n_ot",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

            if($this->actualizarDatos("orden_trabajo",$ot_datos_reg,$condicion)){
                $this->registrarLog($_SESSION['id'],"MODIFICAR OT","MODIFICACION EXITOSA DE PARA LA OT ".$id);
				$alerta=[
					"tipo"=>"limpiar",
					"titulo"=>"Datos Actualizados",
					"texto"=>"Se actualizo correctamente",
					"icono"=>"success"
				];
			}else{
                $this->registrarLog($_SESSION['id'],"MODIFICAR OT","MODIFICACION FALLIDA DE PARA LA OT ".$id);
				$alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "¡Ha ocurrido un error durante el registro!",
                    "icono" => "error"
                ];
			}
			return json_encode($alerta); 
        }
        public function registrarDetalleOtControlador(){
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
            if ($id == "" || $cant == 0 || $turno == "Seleccionar"|| $status == "Seleccionar"|| $cco == "Seleccionar"|| $ccf == "Seleccionar"|| $tecnico == "Seleccionar"|| $prep_ini == ""|| $prep_fin == ""|| $tras_ini == ""|| $tras_fin == ""|| $ejec_ini == ""|| $ejec_fin == "") {
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
                      
            
           # Definición de un array asociativo $miembro_datos_reg que contiene los datos del miembro a registrar
            $ot_datos_reg = [
                [
                    "campo_nombre" => "n_ot",
                    "campo_marcador" => ":nrot",
                    "campo_valor" => $id
                ],
                [
                    "campo_nombre" => "cant_tec",
                    "campo_marcador" => ":cant",
                    "campo_valor" => $cant                    
                ],
                [
                    "campo_nombre" => "turno",
                    "campo_marcador" => ":turno",
                    "campo_valor" => $turno
                ],
                [
                    "campo_nombre" => "responsable_cco ",
                    "campo_marcador" => ":cco",
                    "campo_valor" => $cco
                ],
                [
                    "campo_nombre" => "responsable_act",
                    "campo_marcador" => ":responsable",
                    "campo_valor" => $tecnico
                ],
                [
                    "campo_nombre" => "responsable_ccf ",
                    "campo_marcador" => ":ccf",
                    "campo_valor" => $ccf
                ], 
                [
                    "campo_nombre" => "	hora_ini_pre",
                    "campo_marcador" => ":horapreini",
                    "campo_valor" => $prep_ini
                ], [
                    "campo_nombre" => "	hora_fin_pre",
                    "campo_marcador" => ":horaprefin",
                    "campo_valor" => $prep_fin
                ],
                [
                    "campo_nombre" => "hora_ini_tra",
                    "campo_marcador" => ":horatraini",
                    "campo_valor" => $tras_ini
                ],
                [
                    "campo_nombre" => "hora_fin_tra",
                    "campo_marcador" => ":horatrafin",
                    "campo_valor" => $tras_fin
                ], 
                [
                    "campo_nombre" => "hora_ini_eje",
                    "campo_marcador" => ":horainieje",
                    "campo_valor" => $ejec_ini
                ], [
                    "campo_nombre" => "hora_fin_eje",
                    "campo_marcador" => ":horafineje",
                    "campo_valor" => $ejec_fin
                ], [
                    "campo_nombre" => "status",
                    "campo_marcador" => ":status",
                    "campo_valor" => $status
                ], [
                    "campo_nombre" => "observacion",
                    "campo_marcador" => ":observacion",
                    "campo_valor" => $observacion
                ]
            ];

            #Llamada al método guardarDatos() para guardar los datos del miembro en la base de datos
            $registrar_ot = $this->guardarDatos("detalle_orden", $ot_datos_reg);

            #Verificar si se registró correctamente el miembro
            if ($registrar_ot->rowCount() == 1) {
                $this->registrarLog($_SESSION['id'],"REGISTRO DETALLES OT","REGISTRO EXITOSO DE PARA LA OT ".$id);
                #Si se registró correctamente, se devuelve un mensaje de éxito
                $alerta = [
                    "tipo" => "limpiar",
                    "titulo" => "Detalles Registrados",
                    "texto" => "Los detalles de la orden de trabajo se ha registrado con éxito",
                    "icono" => "success"
                ];
            } else {        
                $this->registrarLog($_SESSION['id'],"REGISTRO DETALLES OT","REGISTRO FALLIDO DE PARA LA OT ".$id);       
                #Se devuelve un mensaje de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "Los detalles de la orden de trabajo no han podido registrarse",
                    "icono" => "error"
                ];
            }

            #Se devuelve el mensaje de alerta en formato JSON
            return json_encode($alerta);

        }
        public function modificarDetalleOtControlador(){
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
            if ($id == "" || $cant <= 0 || $turno == "Seleccionar"|| $status == "Seleccionar"|| $cco == "Seleccionar"|| $ccf == "Seleccionar"|| $tecnico == "Seleccionar"|| $prep_ini == ""|| $prep_fin == ""|| $tras_ini == ""|| $tras_fin == ""|| $ejec_ini == ""|| $ejec_fin == "") {
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
                      
            
           # Definición de un array asociativo $miembro_datos_reg que contiene los datos del miembro a registrar
            $ot_datos_reg = [          
                [
                    "campo_nombre" => "cant_tec",
                    "campo_marcador" => ":cant",
                    "campo_valor" => $cant                    
                ],
                [
                    "campo_nombre" => "turno",
                    "campo_marcador" => ":turno",
                    "campo_valor" => $turno
                ],
                [
                    "campo_nombre" => "responsable_cco ",
                    "campo_marcador" => ":cco",
                    "campo_valor" => $cco
                ],
                [
                    "campo_nombre" => "responsable_act",
                    "campo_marcador" => ":responsable",
                    "campo_valor" => $tecnico
                ],
                [
                    "campo_nombre" => "responsable_ccf ",
                    "campo_marcador" => ":ccf",
                    "campo_valor" => $ccf
                ], 
                [
                    "campo_nombre" => "	hora_ini_pre",
                    "campo_marcador" => ":horapreini",
                    "campo_valor" => $prep_ini
                ], [
                    "campo_nombre" => "	hora_fin_pre",
                    "campo_marcador" => ":horaprefin",
                    "campo_valor" => $prep_fin
                ],
                [
                    "campo_nombre" => "hora_ini_tra",
                    "campo_marcador" => ":horatraini",
                    "campo_valor" => $tras_ini
                ],
                [
                    "campo_nombre" => "hora_fin_tra",
                    "campo_marcador" => ":horatrafin",
                    "campo_valor" => $tras_fin
                ], 
                [
                    "campo_nombre" => "hora_ini_eje",
                    "campo_marcador" => ":horainieje",
                    "campo_valor" => $ejec_ini
                ], [
                    "campo_nombre" => "hora_fin_eje",
                    "campo_marcador" => ":horafineje",
                    "campo_valor" => $ejec_fin
                ], [
                    "campo_nombre" => "status",
                    "campo_marcador" => ":status",
                    "campo_valor" => $status
                ], [
                    "campo_nombre" => "observacion",
                    "campo_marcador" => ":observacion",
                    "campo_valor" => $observacion
                ]
            ];

            $condicion=[
				"condicion_campo"=>"n_ot",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

            if($this->actualizarDatos("detalle_orden",$ot_datos_reg,$condicion)){
                $this->registrarLog($_SESSION['id'],"MODIFICAR DETALLES OT","MODIFICACION EXITOSA DE PARA LA OT ".$id);
				$alerta=[
					"tipo"=>"limpiar",
					"titulo"=>"Datos Actualizados",
					"texto"=>"Se actualizo correctamente",
					"icono"=>"success"
				];
			}else{
                $this->registrarLog($_SESSION['id'],"MODIFICAR DETALLES OT","MODIFICACION FALLIDA DE PARA LA OT ".$id);
				$alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "¡Ha ocurrido un error durante el registro!",
                    "icono" => "error"
                ];
			}
			return json_encode($alerta);  

        }
        public function listarOtControlador ($pagina, $registros, $url, $busqueda){
            
            $pagina = $this->limpiarCadena($pagina);
            $registros = $this->limpiarCadena($registros);

            $url = $this->limpiarCadena($url);
            $url= APP_URL.$url."/";

            $busqueda = $this->limpiarCadena($busqueda);

            $tabla="";

            $pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
            $inicio = ($pagina>0) ? (($pagina*$registros)-$registros) : 0;
            
            if (isset($busqueda) && $busqueda!= "") {

                $consulta_datos="SELECT * FROM orden_trabajo WHERE 
                ((n_ot  LIKE '%$busqueda%' OR nombre_trab LIKE '%$busqueda%' AND std_reg='1')) ORDER BY n_ot ASC LIMIT $inicio, $registros";

                $consulta_total="SELECT COUNT(n_ot) FROM orden_trabajo WHERE 
                ((n_ot LIKE '%$busqueda%' OR nombre_trab LIKE '%$busqueda%' AND std_reg='1'))";
         
            } else {
                $consulta_datos="SELECT ot.*, det_ord.status
                FROM orden_trabajo ot
                LEFT JOIN detalle_orden det_ord ON ot.n_ot = det_ord.n_ot WHERE  std_reg='1' ORDER BY ot.n_ot ASC LIMIT $inicio, $registros";

                $consulta_total="SELECT COUNT(ot.n_ot) FROM orden_trabajo ot
                LEFT JOIN detalle_orden det_ord ON ot.n_ot = det_ord.n_ot WHERE  std_reg='1'";
            }
            
            $datos = $this->ejecutarConsulta($consulta_datos);
            $datos = $datos->fetchAll();

            $total = $this->ejecutarConsulta($consulta_total);
            $total = (int) $total->fetchColumn();

            $numeroPaginas = ceil($total/$registros);

            $tabla .='
                    <div class="table-responsive" id="tabla-ot">
                        <table class="table border mb-0 table-info table-hover table-striped">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="clearfix">#</th>
                                <th class="clearfix">
                                    Estado O.T.                                   
                                </th>
                                <th class="clearfix">Codigo</th>
                                <th class="clearfix">Nombre Trabajo</th>
                                <th class="text-center col-auto" colspan="6">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
            ';
            if ($total >= 1 && $pagina <= $numeroPaginas) {
                $contador = $inicio + 1;
                $pag_inicio= $inicio + 1;
                $titulo="";
                $status="";
                foreach ($datos as $rows) {
                    switch ($rows['status']) {
                        case '1':
                            $titulo = "O.T. Ejecutada";
                        break;
                        case '2':
                            $titulo = "O.T. No Ejecutada";
                        break;
                        case '3':
                            $titulo = "O.T. Extemporánea";
                        break;
                        case '4':
                            $titulo = "O.T. Reprogramada";
                        break;
                        case '5':
                            $titulo = "O.T. Suspendida";
                        break; 
                        default:
                            $titulo = "O.T. Sin Detalle";
                        break;              
                    }
                    
                    $tabla.='
                        <tr class="align-middle">
                            <td class="clearfix col-auto">
                                <div class=""><b>'.$contador.'</b></div>
                            </td>
                            <td class="clearfix col-2">
                                <div class="avatar avatar-md" title="'.$titulo.'"><img class="avatar-img"
                                    src="'.APP_URL.'app/views/icons/ot.png"><span
                                    style="position: absolute; bottom: 0; display: block; border: 1px solid #fff;
                                     border-radius: 50em; width: 0.7333333333rem; height: 0.7333333333rem; right: 0; 
                                     background-color: #000000;" ></span>
                                </div>
                                <b>'.$titulo.'</b>
                            </td>                            
                            <td class="col-auto">
                                <div class="clearfix">
                                    <div class=""><b>'.$rows['n_ot'].'</b></div>
                                </div>
                            </td>
                            <td class="">
                                <div class="clearfix">
                                    <div class=""><b>'.$rows['nombre_trab'].'</b></div>
                                </div>
                            </td>                                                      
                            <td class="col-p">
                                <button type="button" title="Ver" class="btn" style="background-color: #EBEDEF; color:white ;">
                                    <img src="'.APP_URL.'app/views/icons/view.png" alt="icono" width="28" height="28">
                                </button>                       
                            </td>
                            <td class="col-p">
                                <button type="button" title="Generar Reporte" class="btn" style="background-color: #EBEDEF; color:white ;">
                                    <img src="'.APP_URL.'app/views/icons/reporte.png" alt="icono" width="28" height="28">
                                </button>                       
                            </td>
                            <td class="col-p">
                                <a href="#" title="Dettalles Orden" id="detalleot" class="btn" data-bs-toggle="modal" data-bs-target="#ventanaModalDetalleOt" data-bs-id="'.$rows['n_ot'].'" style="background-color: #EBEDEF; color:white ;">
                                    <img src="'.APP_URL.'app/views/icons/detalle.png" alt="icono" width="28" height="28" >
                                </a> 
                            </td>
                            <td class="col-p">
                                <a href="'.APP_URL.'herramientaOt/?id='.$rows['n_ot'].'" title="Herramienta" data-bs-id="'.$rows['n_ot'].'" id="herramientaOt" class="btn" style="background-color: #EBEDEF; color:white ;">
                                    <img src="'.APP_URL.'app/views/icons/her.png" alt="icono" width="28" height="28" >
                                </a> 
                            </td>
                            <td class="col-p">
                                <a href="#" title="Modificar" class="btn" data-bs-toggle="modal" data-bs-target="#ventanaModalModificarOt" data-bs-id="'.$rows['n_ot'].'" style="background-color: #EBEDEF; color:white ;">
                                    <img src="'.APP_URL.'app/views/icons/edit.png" alt="icono" width="28" height="28" >
                                </a> 
                            </td>
                            <td class="col-p">
                                <form class="FormularioAjax" action="'.APP_URL.'app/ajax/miembroAjax.php" method="POST">
                                    <input type="hidden" name="modulo_miembro" value="eliminar">
                                    <input type="hidden" name="miembro_id" value="'.$rows['n_ot'].'">
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
                    <p>Mostrando O.T. <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un 
                    <strong>total de '.$total.'</strong></p>
                ';

                $tabla .= $this->paginadorTablas($pagina, $numeroPaginas, $url, 5);
            }

            return $tabla;
        }
        /**
         * Genera un combo de opciones de miembros según el tipo especificado.
         * 
         * @param int $tipo El tipo de miembro para el cual se generará el combo.
         * @return string El HTML del combo de opciones.
         */
        public function listarComboOtControlador ($tipo){        

            // Variable para almacenar el HTML del combo
            $combo="";            

            // Consulta para obtener los datos de los miembros según el tipo especificado
            $consulta_datos="SELECT * FROM miembro WHERE tipo_miembro = $tipo";
            
            // Ejecutar la consulta para obtener los datos de los miembros
            $datos = $this->ejecutarConsulta($consulta_datos);
            $datos = $datos->fetchAll();

            // Comprobar el tipo de miembro para determinar la etiqueta del combo
            if ($tipo == 1) {
                // Si el tipo es 1, el combo es para el responsable de control de falla 
                $combo .='
                    <label class="form-label">RESP. CCF:</label>
                    <select class="form-select" id="ccf" name="ccf" aria-label="Default select example">
                        <option selected>Seleccionar</option>
                ';
            } else {
                // Si el tipo no es 1, el combo es para el responsable de control de operaciones
                $combo .='
                    <label class="form-label">RESP. CCO:</label>
                    <select class="form-select" id="cco" name="cco" aria-label="Default select example">
                        <option selected>Seleccionar</option>
                ';
            }            
            
            // Comprobar si hay miembros disponibles para mostrar en el combo
            if (count($datos) > 0) { 
                // Si hay miembros disponibles, iterar sobre ellos y agregar opciones al combo
                foreach ($datos as $rows) {
                    $combo.='
                        <option value="'.$rows['id_miembro'].'">'.$rows['nombre_miembro'].'</option>
                    ';
                }
            } 
            
            // Cerrar el combo y devolver el HTML generado
            $combo .='</select>';
                    
            return $combo;
        } 
        
        public function listarComboTecControlador (){        

            // Variable para almacenar el HTML del combo
            $combo="";            

            // Consulta para obtener los datos de los miembros según el tipo especificado
            $consulta_datos="SELECT * FROM user_system WHERE std_reg=1";
            
            // Ejecutar la consulta para obtener los datos de los miembros
            $datos = $this->ejecutarConsulta($consulta_datos);
            $datos = $datos->fetchAll();

            // Comprobar el tipo de miembro para determinar la etiqueta del combo
          
            // Si el tipo no es 1, el combo es para el responsable de control de operaciones
            $combo .='
                <label class="form-label">Tecnico Resp.:</label>
                <select class="form-select" id="tec" name="tec" aria-label="Default select example">
                    <option selected>Seleccionar</option>
            ';
                      
            
            // Comprobar si hay miembros disponibles para mostrar en el combo
            if (count($datos) > 0) { 
                // Si hay miembros disponibles, iterar sobre ellos y agregar opciones al combo
                foreach ($datos as $rows) {
                    $combo.='
                        <option value="'.$rows['id_user'].'">'.$rows['user'].'</option>
                    ';
                }
            } 
            
            // Cerrar el combo y devolver el HTML generado
            $combo .='</select>';
                    
            return $combo;
        } 
        
        public function listarComboUserControlador (){        

            // Variable para almacenar el HTML del combo
            $combo="";            

            // Consulta para obtener los datos de los miembros según el tipo especificado
            $consulta_datos="SELECT * FROM user_system WHERE std_reg=1";
            
            // Ejecutar la consulta para obtener los datos de los miembros
            $datos = $this->ejecutarConsulta($consulta_datos);
            $datos = $datos->fetchAll();

            // Comprobar el tipo de miembro para determinar la etiqueta del combo
            // Si el tipo es 1, el combo es para el responsable de control de falla 
            $combo .='
                <select class="form-select" id="user" name="user" aria-label="Default select example">
                    <option selected>Seleccionar</option>
            ';
            
            
            // Comprobar si hay miembros disponibles para mostrar en el combo
            if (count($datos) > 0) { 
                // Si hay miembros disponibles, iterar sobre ellos y agregar opciones al combo
                foreach ($datos as $rows) {
                    $combo.='
                        <option value="'.$rows['id_user'].'">'.$rows['id_user'].' - '.$rows['user'].'</option>
                    ';
                }
            } 
            
            // Cerrar el combo y devolver el HTML generado
            $combo .='</select>';
                    
            return $combo;
        }
        public function eliminarOtControlador(){
            
            $id = $this->limpiarCadena($_POST['miembro_id']);

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
            $datos = $this->ejecutarConsulta("SELECT * FROM miembro WHERE n_ot='$id'");
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
            
            $eliminarUsuario = $this->eliminarRegistro('miembro', 'n_ot', $id);

            if ($eliminarUsuario->rowCount() == 1) {
                $alerta = [
                    "tipo" => "recargar",
                    "titulo" => "Miembro Eliminado",
                    "texto" => "El Miembro ".$datos['nombre_trab']." ha sido eliminado con exito",
                    "icono" => "success"                    
                ];                
            } else {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "No se pudo eliminar el Miembro, por favor intente nuevamente",
                    "icono" => "error"
                ];                
            }
            return json_encode($alerta);
        }
             
    }