    <div class="row align-items-center">
        <div class="col-auto">
            <i class="bi bi-clock-fill fs-3"></i>
        </div>
        <div class="col">
            <h4>Turnos de trabajo</h4>
        </div>
    </div>
    <hr>
    <form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/configAjax.php" method="POST">
        <input type="hidden" name="modulo_rol" value="registrar_turno" id="accion">
        <div class="form-group" id="nuevo">
            <label class="form-label">Agregar nuevo turno de trabajo</label>
            <div class="input-group">
                <input class="form-control" name="turno" id="turno" type="text" value="" placeholder="Nombre del turno">
                <button class="btn btn-primary" type="submit" id="btnGuardar" title="Guardar">
                    <i class="bi bi-save"></i> Guardar
                </button>
            </div>
        </div>
        <hr>
    </form>
    <?php        
        echo $insConfig->listarTurnoControlador ("");
    ?>