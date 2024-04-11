<?php
    // Se incluyen los archivos necesarios
    require_once "../../config/app.php"; // Archivo de configuración de la aplicación
    require_once "../views/inc/session_start.php"; // Archivo para iniciar la sesión
    require_once "../../autoload.php"; // Archivo de carga automática de clases

    // Se importa la clase userController del namespace app\controllers
    use app\controllers\userController;

    // Se verifica si se ha enviado el parámetro 'modulo_user' a través del método POST
    if (isset($_POST['modulo_user'])) {
        // Se crea una instancia de la clase userController
        $insUser = new userController();

        // Se verifica el valor del parámetro 'modulo_user'
        if ($_POST['modulo_user'] == "registrar") {
            // Si el valor es "registrar", se llama al método registrarUserControlador de la instancia $insUser y se muestra el resultado
            echo $insUser->registrarUserControlador();
        }
        if ($_POST['modulo_user'] == "eliminar") {
            // Si el valor es "eliminar", se llama al método eliminarUserControlador de la instancia $insUser y se muestra el resultado
            echo $insUser->eliminarUserControlador();
        }
        if ($_POST['modulo_user'] == "modificar") {
            // Si el valor es "eliminar", se llama al método eliminarUserControlador de la instancia $insUser y se muestra el resultado
            echo $insUser->actualizarDatosUser();
        } 
        if ($_POST['modulo_user'] == "clave") {
            // Si el valor es "eliminar", se llama al método eliminarUserControlador de la instancia $insUser y se muestra el resultado
            echo $insUser->actualizarClaveUser();
        }               
    } else {
        // Si no se ha enviado el parámetro 'modulo_user' a través del método POST, se destruye la sesión y se redirige al usuario a la página de inicio de sesión
        session_destroy();
        header("Location: ".APP_URL."login/");
    }