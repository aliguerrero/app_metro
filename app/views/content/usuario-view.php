    <!-- Sección de búsqueda de usuario -->
    <div class='row pb-3'>
        <div class='container-fluid'>
            <h3>Gestion de Usuarios</h3> 
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
        <form class="FormularioAjax row" action="<?php echo APP_URL; ?>app/ajax/otAjax.php" method="POST">

            <div class="col-md-4" id="nrot_field">
                <label class="form-label"><b>BUSCAR USUARIO</b></label>
                <div class="input-group">
                    <input class="form-control" name="nrot" id="nrot" type="text" value=""
                        placeholder="Busqueda por cedula o nombre">
                    <button class="btn btn-primary" type="submit" id="" title="Buscar">
                        <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" width="20" height="20">
                    </button>
                </div>
            </div>

            <div class="col-md-2 d-flex flex-column">
                <!-- Añadir clase d-flex y flex-column -->
                <button type="button" class="btn btn-success mt-auto" data-bs-toggle="modal"
                    data-bs-target="#ventanaModalRegistrar">
                    <!-- Icono para agregar usuario -->
                    <img src="<?php echo APP_URL; ?>app/views/icons/add.png" alt="icono" width="20" height="20">
                    Nuevo Usuario
                </button>
            </div>
        </form>
    </div>
    <hr>

    <!-- Sección de usuarios registrados -->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <label>
                    <h4>Usuarios registrados</h4>
                </label>
                <?php 
                    // Incluir controlador de usuario
                    use app\controllers\userController;
                    $insUsuario = new userController();
                    
                    // Listar usuarios
                    echo $insUsuario->listarUsuarioControlador ($url[1],8,$url[0],"");
                ?>
            </div>
        </div>
        <!-- Incluir modales -->
        <?php include 'modals/modalRegistroUser.php' ?>
        <?php include 'modals/modalModificarUser.php' ?>
        <?php include 'modals/modalModificarPass.php' ?>

        <?php require_once "./app/views/scripts/script-user.php"; ?>
    </div>