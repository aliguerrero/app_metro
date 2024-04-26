<div class="row">
    <div class="container-fluid">
        <h3>Configuración</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class='breadcrumb-item active'>
                    <!-- if breadcrumb is single--><span>Panel</span>
                </li>
                <li class='breadcrumb-item active'><span>Orden de trabajo</span></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container d-flex justify-content-center mt-5" style="height: 50vh;">
    <div class="p-4 rounded-3" style="background-color: ; width: 90%; height: 100%;">
        <div class="row d-flex align-items-start">
            <div class="col-md-3 nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                aria-orientation="vertical">
                <button class="nav-link active text-start btn btn-sm btn-outline-secondary" id="v-pills-usuario-tab"
                    data-bs-toggle="pill" data-bs-target="#v-pills-usuario" type="button" role="tab"
                    aria-controls="v-pills-usuario" aria-selected="true">
                    <i class="bi bi-person-fill me-2"></i>Cuenta Usuario
                </button>
                <button class="nav-link text-start btn btn-sm btn-outline-secondary" id="v-pills-roles-tab"
                    data-bs-toggle="pill" data-bs-target="#v-pills-roles" type="button" role="tab"
                    aria-controls="v-pills-roles" aria-selected="false">
                    <i class="bi bi-people-fill me-2"></i>Roles
                </button>
                <button class="nav-link text-start btn btn-sm btn-outline-secondary" id="v-pills-estado-tab"
                    data-bs-toggle="pill" data-bs-target="#v-pills-estado" type="button" role="tab"
                    aria-controls="v-pills-estado" aria-selected="false">
                    <i class="bi bi-list-task me-2"></i>Estados O.T.
                </button>
                <button class="nav-link text-start btn btn-sm btn-outline-secondary" id="v-pills-sitio-tab"
                    data-bs-toggle="pill" data-bs-target="#v-pills-sitio" type="button" role="tab"
                    aria-controls="v-pills-sitio" aria-selected="false">
                    <i class="bi bi-geo-alt-fill me-2"></i>Sitio de trabajo
                </button>
                <button class="nav-link text-start btn btn-sm btn-outline-secondary" id="v-pills-area-tab"
                    data-bs-toggle="pill" data-bs-target="#v-pills-area" type="button" role="tab"
                    aria-controls="v-pills-area" aria-selected="false">
                    <i class="bi bi-geo-fill me-2"></i>Area de Trabajo
                </button>
                <button class="nav-link text-start btn btn-sm btn-outline-secondary" id="v-pills-turno-tab"
                    data-bs-toggle="pill" data-bs-target="#v-pills-turno" type="button" role="tab"
                    aria-controls="v-pills-turno" aria-selected="false">
                    <i class="bi bi-clock-fill me-2"></i>Turnos de Trabajo
                </button>
                <button class="nav-link text-start btn btn-sm btn-outline-secondary" id="v-pills-logs-tab"
                    data-bs-toggle="pill" data-bs-target="#v-pills-logs" type="button" role="tab"
                    aria-controls="v-pills-logs" aria-selected="false">
                    <i class="bi bi-journal me-2"></i>Logs Sistema
                </button>

            </div>
            <div class="col-md-8 p-5 tab-content rounded-3" id="v-pills-tabContent" style="background-color: #ffffff;">
                <div class="tab-pane fade show active" id="v-pills-usuario" role="tabpanel"
                    aria-labelledby="v-pills-usuario-tab">
                    <?php include "./app/views/content/viewConfig/config-user.php"; ?>
                </div>
                <div class="tab-pane fade" id="v-pills-roles" role="tabpanel" aria-labelledby="v-pills-roles-tab">
                    <?php include "./app/views/content/viewConfig/config-roles.php"; ?>
                </div>
                <div class="tab-pane fade" id="v-pills-estado" role="tabpanel" aria-labelledby="v-pills-estado-tab">
                    <?php include "./app/views/content/viewConfig/config-estado.php"; ?>
                </div>
                <div class="tab-pane fade" id="v-pills-sitio" role="tabpanel" aria-labelledby="v-pills-sitio-tab">
                    <?php include "./app/views/content/viewConfig/config-sitio.php"; ?>
                </div>
                <div class="tab-pane fade" id="v-pills-area" role="tabpanel" aria-labelledby="v-pills-area-tab">
                    <?php include "./app/views/content/viewConfig/config-area.php"; ?>
                </div>
                <div class="tab-pane fade" id="v-pills-turno" role="tabpanel" aria-labelledby="v-pills-turno-tab">
                    <?php include "./app/views/content/viewConfig/config-turno.php"; ?>
                </div>
                <div class="tab-pane fade" id="v-pills-logs" role="tabpanel" aria-labelledby="v-pills-logs-tab">
                    <?php include "./app/views/content/viewConfig/config-turno.php"; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "./app/views/scripts/script-config.php"; ?>