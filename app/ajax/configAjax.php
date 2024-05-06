<?php
    // Se incluyen los archivos necesarios
    require_once "../../config/app.php"; // Archivo de configuración de la aplicación
    require_once "../views/inc/session_start.php"; // Archivo para iniciar la sesión
    require_once "../../autoload.php"; // Archivo de carga automática de clases

    // Se importa la clase userController del namespace app\controllers
    use app\controllers\configController;

    // Se verifica si se ha enviado el parámetro 'modulo_rol' a través del método POST
    if (isset($_POST['modulo_rol'])) {
        // Se crea una instancia de la clase userController
        $insConfig = new configController();
        // Se verifica el valor del parámetro 'modulo_rol'       
        if ($_POST['modulo_rol'] == "registrar_rol") {
            // Si el valor es "registrar", se llama al método registrarUserControlador de la instancia $insUser y se muestra el resultado
            echo $insConfig->registrarRolControlador();
        }
        if ($_POST['modulo_rol'] == "modificar_rol") {
            // Si el valor es "eliminar", se llama al método eliminarUserControlador de la instancia $insUser y se muestra el resultado
            echo $insConfig->ModificarRolControlador();
        }
        if ($_POST['modulo_rol'] == "eliminar_rol") {
            // Si el valor es "eliminar", se llama al método eliminarUserControlador de la instancia $insUser y se muestra el resultado
            echo $insConfig->eliminarRolControlador();
        }
        if ($_POST['modulo_rol'] == "registrar_area") {
            echo $insConfig->registrarAreaControlador();
            // Si el valor es "eliminar", se llama al método eliminarUserControlador de la instancia $insUser y se muestra el resultado
        }
        if ($_POST['modulo_rol'] == "eliminar_area") {
            // Si el valor es "eliminar", se llama al método eliminarUserControlador de la instancia $insUser y se muestra el resultado
            echo $insConfig->eliminarAreaControlador();
        }  
        if ($_POST['modulo_rol'] == "registrar_estado") {
            echo $insConfig->registrarEstadoControlador();
            // Si el valor es "eliminar", se llama al método eliminarUserControlador de la instancia $insUser y se muestra el resultado
        }
        if ($_POST['modulo_rol'] == "eliminar_estado") {
            // Si el valor es "eliminar", se llama al método eliminarUserControlador de la instancia $insUser y se muestra el resultado
            echo $insConfig->eliminarEstadoControlador();
        }
        if ($_POST['modulo_rol'] == "registrar_sitio") {
            echo $insConfig->registrarSitioControlador();
            // Si el valor es "eliminar", se llama al método eliminarUserControlador de la instancia $insUser y se muestra el resultado
        }
        if ($_POST['modulo_rol'] == "eliminar_sitio") {
            // Si el valor es "eliminar", se llama al método eliminarUserControlador de la instancia $insUser y se muestra el resultado
            echo $insConfig->eliminarSitioControlador();
        }
        if ($_POST['modulo_rol'] == "registrar_turno") {
            echo $insConfig->registrarTurnoControlador();
            // Si el valor es "eliminar", se llama al método eliminarUserControlador de la instancia $insUser y se muestra el resultado
        }              
    } else {
        // Si no se ha enviado el parámetro 'modulo_rol' a través del método POST, se destruye la sesión y se redirige al usuario a la página de inicio de sesión
        session_destroy();
        header("Location: ".APP_URL."login/");
    }