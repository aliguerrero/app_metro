document.getElementById('selectAccion').addEventListener('change', function() {
    var tipo_busqueda = this.value;
    // Ocultar todos los campos primero    
    document.getElementById('nuevo').style.display = 'none';
    document.getElementById('listar').style.display = 'none';
    // Mostrar el campo correspondiente según el tipo de búsqueda seleccionado
    if (tipo_busqueda === '1') {
        document.getElementById('listar').style.display = 'block';
        document.getElementById('accion').value = "modificar_rol";
    } else if (tipo_busqueda === '2') {
        document.getElementById('nuevo').style.display = 'block';
        document.getElementById('accion').value = "registrar_rol";
    }
});
