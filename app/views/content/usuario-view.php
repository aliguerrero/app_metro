    <!-- Sección de búsqueda de usuario -->
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
            <label class="form-label" for="validationServer03">BUSCAR USUARIO:</label>
            <div class="input-group">
                <input class="form-control" name="buscar" id="buscar" type="text" value=""
                    placeholder="Busqueda por cedula o nombre">
                <button class="btn btn-primary" type="button" id="btnBuscar">
                    <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" width="20" height="20">buscar
                </button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#ventanaModalRegistrar">
                    <!-- Icono para agregar usuario -->
                    <img src="<?php echo APP_URL; ?>app/views/icons/add.png" alt="icono" width="20" height="20">
                    Nuevo Usuario
                </button>
            </div>
        </div>
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