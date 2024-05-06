<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex p-2">
        <img src="<?php echo APP_URL; ?>app/views/icons/metro.png" alt="icon-metro" style="width: 3em;">
        <a class="nav-link" href="<?php ECHO APP_URL; ?>dashboard/">
            <h5 class="fontTitle">FerreNet System</h5>
        </a>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item">
            <a class="nav-link" href="<?php ECHO APP_URL; ?>dashboard/">
                <i class="bi bi-speedometer2 nav-icon"></i> Panel
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php ECHO APP_URL; ?>gestionOT/">
                <i class="bi bi-clipboard nav-icon"></i> Ordenes de Trabajo
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php ECHO APP_URL; ?>gestionMiembro/">
                <i class="bi bi-people nav-icon"></i> Miembro
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php ECHO APP_URL; ?>gestionHerramienta/">
                <i class="bi bi-gear nav-icon"></i> Herramienta
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php ECHO APP_URL; ?>reporte/">
                <i class="bi bi-file-earmark nav-icon"></i> Reportes
            </a>
        </li>
    </ul>

</div>
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
        <div class="container-fluid">
            <button class="header-toggler px-md-0 me-md-3" type="button"
                onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <svg class="icon icon-lg">
                    <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-menu"></use>
                </svg>
            </button>
            <a class="header-brand d-md-none" href="<?php ECHO APP_URL; ?>dashboard/">
                <img src="<?php echo APP_URL; ?>app/views/icons/metro_android.png" width="118" height="46">
            </a>
            <ul class="header-nav d-none d-md-flex">
                <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php ECHO APP_URL; ?>usuario/">Usuarios</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php ECHO APP_URL; ?>config/">Configuración</a></li>
            </ul>

            <ul class="header-nav ms-3">
                <li class="nav-item dropdown">
                    <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="avatar avatar-md">
                            <img class="avatar-img" src="<?php echo APP_URL; ?>app/views/img/avatars/user.png"
                                alt="user@email.com">
                        </div>
                        <label><?php echo $_SESSION['user'] ?></label>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pt-0">
                        <div class="dropdown-header bg-light py-2">
                            <div class="fw-semibold">Settings</div>
                        </div>
                        <a class="dropdown-item" href="<?php ECHO APP_URL; ?>usuario/">
                            <svg class="icon me-2">
                                <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-user"></use>
                            </svg> Usuarios
                        </a>
                        <a class="dropdown-item" href="<?php ECHO APP_URL; ?>usuario/">
                            <i class="bi bi-journal me-2"></i>Logs Sistema
                        </a>
                        <a class="dropdown-item" href="<?php ECHO APP_URL; ?>config/">
                            <svg class="icon me-2">
                                <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-settings"></use>
                            </svg> Configuración
                        </a>
                        <a class="dropdown-item" href="#">
                            <div class="dropdown-divider">
                            </div>
                            <a class="dropdown-item" href="<?php echo APP_URL; ?>logOut/" id="btn_exit">
                                <svg class="icon me-2">
                                    <use
                                        xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-account-logout">
                                    </use>
                                </svg> Cerrar sesión
                            </a>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <main id="main" class="body flex-grow-1 px-3">
        <?php require_once $vista; ?>
    </main>
    <footer class="footer">
        <div class="container text-center">            
            <div class="row">
                <div class="col-lg-12">                    
                    <p class="small mb-0"><i class="bi bi-building"></i> © 2024 C.A, Metro Valencia. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>
</div>