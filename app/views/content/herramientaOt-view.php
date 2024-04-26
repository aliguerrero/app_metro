<div class='row pb-3'>
    <div class='container-fluid'>
    <h3>Herramientas para Orden de Trabajo</h3> 
        <nav aria-label='breadcrumb'>
            <ol class='breadcrumb my-0 ms-2'>
                <li class='breadcrumb-item'><span><a class="link" href="<?php ECHO APP_URL; ?>dashboard/">Panel</a></span></li>
                <li class='breadcrumb-item'><span><a class="link" href="<?php ECHO APP_URL; ?>gestionOT/">Orden de trabajo</a></span></li>
                <li class='breadcrumb-item'><span><a class="link" href="<?php ECHO APP_URL; ?>herramientaOt/">Herramienta O.T.</a></span></li>
            </ol>
        </nav>
    </div>
</div> <hr>
<div class="row" id="viewHerramientaOt">
    <h3 id="codigo1" name="codigo1"></h3>
    <div class="col-md-6">
    <?php 
                use app\controllers\herramientaController;
                $insHerramienta = new herramientaController();
                // Procesamiento PHP para mostrar los resultados de la búsqueda
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Obtener el valor del campo de búsqueda
                    $busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';
                    if ($busqueda != "") {
                        echo $insHerramienta->listarHerramienta ($url[1],4,$url[0],$busqueda); 
                    } else {
                        echo $insHerramienta->listarHerramienta ($url[1],4,$url[0],"");                   
                    }              
                } else {
                    echo $insHerramienta->listarHerramienta ($url[1],4,$url[0],"");
                }
            ?>
    </div>
    <div class="col-md-6">
    <?php 
           
                // Procesamiento PHP para mostrar los resultados de la búsqueda
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Obtener el valor del campo de búsqueda
                    $busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';
                    if ($busqueda != "") {
                        echo $insHerramienta->listarHerramientaOT ($url[1],4,$url[0],$busqueda); 
                    } else {
                        echo $insHerramienta->listarHerramientaOT ($url[1],4,$url[0],"");                   
                    }              
                } else {
                    echo $insHerramienta->listarHerramientaOT ($url[1],4,$url[0],"");
                }
            ?>
    </div>
</div>

<script>
    // Obtener el valor del parámetro 'id' de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    // Mostrar el valor en la etiqueta con el ID 'codigo1'
    document.getElementById('codigo1').textContent = id;
</script>