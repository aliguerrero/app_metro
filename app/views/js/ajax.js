// Seleccionar todos los formularios con la clase "FormularioAjax"
const formularios_ajax = document.querySelectorAll(".FormularioAjax");

// Iterar sobre cada formulario
formularios_ajax.forEach(formulario => {
    // Agregar un evento de escucha para el evento "submit"
    formulario.addEventListener("submit", function(e){
        // Prevenir el comportamiento por defecto del formulario (enviar la solicitud)
        e.preventDefault();

        // Mostrar un cuadro de diálogo de confirmación usando SweetAlert
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
                // Crear un objeto FormData para recopilar los datos del formulario
                let data = new FormData(this);
                // Obtener el método y la acción del formulario
                let method = this.getAttribute("method");
                let action = this.getAttribute("action");

                // Configurar los encabezados para la solicitud fetch
                let encabezados = new Headers();
                // Configurar el objeto de configuración para la solicitud fetch
                let config= {
                    method: method,
                    headers: encabezados,
                    mode: 'cors',
                    cache: 'no-cache',
                    body: data
                };

                // Enviar la solicitud fetch al servidor con la acción y la configuración especificadas
                fetch(action, config)
                // Procesar la respuesta del servidor como JSON
                .then(respuesta => respuesta.json())
                // Procesar la respuesta JSON
                .then(respuesta => {
                    // Llamar a la función alertas_ajax() con la respuesta del servidor como argumento
                    return alertas_ajax(respuesta);
                });
            }
        });
    });
});

function alertas_ajax(alerta){

}