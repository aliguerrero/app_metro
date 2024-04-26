<?php
    namespace app\controllers;
    use app\models\mainModel;

    class loginController extends mainModel{
        # controlador iniciar sesion #
        public function iniciarSesionControlador(){
            // Se obtienen y limpian los datos del formulario
            $username = $this->limpiarCadena($_POST['username']);
            $password = $this->limpiarCadena($_POST['password']);
        
            // Verificar campos obligatorios
            if ($username == "" || $password == "") {
                // Mostrar alerta si los campos obligatorios no están completos
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Ocurrio un error inesperado',
                            text: 'No has llenado todos los campos que son obligatorios',
                            confirmButtonText: 'Aceptar'
                        });
                    </script>
                ";
            }else{
                // Verificar la integridad de los datos del username
                if ($this->verificarDatos('[a-zA-Z0-9]{4,20}', $username)) {
                    // Mostrar alerta si el username no cumple con el formato solicitado
                    echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Ocurrio un error inesperado',
                                text: 'El USERNAME no cumple con el formato solicitado',
                                confirmButtonText: 'Aceptar'
                            });
                        </script>
                    ";
                } else {
                    // Verificar la integridad de los datos de la contraseña
                    if ($this->verificarDatos('[a-zA-Z0-9$@.-]{7,100}', $password)) {
                        // Mostrar alerta si la contraseña no cumple con el formato solicitado
                        echo "
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ocurrio un error inesperado',
                                    text: 'La CLAVE no cumple con el formato solicitado',
                                    confirmButtonText: 'Aceptar'
                                });
                            </script>
                        ";
                    } else {
                        
                        // Verificar el username en la base de datos
                        $check_username = $this->ejecutarConsulta("SELECT * FROM user_system WHERE username='$username'");
                        if ($check_username->rowCount()==1) {
                            $check_username = $check_username->fetch();
                            // Verificar si el username y la contraseña coinciden
                            if ($check_username['username'] == $username && password_verify($password,$check_username['password'])  ) { 
                                if ($check_username['std_reg'] == 1) {
                                    $this->registrarLog($check_username['id_user'],"INICIAR SESION","ACCESO CONCEDIDO");                                                       
                                    // Establecer variables de sesión y redirigir al usuario al panel de control
                                    $_SESSION['id']= $check_username['id_user'];
                                    $_SESSION['user']= $check_username['user'];
                                    $_SESSION['username']= $check_username['username'];
                                    $_SESSION['tipo']= $check_username['tipo'];
                                    if (headers_sent()) {
                                        echo "
                                            <script>
                                                window.location.href='".APP_URL."dashboard/';
                                            </script>
                                        ";
                                    } else {
                                        header("Location: ".APP_URL."dashboard/");
                                    } 
                                } else {
                                    $this->registrarLog($check_username['id_user'],"INICIAR SESION","USUARIO ELIMINADO HA INTENTADO INICIAR SESION");
                                    echo "
                                    <script>
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Acceso denegado',
                                            text: 'Su cuenta ha sido eliminada',
                                            confirmButtonText: 'Aceptar'
                                        });
                                    </script>
                                ";
                                }
                                
                                                       
                            } else {                                
                                 
                                $this->registrarLog($check_username['id_user'],"INICIAR SESION","ACCESO DENEGADO, CLAVE INCORRECTA"); 
                                // Mostrar alerta si el username o la contraseña son incorrectos
                                echo "
                                    <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Ocurrio un error inesperado',
                                            text: 'Clave incorrecta',
                                            confirmButtonText: 'Aceptar'
                                        });
                                    </script>
                                ";
                            }
                        }else{
                            // Mostrar alerta si el username no está registrado en la base de datos
                            echo "
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Ocurrio un error inesperado',
                                        text: 'Username o Clave incorrectos',
                                        confirmButtonText: 'Aceptar'
                                    });
                                </script>
                            ";
                        }
                    }
                }    
            }
        }        
        
        # controlador cerrar sesion #
        public function cerrarSesionControlador(){
            // Destruir todas las variables de sesión
            session_destroy();
            // Verificar si se han enviado encabezados HTTP al navegador
            if (headers_sent()) {
                // Si los encabezados ya se han enviado, redirigir mediante JavaScript
                echo "
                    <script>
                        // Redirigir a la página de inicio de sesión
                        window.location.href='".APP_URL."login/';
                    </script> 
                ";
            } else {
                // Si los encabezados no se han enviado, redirigir mediante encabezados de PHP
                header("Location: ".APP_URL."login/");
            }
        }
        
    }