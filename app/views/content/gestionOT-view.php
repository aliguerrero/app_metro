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
    <div class="row">
        <form class="FormularioAjax row" action="<?php echo APP_URL; ?>app/ajax/otAjax.php" method="POST">
            <div class="col-md-2">
                <label class="form-label" for="validationServer03"><b>SELECCIONE AREA:</b></label>
                <select class="form-select" name="area" aria-label="Default select example">
                    <option value="0">TODAS</option>
                    <option value="1">SEÑALIZACIÓN</option>
                    <option value="2">INFRAESTRUCTURA</option>
                    <option value="3">APARATO DE VIA</option>
                    <option value="4">NO PROGRAMADA</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label" for="validationServer03">TIPO DE BUSQUEDA:</label>
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
                    <button class="btn btn-primary" type="submit" id="" title="Buscar">
                        <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" width="20" height="20">
                    </button>
                </div>
            </div>

            <div class="col-md-4" id="fecha_field" style="display:none;">
                <div class="row">
                    <div class="col-6">
                        <label for="fecha_desde" class="form-label"><b>Desde:</b></label>
                        <input type="date" class="form-control" id="fecha_desde" name="fecha_desde"
                            aria-describedby="textHelp">
                    </div>
                    <div class="col-6">
                        <label for="fecha_hasta" class="form-label"><b>Hasta:</b></label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta"
                                aria-describedby="textHelp">
                            <button class="btn btn-primary" type="submit" id="" title="Buscar">
                                <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" width="20" height="20">
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" col-md-4" id="estado_field" style="display:none;">
                <label for="fecha_desde" class="form-label"><b>Estado:</b></label>
                <div class="input-group">
                    <select class="form-select" id="status" name="status" aria-label="Default select example">
                        <option selected>Seleccionar</option>
                        <option value="1">EJECUTADA</option>
                        <option value="2">NO EJECUTADA</option>
                        <option value="3">EXTEMPORANEA</option>
                        <option value="4">REPROGRAMADA</option>
                        <option value="5">SUSPENDIDA</option>
                    </select>
                    <button class="btn btn-primary" type="submit" id="" title="Buscar">
                        <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" width="20" height="20">
                    </button>
                </div>
            </div>
            <div class="col-md-4" id="operador_field" style="display:none;">
                <label class="form-label"><b>Operador:</b></label>
                <div class="input-group">
                    <?php 
                        // Incluir controlador de ot
                        use app\controllers\otController;
                        $insOt = new otController();
                        
                        echo $insOt->listarComboUserControlador ();
                    ?>
                    <button class="btn btn-primary" type="submit" id="" title="Buscar">
                        <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" width="20" height="20">
                    </button>
                </div>
            </div>
            <div class="col-md-2 d-flex flex-column">
                <!-- Añadir clase d-flex y flex-column -->
                <button type="button" class="btn btn-success mt-auto" data-bs-toggle="modal"
                    data-bs-target="#ventanaModalRegistroOt">
                    <!-- Icono para agregar usuario -->
                    <img src="<?php echo APP_URL; ?>app/views/icons/add.png" alt="icono" width="20" height="20">
                    Nueva O.T.
                </button>
            </div>
        </form>



    </div>
</div>
<hr>
<div class="row">
    <!-- inicio tablas -->
    <div class="col-md-12 p-3">
        <div class="row">
            <label>
                <h4>Lista de Ordenes de Trabajo</h4>
            </label>
            <?php          
                // Listar ot
                echo $insOt->listarOtControlador ($url[1],6,$url[0],"");
            ?>
        </div>
    </div>
</div>

<?php include 'modals/modalRegistroOt.php' ?>
<?php include 'modals/modalDetallesOt.php' ?>
<?php include 'modals/modalModificarOt.php' ?>
<?php include 'modals/modalModificarHerramienta.php' ?>

<?php require_once "./app/views/scripts/script-detalle.php"; ?>