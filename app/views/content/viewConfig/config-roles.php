<div class="row">
    <div class="col-md-8">
        <div class="row align-items-center">
            <div class="col-auto">
                <i class="bi bi-people-fill fs-3"></i>
            </div>
            <div class="col">
                <h4>Roles y permisos</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group d-flex align-items-center">
            <label for="selectAccion" class="me-2"><strong>Acción:</strong></label>
            <select class="form-select" id="selectAccion">
                <option value="1">Listar roles</option>
                <option value="2">Nuevo rol</option>
            </select>
        </div>
    </div>
</div>
<hr>

<form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/configAjax.php" method="POST">
    <!-- Nombre del Rol -->
    <div class="form-group" id="listar">
        <label class="form-label">Roles</label>
        <input type="hidden" name="modulo_rol" value="modificar_rol" id="accion">
        <div class="input-group">
            <?php  
                use app\controllers\configController;
                $insConfig = new configController();                          
                // cargar roles
                echo $insConfig->listarComboRolControlador ();
            ?>
            <button class="btn btn-primary" name="submit_button" type="submit" id="btnModificar" title="Modificar">
                <i class="bi bi-pencil"></i> Modificar
            </button>
            <button class="btn btn-danger" name="submit_button" type="submit" id="btnEliminar" title="Eliminar">
                <i class="bi bi-trash"></i> Eliminar
            </button>
        </div>
    </div>
    <div class="form-group" id="nuevo" style="display:none;">
        <label class="form-label">Nuevo Rol</label>
        <div class="input-group">
            <input class="form-control " name="rol_name" id="rol_name" type="text" value=""
                placeholder="Nombre del rol">
            <button class="btn btn-primary" name="submit_button" type="submit" id="btnGuardar" title="Guardar">
                <i class="bi bi-save"></i> Guardar
            </button>
        </div>
    </div>
    <hr>
    <!-- Permisos -->
    <div class="form-group">
        <label>Permisos:</label><br>
        <div class="row contenido" id="contenido">
            <!-- Permisos para Usuarios -->
            <div class="col-md-4">
                <h5>Usuarios</h5>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permisoUsuarios0" name="permisoUsuarios0">
                    <label class="form-check-label" for="permisoUsuarios0">Permitir acceso</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permisoUsuarios1" name="permisoUsuarios1">
                    <label class="form-check-label" for="permisoUsuarios1">Agregar</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permisoUsuarios2" name="permisoUsuarios2">
                    <label class="form-check-label" for="permisoUsuarios2">Modificar</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permisoUsuarios3" name="permisoUsuarios3">
                    <label class="form-check-label" for="permisoUsuarios3">Eliminar</label>
                </div>
            </div>
            <!-- Permisos para Herramienta -->
            <div class="col-md-4">
                <h5>Herramienta</h5>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permisoHerramienta0" name="permisoHerramienta0">
                    <label class="form-check-label" for="permisoHerramienta0">Permitir acceso</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permisoHerramienta1" name="permisoHerramienta1">
                    <label class=" form-check-label" for="permisoHerramienta1">Agregar</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permisoHerramienta2" name="permisoHerramienta2">
                    <label class="form-check-label" for="permisoHerramienta2">Modificar</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permisoHerramienta3" name="permisoHerramienta3">
                    <label class="form-check-label" for="permisoHerramienta3">Eliminar</label>
                </div>
            </div>
            <!-- Agregar más permisos para Miembro si es necesario -->
            <div class="col-md-4">
                <h5>Miembro</h5>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permisoMiembro0" name="permisoMiembro0">
                    <label class="form-check-label" for="permisoMiembro0">Permitir acceso</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permisoMiembro1" name="permisoMiembro1">
                    <label class="form-check-label" for="permisoMiembro1">Agregar</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permisoMiembro2" name="permisoMiembro2">
                    <label class="form-check-label" for="permisoMiembro2">Modificar</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="permisoMiembro3" name="permisoMiembro3">
                    <label class="form-check-label" for="permisoMiembro3">Eliminar</label>
                </div>
            </div>
            <!-- Permisos para Orden Trabajo -->
            <div class="row">
                <h5>Orden de Trabajo</h5>
                <div class="col-md-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="permisoOrdenTrabajo0"
                            name="permisoOrdenTrabajo0">
                        <label class="form-check-label" for="permisoOrdenTrabajo0">Permitir
                            acceso</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="permisoOrdenTrabajo1"
                            name="permisoOrdenTrabajo1">
                        <label class="form-check-label" for="permisoOrdenTrabajo1">Agregar
                            O.T.</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="permisoOrdenTrabajo2"
                            name="permisoOrdenTrabajo2">
                        <label class="form-check-label" for="permisoOrdenTrabajo2">Modificar
                            O.T.</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="permisoOrdenTrabajo3"
                            name="permisoOrdenTrabajo3">
                        <label class="form-check-label" for="permisoOrdenTrabajo3">Agregar
                            Detalle</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="permisoOrdenTrabajo4"
                            name="permisoOrdenTrabajo4">
                        <label class="form-check-label" for="permisoOrdenTrabajo4">Eliminar
                            O.T.</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="permisoOrdenTrabajo5"
                            name="permisoOrdenTrabajo5">
                        <label class="form-check-label" for="permisoOrdenTrabajo5">Generar
                            Reporte</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="permisoOrdenTrabajo6"
                            name="permisoOrdenTrabajo6">
                        <label class="form-check-label" for="permisoOrdenTrabajo6">Agregar
                            Herramienta</label>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>