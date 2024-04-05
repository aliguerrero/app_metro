
const passwordInput1 = document.getElementById('clave1');
const togglePasswordButton1 = document.getElementById('togglePassword1');
const passwordIcon1 = togglePasswordButton1.querySelector('img');

const passwordInput2 = document.getElementById('clave2');
const togglePasswordButton2 = document.getElementById('togglePassword2');
const passwordIcon2 = togglePasswordButton2.querySelector('img');

togglePasswordButton1.addEventListener('click', function () {
    const type1 = passwordInput1.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput1.setAttribute('type', type1);

    // Cambiar el icono según la visibilidad de la contraseña
    passwordIcon1.src = type1 === 'password' ? '../app/views/icons/eye.png' : '../app/views/icons/eye2.png';
});

togglePasswordButton2.addEventListener('click', function () {
    const type2 = passwordInput2.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput2.setAttribute('type', type2);

    // Cambiar el icono según la visibilidad de la contraseña
    passwordIcon2.src = type2 === 'password' ? '../app/views/icons/eye.png' : '../app/views/icons/eye2.png';
});