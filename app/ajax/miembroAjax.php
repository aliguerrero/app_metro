<?php
    require_once "../../config/app.php";
    require_once "../views/inc/session_start.php";
    require_once "../../autoload.php";

    use app\controllers\miembroController;

    if (isset($_POST ['modulo_miembro'])) {
        $insMiembro = new miembroController();
        if ($_POST ['modulo_miembro'] == "registrar") {
            echo $insMiembro->registrarMiembroControlador();
        }
    } else {
        session_destroy();
        header("Location: ".APP_URL."login/");
    }
    