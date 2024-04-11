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
    <label class='form-label' for='validationServer02'>BUSCADOR HERRAMIENTA:</label>
    <div class='col-md-4'>
        <input class='form-control ' id='validationServer02' type='text' value='' placeholder='Codigo/Nombre'>
    </div>
    <div class='col-md-1'>
        <button class='form-control' style='background-color: rgb(60, 75, 100); color:white ;' type='button'
            data-coreui-toggle='dropdown' aria-haspopup='true' aria-expanded='false' width="26"
            height="26">Buscar</button>
    </div>
    <div class="col-md-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#ventanaModalRegistrarHerr">
            <!-- Icono para agregar usuario -->
            <img src="<?php echo APP_URL; ?>app/views/icons/add.png" alt="icono" width="26" height="26">
            Nueva Herramienta
        </button>
    </div>
</div>
<hr>

<div class='row'>
    <div class='col-md-6'>
        <h4>Herramientas</h4>
        <?php 
      use app\controllers\herramientaController;
      $insHerramienta = new herramientaController();
        
      echo $insHerramienta->listarHerramientaControlador ($url[1],4,$url[0],"");
    ?>
    </div><br>

    <div class='col-md-6'>
        <h4>Herramientas O.T.</h4>
        <?php        
      echo $insHerramienta->listarHerramientaOTControlador ($url[1],4,$url[0],"");
    ?>
    </div>

    <?php include 'modalRegistroHerramienta.php' ?>
    <?php include 'modalModificarHerramienta.php' ?>

    <?php require_once "./app/views/scripts/script-herr.php"; ?>
</div>