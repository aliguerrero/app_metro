<div class="body flex-grow-1 px-3">
            <div class="row">
                <div class="col-md-8 p-4">
                    <div class="row">
                        <label class="form-label" >BUSCAR USUARIO:</label>
                        <div class="col-md-4">
                            <input class="form-control "  type="text"  
                                placeholder="Cedula/Nombre">
                            <div class="valid-feedback">Bien Hecho</div>
                        </div>
                        <div class="col-md-2">
                            <button class="form-control" style="background-color: rgb(60, 75, 100); color:white ;" type="button"
                                data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Buscar</button>
                        </div>
                    </div>                   
                </div>
                <!--<div class="col-md-2 p-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-medium-emphasis text-end mb-4">
                                <svg class="icon icon-xxl">
                                    <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-people"></use>
                                </svg>
                            </div>
                            <div class="fs-4 fw-semibold">87.500</div><small
                                class="text-medium-emphasis text-uppercase fw-semibold">Responsable Ccf</small>
                            <div class="progress progress-thin mt-3 mb-0">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div><br>

                <div class="col-md-2 p-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-medium-emphasis text-end mb-4">

                                <svg class="icon icon-xxl">
                                    <use xlink:href="<?php echo APP_URL; ?>app/views/icons/svg/free.svg#cil-people"></use>
                                </svg>
                            </div>
                            <div class="fs-4 fw-semibold">87.500</div><small
                                class="text-medium-emphasis text-uppercase fw-semibold">Responsable Cco</small>
                            <div class="progress progress-thin mt-3 mb-0">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div> -->               
            </div>
            <hr>

            <div class="row">
                <div class="col-md-8 p-3">
                    <div class="row">
                        <label for="">
                            <h4>Usuarios registrados</h4>
                        </label>
                        <?php 
                            use app\controllers\userController;
                            $insUsuario = new userController();
                            
                            echo $insUsuario->listarUsuarioControlador ($url[1],8,$url[0],"");
                        ?>                                
                    </div>                           
                </div>

                <div class="col-md-3">
                    <form class="row g-3 FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/userAjax.php" method="POST" autocomplete="">
                        <input type="hidden" name="modulo_user" value="registrar">
                        <div class="row">
                            <div class="col-md-5"><br>
                                <label class="form-label" >CEDULA:</label>
                                <input class="form-control " name="cedula"  id="" type="text" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label" >NOMBRE COMPLETO:</label>
                                <input class="form-control "  name="nombre"  id="" type="text" value="" >                               
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label  class="form-label">USERNAME:</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input  id="" type="text" value="" class="form-control" name="username" 
                                        aria-describedby="inputGroupPrepend" >                                    
                                </div>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label" >CONTRASEÑA:</label>
                                <input class="form-control " name="clave1"  type="password" id="" value="" 
                                     placeholder="Ingrese Contraseña">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label" >REPETIR CONTRASEÑA:</label>
                                <input class="form-control "  name="clave2" type="password" id="" value="" 
                                     placeholder="Repita Contraseña">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label" >TIPO DE USUARIO:</label>
                                <select class="form-select"  name="tipo" aria-label="Default select example" id="" value="" >
                                    <option selected>Seleccionar</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Operador</option>
                                </select>                                
                            </div>
                        </div>
                        <div class="row offset-2 p-4">
                            <div class="col-md-4">
                                <button class="form-control" style="background-color: rgb(60, 75, 100); color:white ;"
                                    type="submit"  aria-haspopup="true"
                                    aria-expanded="false">Guardar</button>
                            </div>

                            <div class="col-md-4">
                                <button class="form-control" style="background-color: rgb(60, 75, 100); color:white ;"
                                    type="button" data-coreui-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">Cancelar</button>
                            </div>

                        </div>
                    </form>
                </div>
                <!------------------------widgets-------------------------->

                


                <!------------------------ fin widgets-------------------------->
            </div>

        </div>