<?php
    // Se incluyen los archivos necesarios
    require_once "../../config/app.php"; // Archivo de configuración de la aplicación
    require_once "../views/inc/session_start.php"; // Archivo para iniciar la sesión
    require_once "../../autoload.php"; // Archivo de carga automática de clases

    // Se importa la clase userController del namespace app\controllers
    use app\controllers\otController;

    // Se verifica si se ha enviado el parámetro 'modulo_ot' a través del método POST
    if (isset($_POST['modulo_ot'])) {
        // Se crea una instancia de la clase userController
        $insOt = new otController();

        // Se verifica el valor del parámetro 'modulo_ot'
        if ($_POST['modulo_ot'] == "registrar_ot") {
            // Si el valor es "registrar", se llama al método registrarUserControlador de la instancia $insOt y se muestra el resultado
            echo $insOt->registrarOtControlador();
        }
        if ($_POST['modulo_ot'] == "registrar_detalle") {
            // Si el valor es "registrar", se llama al método registrarUserControlador de la instancia $insOt y se muestra el resultado
            echo $insOt->registrarDetalleOtControlador();
        }
        if ($_POST['modulo_ot'] == "eliminar") {
            // Si el valor es "eliminar", se llama al método eliminarUserControlador de la instancia $insOt y se muestra el resultado
            echo $insOt->eliminarUserControlador();
        }
        if ($_POST['modulo_ot'] == "modificar") {
            // Si el valor es "eliminar", se llama al método eliminarUserControlador de la instancia $insOt y se muestra el resultado
            echo $insOt->actualizarDatosUser();
        } 
                       
    } else {
        // Si no se ha enviado el parámetro 'modulo_ot' a través del método POST, se destruye la sesión y se redirige al usuario a la página de inicio de sesión
        session_destroy();
        header("Location: ".APP_URL."login/");
    }