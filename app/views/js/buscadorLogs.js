// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    // Obtener el modal de modificación por su ID
    let dir = document.getElementById('url').value;
    let btnBuscarLogs = document.getElementById('btnBuscarLogs');
    let btnRecargar = document.getElementById('btnRecargar');

    // Agregar un listener para el evento "shown.bs.modal", que se dispara cuando el modal se muestra al usuario
    btnBuscarLogs.addEventListener('click', function (event) {
        let tipoBusqueda = 'id';        
        let user = limpiarCadena(document.getElementById('user').value);
        let accion = limpiarCadena(document.getElementById('accion').value);
        let fecha_desde = limpiarCadena(document.getElementById('fecha_desde').value);
        let fecha_hasta = limpiarCadena(document.getElementById('fecha_hasta').value);

        if (fecha_desde === "" || fecha_hasta === "") {
            reiniciarTabla(dir);
            var alerta = {
                tipo: "simple",
                icono: "info",
                titulo: "¡Ups!",
                texto: 'Seleccione el rango de fecha a consultar'
            };
            alertas_ajax(alerta);
            return;
        } else {
            $.ajax({
                url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorLogs.php',
                method: 'GET',
                dataType: 'json',
                data: { id: user, accion: accion, fecha_desde: fecha_desde, fecha_hasta: fecha_hasta, tipoBusqueda: tipoBusqueda },
                success: function (data) {
                    if (data.length > 0) {
                        let tabla = document.getElementById('tablaDatosLogs').getElementsByTagName('tbody')[0];
                        tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos
                        let contador = 1;
                        data.forEach(function (datos) {
                            let fila = tabla.insertRow();
                            fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                            // Celdas de la fila con el mismo estilo que en tu HTML
                            fila.innerHTML = tablaLogs(dir, contador, datos.nombre_usuario, datos.accion, datos.resp_system, datos.fecha_hora);
                            contador++;
                        });
                    } else {
                        reiniciarTabla(dir);
                        var alerta = {
                            tipo: "simple",
                            icono: "info",
                            titulo: "¡Ups!",
                            texto: 'No existen registros'
                        };
                        alertas_ajax(alerta);
                        return;
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error al obtener la orden de trabajo:', error);
                }
            });

        }
    });

    btnRecargar.addEventListener('click', function (event) {
        alerta("success", "Tabla recargada", 4000);
        reiniciarTabla(dir);
    });


});

function reiniciarTabla(dir) {
    let tipoBusqueda = 'todo';
    $.ajax({
        url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorLogs.php',
        method: 'GET',
        dataType: 'json',
        data: { tipoBusqueda: tipoBusqueda },
        success: function (data) {
            let tabla = document.getElementById('tablaDatosLogs').getElementsByTagName('tbody')[0];
            tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos
            if (data.length > 0) {
                let contador = 1;
                data.forEach(function (datos) {
                    let fila = tabla.insertRow();
                    fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                    // Celdas de la fila con el mismo estilo que en tu HTML                    
                    fila.innerHTML = tablaLogs(dir, contador, datos.nombre_usuario, datos.accion, datos.resp_system, datos.fecha_hora);
                    contador++;
                });
            } else {
                let fila = tabla.insertRow();
                fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                // Celdas de la fila con el mismo estilo que en tu HTML                    
                fila.innerHTML = tablaLogsVacia();
            }
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener la orden de trabajo:', error);
        }
    });
}
function tablaLogs(dir, contador, nombre_usuario, accion, resp_system, fecha_hora) {
    tabla = `
                            <td class="clearfix col-p">
                                <div class=""><b>${contador}</b></div>
                            </td>                                                    
                            <td class="col-auto">
                                <div class="clearfix">
                                    <div class=""><b>${nombre_usuario}</b></div>
                                </div>
                            </td>
                            <td class="col-2">
                                <div class="clearfix">
                                    <div class=""><b>${accion}</b></div>
                                </div>
                            </td>
                            <td class="col-auto">
                                <div class="clearfix">
                                    <div class=""><b>${resp_system}</b></div>
                                </div>
                            </td>
                            <td class="col-2">
                                <div class="clearfix">
                                    <div class=""><b>${fecha_hora}</b></div>
                                </div>
                            </td>                         
                                                      
    `;
    return tabla;
}

function tablaLogsVacia() {
    tabla = `
        <td class="text-center">
            No hay registros en el sistema
        </td>
    `;
    return tabla;
}

function eliminarHerramienta(parametro, dir) {
    let tipoBusqueda = 'eliminar';
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡Quieres realizar la acción solicitada!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, realizar",
        cancelButtonText: "No, cancelar",
    }).then((result) => { // Una vez que el usuario hace clic en el botón del cuadro de diálogo...
        if (result.isConfirmed) { // Si el usuario confirma la acción...
            $.ajax({
                url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorLogs.php',
                method: 'GET',
                dataType: 'json',
                data: { id: parametro, tipoBusqueda: tipoBusqueda },
                success: function (data) {
                    if (data) {
                        reiniciarTabla(dir);
                        var alerta = {
                            tipo: "simple",
                            icono: "success",
                            titulo: "Herramienta Eliminada",
                            texto: 'La herramienta ha sido eliminado con exito'
                        };
                        alertas_ajax(alerta);
                        return;
                    } else {
                        reiniciarTabla(dir);
                        var alerta = {
                            tipo: "simple",
                            icono: "error",
                            titulo: "Ocurrió un error inesperado",
                            texto: 'No se pudo eliminar la Herramienta, por favor intente nuevamente'
                        };
                        alertas_ajax(alerta);
                        return;
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error al obtener la orden de trabajo:', error);
                }
            });
        }
    });

}

function alerta(icono, texto, segundo) {
    let Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: segundo,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: icono,
        title: texto,
    });
}
function mostrarAlerta(icono, titulo, texto) {
    Swal.fire({
        icon: icono,
        title: titulo,
        text: texto,
        confirmButtonText: 'Aceptar'
    });
}
function limpiarCadena(cadena) {
    const palabras = [
        '<script>',
        '</script>',
        '<script src',
        '<script type=',
        'SELECT * FROM',
        'SELECT ',
        ' SELECT ',
        'DELETE FROM',
        'INSERT INTO',
        'DROP TABLE',
        'DROP DATABASE',
        'TRUNCATE TABLE',
        'SHOW TABLES',
        'SHOW DATABASES',
        '\\<\\?php',
        '\\?\\>',
        '--',
        '^',
        '<', '>', '==', '=', ';', '::'
    ];


    // Eliminar espacios en blanco al inicio y al final de la cadena
    cadena = cadena.trim();

    // Eliminar barras invertidas (\)
    cadena = cadena.replace(/\\/g, '');

    // Iterar sobre cada palabra prohibida y eliminarla de la cadena
    palabras.forEach(function (palabra) {
        cadena = cadena.replace(new RegExp(palabra, 'gi'), '');
    });

    // Escapar caracteres HTML
    cadena = cadena.replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");

    // Eliminar espacios en blanco adicionales
    cadena = cadena.trim();

    // Eliminar barras invertidas (\)
    cadena = cadena.replace(/\\/g, '');

    return cadena;
}

document.getElementById('fecha_desde').addEventListener('change', function() {
    var fecha_desde = new Date(this.value);
    var fecha_hasta = new Date(document.getElementById('fecha_hasta').value);

    if (fecha_desde > fecha_hasta) {
        
        const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 7000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        } });
          Toast.fire({
            icon: "warning",
            title: "Verificar rango de fecha inicial, no puede ser superior a fecha final.",
        });
        this.value = ''; // Limpiar el campo
    }
});

document.getElementById('fecha_hasta').addEventListener('change', function() {
    var fecha_desde = new Date(document.getElementById('fecha_desde').value);
    var fecha_hasta = new Date(this.value);

    if (fecha_hasta < fecha_desde) {
       
        const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 7000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        } });
            Toast.fire({
            icon: "warning",
            title: "Verificar rango de fecha final, no puede ser inferior a fecha inicial.",
        });    
        this.value = ''; // Limpiar el campo
    }
});