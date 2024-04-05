<?php
// Declarar el namespace
namespace app\models;

// Definir la clase viewsModel
class viewsModel{
    // Método protegido para obtener la vista del modelo
    protected function obtenerVistaModelo ($vista){
        // Lista blanca de vistas permitidas

        $listaBlanca = ["dashboard","gestionMiembro","gestionOT","gestionHerramienta","usuario","logOut","cargarUser"];

        // Verificar si la vista está en la lista blanca
        if (in_array($vista,$listaBlanca)) {
            // Si la vista está en la lista blanca y el archivo de vista existe, devolver la ruta al archivo
            if (is_file("./app/views/content/".$vista."-view.php")) {
                $contenido = "./app/views/content/".$vista."-view.php";
            } else {
                // Si el archivo de vista no existe, devolver una vista de error 404
                $contenido = "404";
            }    
        } elseif ($vista == "login" || $vista == "index") {
            // Si la vista es "login" o "index", devolver la vista "login"
            $contenido = "login";
        } else {
            // Si no es ninguna de las anteriores, devolver una vista de error 404
            $contenido = "404";
        }

        // Devolver la ruta del contenido
        return $contenido;
    }
}