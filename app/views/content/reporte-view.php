<div class="container-fluid mt-4">
    <div class="row">

        <!-- Panel de filtros -->
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Generar Reporte del Sistema</h5>

                    <!-- Botones de exportación -->
                    <div>
                        <button id="btn_pdf" class="btn btn-light btn-sm me-2">
                            <i class="bi bi-filetype-pdf"></i> PDF
                        </button>
                        <button id="btn_excel" class="btn btn-light btn-sm">
                            <i class="bi bi-file-earmark-spreadsheet"></i> Excel
                        </button>
                    </div>
                </div>

                <div class="card-body">

                    <!-- SELECCIÓN DE TIPO DE REPORTE -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label><b>Tipo de Reporte</b></label>
                            <select id="tipo_reporte" class="form-select">
                                <option value="">Seleccione...</option>
                                <option value="reporte_ot">Órdenes de Trabajo</option>
                                <option value="reporte_detalle_ot">Detalles de OT</option>
                                <option value="reporte_herramientas">Herramientas</option>
                                <option value="reporte_herramienta_ot">Herramientas asignadas</option>
                                <option value="reporte_usuarios">Usuarios del sistema</option>
                                <option value="reporte_logs">Logs del sistema</option>
                                <option value="reporte_miembros">Miembros (CCO/CCF)</option>
                                <option value="reporte_turnos">Turnos</option>
                                <option value="reporte_estados">Estados</option>
                                <option value="reporte_sitios">Sitios de trabajo</option>
                            </select>
                        </div>
                    </div>

                    <!-- FILTROS (DINÁMICOS SEGÚN REPORTE) -->
                    <div id="filtros_ot">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Área de Trabajo</label>
                                <select id="f_area" class="form-select"></select>
                            </div>

                            <div class="col-md-6">
                                <label>Sitio de Trabajo</label>
                                <select id="f_sitio" class="form-select"></select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Fecha Inicio</label>
                                <input type="date" id="f_ini" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Fecha Fin</label>
                                <input type="date" id="f_fin" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>Estado</label>
                                <select id="f_estado" class="form-select"></select>
                            </div>

                            <div class="col-md-4">
                                <label>Turno</label>
                                <select id="f_turno" class="form-select"></select>
                            </div>

                            <div class="col-md-4">
                                <label>Técnico</label>
                                <select id="f_tec" class="form-select"></select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Número OT</label>
                                <input type="text" id="f_ot" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Miembro CCO/CCF</label>
                                <select id="f_miembro" class="form-select"></select>
                            </div>
                        </div>

                    </div>

                    <!-- Botón Generar -->
                    <button id="btn_generar" class="btn btn-success w-100 mt-2">
                        <i class="bi bi-search"></i> Generar Reporte
                    </button>

                </div>

            </div>
        </div>

        <!-- VISTA PREVIA + PAGINACIÓN + GRÁFICO -->
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h6 class="mb-0">Vista Previa del Reporte</h6>
                </div>

                <div class="card-body" id="vista_previa" style="height: 500px; overflow-y:auto;">
                    <p class="text-muted">Seleccione un tipo de reporte...</p>
                </div>

                <!-- PAGINACIÓN -->
                <div id="paginacion_reporte" class="text-center p-2"></div>
            </div>

            <!-- GRÁFICO -->
            <div class="card shadow mt-3">
                <div class="card-header bg-secondary text-white">
                    <h6 class="mb-0">Gráfico del Reporte</h6>
                </div>

                <div class="card-body">
                    <canvas id="chart_reporte" height="150"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Script de JS -->
<?php require_once "./app/views/scripts/script-reporte.php"; ?>
