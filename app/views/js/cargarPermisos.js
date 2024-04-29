document.addEventListener('DOMContentLoaded', function () {
    let rol = document.getElementById('opciones');
    let contenido = document.getElementById('contenido');


    rol.addEventListener('change', function (event) {

        let checkboxUsuarios0 = contenido.querySelector('.contenido #permisoUsuarios0');
        let checkboxUsuarios1 = contenido.querySelector('.contenido #permisoUsuarios1');
        let checkboxUsuarios2 = contenido.querySelector('.contenido #permisoUsuarios2');
        let checkboxUsuarios3 = contenido.querySelector('.contenido #permisoUsuarios3');
        let checkboxHerramienta0 = contenido.querySelector('.contenido #permisoHerramienta0');
        let checkboxHerramienta1 = contenido.querySelector('.contenido #permisoHerramienta1');
        let checkboxHerramienta2 = contenido.querySelector('.contenido #permisoHerramienta2');
        let checkboxHerramienta3 = contenido.querySelector('.contenido #permisoHerramienta3');
        let checkboxMiembro0 = contenido.querySelector('.contenido #permisoMiembro0');
        let checkboxMiembro1 = contenido.querySelector('.contenido #permisoMiembro1');
        let checkboxMiembro2 = contenido.querySelector('.contenido #permisoMiembro2');
        let checkboxMiembro3 = contenido.querySelector('.contenido #permisoMiembro3');
        let checkboxOrdenTrabajo0 = contenido.querySelector('.contenido #permisoOrdenTrabajo0');
        let checkboxOrdenTrabajo1 = contenido.querySelector('.contenido #permisoOrdenTrabajo1');
        let checkboxOrdenTrabajo2 = contenido.querySelector('.contenido #permisoOrdenTrabajo2');
        let checkboxOrdenTrabajo3 = contenido.querySelector('.contenido #permisoOrdenTrabajo3');
        let checkboxOrdenTrabajo4 = contenido.querySelector('.contenido #permisoOrdenTrabajo4');
        let checkboxOrdenTrabajo5 = contenido.querySelector('.contenido #permisoOrdenTrabajo5');
        let checkboxOrdenTrabajo6 = contenido.querySelector('.contenido #permisoOrdenTrabajo6');

        let url = "http://localhost/app_metro/app/controllers/cargarDatosRol.php";
        let formData = new FormData();
        formData.append('id', rol.value);

        fetch(url, {
            method: "POST",
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al cargar los datos de los miembros');
                }
                return response.json();
            })
            .then(data => {
                if (Object.keys(data).length === 0) {
                    checkboxUsuarios0.checked = false;
                    checkboxUsuarios1.checked = false;
                    checkboxUsuarios2.checked = false;
                    checkboxUsuarios3.checked = false;
                    checkboxHerramienta0.checked = false;
                    checkboxHerramienta1.checked = false;
                    checkboxHerramienta2.checked = false;
                    checkboxHerramienta3.checked = false;
                    checkboxMiembro0.checked = false;
                    checkboxMiembro1.checked = false;
                    checkboxMiembro2.checked = false;
                    checkboxMiembro3.checked = false;
                    checkboxOrdenTrabajo0.checked = false;
                    checkboxOrdenTrabajo1.checked = false;
                    checkboxOrdenTrabajo2.checked = false;
                    checkboxOrdenTrabajo3.checked = false;
                    checkboxOrdenTrabajo4.checked = false;
                    checkboxOrdenTrabajo5.checked = false;
                    checkboxOrdenTrabajo6.checked = false;
                } else {
                    checkboxUsuarios0.checked = data.perm_usuarios_view === 1 ? true : false;
                    checkboxUsuarios1.checked = data.perm_usuarios_add === 1 ? true : false;
                    checkboxUsuarios2.checked = data.perm_usuarios_edit === 1 ? true : false;
                    checkboxUsuarios3.checked = data.perm_usuarios_delete === 1 ? true : false;
                    checkboxHerramienta0.checked = data.perm_herramienta_view === 1 ? true : false;
                    checkboxHerramienta1.checked = data.perm_herramienta_add === 1 ? true : false;
                    checkboxHerramienta2.checked = data.perm_herramienta_edit === 1 ? true : false;
                    checkboxHerramienta3.checked = data.perm_herramienta_delete === 1 ? true : false;
                    checkboxMiembro0.checked = data.perm_miembro_view === 1 ? true : false;
                    checkboxMiembro1.checked = data.perm_miembro_add === 1 ? true : false;
                    checkboxMiembro2.checked = data.perm_miembro_edit === 1 ? true : false;
                    checkboxMiembro3.checked = data.perm_miembro_delete === 1 ? true : false;
                    checkboxOrdenTrabajo0.checked = data.perm_ot_view === 1 ? true : false;
                    checkboxOrdenTrabajo1.checked = data.perm_ot_add === 1 ? true : false;
                    checkboxOrdenTrabajo2.checked = data.perm_ot_edit === 1 ? true : false;
                    checkboxOrdenTrabajo3.checked = data.perm_ot_add_detalle === 1 ? true : false;
                    checkboxOrdenTrabajo4.checked = data.perm_ot_delete === 1 ? true : false;
                    checkboxOrdenTrabajo5.checked = data.perm_ot_generar_reporte === 1 ? true : false;
                    checkboxOrdenTrabajo6.checked = data.perm_ot_add_herramienta === 1 ? true : false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al cargar los datos. Por favor, inténtalo de nuevo más tarde.');
            });


    });
    // Obtener el select de acciones
    let selectAccion = document.getElementById('selectAccion');
    // Obtener todos los checkboxes de permisos
    let checkboxes = document.querySelectorAll('input[type="checkbox"]');
    // Obtener el combo de roles
    let comboRoles = document.querySelector('#listar select');

    // Agregar un listener para el evento change del select de acciones
    selectAccion.addEventListener('change', function () {
        // Desactivar todos los checkboxes
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = false;
        });
        // Seleccionar la primera opción del combo de roles
        comboRoles.selectedIndex = 0;
    });
});

// Obtener referencias al botón y al input
const miBoton1 = document.getElementById('btnGuardar');
const miBoton2 = document.getElementById('btnModificar');
const miBoton3 = document.getElementById('btnEliminar');

const miInput = document.getElementById('accion');

// Agregar un event listener para el evento mouseover al botón
miBoton1.addEventListener('mouseover', function () {
    // Actualizar el valor del input al pasar el mouse sobre el botón
    miInput.value = 'registrar_rol';
});

miBoton2.addEventListener('mouseover', function () {
    // Actualizar el valor del input al pasar el mouse sobre el botón
    miInput.value = 'modificar_rol';
});

miBoton3.addEventListener('mouseover', function () {
    // Actualizar el valor del input al pasar el mouse sobre el botón
    miInput.value = 'eliminar_rol';
});