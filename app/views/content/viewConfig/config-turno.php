    <div class="row align-items-center">
        <div class="col-auto">
            <i class="bi bi-clock-fill fs-3"></i>
        </div>
        <div class="col">
            <h4>Turnos de trabajo</h4>
        </div>
    </div>
    <hr>
    <form action="">
        <div class="form-group" id="nuevo">
            <label class="form-label">Agregar nuevo sitio de trabajo</label>
            <div class="input-group">
                <input class="form-control" name="cedula" id="cedula" type="text" value=""
                    placeholder="Nombre del estado">
                <button class="btn btn-primary" type="submit" id="btnGuardar" title="Guardar">
                    <i class="bi bi-save"></i> Guardar
                </button>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Color</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Ejemplo de fila -->
                            <tr>
                                <th scope="row">1</th>
                                <td>Estado 1</td>
                                <td>
                                    <!-- Botones con iconos -->
                                    <button type="button" class="btn btn-primary"><i class="bi bi-pencil"></i></button>
                                    <button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <!-- Repite esta estructura para cada fila -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>