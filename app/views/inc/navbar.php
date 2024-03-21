<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
      
      <img src="./app/views/icons/metro.png " alt="icon-metro" style="width: 3em;">
      <a class="nav-link" href="<?php ECHO APP_URL; ?>dashboard">
      <h4>FerreNet System</h4>
      </a>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
      <li class="nav-item"><a class="nav-link" href="<?php ECHO APP_URL; ?>dashboard">
          <svg class="nav-icon">
            <use xlink:href="./app/views/icons/svg/free.svg#cil-speedometer"></use>
          </svg> Panel</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="<?php ECHO APP_URL; ?>gestionOT">
          <svg class="nav-icon">
            <use xlink:href="./app/views/icons/svg/free.svg#cil-star"></use>
          </svg> Ordenes de Trabajo</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="<?php ECHO APP_URL; ?>gestionMiembro">
          <svg class="nav-icon">
            <use xlink:href="./app/views/icons/svg/free.svg#cil-star"></use>
          </svg> Miembro</a>        
      </li>
      <li class="nav-item"><a class="nav-link" href="<?php ECHO APP_URL; ?>gestionHerramienta">
          <svg class="nav-icon">
            <use xlink:href="./app/views/icons/svg/free.svg#cil-star"></use>
          </svg> Herramienta</a>        
      </li>

  </div>
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
      <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button"
          onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
          <svg class="icon icon-lg">
            <use xlink:href="./app/views/icons/svg/free.svg#cil-menu"></use> 
          </svg>
        </button><a class="header-brand d-md-none" href="<?php ECHO APP_URL; ?>dashboard">
          <svg width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="./app/views/icons/svg/coreui.svg#full"></use>
          </svg></a>
        <ul class="header-nav d-none d-md-flex">
          <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php ECHO APP_URL; ?>usuario">Usuarios</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Configuración</a></li>
        </ul>
        
        <ul class="header-nav ms-3">
          <li class="nav-item dropdown">
            <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button"
              aria-haspopup="true" aria-expanded="false">
              <div class="avatar avatar-md">
                <img class="avatar-img" src="./app/views/img/avatars/user.png" alt="user@email.com">                
              </div>
              <label for="">USUARIO NOMBRE</label>
            </a>
            <div class="dropdown-menu dropdown-menu-end pt-0">              
              <div class="dropdown-header bg-light py-2">
                <div class="fw-semibold">Settings</div>
              </div>
                <a class="dropdown-item" href="<?php ECHO APP_URL; ?>usuario">
                  <svg class="icon me-2">
                    <use xlink:href="./app/views/icons/svg/free.svg#cil-user"></use>
                  </svg> Usuarios
                </a>
                <a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="./app/views/icons/svg/free.svg#cil-settings"></use>
                  </svg> Configuración
                </a>
                <a class="dropdown-item" href="#">                
                  <div class="dropdown-divider">                    
                  </div>
                  <a class="dropdown-item" href="<?php ECHO APP_URL; ?>logOut">                    
                    <svg class="icon me-2">
                      <use xlink:href="./app/views/icons/svg/free.svg#cil-account-logout"></use>
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
    </div>