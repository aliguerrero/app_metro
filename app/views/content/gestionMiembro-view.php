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
    <label class='form-label' for='validationServer02'>BUSCAR OPERADOR:</label>
    <div class='col-md-4'>
        <input class='form-control is-valid' id='validationServer02' type='text' value='' required=''
            placeholder='Codigo/Nombre'>
        <div class='valid-feedback'>Bien Hecho</div>
    </div>
    <div class='col-md-1'>
        <button class='form-control' style='background-color: rgb(60, 75, 100); color:white ;' type='button'
            data-coreui-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Buscar
        </button>
    </div>
    <div class="col-md-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#ventanaModalRegistrarMiem">
            <!-- Icono para agregar usuario -->
            <img src="<?php echo APP_URL; ?>app/views/icons/add.png" alt="icono" width="26" height="26">
            Nuevo miembro
        </button>
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

    <?php include 'modalRegistroMiembro.php' ?>
    <?php include 'modalModificarMiembro.php' ?>

    <?php require_once "./app/views/scripts/script-miem.php"; ?>
</div>