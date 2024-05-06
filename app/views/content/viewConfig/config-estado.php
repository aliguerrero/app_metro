    <div class="row align-items-center">
        <div class="col-auto">
            <i class="bi bi-list-task fs-3"></i>
        </div>
        <div class="col">
            <h4>Estados de Ordenes de trabajo</h4>
        </div>
    </div>
    <hr>
    <form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/configAjax.php" method="POST">
        <input type="hidden" name="modulo_rol" value="registrar_estado" id="accion">
        <div class="form-group" id="nuevo">
            <label class="form-label">Agregar nuevo estado</label>
            <div class="input-group">
                <input class="form-control" name="nombre_estado" id="nombre_estado" type="text" value=""
                    placeholder="Nombre del estado">
                <input type="color" class="form-control form-control-color" id="color" name="color" value="#00FFCC"
                    title="Seleccionar color" style="max-width: 50px;">
                <button class="btn btn-primary" type="submit" title="Guardar">
                    <i class="bi bi-save"></i> Guardar
                </button>
            </div>
        </div>
        <hr>
    </form>
    <?php 
        use app\controllers\configController;
        $insConfig = new configController();
        
        echo $insConfig->listarEstadoControlador ("");
    ?>