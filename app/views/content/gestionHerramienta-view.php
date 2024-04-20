    <div class='row pb-3'>
        <div class='header-divider'></div>
        <div class='container-fluid'>
            <nav aria-label='breadcrumb'>
                <ol class='breadcrumb my-0 ms-2'>
                    <li class='breadcrumb-item'>
                        <!-- if breadcrumb is single--><span>Home</span>
                    </li>
                    <li class='breadcrumb-item active'><span>Panel</span></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 p-4">
            <label class="form-label" for="validationServer03">BUSCAR HERRAMIENTA:</label>
            <div class="input-group">
                <input class="form-control" name="buscar" id="buscar" type="text" value=""
                    placeholder="Busqueda por codigo o nombre">
                <button class="btn btn-primary" type="button" id="btnBuscar">
                    <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" width="20" height="20">buscar
                </button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#ventanaModalRegistrarHerr">
                    <!-- Icono para agregar usuario -->
                    <img src="<?php echo APP_URL; ?>app/views/icons/add.png" alt="icono" width="20" height="20">
                    Nueva Herramienta
                </button>
            </div>
        </div>
    </div>
    <hr>

    <div class='row'>
        <div class='col-md-12'>
            <h4>Herramientas</h4>
            <div id="resultados">
                <?php 
                use app\controllers\herramientaController;
                $insHerramienta = new herramientaController();
                // Procesamiento PHP para mostrar los resultados de la búsqueda
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Obtener el valor del campo de búsqueda
                    $busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';
                    if ($busqueda != "") {
                        echo $insHerramienta->listarHerramientaControlador ($url[1],4,$url[0],$busqueda); 
                    } else {
                        echo $insHerramienta->listarHerramientaControlador ($url[1],4,$url[0],"");                   
                    }              
                } else {
                    echo $insHerramienta->listarHerramientaControlador ($url[1],4,$url[0],"");
                }
            ?>
            </div>
        </div>
    </div>

    <?php include 'modals/modalRegistroHerramienta.php' ?>
    <?php include 'modals/modalModificarHerramienta.php' ?>
    <?php include 'modals/modalVerHerramienta.php' ?>

    <?php require_once "./app/views/scripts/script-herr.php"; ?>