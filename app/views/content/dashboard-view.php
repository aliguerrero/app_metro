<div class="row pb-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>Porcentaje de estados por area de trabajo </strong>
                    </div>
                    <div class="card-body d-flex flex-wrap" id="graficas-container1"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>Porcentaje de estados por turno de trabajo </strong>
                    </div>
                    <div class="card-body d-flex flex-wrap" id="graficas-container2"></div>
                </div>
            </div>
        </div>
        <!-- /.row-->
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 ">
                    <div class="card-header d-flex justify-content-between">
                        <strong>Grafica de Odenes de trabajo por Estado</strong>
                    </div>
                    <div class="card-body">
                        <div class="c-chart-wrapper">
                            <canvas id="ChartOt"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row row-cols-1 row-cols-md-5 text-center">
                            <?php
                            //Incluir controlador de main
                            use app\controllers\mainController;

                            $insMain = new mainController();
                            echo $insMain->listarCardEstadoControlador();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <strong>Grafica de Odenes de trabajo por Turno</strong>
                    </div>
                    <div class="card-body">
                        <div class="c-chart-wrapper">
                            <canvas id="ChartTurno"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row row-cols-1 row-cols-md-5 text-center">
                            <?php
                            // Incluir controlador de main
                            echo $insMain->listarCardTurnoControlador();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header"><strong>Trafico</strong></div>
                    <div class="card-body">
                        <?php
                        // Incluir controlador de main
                        echo $insMain->listarActividadesControlador();
                        ?>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- /.row-->
    </div>
    <?php require_once "./app/views/scripts/script-panel.php"; ?>