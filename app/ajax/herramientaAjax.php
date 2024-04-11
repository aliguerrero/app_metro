<?php
    require_once "../../config/app.php";
    require_once "../views/inc/session_start.php";
    require_once "../../autoload.php";

    use app\controllers\herramientaController;

    if (isset($_POST ['modulo_herramienta'])) {
        $insTools = new herramientaController();
        if ($_POST ['modulo_herramienta'] == "registrar") {
            echo $insTools->registrarHerramientaControlador();
        }
        if ($_POST ['modulo_herramienta'] == "eliminar") {
            echo $insTools->eliminarHerramientaControlador();
        }
    } else {
        session_destroy();
        header("Location: ".APP_URL."login/");
    }