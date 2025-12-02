// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Obtener el modal de modificación por su ID
    //Vista Usuario
    let modificarModalUser = document.getElementById('ventanaModalModificar');
    let modificarModalPassUser = document.getElementById('ventanaModalModificarPass');   

    //Vista Usuario
    // Agregar un listener para el evento "shown.bs.modal", que se dispara cuando el modal se muestra al usuario
    modificarModalUser.addEventListener('show.bs.modal', function(event) {
        // Obtener el botón que abrió el modal
        let button = event.relatedTarget;
        // Obtener el ID del usuario del atributo "data-bs-id" del botón
        let id = button.getAttribute('data-bs-id');

        // Obtener referencias a los campos de entrada dentro del modal
        let inputId = modificarModalUser.querySelector('.modal-body #id');
        let inputId2 = modificarModalUser.querySelector('.modal-body #cedula');
        let inputNombre = modificarModalUser.querySelector('.modal-body #nombre');
        let inputUser = modificarModalUser.querySelector('.modal-body #username');
        let inputTipo = modificarModalUser.querySelector('.modal-body #tipo2');

        // Construir la URL del script PHP que carga los datos del usuario
        let url = "http://localhost/app_metro/app/controllers/cargarDatosUser.php";
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
                throw new Error('Error al cargar los datos del usuario');
            }
            // Convertir la respuesta en formato JSON y devolverla
            return response.json();
        })
        .then(data => {
            // Asignar los datos del usuario a los campos de entrada en el modal
            inputId.value = data.id_user;
            inputId2.value = data.id_user;
            inputNombre.value = data.user;
            inputUser.value = data.username;
            inputTipo.value = data.tipo;
        })
        .catch(error => {
            // Capturar y manejar cualquier error que ocurra durante la carga de los datos del usuario
            console.error('Error:', error);
            alert('Ocurrió un error al cargar los datos del usuario. Por favor, inténtalo de nuevo más tarde.');
        });

    });

    modificarModalPassUser.addEventListener('show.bs.modal', function(event) {
        // Obtener el botón que abrió el modal
        let button = event.relatedTarget;
        // Obtener el ID del usuario del atributo "data-bs-id" del botón
        let id = button.getAttribute('data-bs-id');

        // Obtener referencias a los campos de entrada dentro del modal
        let inputId = modificarModalPassUser.querySelector('.modal-body #id2');
        let inputNombre = modificarModalPassUser.querySelector('.modal-body #nombreUser');

        // Construir la URL del script PHP que carga los datos del usuario
        let url = "http://localhost/app_metro/app/controllers/cargarDatosUser.php";
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
                throw new Error('Error al cargar los datos del usuario');
            }
            // Convertir la respuesta en formato JSON y devolverla
            return response.json();
        })
        .then(data => {
            // Asignar los datos del usuario a los campos de entrada en el modal
            inputId.value = data.id_user;
            inputNombre.textContent  = data.user;
        })
        .catch(error => {
            // Capturar y manejar cualquier error que ocurra durante la carga de los datos del usuario
            console.error('Error:', error);
            alert('Ocurrió un error al cargar los datos del usuario. Por favor, inténtalo de nuevo más tarde.');
        });

    });       
});
