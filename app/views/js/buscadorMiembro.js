// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    // Obtener el modal de modificación por su ID
    let dir = document.getElementById('url').value;
    let btnBuscarMiembro = document.getElementById('btnBuscarMiembro');
    let btnRecargar = document.getElementById('btnRecargar');

    // Agregar un listener para el evento "shown.bs.modal", que se dispara cuando el modal se muestra al usuario
    btnBuscarMiembro.addEventListener('click', function (event) {
        let tipoBusqueda = 'id';
        let campo = limpiarCadena(document.getElementById('campo').value);
        if (campo === "") {
            reiniciarTabla(dir);
            mostrarAlerta('warning', '¡Ups!', 'No has ingresado nada');
        } else {
            $.ajax({
                url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorMiem.php',
                method: 'GET',
                dataType: 'json',
                data: { id: campo, tipoBusqueda: tipoBusqueda },
                success: function (data) {
                    if (data.length > 0) {
                        let tabla = document.getElementById('tablaDatosMiem').getElementsByTagName('tbody')[0];
                        tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos
                        let contador = 1;
                        data.forEach(function (miem) {
                            let fila = tabla.insertRow();
                            fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                            // Celdas de la fila con el mismo estilo que en tu HTML
                            fila.innerHTML = tablaMiembro(dir, contador, miem.id_miembro, miem.nombre_miembro, miem.tipo_miembro);
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
        url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorMiem.php',
        method: 'GET',
        dataType: 'json',
        data: { tipoBusqueda: tipoBusqueda },
        success: function (data) {
            let tabla = document.getElementById('tablaDatosMiem').getElementsByTagName('tbody')[0];
            tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos
            if (data.length > 0) {
                let contador = 1;
                data.forEach(function (miem) {
                    let fila = tabla.insertRow();
                    fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                    // Celdas de la fila con el mismo estilo que en tu HTML                    
                    fila.innerHTML = tablaMiembro(dir, contador, miem.id_miembro, miem.nombre_miembro, miem.tipo_miembro);
                    contador++;
                });
            } else {
                let fila = tabla.insertRow();
                fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                // Celdas de la fila con el mismo estilo que en tu HTML                    
                fila.innerHTML = tablaMiembroVacia();
            }
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener la orden de trabajo:', error);
        }
    });
}
function tablaMiembro(dir, contador, codigo, nombre, tipo) {
    let self = this;
    tabla = `
    <td class="clearfix col-p">
                                <div class=""><b>${contador}</b></div>
                            </td>
                            <td class="text-center col-p">
                                <div class="avatar avatar-md"><img class="avatar-img"
                                        src="${dir}app/views/img/avatars/user.png" alt="user@email.com"><span
                            </td>                            
                            <td class="col-p">
                                <div class="clearfix">
                                    <div class=""><b>${codigo}</b></div>
                                </div>
                            </td>
                            <td class="">
                                <div class="clearfix">
                                    <div class=""><b>${nombre}</b></div>
                                </div>
                            </td>
                            <td class="col-2">
                                <div class="text-center">
                                    <div class=""><b>${self.tipoOperador(tipo)}</b></div>
                                </div>
                            </td>
                            <td class="col-p">
                                <button type="button" title="Ver" class="btn btn-primary"">
                                    <i class="bi bi-eye" style="color: white;"></i>
                                </button>                       
                            </td>
                            <td class="col-p">
                                <a href="#" title="Modificar" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventanaModalModificarMiem" data-bs-id="${codigo}">
                                    <i class="bi bi-pencil" style="color: white;"></i>
                                </a> 
                            </td>
                            <td class="col-p">
                                <a href="#" title="Modificar" id="btnEliminar" class="btn btn-primary" onclick="eliminarMiembro('${codigo}','${dir}')">
                                    <i class="bi bi-trash" style="color: white;"></i>                                
                                </a>                                  
                            </td> 
    `;
    return tabla;
}

function tablaMiembroVacia() {
    tabla = `
        <td class="text-center">
            No hay registros en el sistema
        </td>
    `;
    return tabla;
}

function eliminarMiembro(parametro, dir) {
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
                url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorMiem.php',
                method: 'GET',
                dataType: 'json',
                data: { id: parametro, tipoBusqueda: tipoBusqueda },
                success: function (data) {
                    if (data) {
                        reiniciarTabla(dir);
                        var alerta = {
                            tipo: "simple",
                            icono: "success",
                            titulo: "Miembro Eliminado",
                            texto: 'El Miembro ha sido eliminado con exito'
                        };
                        alertas_ajax(alerta);
                        return;
                    } else {
                        reiniciarTabla(dir);
                        var alerta = {
                            tipo: "simple",
                            icono: "error",
                            titulo: "Ocurrió un error inesperado",
                            texto: 'No se pudo eliminar el Miembro, por favor intente nuevamente'
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
function tipoOperador(tipo) {
    if (tipo === 1) {
        return "C.C.F.";
    } else {
        return "C.C.O.";
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