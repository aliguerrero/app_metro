/**
 * Función para mostrar un alerta de Swal con instrucciones para ingresar un código.
 *
 * @function mostrarAlertaCodigo
 * @returns {void} - No devuelve valor.
 */
function mostrarAlertaCodigo() {
    /**
     * @typedef {Object} SwalOptions
     * @property {string} title - El título del alerta.
     * @property {string} html - El contenido HTML del alerta.
     * @property {string} icon - La icona del alerta.
     * @property {string} confirmButtonText - El texto del botón de confirmación.
     * @property {boolean} buttonsStyling - Si aplicar estilos personalizados a los botones.
     * @property {string} customClass - La clase personalizada para el botón de confirmación.
     */

    /**
     * Función para mostrar un alerta de SweetAlert2 con las opciones especificadas.
     *
     * @param {SwalOptions} options - Las opciones para el alerta.
     * @returns {void} - No devuelve valor.
     */
    function showAlert(options) {
        Swal.fire(options);
    }

    /**
     * Crea y muestra el alerta con instrucciones para ingresar un código.
     */
    const instructionsAlertOptions = {
        title: "Ingresar un Código",
        html: `
            <hr>
            <div style="text-align: left;">
                <p><strong>Por favor, sigue estas instrucciones al ingresar tu código:</strong></p>
                <ul>
                    <li>El código puede contener letras (mayúsculas o minúsculas), números y guiones.</li>
                    <li>Debe tener entre 1 y 10 caracteres de longitud.</li>
                </ul>
                <p><strong>Ejemplos de códigos válidos:</strong></p>
                <ul>
                    <li>abc123</li>
                    <li>CODE-123</li>
                    <li>code</li>
                </ul>
                <p>Asegúrate de seguir estas pautas al ingresar tu código. ¡Gracias!</p>
            </div>`,
        icon: "info",
        confirmButtonText: "<strong>Entendido</strong>",
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-primary'
        }
    };

    showAlert(instructionsAlertOptions);
}
