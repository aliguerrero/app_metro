    <div class="row">
        <div class='row pb-3'>
            <div class='container-fluid'>
                <h3>Gestion de Herramientas</h3>
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
        <div class="card mb-4">
            <div class="card-header">
                <strong>Buscador</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4" id="nrot_field">
                        <label class="form-label"><b>BUSCAR HERRAMIENTA</b></label>
                        <div class="input-group">
                            <input class="form-control" name="campo" id="campo" type="text" placeholder="Busqueda por codigo o nombre">
                            <button class="btn btn-primary" type="button" id="btnBuscarHerramienta" title="Buscar">
                                <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" width="20" height="20">
                            </button>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex flex-column">
                        <!-- Añadir clase d-flex y flex-column -->
                        <button type="button" class="btn btn-success mt-auto" data-bs-toggle="modal" data-bs-target="#ventanaModalRegistrarHerr">
                            <!-- Icono para agregar usuario -->
                            <img src="<?php echo APP_URL; ?>app/views/icons/add.png" alt="icono" width="20" height="20">
                            Nueva Herramienta
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class='row'>
        <div class="card mb-4">
            <div class="card-header">
            <button type="button" class="btn btn-sm btn-primary ms-auto" id="btnRecargar" title="Recargar Tabla">
                    <i class="bi bi-arrow-clockwise"></i> <!-- Icono de actualización -->
                </button>
                <strong>Lista de Herramienta</strong>                
            </div>
            <div class="card-body">
                <?php

                use app\controllers\herramientaController;

                $insHerramienta = new herramientaController();
                echo $insHerramienta->listarHerramientaControlador();
                ?>
            </div>
        </div>
    </div>


    <?php include 'modals/modalRegistroHerramienta.php' ?>
    <?php include 'modals/modalModificarHerramienta.php' ?>
    <?php include 'modals/modalVerHerramienta.php' ?>

    <?php require_once "./app/views/scripts/script-herr.php"; ?>