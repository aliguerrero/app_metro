<?php

require_once '../../../controllers/configController.php';

use app\controllers\configController;

$insConfig = new configController();
echo $insConfig->listarTurnoControlador ( '' );

?>