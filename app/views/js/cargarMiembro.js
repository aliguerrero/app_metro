// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Obtener el modal de modificación por su ID
    let modificarModal = document.getElementById('ventanaModalModificarMiem');


    // Agregar un listener para el evento "shown.bs.modal", que se dispara cuando el modal se muestra al usuario
    modificarModal.addEventListener('show.bs.modal', function(event) {
        // Obtener el botón que abrió el modal
        let button = event.relatedTarget;
        // Obtener el ID del usuario del atributo "data-bs-id" del botón
        let id = button.getAttribute('data-bs-id');

        // Obtener referencias a los campos de entrada dentro del modal
        let inputId = modificarModal.querySelector('.modal-body #codigo');
        let inputId2 = modificarModal.querySelector('.modal-body #id');
        let inputNombre = modificarModal.querySelector('.modal-body #nombre');
        let inputTipo = modificarModal.querySelector('.modal-body #tipo');

        // Construir la URL del script PHP que carga los datos del usuario
        let url = "../app/controllers/cargarDatosMiembro.php";
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
                throw new Error('Error al cargar los datos de los miembros');
            }
            // Convertir la respuesta en formato JSON y devolverla
            return response.json();
        })
        .then(data => {
            // Asignar los datos del usuario a los campos de entrada en el modal
            inputId.value = data.id_miembro;
            inputId2.value = data.id_miembro;
            inputNombre.value = data.nombre_miembro;
            inputTipo.value = data.tipo_miembro;
        })
        .catch(error => {
            // Capturar y manejar cualquier error que ocurra durante la carga de los datos del usuario
            console.error('Error:', error);
            alert('Ocurrió un error al cargar los datos del miembro. Por favor, inténtalo de nuevo más tarde.');
        });

    });    
});
