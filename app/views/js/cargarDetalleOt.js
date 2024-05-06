// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Obtener el modal de modificación por su ID
    //Vista Usuario
    let modificarModalDetalle = document.getElementById('ventanaModalDetalleOt');
    //Vista Usuario
    // Agregar un listener para el evento "shown.bs.modal", que se dispara cuando el modal se muestra al usuario
    modificarModalDetalle.addEventListener('show.bs.modal', function(event) {
        // Obtener el botón que abrió el modal
        let button = event.relatedTarget;
        // Obtener el ID del usuario del atributo "data-bs-id" del botón
        let id = button.getAttribute('data-bs-id');
        // Obtener referencias a los campos de entrada dentro del modal
        let inputT = modificarModalDetalle.querySelector('.modal-body #detalle');
        let inputId = modificarModalDetalle.querySelector('.modal-body #id');
        let inputCant = modificarModalDetalle.querySelector('.modal-body #cant');
        let inputTurno = modificarModalDetalle.querySelector('.modal-body #turno');
        let inputStatus = modificarModalDetalle.querySelector('.modal-body #status');
        let inputCco = modificarModalDetalle.querySelector('.modal-body #cco');
        let inputCcf= modificarModalDetalle.querySelector('.modal-body #ccf');
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
            // Verificar si la respuesta JSON está vacía
            if (Object.keys(data).length === 0) {
                // No se encontraron datos, no realizar cambios en los campos de entrada
                inputId.value = id;
                inputT.value = "registrar_detalle";
                inputCant.value = "";
                inputTurno.value = "Seleccionar";
                inputStatus.value = "Seleccionar";
                inputCco.value = "Seleccionar"; 
                inputCcf.value = "Seleccionar"; 
                inputTecnico.value = "Seleccionar";
                inputPrep_ini.value = "";
                inputPrep_fin.value = "";
                inputTras_ini.value = "";
                inputTras_fin.value = "";
                inputEjec_ini.value = "";
                inputEjec_fin.value = "";
                inputObserv.value = "";
            } else {
                // Asignar los datos del usuario a los campos de entrada en el modal
                inputT.value = "modificar_detalle";
                inputId.value = data.n_ot;
                inputCant.value = data.cant_tec;
                inputTurno.value = data.id_turno;
                inputStatus.value = data.id_estado;
                inputCco.value = data.id_miembro_cco; 
                inputCcf.value = data.id_miembro_ccf; 
                inputTecnico.value = data.id_user_act ;
                inputPrep_ini.value = data.hora_ini_pre;
                inputPrep_fin.value = data.hora_fin_pre;
                inputTras_ini.value = data.hora_ini_tra;
                inputTras_fin.value = data.hora_fin_tra;
                inputEjec_ini.value = data.hora_ini_eje;
                inputEjec_fin.value = data.hora_fin_eje;
                inputObserv.value = data.observacion;
            }
        });
        

    });        
});
