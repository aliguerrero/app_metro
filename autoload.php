<?php 
    // Se registra una función de autoloading anónima para cargar automáticamente las clases
    spl_autoload_register(function($clase){

        // Se construye la ruta al archivo de la clase basándose en el nombre de la clase y la ruta del directorio actual
        $archivo=__DIR__."/".$clase.".php";

        // Se reemplazan las barras invertidas en la ruta del archivo por barras inclinadas para garantizar la compatibilidad con diferentes sistemas operativos
        $archivo=str_replace("\\","/",$archivo);

        // Se verifica si el archivo de la clase existe
        if (is_file($archivo)) {
            // Si el archivo existe, se incluye en el script
            require_once $archivo;
        }
        
    });
?>