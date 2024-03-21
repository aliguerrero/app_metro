<?php
    namespace app\controllers;
    use app\models\mainModel;

    class loginController extends mainModel{
        # controlador iniciar sesion #
        public function iniciarSesionControlador(){
            // Se obtienen y limpian los datos del formulario
            $username = $this->limpiarCadena($_POST['username']);
            $password = $this->limpiarCadena($_POST['password']);
            # verificando campor obligatorio #
            if ($username == "" || $password == "") {
                echo "
                    <script>
                        // Mostrar una alerta simple usando SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Ocurrio un error inesperado',
                            text: 'No has llenado todos los campos que son obligatorios',
                            confirmButtonText: 'Aceptar'
                        });
                    </script> 
                ";
            }else{
                # Verificar la integridad de los datos de código #
                if ($this->verificarDatos('[a-zA-Z0-9]{4,20}', $username)) {
                    echo "
                        <script>
                            // Mostrar una alerta simple usando SweetAlert
                            Swal.fire({
                                icon: 'error',
                                title: 'Ocurrio un error inesperado',
                                text: 'El USERNAME no cumple con el formato solicitado',
                                confirmButtonText: 'Aceptar'
                            });
                        </script> 
                    ";
                } else {
                    if ($this->verificarDatos('[a-zA-Z0-9$@.-]{7,100}', $password)) {
                        echo "
                            <script>
                                // Mostrar una alerta simple usando SweetAlert
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ocurrio un error inesperado',
                                    text: 'La CLAVE no cumple con el formato solicitado',
                                    confirmButtonText: 'Aceptar'
                                });
                            </script> 
                        ";
                    } else {
                        # Verificar el username #
                        $check_username = $this->ejecutarConsulta("SELECT * FROM user_system WHERE username='$username'");
                        if ($check_username->rowCount()==1) {
                            $check_username = $check_username->fetch();
                            if ($check_username['username'] == $username && password_verify($password,$check_username['password'])) {
                                $_SESSION['id']= $check_username['id_user'];
                                $_SESSION['user']= $check_username['user'];
                                $_SESSION['username']= $check_username['username'];
                                $_SESSION['tipo']= $check_username['tipo'];
                                if (headers_sent()) {
                                    echo "
                                        <script>
                                            window.location.href='".APP_URL."dashboard';
                                        </script> 
                                    ";
                                } else {                                    
                                    header("Location: ".APP_URL."dashboard");
                                }
                                
                            } else {
                                echo "
                                    <script>
                                        // Mostrar una alerta simple usando SweetAlert
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Ocurrio un error inesperado',
                                            text: 'Usuario o clave incorrectos',
                                            confirmButtonText: 'Aceptar'
                                        });
                                    </script> 
                                ";
                            }
                            
                        }else{
                            echo "
                                <script>
                                    // Mostrar una alerta simple usando SweetAlert
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Ocurrio un error inesperado',
                                        text: 'Username o Clave inconrrectos',
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
            session_destroy();
            if (headers_sent()) {
                echo "
                    <script>
                        window.location.href='".APP_URL."login';
                    </script> 
                ";
            } else {
                header("Location: ".APP_URL."login");
            }
        }
    }