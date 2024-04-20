/**
 * Función para mostrar un alerta con crear un nombre de usuario.
 *
 * @function
 * @name mostrarAlertaUsername
 * @description Muestra un alerta con crear un nombre de usuario.
 * @returns {void} No devuelve valor.
 */
function mostrarAlertaUsername() {
    Swal.fire({
        title: "Crear un Nombre de Usuario",
        html: `
            <hr>  
            <div style="text-align: left;">
                <p><strong>Por favor, sigue estas instrucciones al crear tu nombre de usuario:</strong></p>
                <ul>
                    <li>Tu nombre de usuario debe contener solo letras (mayúsculas o minúsculas) y números.</li>
                    <li>Debe tener entre 4 y 20 caracteres de longitud.</li>
                    <li>Solo se admiten letras y números.</li>
                </ul>
                <p><strong>Ejemplos de nombres de usuario válidos:</strong></p>
                <ul>
                    <li>johnDoe123</li>
                    <li>aliceSmith5678</li>
                    <li>johndoe</li>
                </ul>
                <p><strong>Ejemplos de nombres de usuario inválidos:</strong></p>
                <ul>
                    <li>john_Doe (contiene guión bajo)</li>
                    <li>alice-Smith (contiene guión)</li>
                    <li>john.Doe (contiene punto)</li>
                </ul>
                <p>Asegúrate de seguir estas pautas al crear tu nombre de usuario. ¡Gracias!</p>
            </div>`,
        icon: "info",
        confirmButtonText: "<strong>Entendido</strong>",
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-primary'
        }
    });
}
/**
 * Función para mostrar un alerta de Swal con crear una contraseña segura.
 */
function mostrarAlertaContrasena() {
    /**
     * @function
     * @name mostrarAlertaContrasena
     * @description Muestra un alerta de Swal con crear una contraseña segura.
     * @returns {void} No devuelve valor.
     */
    Swal.fire({
        title: "Crear una Contraseña Segura",
        html: `
        <hr>
        <div style="text-align: left;">
            <p><strong>Por favor, sigue estas instrucciones al crear tu contraseña:</strong></p>
            <ul>
                <li>Tu contraseña debe contener letras (mayúsculas o minúsculas), números y los siguientes caracteres especiales: $, @, . y -.</li>
                <li>Debe tener entre 8 y 15 caracteres de longitud.</li>
            </ul>
            <p><strong>Ejemplos de contraseñas seguras:</strong></p>
            <ul>
                <li>Abc123@.-</li>
                <li>SecurePwd$567</li>
                <li>Passw0rd.-@</li>
            </ul>
            <p>Asegúrate de seguir estas pautas al crear tu contraseña para garantizar la seguridad de tu cuenta. ¡Gracias!</p>
        </div>`,
        icon: "info",
        confirmButtonText: "<strong>Entendido</strong>",
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-primary'
        }
    });
}
/**
 * Función para mostrar un alerta de Swal con crear una cédula válida.
 *
 * @function
 * @name mostrarAlertaCedula
 * @description Muestra un alerta de Swal con crear una cédula válida.
 * @returns {void} No devuelve valor.
 */
function mostrarAlertaCedula() {
    Swal.fire({
        title: "Ingresar una Cédula Válida",
        html: `
        <hr>
        <div style="text-align: left;">
            <p><strong>Por favor, sigue estas instrucciones al ingresar tu número de cédula:</strong></p>
            <ul>
                <li>El número de cédula debe contener únicamente dígitos numéricos.</li>
                <li>Debe tener entre 6 y 10 dígitos de longitud.</li>
            </ul>
            <p><strong>Ejemplos de cédulas válidas:</strong></p>
            <ul>
                <li>123456</li>
                <li>9876543210</li>
                <li>0123456789</li>
            </ul>
            <p><strong>Ejemplos de cédulas inválidas:</strong></p>
            <ul>
                <li>ABC123</li>
                <li>12345 (menos de 6 dígitos)</li>
                <li>12345678901234567890 (más de 10 dígitos)</li>
            </ul>
            <p>Asegúrate de seguir estas pautas al ingresar tu número de cédula. ¡Gracias!</p>
        </div>`,
        icon: "info",
        confirmButtonText: "<strong>Entendido</strong>",
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-primary'
        }
    });
}


