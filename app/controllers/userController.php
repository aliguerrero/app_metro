<?php
    namespace app\controllers;
    use app\models\mainModel;

    class userController extends mainModel{
        
        public function registrarUserControlador(){
            // Se obtienen y limpian los datos del formulario
            $cedula = $this->limpiarCadena($_POST['cedula']);
            $nombre = $this->limpiarCadena($_POST['nombre']);
            $username = $this->limpiarCadena($_POST['username']);
            $clave1 = $this->limpiarCadena($_POST['clave1']);
            $clave2 = $this->limpiarCadena($_POST['clave2']);
            $tipo   = $this->limpiarCadena($_POST['tipo']);
        
            # Verificación de campos obligatorios #
            if ($cedula == "" || $nombre == "" || $username == ""|| $clave1 == ""|| $clave2 == ""|| $tipo == "Seleccionar") {
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
        
            # Verificar la integridad de los datos de cédula #
            if ($this->verificarDatos('^[0-9]{6,10}$', $cedula)) {
                // Si el formato de la cédula no es válido, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "La cédula no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
        
            # Verificar el Cedula #
            $check_cedula = $this->ejecutarConsulta("SELECT id_user FROM user_system WHERE id_user='$cedula'");
            if ($check_cedula->rowCount() > 0) {
                // Si la Cédula ya existe en la base de datos, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "La Cédula ingresada ya existe en los registros",
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
                    "texto" => "El nombre de usuario no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
        
            # Verificar la integridad de los datos de nombre de usuario #
            if ($this->verificarDatos('[a-zA-Z0-9]{4,20}', $username)) {
                // Si el formato del nombre de usuario no es válido, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El username no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
        
            # Verificar el username #
            $check_username = $this->ejecutarConsulta("SELECT username FROM user_system WHERE username='$username'");
            if ($check_username->rowCount() > 0) {
                // Si el username ya existe en la base de datos, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El username ingresado ya existe en los registros",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
        
            # Verificar las claves #
            if ($clave1 != $clave2) {
                // Si las claves no coinciden, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "Las claves no coinciden",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            } else {
                // Si coinciden, se crea un hash de la clave
                $clave = password_hash($clave1,PASSWORD_BCRYPT,["cost="=> 10]);
            }
        
            # Verificar la integridad de los datos de la clave #
            if ($this->verificarDatos('[a-zA-Z0-9$@.-]{8,15}', $clave1)) {
                // Si el formato de la clave no es válido, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "La clave no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
        
            // Definición de un array asociativo $user_datos_reg que contiene los datos del usuario a registrar
            $user_datos_reg=[
                [
                    "campo_nombre"=>"id_user",
                    "campo_marcador"=>":Cedula",
                    "campo_valor"=> $cedula
                ],
                [
                    "campo_nombre"=>"user",
                    "campo_marcador"=>":Nombre",
                    "campo_valor"=> $nombre
                ],
                [
                    "campo_nombre"=>"username",
                    "campo_marcador"=>":Username",
                    "campo_valor"=> $username
                ],
                [
                    "campo_nombre"=>"password",
                    "campo_marcador"=>":Pass",
                    "campo_valor"=> $clave
                ],
                [
                    "campo_nombre"=>"tipo",
                    "campo_marcador"=>":Tipo",
                    "campo_valor"=> $tipo
                ],
                [
                    "campo_nombre"=>"std_reg",
                    "campo_marcador"=>":std_reg",
                    "campo_valor"=> "1"
                ]
            ];
        
            // Llamada al método guardarDatos() para guardar los datos del usuario en la base de datos
            $registrar_user= $this->guardarDatos("user_system", $user_datos_reg);
        
            if ($registrar_user->rowCount()==1) {
                $this->registrarLog($_SESSION['id'],"REGISTRO DE USUARIO","REGISTRO EXITOSO DEL USUARIO ".$nombre);
                // Si se registró correctamente, se devuelve un mensaje de éxito
                $alerta = [
                    "tipo" => "limpiar",
                    "titulo" => "Usuario Registrado",
                    "texto" => "El Usuario ".$nombre." se ha registrado con éxito",
                    "icono" => "success"
                ];            
            } else {      
                $this->registrarLog($_SESSION['id'],"REGISTRO DE USUARIO","REGISTRO FALLIDO DEL USUARIO ".$nombre);      
                // Si no se pudo registrar, se devuelve un mensaje de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El Usuario no se pudo registrar correctamente",
                    "icono" => "error"
                ];
            }
            return json_encode($alerta);
        }
        

        # controlador listar usuarios # 
        public function listarUsuarioControlador ($pagina, $registros, $url, $busqueda){
            
            $pagina = $this->limpiarCadena($pagina);
            $registros = $this->limpiarCadena($registros);

            $url = $this->limpiarCadena($url);
            $url= APP_URL.$url."/";

            $busqueda = $this->limpiarCadena($busqueda);

            $tabla="";

            $pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
            $inicio = ($pagina>0) ? (($pagina*$registros)-$registros) : 0;
            
            if (isset($busqueda) && $busqueda!= "") {

                $consulta_datos="SELECT * FROM user_system WHERE 
                ((id_user!='".$_SESSION['id']."' AND tipo!='1' AND 	std_reg='1') AND (user LIKE '%$busqueda%' 
                OR id_user LIKE '%$busqueda%' OR username LIKE '%$busqueda%')) ORDER 
                BY user ASC LIMIT $inicio, $registros";

                $consulta_total="SELECT COUNT(id_user) FROM user_system WHERE 
                ((id_user!='".$_SESSION['id']."' AND tipo!='1' AND 	std_reg='1') AND (user LIKE '%$busqueda%' 
                OR id_user LIKE '%$busqueda%' OR username LIKE '%$busqueda%'))";
         
            } else {
                $consulta_datos="SELECT * FROM user_system WHERE
                id_user!='".$_SESSION['id']."' AND 	std_reg='1' ORDER
                BY user ASC LIMIT $inicio, $registros";

                $consulta_total="SELECT COUNT(id_user) FROM user_system WHERE
                id_user!='".$_SESSION['id']."' AND 	std_reg='1'";
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
                                <th class="clearfix">
                                    <svg class="icon">
                                        <use xlink:href="'.APP_URL.'app/views/icons/svg/free.svg#cil-people"></use>
                                    </svg>
                                </th>
                                <th class="clearfix">Cedula</th>
                                <th class="clearfix">Nombre Completo </th>
                                <th class="text-center">Tipo de Cuenta</th>
                                <th class="text-center" colspan="4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
            ';
            if ($total >= 1 && $pagina <= $numeroPaginas) {
                $contador = $inicio + 1;
                $pag_inicio= $inicio + 1;
                $tipo_user="";
                foreach ($datos as $rows) {
                    if($rows['tipo']=='1'){
                        $tipo_user="Administrador";
                    }else{
                        $tipo_user="Operador";
                    }
                    $tabla.='
                        <tr class="align-middle">
                            <td class="clearfix col-p">
                                <div class=""><b>'.$contador.'</b></div>
                            </td>
                            <td class="clearfix col-p">
                                <div class="avatar avatar-md"><img class="avatar-img"
                                        src="'.APP_URL.'app/views/img/avatars/user.png" alt="user@email.com"><span
                                        class="avatar-status bg-success"></span></div>
                            </td>                            
                            <td class="col-p">
                                <div class="clearfix">
                                    <div class=""><b>'.$rows['id_user'].'</b></div>
                                </div>
                            </td>
                            <td>
                                <div class="clearfix">
                                    <div class=""><b>'.$rows['user'].'</b></div>
                                </div>
                            </td>
                            <td class="col-p">
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
                                <a href="#" title="Cambiar Clave" class="btn" data-bs-toggle="modal" data-bs-target="#ventanaModalModificarPass" data-bs-id="'.$rows['id_user'].'" style="background-color: #EBEDEF; color:white ;">
                                    <img src="'.APP_URL.'app/views/icons/password.png" alt="icono" width="28" height="28" >
                                </a> 
                            </td>
                            <td class="col-p">                              
                                <a href="#" title="Modificar" class="btn" data-bs-toggle="modal" data-bs-target="#ventanaModalModificar" data-bs-id="'.$rows['id_user'].'" style="background-color: #EBEDEF; color:white ;">
                                    <img src="'.APP_URL.'app/views/icons/edit.png" alt="icono" width="28" height="28" >
                                </a> 
                            </td>
                            <td class="col-p">
                                <form class="FormularioAjax" action="'.APP_URL.'app/ajax/userAjax.php" method="POST">
                                    <input type="hidden" name="modulo_user" value="eliminar">
                                    <input type="hidden" name="id_user" value="'.$rows['id_user'].'">
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
                    <p>Mostrando usuarios <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un 
                    <strong>total de '.$total.'</strong></p>
                ';

                $tabla .= $this->paginadorTablas($pagina, $numeroPaginas, $url, 5);
            }

            return $tabla;
        }

        # eliminar usuario 
        public function eliminarUserControlador(){
            
            $id = $this->limpiarCadena($_POST['id_user']);
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
            $datos = $this->ejecutarConsulta("SELECT * FROM user_system WHERE id_user='$id'");
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
                    "campo_nombre" => "id_user",
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
				"condicion_campo"=>"id_user",
				"condicion_marcador"=>":id_user",
				"condicion_valor"=>$id
			];

            if($this->actualizarDatos("user_system",$datos_reg,$condicion)){
                $this->registrarLog($_SESSION['id'],"ELIMINACION DE USUARIO","ELIMINACION EXITOSA DEL USUARIO ".$datos['user']);
                $alerta = [
                    "tipo" => "recargar",
                    "titulo" => "Usuario Eliminador",
                    "texto" => "El Usuario ".$datos['user']." ha sido eliminado con exito",
                    "icono" => "success"                    
                ];                
            } else {
                $this->registrarLog($_SESSION['id'],"ELIMINACION DE USUARIO","ELIMINACION FALLIDA DEL USUARIO ".$datos['user']);
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "No se pudo eliminar el usuario, por favor intente nuevamente",
                    "icono" => "error"
                ];                
            }
            return json_encode($alerta);
        }

        # cargar datis de la tabla 
        public function cargarUserControlador() {
            $id = $this->limpiarCadena($_POST['id_user']);
            
            # Verificar el usuario
            $datos = $this->ejecutarConsulta("SELECT * FROM user_system WHERE id_user='$id'");
            
            if ($datos->rowCount() <= 0) {
                // Si no se encuentra el usuario, registra un mensaje de error y devuelve un resultado indicando que no se encontró el usuario
                error_log("No se encontró el usuario en la base de datos. ID de usuario: $id");
                
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "No hemos encontrado el usuario en el sistema",
                    "icono" => "error"
                ];                
                return json_encode($alerta);
                exit();
            } else {
                // Si se encuentra el usuario, obtén los datos y devuélvelos en un arreglo asociativo
                $datosUsuario = $datos->fetch(PDO::FETCH_ASSOC);
                return $datosUsuario;
            }
        }

        public function actualizarDatosUser(){
            $id = $this->limpiarCadena($_POST['id']);

            $cedula = $this->limpiarCadena($_POST['cedula']);
            $nombre = $this->limpiarCadena($_POST['nombre']);
            $username = $this->limpiarCadena($_POST['username']);
            $tipo   = $this->limpiarCadena($_POST['tipo']);

            # Verificación de campos obligatorios #
            if ($cedula == "" || $nombre == "" || $username == ""|| $tipo == "Seleccionar") {
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
            if ($this->verificarDatos('^[0-9]{6,8}$', $cedula)) {
                // Si el formato del código no es válido, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "La CEDULA no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }  
            #VERIFICAR LA CEDULA NO EXISTA        
            $check_cedula = $this->ejecutarConsulta("SELECT * FROM user_system WHERE id_user='$cedula' AND id_user!='$id'" );
            if ($check_cedula->rowCount() > 0) {
                // Si el username ya existe en la base de datos, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "La CEDULA ingresado ya existe en los registros",
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
            # Verificar la integridad de los datos de nombre #
            if ($this->verificarDatos('[a-zA-Z0-9]{4,20}', $username)) {
                // Si el formato del nombre no es válido, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El USERNAME no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
            # Verificar el username #
            $check_username = $this->ejecutarConsulta("SELECT username FROM user_system WHERE username='$username' AND id_user!='$id'");
            if ($check_username->rowCount() > 0) {
                // Si el username ya existe en la base de datos, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El USERNAME ingresado ya existe en los registros",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }            

            $user_datos=[
                [
                    "campo_nombre"=>"id_user",
                    "campo_marcador"=>":Cedula",
                    "campo_valor"=> $cedula
                ],
                [
                    "campo_nombre"=>"user",
                    "campo_marcador"=>":Nombre",
                    "campo_valor"=> $nombre
                ],
                [
                    "campo_nombre"=>"username",
                    "campo_marcador"=>":Username",
                    "campo_valor"=> $username
                ],
                [
                    "campo_nombre"=>"tipo",
                    "campo_marcador"=>":Tipo",
                    "campo_valor"=> $tipo
                ]
            ];

            $condicion=[
				"condicion_campo"=>"id_user",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

            if($this->actualizarDatos("user_system",$user_datos,$condicion)){
                $this->registrarLog($_SESSION['id'],"ACTUALIZACION DE DATOS","ACTUALIZACION EXITOSA");
				$alerta=[
					"tipo"=>"limpiar",
					"titulo"=>"Datos Actualizados",
					"texto"=>"Se actualizo correctamente",
					"icono"=>"success"
				];
			}else{
                $this->registrarLog($_SESSION['id'],"ACTUALIZACION DE DATOS","ERROR EN LA ACTUALIZACION");
				$alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "¡Ha ocurrido un error durante el registro!",
                    "icono" => "error"
                ];
			}
			return json_encode($alerta);                  
        }
        
    
        /**
         * Método para actualizar la clave de un usuario en la base de datos.
         * 
         * Este método recibe los datos de la nueva clave desde un formulario y realiza
         * las validaciones necesarias antes de actualizar la clave en la base de datos.
         * 
         * @return string JSON con un mensaje de éxito o error según el resultado de la operación.
         */
        public function actualizarClaveUser(){
            // Obtener el ID del usuario desde el formulario y limpiar los datos
            $id = $this->limpiarCadena($_POST['id2']);

            // Obtener y limpiar las claves proporcionadas desde el formulario
            $clave1 = $this->limpiarCadena($_POST['clave1']);
            $clave2 = $this->limpiarCadena($_POST['clave2']);
        
            # Verificación de campos obligatorios #
            if ($clave1 == ""|| $clave2 == "") {
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

            # Verificar las claves #
            if ($clave1 != $clave2) {
                // Si las claves no coinciden, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "Las claves no coinciden",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            } else {
                // Si coinciden, se crea un hash de la clave
                $clave = password_hash($clave1,PASSWORD_BCRYPT,["cost="=> 10]);
            }
            
            # Verificar la integridad de los datos de clave #
            if ($this->verificarDatos('[a-zA-Z0-9$@.-]{8,15}', $clave1)) {
                // Si el formato del nombre no es válido, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "La clave no cumple con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }

            // Definir los datos a actualizar en la base de datos
            $user_datos=[                
                [
                    "campo_nombre"=>"password",
                    "campo_marcador"=>":Pass",
                    "campo_valor"=> $clave
                ]
            ];

            // Definir la condición para identificar al usuario cuya clave se actualizará
            $condicion=[
                "condicion_campo"=>"id_user",
                "condicion_marcador"=>":ID",
                "condicion_valor"=>$id
            ];

            // Intentar actualizar la clave en la base de datos
            if($this->actualizarDatos("user_system",$user_datos,$condicion)){
                $this->registrarLog($_SESSION['id'],"CAMBIO DE CLAVE","CLAVE MODIFICADA EXITOSAMENTE"); 
                // Si se actualiza correctamente, se devuelve un mensaje de éxito
                $alerta=[
                    "tipo"=>"limpiar",
                    "titulo"=>"Contraseña Actualizada",
                    "texto"=>"Se actualizó correctamente",
                    "icono"=>"success"
                ];
            } else {
                $this->registrarLog($_SESSION['id'],"CAMBIO DE CLAVE","ERROR AL MODIFICAR LA CLAVE"); 
                // Si ocurre algún error durante la actualización, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "¡Ha ocurrido un error durante la actualización!",
                    "icono" => "error"
                ];
            }

            // Devolver el mensaje resultante en formato JSON
            return json_encode($alerta);                  
        }       

    }