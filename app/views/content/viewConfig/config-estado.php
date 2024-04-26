    <div class="row align-items-center">
        <div class="col-auto">
            <i class="bi bi-list-task fs-3"></i>
        </div>
        <div class="col">
            <h4>Estados de Ordenes de trabajo</h4>
        </div>
    </div>
    <hr>
    <form action="">
        <div class="form-group" id="nuevo">
            <label class="form-label">Agregar nuevo estado</label>
            <div class="input-group">
                <input class="form-control" name="cedula" id="cedula" type="text" value=""
                    placeholder="Nombre del estado">
                <input type="color" class="form-control form-control-color" id="myColorInput2" value="#563d7c"
                    title="Choose your color" style="max-width: 50px;">
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
                                <th scope="col">Nombre del estado</th>
                                <th scope="col">Color</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Ejemplo de fila -->
                            <tr>
                                <th scope="row">1</th>
                                <td>Estado 1</td>
                                <td><input type="color" value="#ff0000" disabled></td>
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