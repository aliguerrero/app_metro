// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Obtener el modal de modificación por su ID
    //Vista Usuario
    let modificarModalOt = document.getElementById('herramientaOt');

    //Vista Usuario
    // Agregar un listener para el evento "shown.bs.modal", que se dispara cuando el modal se muestra al usuario
    modificarModalOt.addEventListener('click', function(event) {
        // Obtener el botón que abrió el modal
        let button = event.relatedTarget;
        // Obtener el ID del usuario del atributo "data-bs-id" del botón
        let id = button.getAttribute('data-bs-id');
        // Obtener referencias a los campos de entrada dentro del modal
        let inputCodigo = modificarModalOt.querySelector('.modal-body #codigo');
        let inputId = modificarModalOt.querySelector('.modal-body #id');
        let inputFecha = modificarModalOt.querySelector('.modal-body #fecha1');
        let inputNomb = modificarModalOt.querySelector('.modal-body #nombre');
        let inputSemana = modificarModalOt.querySelector('.modal-body #semana1');
        let inputMes = modificarModalOt.querySelector('.modal-body #mes1');
        let inputSitio = modificarModalOt.querySelector('.modal-body #sitio');        
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
            inputId.value = data.n_ot;
            inputFecha.value = data.fecha;
            inputNomb.value = data.nombre_trab;
            inputSemana.value = data.semana;
            inputMes.value = data.mes; 
            inputSitio.value = data.sitio_trab;                    
        });    
    });        
});


