// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    // Obtener el modal de modificación por su ID
    let tipoBusqueda = '';
    let dir = document.getElementById('url').value;
    let btnBuscarOt = document.getElementById('btnBuscarOt');
    let btnBuscarFecha = document.getElementById('btnBuscarFecha');
    let btnBuscarEstado = document.getElementById('btnBuscarEstado');
    let btnBuscarUser = document.getElementById('btnBuscarUser');
    let btnRecargar = document.getElementById('btnRecargar');

    // Agregar un listener para el evento "shown.bs.modal", que se dispara cuando el modal se muestra al usuario
    btnBuscarOt.addEventListener('click', function (event) {
        tipoBusqueda = 'ot';
        let area = limpiarCadena(document.getElementById('area').value);
        let nrot = limpiarCadena(document.getElementById('nrot').value);
        if (area === "Seleccionar") {
            mostrarAlerta('warning', '¡Ups!', 'No has seleccionado el area');
        } else {
            if (nrot === "") {
                reiniciarTabla(dir);
                var alerta = {
                    tipo: "simple",
                    icono: "warning",
                    titulo: "¡Ups!",
                    texto: "Ingresa un numero de orden de trabajo."
                };
                alertas_ajax(alerta);
                return;
            } else {
                if (verificarDatos('^[0-9]{1,10}$', nrot)) {
                    var alerta = {
                        tipo: "simple",
                        icono: "warning",
                        titulo: "¡Ups!",
                        texto: "El código no cumple con el formato solicitado."
                    };
                    alertas_ajax(alerta);
                    return; // Detener la ejecución del código aquí
                }
                let codigo = area + nrot;
                $.ajax({
                    url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorOt.php',
                    method: 'GET',
                    dataType: 'json',
                    data: { id: codigo, tipoBusqueda: tipoBusqueda },
                    success: function (data) {
                        if (data.length > 0) {
                            let tabla = document.getElementById('tablaDatosOt').getElementsByTagName('tbody')[0];
                            tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos
                            let contador = 1;
                            data.forEach(function (orden) {
                                let fila = tabla.insertRow();
                                fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                                // Celdas de la fila con el mismo estilo que en tu HTML
                                fila.innerHTML = tablaOt(dir, contador, orden.nombre_estado, orden.color, orden.n_ot, orden.nombre_trab, orden.fecha);
                                contador++;
                            });
                        } else {
                            reiniciarTabla(dir);
                            var alerta = {
                                tipo: "simple",
                                icono: "info",
                                titulo: "¡Ups!",
                                texto: 'No existen registros con el codigo: ' + codigo
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
        }
    });

    btnBuscarFecha.addEventListener('click', function (event) {
        tipoBusqueda = 'fecha';
        let area = limpiarCadena(document.getElementById('area').value);
        let fechaDesde = limpiarCadena(document.getElementById('fecha_desde').value);
        let fechaHasta = limpiarCadena(document.getElementById('fecha_hasta').value);

        if (fechaDesde === "" || fechaHasta === "") {
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
                url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorOt.php',
                method: 'GET',
                dataType: 'json',
                data: { fechaI: fechaDesde, fechaF: fechaHasta, area: area, tipoBusqueda: tipoBusqueda },
                success: function (data) {
                    if (data.length > 0) {
                        let tabla = document.getElementById('tablaDatosOt').getElementsByTagName('tbody')[0];
                        tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos
                        let contador = 1;
                        data.forEach(function (orden) {
                            let fila = tabla.insertRow();
                            fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                            // Celdas de la fila con el mismo estilo que en tu HTML
                            fila.innerHTML = tablaOt(dir, contador, orden.nombre_estado, orden.color, orden.n_ot, orden.nombre_trab, orden.fecha);
                            contador++;
                        });
                    } else {
                        reiniciarTabla(dir);
                        var alerta = {
                            tipo: "simple",
                            icono: "info",
                            titulo: "¡Ups!",
                            texto: 'No existen registros en este rango de fecha'
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
    btnBuscarEstado.addEventListener('click', function (event) {
        tipoBusqueda = 'estado';
        let area = limpiarCadena(document.getElementById('area').value);
        let estado = limpiarCadena(document.getElementById('status').value);

        if (estado === "Seleccionar") {
            reiniciarTabla(dir);
            var alerta = {
                tipo: "simple",
                icono: "info",
                titulo: "¡Ups!",
                texto: 'Selecciona el estado.'
            };
            alertas_ajax(alerta);
            return;
        } else {
            $.ajax({
                url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorOt.php',
                method: 'GET',
                dataType: 'json',
                data: { estado: estado, area: area, tipoBusqueda: tipoBusqueda },
                success: function (data) {
                    if (data.length > 0) {
                        let tabla = document.getElementById('tablaDatosOt').getElementsByTagName('tbody')[0];
                        tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos
                        let contador = 1;
                        data.forEach(function (orden) {
                            let fila = tabla.insertRow();
                            fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                            // Celdas de la fila con el mismo estilo que en tu HTML
                            fila.innerHTML = tablaOt(dir, contador, orden.nombre_estado, orden.color, orden.n_ot, orden.nombre_trab, orden.fecha);
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
    btnBuscarUser.addEventListener('click', function (event) {
        tipoBusqueda = 'user';
        let area = limpiarCadena(document.getElementById('area').value);
        let user = limpiarCadena(document.getElementById('user').value);

        if (user === "Seleccionar") {
            reiniciarTabla(dir);
            var alerta = {
                tipo: "simple",
                icono: "info",
                titulo: "¡Ups!",
                texto: 'Selecciona el Usuario.'
            };
            alertas_ajax(alerta);
            return;
        } else {
            $.ajax({
                url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorOt.php',
                method: 'GET',
                dataType: 'json',
                data: { user: user, area: area, tipoBusqueda: tipoBusqueda },
                success: function (data) {
                    if (data.length > 0) {
                        let tabla = document.getElementById('tablaDatosOt').getElementsByTagName('tbody')[0];
                        tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos
                        let contador = 1;
                        data.forEach(function (orden) {
                            let fila = tabla.insertRow();
                            fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                            // Celdas de la fila con el mismo estilo que en tu HTML
                            fila.innerHTML = tablaOt(dir, contador, orden.nombre_estado, orden.color, orden.n_ot, orden.nombre_trab, orden.fecha);
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
        url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorOt.php',
        method: 'GET',
        dataType: 'json',
        data: { tipoBusqueda: tipoBusqueda },
        success: function (data) {
            let tabla = document.getElementById('tablaDatosOt').getElementsByTagName('tbody')[0];
            tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos
            if (data.length > 0) {              
                let contador = 1;
                data.forEach(function (orden) {
                    let fila = tabla.insertRow();
                    fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                    // Celdas de la fila con el mismo estilo que en tu HTML                    
                    fila.innerHTML = tablaOt(dir, contador, orden.nombre_estado, orden.color, orden.n_ot, orden.nombre_trab, orden.fecha);
                    contador++;
                });
            }else{
                let fila = tabla.insertRow();
                fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                tabla.innerHTML = tablaOtVacia();
            }
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener la orden de trabajo:', error);
        }
    });
}
function tablaOtVacia() {
    tabla = `
        <td class="text-center">
            No hay registros en el sistema
        </td>                    
    `;
    return tabla;
}
function tablaOt(dir, contador, estado, color, n_ot, nombre_trab, fecha) {
    let self = this;
    tabla = `
            <td class="clearfix col-auto">
                            <div class=""><b>${contador}</b></div>
                        </td>
                        <td class="clearfix col-pE">
                            <div class="avatar avatar-md" title="${self.estado(estado)}"><img class="avatar-img"
                                src="${dir}app/views/icons/ot.png"><span
                                style="position: absolute; bottom: 0; display: block; border: 1px solid #fff;
                                    border-radius: 50em; width: 0.7333333333rem; height: 0.7333333333rem; right: 0; 
                                    background-color: ${color};" ></span>
                            </div>
                            <b>${self.estado(estado)}</b>
                        </td>
                        <td class="col-p6">
                            <div class="clearfix">
                                <div class=""><b>${self.formatearFecha(fecha)}</b></div>
                            </div>
                        </td>                            
                        <td class="col-p6">
                            <div class="clearfix">
                                <div class=""><b>${n_ot}</b></div>
                            </div>
                        </td>
                        <td class="">
                            <div class="clearfix">
                                <div class=""><b>${nombre_trab}</b></div>
                            </div>
                        </td>                                     
                        <td class="col-p">
                            <button type="button" title="Ver" class="btn btn-primary">
                                <i class="bi bi-eye"></i>
                            </button>                       
                        </td>
                        <td class="col-p">
                            <button type="button" title="Generar Reporte" class="btn btn-primary">
                                <i class="bi bi-file-earmark-text"></i>
                            </button>                       
                        </td>
                        <td class="col-p">
                            <a href="#" title="Detalles Orden" id="detalleot" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventanaModalDetalleOt" data-bs-id="${n_ot}">
                                <i class="bi bi-card-list"></i>
                            </a> 
                        </td>
                        <td class="col-p">
                                <a href="#" title="Agregar Herramienta" id="herramientaOt" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModificarHerrOt" data-bs-id="${n_ot}">
                                    <i class="bi bi-tools"></i>
                                </a> 
                            </td>
                        <td class="col-p">
                            <a href="#" title="Modificar O.T." class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventanaModalModificarOt" data-bs-id="${n_ot}">
                                <i class="bi bi-pencil"></i>
                            </a> 
                        </td>
                        <td class="col-p">
                            <form class="FormularioAjaxJs" action="${dir}app/ajax/otAjax.php" method="POST">
                                <input type="hidden" name="modulo_ot" value="eliminar">
                                <input type="hidden" name="miembro_id" value="${n_ot}">
                                <button type="submit" class="btn btn-primary" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button> 
                            </form>
                        </td>
    `;
    return tabla;
}
function formatearFecha(fecha) {
    var partes = fecha.split('-');
    var dia = partes[2];
    var mes = partes[1];
    var año = partes[0];
    return dia + '/' + mes + '/' + año;
}
function estado(estado) {
    if (!estado || estado.trim() === '') {
        return 'SIN DETALLE';
    } else {
        return estado;
    }
}

function verificarDatos(filtro, cadena) {
    let regex = new RegExp('^' + filtro + '$');
    if (regex.test(cadena)) {
        return false;
    } else {
        return true;
    }
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