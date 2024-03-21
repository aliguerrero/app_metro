<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
  <!-- Contenedor principal con fondo claro y elementos centrados verticalmente -->
  <div class="container">
    <!-- Contenedor para el contenido principal -->
    <div class="row justify-content-center">
      <!-- Fila centrada horizontalmente -->
      <div class="col-lg-8">
        <!-- Columna que ocupa 8 espacios en pantallas grandes -->
        <div class="card-group d-block d-md-flex row">
          <!-- Grupo de tarjetas, se muestra en bloque en pantallas pequeñas y como fila en medianas/grandes -->
          <div class="card col-md-7 p-4 mb-0">
            <!-- Tarjeta para el formulario de inicio de sesión -->
            <div class="card-body">
              <!-- Cuerpo de la tarjeta -->
              <h1 class="mb-4">Login</h1>
              <!-- Encabezado principal -->
              <form class="" action="" method="POST" class="needs-validation" novalidate>
                <!-- Formulario de inicio de sesión con validación -->
                <div class="mb-3">
                  <!-- Grupo de entrada para el nombre de usuario -->
                  <label for="username" class="form-label visually-hidden">Username</label>
                  <!-- Etiqueta para el campo de nombre de usuario (oculta visualmente) -->
                  <div class="input-group">
                    <!-- Grupo de entrada -->
                    <span class="input-group-text">
                      <!-- Icono de usuario -->
                      <svg class="icon">
                        <!-- Icono SVG -->
                        <use xlink:href="./app/views/icons/svg/free.svg#cil-user"></use>
                        <!-- Uso del icono definido en el archivo de sprites SVG -->
                      </svg>
                    </span>
                    <!-- Icono de usuario -->
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    <!-- Campo de entrada para el nombre de usuario -->
                    <div class="invalid-feedback">Por favor ingresa tu nombre de usuario.</div>
                    <!-- Mensaje de retroalimentación para la validación -->
                  </div>
                </div>
                <div class="mb-3">
                  <!-- Grupo de entrada para la contraseña -->
                  <label for="password" class="form-label visually-hidden">Contraseña</label>
                  <!-- Etiqueta para el campo de contraseña (oculta visualmente) -->
                  <div class="input-group">
                    <!-- Grupo de entrada -->
                    <span class="input-group-text">
                      <!-- Icono de candado -->
                      <svg class="icon">
                        <!-- Icono SVG -->
                        <use xlink:href="./app/views/icons/svg/free.svg#cil-lock-locked"></use>
                        <!-- Uso del icono definido en el archivo de sprites SVG -->
                      </svg>
                    </span>
                    <!-- Icono de candado -->
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                    <!-- Campo de entrada para la contraseña -->
                    <div class="invalid-feedback">Por favor ingresa tu contraseña.</div>
                    <!-- Mensaje de retroalimentación para la validación -->
                  </div>
                </div>
                <div class="row">
                  <!-- Fila para botones -->
                  <div class="col-6">
                    <!-- Columna para el botón de "Entrar" -->
                    <button class="btn btn-primary w-100" type="submit">Entrar</button>
                    <!-- Botón para enviar el formulario -->
                  </div>
                  <div class="col-6 text-end">
                    <!-- Columna para el botón de "¿Has olvidado tu contraseña?" -->
                    <a href="#" class="btn btn-link px-0">¿Has olvidado tu contraseña?</a>
                    <!-- Botón para recuperar la contraseña -->
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="card col-md-5 text-white bg-primary py-5">
            <!-- Tarjeta para información adicional -->
            <div class="card-body text-center">
              <!-- Cuerpo de la tarjeta -->
              <div>
                <!-- Contenido adicional -->
                <h2>FerreNet System</h2>
                <!-- Encabezado secundario -->
                <p>
                  Utilizar el sistema ofrece una serie de ventajas significativas que mejoran la eficiencia y la comodidad.
                </p>
                <!-- Texto descriptivo -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $insLogin->iniciarSesionControlador();
  }
?>