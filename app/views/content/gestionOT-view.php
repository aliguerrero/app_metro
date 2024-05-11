<div class="row">
    <div class="row pb-3">
        <div class="container-fluid">
            <h3>Gestion de Ordenes de trabajo</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2">
                    <li class='breadcrumb-item active'>
                        <!-- if breadcrumb is single--><span>Panel</span>
                    </li>
                    <li class='breadcrumb-item active'><span>Orden de trabajo</span></li>
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
                <div class="col-md-2">
                    <?php

                    use app\controllers\otController;

                    $insOt = new otController();
                    // Listar area
                    echo $insOt->listarComboAreaControlador();
                    ?>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="validationServer03"><b>TIPO DE BUSQUEDA:</b></label>
                    <select class="form-select" id="tipo_busqueda" name="tipo_busqueda" aria-label="Default select example">
                        <option value="1">NRO O.T.</option>
                        <option value="2">RANGO DE FECHA</option>
                        <option value="3">ESTADO</option>
                        <option value="4">OPERADOR</option>
                    </select>
                </div>
                <div class="col-md-4" id="nrot_field">
                    <label class="form-label"><b>N° de O.T.:</b></label>
                    <div class="input-group">
                        <input class="form-control" name="nrot" id="nrot" type="text" value="" placeholder="Numero de O.T.">
                        <button class="btn btn-primary" type="button" id="btnBuscarOt" title="Buscar">
                            <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" width="20" height="20">
                        </button>
                    </div>
                </div>

                <div class="col-md-4" id="fecha_field" style="display:none;">
                    <div class="row">
                        <div class="col-6">
                            <label for="fecha_desde" class="form-label"><b>DESDE:</b></label>
                            <input type="date" class="form-control" id="fecha_desde" name="fecha_desde" aria-describedby="textHelp">
                        </div>
                        <div class="col-6">
                            <label for="fecha_hasta" class="form-label"><b>HASTA:</b></label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta" aria-describedby="textHelp">
                                <button class="btn btn-primary" type="button" id="btnBuscarFecha" title="Buscar">
                                    <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" width="20" height="20">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" col-md-4" id="estado_field" style="display:none;">
                    <label for="fecha_desde" class="form-label"><b>ESTADO:</b></label>
                    <div class="input-group">
                        <?php
                        // cargar estado
                        echo $insOt->listarComboEstadoControlador();
                        ?>
                        <button class="btn btn-primary" type="button" id="btnBuscarEstado" title="Buscar">
                            <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" width="20" height="20">
                        </button>
                    </div>
                </div>
                <div class="col-md-4" id="operador_field" style="display:none;">
                    <label class="form-label"><b>OPERADOR:</b></label>
                    <div class="input-group">
                        <?php
                        // Incluir controlador de ot    
                        echo $insOt->listarComboUserControlador();
                        ?>
                        <button class="btn btn-primary" type="button" id="btnBuscarUser" title="Buscar">
                            <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" width="20" height="20">
                        </button>
                    </div>
                </div>
                <div class="col-md-2 d-flex flex-column">
                    <!-- Añadir clase d-flex y flex-column -->
                    <button type="button" class="btn btn-success mt-auto" data-bs-toggle="modal" data-bs-target="#ventanaModalRegistroOt">
                        <!-- Icono para agregar usuario -->
                        <img src="<?php echo APP_URL; ?>app/views/icons/add.png" alt="icono" width="20" height="20">
                        Nueva O.T.
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- inicio tablas -->
    <div class="card mb-4">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-primary ms-auto" id="btnRecargar" title="Recargar Tabla">
                <i class="bi bi-arrow-clockwise"></i> <!-- Icono de actualización -->
            </button>
            <strong>Lista de Ordenes de Trabajo</strong>
        </div>
        <div class="card-body">
            <?php
            // Listar ot
            echo $insOt->listarOtControlador();
            ?>
        </div>
    </div>
</div>

<?php include 'modals/modalRegistroOt.php' ?>
<?php include 'modals/modalDetallesOt.php' ?>
<?php include 'modals/modalModificarOt.php' ?>
<?php include 'modals/modalModificarHerramienta.php' ?>
<?php include 'modals/modalHerramientaOt.php' ?>


<?php require_once "./app/views/scripts/script-detalle.php"; ?>