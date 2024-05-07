// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    // Obtener el modal de modificación por su ID
    let btnBuscarOt = document.getElementById('btnBuscarOt');
    let btnBuscarFecha = document.getElementById('btnBuscarFecha');
    let btnBuscarEstado = document.getElementById('btnBuscarEstado');
    let btnBuscarUser = document.getElementById('btnBuscarUser');

    // Agregar un listener para el evento "shown.bs.modal", que se dispara cuando el modal se muestra al usuario
    btnBuscarOt.addEventListener('click', function (event) {

        const area = document.getElementById('area').value;
        const nrot = document.getElementById('nrot').value;
        if(nrot === "") {
            mostrarAlerta('error','¡Error inesperado!','Ingresa un numero de orden de trabajo');
        }else{
            if(verificarDatos( '^[0-9]{1,10}$', nrot )) {
                mostrarAlerta('error','¡Error inesperado!','El código no cumple con el formato solicitado');
                return; // Detener la ejecución del código aquí
            }
            console.log('ot', nrot);
        }

        /*
        $.ajax({
            url: 'http://localhost/app_metro/app/controllers/cargarGraficaArea.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                data.forEach(function (area) {
                    $.ajax({
                        url: 'http://localhost/app_metro/app/controllers/cargarDatosGraficaArea.php',
                        method: 'GET',
                        dataType: 'json',
                        data: { id: areaId }, 
                        success: function (estadoData) {

                        },
                        error: function (xhr, status, error) {
                            console.error(`Error al obtener los datos del estado ${areaNombre}:`, error);
                        }
                    });
                });
            },
            error: function (xhr, status, error) {
                console.error('Error al obtener la lista de estados:', error);
            }
        });*/
    });
    btnBuscarFecha.addEventListener('click', function (event) {

        const area = document.getElementById('area').value;
        const fechaDesde = document.getElementById('fecha_desde').value;
        const fechaHasta = document.getElementById('fecha_hasta').value;

        console.log('Área:', area);
        console.log('Fecha desde:', fechaDesde);
        console.log('Fecha hasta:', fechaHasta);
        /*
        $.ajax({
            url: 'http://localhost/app_metro/app/controllers/cargarGraficaArea.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                data.forEach(function (area) {
                    $.ajax({
                        url: 'http://localhost/app_metro/app/controllers/cargarDatosGraficaArea.php',
                        method: 'GET',
                        dataType: 'json',
                        data: { id: areaId }, 
                        success: function (estadoData) {

                        },
                        error: function (xhr, status, error) {
                            console.error(`Error al obtener los datos del estado ${areaNombre}:`, error);
                        }
                    });
                });
            },
            error: function (xhr, status, error) {
                console.error('Error al obtener la lista de estados:', error);
            }
        });*/
    });
    btnBuscarEstado.addEventListener('click', function (event) {

        const area = document.getElementById('area').value;
        const estado = document.getElementById('estado').value;

        console.log('Área:', area);
        console.log('Estado:', estado);
        /*
        $.ajax({
            url: 'http://localhost/app_metro/app/controllers/cargarGraficaArea.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                data.forEach(function (area) {
                    $.ajax({
                        url: 'http://localhost/app_metro/app/controllers/cargarDatosGraficaArea.php',
                        method: 'GET',
                        dataType: 'json',
                        data: { id: areaId }, 
                        success: function (estadoData) {

                        },
                        error: function (xhr, status, error) {
                            console.error(`Error al obtener los datos del estado ${areaNombre}:`, error);
                        }
                    });
                });
            },
            error: function (xhr, status, error) {
                console.error('Error al obtener la lista de estados:', error);
            }
        });*/
    });
    btnBuscarUser.addEventListener('click', function (event) {

        const area = document.getElementById('area').value;
        const user = document.getElementById('user').value;

        console.log('Área:', area);
        console.log('Usuario:', user);
        /*
        $.ajax({
            url: 'http://localhost/app_metro/app/controllers/cargarGraficaArea.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                data.forEach(function (area) {
                    $.ajax({
                        url: 'http://localhost/app_metro/app/controllers/cargarDatosGraficaArea.php',
                        method: 'GET',
                        dataType: 'json',
                        data: { id: areaId }, 
                        success: function (estadoData) {

                        },
                        error: function (xhr, status, error) {
                            console.error(`Error al obtener los datos del estado ${areaNombre}:`, error);
                        }
                    });
                });
            },
            error: function (xhr, status, error) {
                console.error('Error al obtener la lista de estados:', error);
            }
        });*/
    });
});
function verificarDatos(filtro, cadena) {
    const regex = new RegExp('^' + filtro + '$');
    if (regex.test(cadena)) {
        return false;
    } else {
        return true;
    }
}
function mostrarAlerta(icono, titulo, texto) {
    Swal.fire({
        icon: icono,
        title: titulo,
        text: texto,
        confirmButtonText: 'Aceptar'
    });
}
function limpiarCadena($cadena) {
    // Convertir la cadena a UTF-8 si no lo está
    if (!mb_detect_encoding($cadena, 'UTF-8', true)) {
        $cadena = mb_convert_encoding($cadena, 'UTF-8');
    }

    // Eliminar etiquetas HTML y PHP
    $cadena = strip_tags($cadena);

    // Eliminar espacios en blanco al principio y al final
    $cadena = trim($cadena);

    // Escapar caracteres especiales para usar en consultas SQL
    $cadena = addslashes($cadena);

    return $cadena;
}

