    <div class="row align-items-center">
        <div class="col-auto">
            <i class="bi bi-geo-fill fs-3"></i>
        </div>
        <div class="col">
            <h4>Areas de trabajo</h4>
        </div>
    </div>
    <hr>
    <form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/configAjax.php" method="POST">
        <input type="hidden" name="modulo_rol" value="registrar_area" id="accion">
        <div class="form-group" id="nuevo">
            <label class="form-label">Agregar nueva de trabajo</label>
            <div class="input-group">
                <input class="form-control" name="nombre_area" id="nombre_area" type="text" value=""
                    placeholder="Nombre del Area">
                <input class="form-control" name="nome" id="nome" type="text" value="" placeholder="Nomenclatura"
                    style="max-width: 150px;">
                <button class="btn btn-primary" type="submit" title="Guardar">
                    <i class="bi bi-save"></i> Guardar
                </button>
            </div>
        </div>
        <hr>
    </form>
    <?php        
        echo $insConfig->listarAreaControlador ($url[1],5,$url[0],"");
    ?>