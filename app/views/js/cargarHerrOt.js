// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    // Obtener el modal de modificación por su ID
    //Vista Usuario
    let modificarModalHerr = document.getElementById('ModificarHerrOt');

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
                inputNombre.textContent = data.nombre_trab;

            });
    });
});
$(document).ready(function () {
    $('#ModificarHerrOt').on('shown.bs.modal', function (e) {
        let dir = document.getElementById('url').value;
        // Aquí se ejecuta cuando el modal se muestra completamente
        // Primero, obtenemos el contenido del h5 con el ID "codigoOt"
        let tipoBusqueda = 'cargarTabla';
        let codigoOt = $('#codigoOt').text();
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
                    tabla.innerHTML = tablaVacia();
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
        $.ajax({
            url: 'http://localhost/app_metro/app/controllers/cargarDatosBuscadorHOT.php',
            method: 'GET',
            dataType: 'json',
            data: { tipoBusqueda: 'todoHer' },
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
    });
    $('#ModificarHerrOt').on('hidden.bs.modal', function (e) {
        // Limpiar el contenido del elemento con el ID "codigoOt"
        $('#codigoOt').text('');
    
        // Limpiar la tabla de herramientas
        let tabla = document.getElementById('tablaHerramientaOt').getElementsByTagName('tbody')[0];
        tabla.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de insertar nuevos datos
    
        // Agregar una fila vacía a la tabla
        let fila = tabla.insertRow();
        fila.classList.add('align-middle'); // Agregar clase para centrar verticalmente la fila
        tabla.innerHTML = tablaVacia(); // Agregar el contenido de la fila vacía
    });
    
});
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
function tablaHerramientaOT(dir, contador, n_ot, nombre_herramienta, cantidadot,id_herramienta) {
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
        <a href="#" title="Quitar" class="btn btn-primary" data-bs-id="${id_herramienta}">
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
