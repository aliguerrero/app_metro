<div class="body flex-grow-1 px-3">
    <!-- Sección de búsqueda de usuario -->
    <div class="row">
        <div class="col-md-8 p-4">
            <div class="row">
                <label class="form-label" >BUSCAR USUARIO:</label>
                <div class="col-md-4">
                    <input class="form-control "  type="text" placeholder="Cedula / Nombre">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-primary">
                        <!-- Icono de búsqueda -->
                        <img src="<?php echo APP_URL; ?>app/views/icons/buscar.png" alt="icono" width="26" height="26">
                    </button>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventanaModalRegistrar">
                        <!-- Icono para agregar usuario -->
                        <img src="<?php echo APP_URL; ?>app/views/icons/add.png" alt="icono" width="26" height="26">
                        Nuevo usuario
                    </button>
                </div>
            </div>                   
        </div>                            
    </div>
    <hr>

    <!-- Sección de usuarios registrados -->
    <div class="row">
        <div class="col-md-12 p-3">
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
        <?php include 'modalRegistroUser.php' ?>  
        <?php include 'modalModificarUser.php' ?>
        <?php include 'modalModificarPass.php' ?>

        <?php require_once "./app/views/scripts/script-user.php"; ?>
    </div>
</div>
