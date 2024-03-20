<?php
    namespace app\controllers;
    use app\models\viewsModel;

    class viewsController extends viewsModel{

        public function obternerVistaControlador ($vista){
            if ($vista != "") {
                $respuesta = $this->obtenerVistaModelo ($vista);
            }else{
                $respuesta = "login";
            }
            return $respuesta;
        }
    }