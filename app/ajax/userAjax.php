<?php
    require_once "../../config/app.php";
    require_once "../views/inc/session_start.php";
    require_once "../../autoload.php";

    use app\controllers\userController;

    if (isset($_POST ['modulo_user'])) {
        $insUser = new userController();
        if ($_POST ['modulo_user'] == "registrar") {
            echo $insUser->registrarUserControlador();
        }
    } else {
        session_destroy();
        header("Location: ".APP_URL."login/");
    }