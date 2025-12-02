// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    // Obtener el modal de modificación por su ID
    //Vista Usuario
    let modificarModalHerr = document.getElementById('detallesOt');
    let btnRecargar = document.getElementById('btnRecargarDetalle');
    let dir = document.getElementById('url').value;

    //Vista Usuario
    // Agregar un listener para el evento "shown.bs.modal", que se dispara cuando el modal se muestra al usuario
    modificarModalHerr.addEventListener('show.bs.modal', function (event) {
        // Obtener el botón que abrió el modal
        let button = event.relatedTarget;
        // Obtener el ID del usuario del atributo "data-bs-id" del botón
        let id = button.getAttribute('data-bs-id');
        // Obtener referencias a los campos de entrada dentro del modal
        let inputCodigo = modificarModalHerr.querySelector('.modal-body #codigoOt');
        let inputNombre = modificarModalHerr.querySelector('.modal-body #nombreOt');
        let inputid = modificarModalHerr.querySelector('.modal-body #id');

        // Construir la URL del script PHP que carga los datos del usuario
        let url = "http://localhost/app_metro/app/controllers/cargarDatosOt.php";
        // Crear un objeto FormData y agregar el ID del usuario como parámetro
        let formData = new FormData();
        formData.append('id', id);

        // Realizar una petición fetch al script PHP para obtener los datos del usuario
        fetch(url, {
            method: "POST",
            body: formData
        })
            .then(response => {
                // Verificar si la respuesta HTTP fue exitosa
                if (!response.ok) {
                    throw new Error('Error al cargar los datos');
                }
                // Convertir la respuesta en formato JSON y devolverla
                return response.json();
            })
            .then(data => {
                // Asignar los datos del usuario a los campos de entrada en el modal
                inputCodigo.textContent = data.n_ot;
                inputid.value = data.n_ot;
                inputNombre.textContent = data.nombre_trab;

            });
    });

    btnRecargar.addEventListener('click', function (event) {
        alerta("success", "Tabla recargada", 4000);
        reiniciarTabla(dir);
    });
});
$(document).ready(function () {
    $('#detallesOt').on('shown.bs.modal', function (e) {s
        let dir = document.getElementById('url').value;
        // Aquí se ejecuta cuando el modal se muestra completamente
        // Primero, obtenemos el contenido del h5 con el ID "codigoOt"
        let tipoBusqueda = 'cargarTabla';
        let codigoOt = $('#codigoOt').text();
        $.ajax({
            url: 'http://localhost/app_metro/app/controllers/cargarDatosDetalles.php',
            method: 'GET',
            dataType: 'json',
            data: { id: codigoOt, tipoBusqueda: tipoBusqueda },
            success: function (data) {
                let tabla = document.getElementById('tablaDetalles').getElementsByTagName('tbody')[0];
                tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos
                if (data.length > 0) {
                    let contador = 1;
                    data.forEach(function (datos) {
                        let fila = tabla.insertRow();
                        fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                        // Celdas de la fila con el mismo estilo que en tu HTML
                        fila.innerHTML = tablaDetalles(dir, contador, datos.fecha, datos.descripcion, datos.n_ot, datos.id, datos.color, datos.nombre_estado);
                        contador++;
                    });
                } else {
                    let fila = tabla.insertRow();
                    fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                    tabla.innerHTML = tablaVacia();
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
    $('#ModificarHerrOt').on('hidden.bs.modal', function (e) {
        // Limpiar el contenido del elemento con el ID "codigoOt"
        $('#codigoOt').text('');

        // Limpiar la tabla de herramientas
        let tabla = document.getElementById('tablaDetalles').getElementsByTagName('tbody')[0];
        tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos

        // Agregar una fila vacía a la tabla
        let fila = tabla.insertRow();
        fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
        tabla.innerHTML = tablaVacia(); // Agregar el contenido de la fila vacía
    });

});
function tablaDetalles(dir, contador, fecha, descripcion, n_ot, id, color, nombre_estado) {
    tabla = `
<tr class="align-middle">
    <td class="col-p">
        <div class="clearfix">
            <div class=""><b>${contador}</b></div>
        </div>
    </td> 
    <td class="col-p">
        <div class="clearfix">
            <span style="bottom: 0; display: block; border: 1px solid #fff;
                  border-radius: 50em; width: 1.7333333333rem; height: 1.7333333333rem; 
                  background-color:${color};" title="${nombre_estado}"></span>
        </div>
    </td> 
    <td class="col-1">
        <div class="clearfix">
            <div class=""><b>${self.formatearFecha(fecha)}</b></div>
        </div>
    </td>
    <td class="col-5">
        <div class="clearfix">
            <div class=""><b>${descripcion}</b></div>
        </div>
    </td> 
    <td class="col-p">
        <a href="#" title="Ver" class="btn btn-primary" onclick="verDetalles('${id}','${fecha}','${n_ot}')" data-bs-id="${n_ot}">
            <i class="bi bi-eye"></i>
        </a>                                                 
    </td>    
    <td class="col-p">
        <a href="#" title="Eliminar" class="btn btn-primary" onclick="eliminarDetalles('${id}','${fecha}','${n_ot}')" data-bs-id="${n_ot}">
            <i class="bi bi-trash"></i>        
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
function cerrarVentana() {
    limpiarDetalles();
    let tabla = document.getElementById('tablaDetalles').getElementsByTagName('tbody')[0];
    tabla.innerHTML = '';
    let fila = tabla.insertRow();
    fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
    tabla.innerHTML = tablaVacia();
}
function reiniciarTabla(dir) {
    let tipoBusqueda = 'cargarTabla';
    let codigoOt = $('#codigoOt').text();
    $.ajax({
        url: 'http://localhost/app_metro/app/controllers/cargarDatosDetalles.php',
        method: 'GET',
        dataType: 'json',
        data: { id: codigoOt, tipoBusqueda: tipoBusqueda },
        success: function (data) {
            let tabla = document.getElementById('tablaDetalles').getElementsByTagName('tbody')[0];
            tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos
            if (data.length > 0) {
                let contador = 1;
                data.forEach(function (datos) {
                    let fila = tabla.insertRow();
                    fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                    // Celdas de la fila con el mismo estilo que en tu HTML
                    fila.innerHTML = tablaDetalles(dir, contador, datos.fecha, datos.descripcion, datos.n_ot, datos.id, datos.color, datos.nombre_estado);
                    contador++;
                });
            } else {
                let fila = tabla.insertRow();
                fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
                tabla.innerHTML = tablaVacia();
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}
function verDetalles(id, fecha, codigo) {
    let modificarModalDetalle = document.getElementById('detallesOt');

    let inputT = modificarModalDetalle.querySelector('.modal-body #detalle');
    let inputId = modificarModalDetalle.querySelector('.modal-body #id');
    let inputId2 = modificarModalDetalle.querySelector('.modal-body #id2');
    let inputFecha = modificarModalDetalle.querySelector('.modal-body #fecha');
    let inputDesc = modificarModalDetalle.querySelector('.modal-body #desc');
    let inputCant = modificarModalDetalle.querySelector('.modal-body #cant');
    let inputTurno = modificarModalDetalle.querySelector('.modal-body #turno');
    let inputStatus = modificarModalDetalle.querySelector('.modal-body #status');
    let inputCco = modificarModalDetalle.querySelector('.modal-body #cco');
    let inputCcf = modificarModalDetalle.querySelector('.modal-body #ccf');
    let inputTecnico = modificarModalDetalle.querySelector('.modal-body #tec');
    let inputPrep_ini = modificarModalDetalle.querySelector('.modal-body #prep_ini');
    let inputPrep_fin = modificarModalDetalle.querySelector('.modal-body #prep_fin');
    let inputTras_ini = modificarModalDetalle.querySelector('.modal-body #tras_ini');
    let inputTras_fin = modificarModalDetalle.querySelector('.modal-body #tras_fin');
    let inputEjec_ini = modificarModalDetalle.querySelector('.modal-body #ejec_ini');
    let inputEjec_fin = modificarModalDetalle.querySelector('.modal-body #ejec_fin');
    let inputObserv = modificarModalDetalle.querySelector('.modal-body #observacion');

    // Construir la URL del script PHP que carga los datos del usuario
    let url = "http://localhost/app_metro/app/controllers/cargarDatosDetalle.php";
    // Crear un objeto FormData y agregar el ID del usuario como parámetro
    let formData = new FormData();
    formData.append('id', id);
    formData.append('fecha', fecha);
    formData.append('codigo', codigo);
    formData.append('tipo', 'ver');

    // Realizar una petición fetch al script PHP para obtener los datos del usuario
    fetch(url, {
        method: "POST",
        body: formData
    })
        .then(response => {
            // Verificar si la respuesta HTTP fue exitosa
            if (!response.ok) {
                console.error('Error en la respuesta del servidor:', response.status, response.statusText);
                throw new Error('Error al cargar los datos');
            }
            // Convertir la respuesta en formato JSON y devolverla
            return response.json();
        })
        .then(data => {
            // Verificar si se recibieron datos válidos
            if (!data) {
                throw new Error('Datos vacíos recibidos');
            }

            // Asignar los datos del usuario a los campos de entrada en el modal
            inputT.value = "modificar_detalle";
            inputId.value = data.n_ot;
            inputId2.value = data.id;
            inputFecha.value = data.fecha;
            inputDesc.value = data.descripcion;
            inputCant.value = data.cant_tec;
            inputTurno.value = data.id_turno;
            inputStatus.value = data.id_estado;
            inputCco.value = data.id_miembro_cco;
            inputCcf.value = data.id_miembro_ccf;
            inputTecnico.value = data.id_user_act;
            inputPrep_ini.value = data.hora_ini_pre;
            inputPrep_fin.value = data.hora_fin_pre;
            inputTras_ini.value = data.hora_ini_tra;
            inputTras_fin.value = data.hora_fin_tra;
            inputEjec_ini.value = data.hora_ini_eje;
            inputEjec_fin.value = data.hora_fin_eje;
            inputObserv.value = data.observacion;
        })
        .catch(error => {
            console.error('Error al cargar los datos:', error);
        }
        );
}
function eliminarDetalles(id, fecha, codigo) {
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
            // Construir la URL del script PHP que carga los datos del usuario
            let url = "http://localhost/app_metro/app/controllers/cargarDatosDetalle.php";
            // Crear un objeto FormData y agregar el ID del usuario como parámetro
            let formData = new FormData();
            formData.append('id', id);
            formData.append('fecha', fecha);
            formData.append('codigo', codigo);
            formData.append('tipo', 'eliminar');

            // Realizar una petición fetch al script PHP para obtener los datos del usuario
            fetch(url, {
                method: "POST",
                body: formData
            })
                .then(response => {
                    // Verificar si la respuesta HTTP fue exitosa
                    if (!response.ok) {
                        console.error('Error en la respuesta del servidor:', response.status, response.statusText);
                        throw new Error('Error al cargar los datos');
                    }
                    // Convertir la respuesta en formato JSON y devolverla
                    return response.json();
                })
                .then(data => {
                    // Verificar si se recibieron datos válidos
                    if (!data) {
                        alerta("error", "Ha ocurrido un eror.", 4000);
                        throw new Error('Datos vacíos recibidos');
                    }
                    console.log('eliminacion exitosa');
                    limpiarDetalles();
                    reiniciarTabla('');
                    alerta("success", "Detalle eliminado con exito.", 4000);
                })
                .catch(error => {
                    console.error('Error al cargar los datos:', error);
                }
                );
        }
    });
}
function limpiarDetalles() {
    let modificarModalDetalle = document.getElementById('detallesOt');

    let inputT = modificarModalDetalle.querySelector('.modal-body #detalle');
    let inputId2 = modificarModalDetalle.querySelector('.modal-body #id2');
    let inputFecha = modificarModalDetalle.querySelector('.modal-body #fecha');
    let inputDesc = modificarModalDetalle.querySelector('.modal-body #desc');
    let inputCant = modificarModalDetalle.querySelector('.modal-body #cant');
    let inputTurno = modificarModalDetalle.querySelector('.modal-body #turno');
    let inputStatus = modificarModalDetalle.querySelector('.modal-body #status');
    let inputCco = modificarModalDetalle.querySelector('.modal-body #cco');
    let inputCcf = modificarModalDetalle.querySelector('.modal-body #ccf');
    let inputTecnico = modificarModalDetalle.querySelector('.modal-body #tec');
    let inputPrep_ini = modificarModalDetalle.querySelector('.modal-body #prep_ini');
    let inputPrep_fin = modificarModalDetalle.querySelector('.modal-body #prep_fin');
    let inputTras_ini = modificarModalDetalle.querySelector('.modal-body #tras_ini');
    let inputTras_fin = modificarModalDetalle.querySelector('.modal-body #tras_fin');
    let inputEjec_ini = modificarModalDetalle.querySelector('.modal-body #ejec_ini');
    let inputEjec_fin = modificarModalDetalle.querySelector('.modal-body #ejec_fin');
    let inputObserv = modificarModalDetalle.querySelector('.modal-body #observacion');


    // Asignar los datos del usuario a los campos de entrada en el modal
    inputT.value = "registrar_detalle";
    inputId2.value = '';
    inputFecha.value = '';
    inputDesc.value = '';
    inputCant.value = '';
    inputTurno.value = 'Seleccionar';
    inputStatus.value = 'Seleccionar';
    inputCco.value = 'Seleccionar';
    inputCcf.value = 'Seleccionar';
    inputTecnico.value = 'Seleccionar';
    inputPrep_ini.value = '';
    inputPrep_fin.value = '';
    inputTras_ini.value = '';
    inputTras_fin.value = '';
    inputEjec_ini.value = '';
    inputEjec_fin.value = '';
    inputObserv.value = '';
}


function limpiarCadena(cadena) {
    const palabras = [
        '<script>', '</script>', '<script src', '<script type=',
        'SELECT * FROM', 'SELECT ', ' SELECT ', 'DELETE FROM',
        'INSERT INTO', 'DROP TABLE', 'DROP DATABASE', 'TRUNCATE TABLE',
        'SHOW TABLES', 'SHOW DATABASES', '\\<\\?php', '\\?\\>', '--',
        '^', '<', '>', '==', '=', ';', '::'
    ];

    // Eliminar espacios en blanco al inicio y al final de la cadena
    cadena = cadena.trim();

    // Iterar sobre cada palabra prohibida y eliminarla de la cadena
    palabras.forEach(palabra => {
        cadena = cadena.replace(new RegExp(palabra, 'gi'), '');
    });

    // Escapar caracteres HTML
    cadena = cadena.replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");

    return cadena;
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
function formatearFecha(fecha) {
    var partes = fecha.split('-');
    var dia = partes[2];
    var mes = partes[1];
    var año = partes[0];
    return dia + '/' + mes + '/' + año;
}