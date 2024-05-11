<div class='row pb-3'>
    <div class='container-fluid'>
        <h3>Entradas logs</h3>
        <nav aria-label='breadcrumb'>
            <ol class='breadcrumb my-0 ms-2'>
                <li class='breadcrumb-item'>
                    <!-- if breadcrumb is single--><span>Panel</span>
                </li>
                <li class='breadcrumb-item active'><span>Usuario</span></li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="card mb-4">
        <div class="card-header">
            <strong>Buscador</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label"><b>Operador:</b></label>
                    <?php
                    // Incluir controlador de ot
                    use app\controllers\logsController;

                    $insLogs = new logsController();

                    echo $insLogs->listarComboUserControlador();
                    ?>
                </div>
                <div class="col-md-2">
                    <label class="form-label"><b>Acciones:</b></label>
                    <?php

                    echo $insLogs->listarComboAccionControlador();
                    ?>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-6">
                            <label for="fecha_desde" class="form-label"><b>Desde:</b></label>
                            <input type="date" class="form-control" id="fecha_desde" name="fecha_desde" aria-describedby="textHelp">
                        </div>
                        <div class="col-6">
                            <label for="fecha_hasta" class="form-label"><b>Hasta:</b></label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta" aria-describedby="textHelp">
                                <button class="btn btn-primary" type="button" id="btnBuscarLogs" title="Buscar">
                                    <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" width="20" height="20">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card mb-4">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-primary ms-auto" id="btnRecargar" title="Recargar Tabla">
                <i class="bi bi-arrow-clockwise"></i> <!-- Icono de actualización -->
            </button>
            <strong>Registros Logs</strong>
        </div>
        <div class="card-body">
            <?php
            echo $insLogs->listarLogsControlador();
            ?>
        </div>
    </div>
</div>
<?php require_once "./app/views/scripts/script-logs.php"; ?>