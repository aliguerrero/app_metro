// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    // Obtener el modal de modificación por su ID
    let dir = document.getElementById('url').value;


    let btnBuscarHerramienta = document.getElementById('btnBuscarHerramienta');
    let btnBuscarHerramientaOt = document.getElementById('btnBuscarHerramientaOt');

    let btnRecargarHer = document.getElementById('btnRecargarHer');
    let btnRecargarOt = document.getElementById('btnRecargarOt');


    // Agregar un listener para el evento "shown.bs.modal", que se dispara cuando el modal se muestra al usuario
    btnBuscarHerramienta.addEventListener('click', function (event) {
        let codigoOt = document.getElementById("codigoOt").innerText;
        let tipoBusqueda = 'her';
        let campo = limpiarCadena(document.getElementById('campoHe').value);
        if (campo === "") {
            reiniciarTabla(dir);
            mostrarAlerta('warning', '¡Ups!', 'No has ingresado nada');
        } else {
            $.ajax({
                url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorHOT.php',
                method: 'GET',
                dataType: 'json',
                data: { campo: campo, tipoBusqueda: tipoBusqueda },
                success: function (data) {
                    if (data.length > 0) {
                        let tabla = document.getElementById('tablaHerramienta').getElementsByTagName('tbody')[0];
                        tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos
                        let contador = 1;
                        data.forEach(function (datos) {
                            let fila = tabla.insertRow();
                            fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                            // Celdas de la fila con el mismo estilo que en tu HTML
                            fila.innerHTML = tablaHerramienta(dir, contador, codigoOt, datos.id_herramienta, datos.nombre_herramienta, datos.cantidad_disponible);
                            contador++;
                        });
                    } else {
                        reiniciarTablaHerr(dir);
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

    btnBuscarHerramientaOt.addEventListener('click', function (event) {
        let codigoOt = document.getElementById("codigoOt").innerText;
        let tipoBusqueda = 'herOt';
        let campo = limpiarCadena(document.getElementById('campoOt').value);
        if (campo === "") {
            reiniciarTabla(dir);
            mostrarAlerta('warning', '¡Ups!', 'No has ingresado nada');
        } else {
            $.ajax({
                url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorHOT.php',
                method: 'GET',
                dataType: 'json',
                data: { id: codigoOt, campo: campo, tipoBusqueda: tipoBusqueda },
                success: function (data) {
                    if (data.length > 0) {
                        let tabla = document.getElementById('tablaHerramientaOt').getElementsByTagName('tbody')[0];
                        tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos
                        let contador = 1;
                        data.forEach(function (datos) {
                            let fila = tabla.insertRow();
                            fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                            // Celdas de la fila con el mismo estilo que en tu HTML
                            fila.innerHTML = tablaHerramientaOT(dir, contador, datos.n_ot, datos.nombre_herramienta, datos.cantidadot, datos.id_herramienta);
                            contador++;
                        });
                    } else {
                        reiniciarTablaHerrOt(dir);
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

    btnRecargarHer.addEventListener('click', function (event) {
        alerta("success", "Tabla Herramienta recargada", 4000);
        reiniciarTablaHerr(dir);
    });

    btnRecargarOt.addEventListener('click', function (event) {
        alerta("success", "Tabla Herramienta O.T. recargada", 4000);
        reiniciarTablaHerrOt(dir);
    });

    $('#ModificarHerrOt').on('hidden.bs.modal', function (e) {
        // Limpiar el contenido del elemento con el ID "codigoOt"
        $('#campoHe').val('');
        $('#campoOt').val('');
        reiniciarTablaHerr(dir);
    });

});
function reiniciarTablaHerr(dir) {
    let codigoOt = document.getElementById("codigoOt").innerText;
    let tipoBusqueda = 'todoHer';
    $.ajax({
        url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorHOT.php',
        method: 'GET',
        dataType: 'json',
        data: { tipoBusqueda: tipoBusqueda },
        success: function (data) {
            let tabla = document.getElementById('tablaHerramienta').getElementsByTagName('tbody')[0];
            tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos
            if (data.length > 0) {
                let contador = 1;
                data.forEach(function (datos) {
                    let fila = tabla.insertRow();
                    fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                    // Celdas de la fila con el mismo estilo que en tu HTML                    
                    fila.innerHTML = tablaHerramienta(dir, contador, codigoOt, datos.id_herramienta, datos.nombre_herramienta, datos.cantidad_disponible);
                    contador++;
                });
            } else {
                let fila = tabla.insertRow();
                fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                // Celdas de la fila con el mismo estilo que en tu HTML                    
                fila.innerHTML = tablaVacia();
            }
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener la orden de trabajo:', error);
        }
    });
}
function reiniciarTablaHerrOt(dir) {
    let codigoOt = document.getElementById("codigoOt").innerText;
    let tipoBusqueda = 'todoHerOt';
    $.ajax({
        url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorHOT.php',
        method: 'GET',
        dataType: 'json',
        data: { id: codigoOt, tipoBusqueda: tipoBusqueda },
        success: function (data) {
            let tabla = document.getElementById('tablaHerramientaOt').getElementsByTagName('tbody')[0];
            tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos
            if (data.length > 0) {
                let contador = 1;
                data.forEach(function (datos) {
                    let fila = tabla.insertRow();
                    fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                    // Celdas de la fila con el mismo estilo que en tu HTML                    
                    fila.innerHTML = tablaHerramientaOT(dir, contador, datos.n_ot, datos.nombre_herramienta, datos.cantidadot, datos.id_herramienta);
                    contador++;
                });
            } else {
                let fila = tabla.insertRow();
                fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                // Celdas de la fila con el mismo estilo que en tu HTML                    
                fila.innerHTML = tablaVacia();
            }
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener la orden de trabajo:', error);
        }
    });
}
function tablaHerramienta(dir, contador, n_ot, id_herramienta, nombre_herramienta, cantidad_disponible) {
    let op = 'mas';
    tabla = `
    <td class="clearfix col-p">
        <div class=""><b>${contador}</b></div>
    </td>
    <td class="text-center col-p">
        <div class="avatar avatar-md"><img class="avatar-img"
                src="${dir}app/views/img/tools.png" alt="user@email.com"><span
    </td>                            
    <td class="col-2">
        <div class="clearfix">
            <div class=""><b>${id_herramienta}</b></div>
        </div>
    </td>
    <td class="">
        <div class="clearfix">
            <div class=""><b>${nombre_herramienta}</b></div>
        </div>
    </td>                          
    <td class="col-2">
        <div class="text-center">
            <div class=""><b>${cantidad_disponible}</b></div>
        </div>
    </td>                            
    <td class="col-p">
        <a href="#" title="Agregar" class="btn btn-primary" onclick="agregarQuitarHerramienta('${op}','${n_ot}','${id_herramienta}','${dir}')" data-bs-id="${id_herramienta}">
            <img src="${dir}app/views/icons/add.png" alt="icono" width="28" height="28">
        </a>                                                   
    </td> 
    `;
    return tabla;
}
function tablaHerramientaOT(dir, contador, n_ot, nombre_herramienta, cantidadot, id_herramienta) {
    let op = 'menos';
    tabla = `
<tr class="align-middle">
    <td class="col-p">
        <div class="clearfix">
            <div class=""><b>${contador}</b></div>
        </div>
    </td>   
    <td class="text-center col-p">
        <div class="avatar avatar-md"><img class="avatar-img"
                src="${dir}app/views/img/tools.png" alt="user@email.com"><span
    </td>          
    <td class="col-2">
        <div class="clearfix">
            <div class=""><b>${id_herramienta}</b></div>
        </div>
    </td>
    <td class="col-5">
        <div class="clearfix">
            <div class=""><b>${nombre_herramienta}</b></div>
        </div>
    </td>
    <td class="col-p">
        <div class="text-center">
            <div class=""><b>${cantidadot}</b></div>
        </div>
    </td> 
    <td class="col-p">
        <a href="#" title="Quitar" class="btn btn-primary" onclick="agregarQuitarHerramienta('${op}','${n_ot}','${id_herramienta}','${dir}')" data-bs-id="${id_herramienta}">
            <img src="${dir}app/views/icons/menos.png" alt="icono" width="28" height="28">
        </a>                                                   
    </td>                               
</tr> 
    `;
    return tabla;
}
function tablaVacia() {
    tabla = `
        <td class="text-center">
            No hay registros en el sistema
        </td>
    `;
    return tabla;
}

function agregarQuitarHerramienta(tipo, codigoOt, codigoHer, dir) {
    let self = this;
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
                url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorHOT.php',
                method: 'GET',
                dataType: 'json',
                data: { id: codigoOt, codigoHer: codigoHer, tipoBusqueda: tipoBusqueda, tipo: tipo },
                success: function (data) {
                    if (data != 'nohay') {
                        if (tipo === 'mas') {
                            if (data) {
                                reiniciarTablaHerrOt(dir);
                                reiniciarTablaHerr(dir);
                                self.alerta("success", "La herramienta ha sido agregada con exito", 4000);
                                return;
                            } else {
                                reiniciarTablaHerrOt(dir);
                                reiniciarTablaHerr(dir);
                                self.alerta("error", "No se pudo agregar la Herramienta, por favor intente nuevamente", 4000);
                                return;
                            }
                        } else {
                            if (data) {
                                reiniciarTablaHerr(dir);
                                reiniciarTablaHerrOt(dir);
                                self.alerta("success", "La herramienta ha sido desincorporada con exito", 4000);
                                return;
                            } else {
                                reiniciarTablaHerr(dir);
                                reiniciarTablaHerrOt(dir);
                                self.alerta("error", "No se pudo desincorporar la Herramienta, por favor intente nuevamente", 4000);
                                return;
                            }
                        }
                    } else {
                        mostrarAlerta('warning', '¡Ups!', 'No hay disponible');
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