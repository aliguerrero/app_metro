<div class='row'>
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
            <label class="form-label" for="validationServer03">BUSCAR OPERADOR:</label>
            <div class="input-group">
                <input class="form-control" name="buscar" id="buscar" type="text" value=""
                    placeholder="Busqueda por codigo o nombre">
                <button class="btn btn-primary" type="button" id="btnBuscar">
                    <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" width="20" height="20">buscar
                </button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#ventanaModalRegistrarMiem">
                    <!-- Icono para agregar usuario -->
                    <img src="<?php echo APP_URL; ?>app/views/icons/add.png" alt="icono" width="20" height="20">
                    Nuevo miembro
                </button>
            </div>
        </div>
    </div>
</div>
<hr>

<div class='row'>
    <div class='col-md-12'>
        <div class='row'>
            <label>
                <h4>Miembros registrados</h4>
            </label>
            <?php 
                use app\controllers\miembroController;
                $insMiembro = new miembroController();
                
                echo $insMiembro->listarMiembroControlador ($url[1],8,$url[0],"");
            ?>
        </div><br>
    </div>

    <?php include 'modals/modalRegistroMiembro.php' ?>
    <?php include 'modals/modalModificarMiembro.php' ?>

    <?php require_once "./app/views/scripts/script-miem.php"; ?>
</div>