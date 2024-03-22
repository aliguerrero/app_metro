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

            # Verificar la integridad de los datos de código #
            if ($this->verificarDatos('^[0-9]{6,10}$', $cedula)) {
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
            # Verificar el Cedula #
            $check_cedula = $this->ejecutarConsulta("SELECT id_user FROM user_system WHERE id_user='$cedula'");
            if ($check_cedula->rowCount() > 0) {
                // Si la Cedula ya existe en la base de datos, se devuelve una alerta de error
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "La Cedula ingresada ya existe en los registros",
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
            $check_username = $this->ejecutarConsulta("SELECT username FROM user_system WHERE username='$username'");
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
            if ($this->verificarDatos('[a-zA-Z0-9$@.-]{7,100}', $clave1)) {
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
                ]
            ];

            $registrar_user= $this->guardarDatos("user_system", $user_datos_reg);

            if ($registrar_user->rowCount()==1) {
                $alerta = [
                    "tipo" => "limpiar",
                    "titulo" => "Usuario Registrado",
                    "texto" => "El Usuario ".$nombre." se ha resgitrado con exito",
                    "icono" => "success"
                ];            
            }else{            
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
                ((id_user!='".$_SESSION['id']."' AND tipo!='1') AND (user LIKE '%$busqueda%' 
                OR id_user LIKE '%$busqueda%' OR username LIKE '%$busqueda%')) ORDER 
                BY user ASC LIMIT $inicio, $registros";

                $consulta_total="SELECT COUNT(id_user) FROM user_system WHERE 
                ((id_user!='".$_SESSION['id']."' AND tipo!='1') AND (user LIKE '%$busqueda%' 
                OR id_user LIKE '%$busqueda%' OR username LIKE '%$busqueda%'))";
         
            } else {
                $consulta_datos="SELECT * FROM user_system WHERE
                id_user!='".$_SESSION['id']."' ORDER
                BY user ASC LIMIT $inicio, $registros";

                $consulta_total="SELECT COUNT(id_user) FROM user_system WHERE
                id_user!='".$_SESSION['id']."'";
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
                                <th class="clearfix">Acciones</th>
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
                            <td class="clearfix">
                                <div class="">'.$contador.'</div>
                            </td>
                            <td class="text-center">
                                <div class="avatar avatar-md"><img class="avatar-img"
                                        src="'.APP_URL.'app/views/img/avatars/user.png" alt="user@email.com"><span
                                        class="avatar-status bg-success"></span></div>
                            </td>                            
                            <td>
                                <div class="clearfix">
                                    <div class="">'.$rows['id_user'].'</div>
                                </div>
                            </td>
                            <td>
                                <div class="clearfix">
                                    <div class="">'.$rows['user'].'</div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <div class="">'.$rows['tipo'].'</div>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-transparent p-0" type="button"
                                        data-coreui-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <svg class="icon">
                                            <use
                                                xlink:href="'.APP_URL.'app/views/icons/svg/free.svg#cil-options">
                                            </use>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Ver</a>
                                        <a class="dropdown-item" href="#">Editar</a>
                                        <form class="FormularioAjax" action="<?php APP_URL ?>app/ajax/userAjax.php" method="POST" autocomplete="off">
                                            <input type="hidden" name="modulo_user" value="eliminar">
                                            <input type="hidden" name="usuario_id" value="'.$rows['id_user'].'">
                                            <a class="dropdown-item text-danger" href="#" type="submit">Eliminar</a>
                                        </form>
                                    </div>
                                </div>
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
                                <a class="btn btn-primary" href="'.$url.'1/" role="button">Haga clic para recargar la tabla</a>
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
    }