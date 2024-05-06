    <div class="row align-items-center">
        <div class="col-auto">
            <i class="bi bi-geo-alt-fill fs-3"></i>
        </div>
        <div class="col">
            <h4>Sitios de trabajo</h4>
        </div>
    </div>
    <hr>
    <form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/configAjax.php" method="POST">
        <input type="hidden" name="modulo_rol" value="registrar_sitio" id="accion">
        <div class="form-group" id="nuevo">
            <label class="form-label">Agregar nuevo sitio de trabajo</label>
            <div class="input-group">
                <input class="form-control" name="sitio" id="sitio" type="text" value=""
                    placeholder="Nombre del estado">
                <button class="btn btn-primary" type="submit" title="Guardar">
                    <i class="bi bi-save"></i> Guardar
                </button>
            </div>
        </div>
        <hr>
    </form>
    <?php        
        echo $insConfig->listarSitioControlador ("");
    ?>