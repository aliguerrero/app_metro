<div class="row align-items-center">
    <div class="col-auto">
        <i class="bi bi-person-fill fs-3"></i>
    </div>
    <div class="col">
        <h4 class="mb-0">Cuenta usuario</h4>
    </div>
</div>
<hr>
<form class="g-3 FormularioAjax contenido" action="<?php echo APP_URL; ?>app/ajax/userAjax.php" method="POST"
    id="configUser">
    <input type="hidden" name="modulo_user" value="modificarUserSesion">
    <div class="row">
        <div class="col-md-4">
            <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
            <label class="form-label">CEDULA:</label>
            <input class="form-control " name="cedula" id="cedula" type="text" value="<?php echo $_SESSION['id']; ?>"
                placeholder="Ingresar cedula" autocomplete="off">
        </div>
        <div class="col-md-8">
            <label class="form-label">NOMBRE COMPLETO:</label>
            <input class="form-control " name="nombre" id="nombre" type="text" value="<?php echo $_SESSION['user']; ?>"
                placeholder="Ingresar Nombre y Apellido" autocomplete="off">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label class="form-label">USERNAME:</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" value="<?php echo $_SESSION['username']; ?>" class="form-control" name="username"
                    id="username" aria-describedby="inputGroupPrepend" placeholder="Ingresar Nombre de usuario"
                    autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="form-label">Contraseña:</label>
            <input class="form-control " name="clave1" id="clave1" type="password" value=""
                placeholder="Ingresar nueva contraseña" autocomplete="off">
        </div>
        <div class="col-md-6">
            <label class="form-label">Repetir Contraseña:</label>
            <input class="form-control " name="clave2" id="clave2" type="password" value=""
                placeholder="Repetir contraseña" autocomplete="off">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <button class="form-control" style="background-color: rgb(60, 75, 100); color:white ;" type="submit"
                aria-haspopup="true" aria-expanded="false">Actualizar</button>
        </div>
    </div>
</form>