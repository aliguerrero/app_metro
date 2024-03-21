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
//muestra una alerta específica dependiendo del tipo de alerta proporcionado en el objeto. 
//Las acciones posibles incluyen mostrar una alerta simple, 
//recargar la página, limpiar el formulario y redirigir a otra página.
function alertas_ajax(alerta) {
    // Verificar el tipo de alerta
    if (alerta.tipo == "simple") {
        // Mostrar una alerta simple usando SweetAlert
        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        });
    } else if (alerta.tipo == "recargar") {
        // Mostrar una alerta y recargar la página si el usuario confirma
        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload(); // Recargar la página
            }
        });
    } else if (alerta.tipo == "limpiar") {
        // Mostrar una alerta y limpiar el formulario si el usuario confirma
        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector(".FormularioAjax").reset(); // Limpiar el formulario
            }
        });
    } else if (alerta.tipo == "redireccionar") {
        // Redirigir a una URL específica
        window.location.href = alerta.url; // Redireccionar
    }
}
