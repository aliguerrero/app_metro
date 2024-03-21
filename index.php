<?php
// Incluir el archivo de configuración de la aplicación
require_once "./config/app.php";
// Incluir el archivo de autoloading
require_once "./autoload.php";
// Incluir el archivo de inicio de sesión
require_once "./app/views/inc/session_start.php";

// Verificar si existe la variable 'views' en la URL
if ( isset( $_GET[ 'views' ] ) ) {
    // Si existe, dividir la URL en partes usando '/' como delimitador y almacenarlas en un array
    $url = explode( "/", $_GET[ 'views' ] );
} else {
    // Si no existe, establecer una URL predeterminada ( en este caso, 'login' )
    $url = ["login"];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once "./app/views/inc/head.php"; ?>
</head>
<body>
    <?php
        // Importar la clase viewsController
        use app\controllers\viewsController;
        // Importar la clase loginController
        use app\controllers\loginController;
        // Instanciar el controlador de vistas
        $insLogin = new loginController();
        // Instanciar el controlador de vistas
        $viewsControllers = new viewsController();
        // Obtener la vista correspondiente
        $vista = $viewsControllers->obternerVistaControlador($url[0]);
        // Verificar qué vista se debe mostrar
        if ($vista == "login" || $vista == "404") {
            // Si es la vista de inicio de sesión o error 404, incluir el contenido correspondiente
            require_once "./app/views/content/".$vista."-view.php";
        } else {
            # cerrar sesion #
            if (!isset($_SESSION['id']) || !isset($_SESSION['user']) || !isset($_SESSION['username']) || 
            !isset($_SESSION['tipo']) || $_SESSION['id']=="" || $_SESSION['user']=="" || $_SESSION['username']=="" || $_SESSION['tipo']=="") {
                $insLogin->cerrarSesionControlador();
                exit();
            }
            // Si es otra vista, incluir el archivo de la vista directamente
            require_once "./app/views/inc/navbar.php";
        }
        
        // Incluir archivos de script al final del cuerpo del documento
        require_once "./app/views/inc/script.php";
    ?>
</body>
</html>
