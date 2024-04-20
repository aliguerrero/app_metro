document.getElementById('fecha_desde').addEventListener('change', function() {
    var fecha_desde = new Date(this.value);
    var fecha_hasta = new Date(document.getElementById('fecha_hasta').value);

    if (fecha_desde > fecha_hasta) {
        
        const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 7000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        } });
          Toast.fire({
            icon: "warning",
            title: "Verificar rango de fecha inicial, no puede ser superior a fecha final.",
        });
        this.value = ''; // Limpiar el campo
    }
});

document.getElementById('fecha_hasta').addEventListener('change', function() {
    var fecha_desde = new Date(document.getElementById('fecha_desde').value);
    var fecha_hasta = new Date(this.value);

    if (fecha_hasta < fecha_desde) {
       
        const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 7000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        } });
            Toast.fire({
            icon: "warning",
            title: "Verificar rango de fecha final, no puede ser inferior a fecha inicial.",
        });    
        this.value = ''; // Limpiar el campo
    }
});
document.getElementById('tipo_busqueda').addEventListener('change', function() {
    var tipo_busqueda = this.value;
    // Ocultar todos los campos primero
    document.getElementById('nrot_field').style.display = 'none';
    document.getElementById('fecha_field').style.display = 'none';
    document.getElementById('estado_field').style.display = 'none';
    document.getElementById('operador_field').style.display = 'none';
    // Mostrar el campo correspondiente según el tipo de búsqueda seleccionado
    if (tipo_busqueda === '1') {
        document.getElementById('nrot_field').style.display = 'block';
    } else if (tipo_busqueda === '2') {
        document.getElementById('fecha_field').style.display = 'block';
    } else if (tipo_busqueda === '3') {
        document.getElementById('estado_field').style.display = 'block';
    } else if (tipo_busqueda === '4') {
        document.getElementById('operador_field').style.display = 'block';
    }
});

    // Función para calcular la semana y el mes correspondientes
    function calcularSemanaYMes() {
        // Obtener el valor seleccionado del campo de fecha
        var fechaSeleccionada = document.getElementById("fecha").value;
        
        // Convertir la fecha seleccionada en un objeto de fecha
        var fecha = new Date(fechaSeleccionada);
        
        // Calcular la semana del año (de lunes a domingo)
        var semana = getWeekNumber(fecha);
        
        // Obtener el mes de la fecha seleccionada
        var mes = fecha.getMonth() + 1; // Sumar 1 porque getMonth() devuelve un número de 0 a 11
        
        // Actualizar los campos de semana y mes con los valores calculados
        document.getElementById("semana").value = semana;
        document.getElementById("mes").value = mes;
    }

    // Función para obtener el número de semana del año (de lunes a domingo)
    function getWeekNumber(date) {
        // Obtener el día de la semana (0 para domingo, 1 para lunes, ..., 6 para sábado)
        var dayOfWeek = date.getDay();
        
        // Ajustar la fecha para que comience en el primer día de la semana (lunes)
        var firstDayOfWeek = new Date(date);
        firstDayOfWeek.setDate(date.getDate() - dayOfWeek + (dayOfWeek === 0 ? -6 : 1));

        // Calcular el número de días transcurridos desde el inicio del año
        var daysSinceStart = Math.floor((date - new Date(date.getFullYear(), 0, 1)) / 86400000);
        
        // Calcular el número de semanas completas y sumar 1
        var weekNumber = Math.ceil((daysSinceStart + 2) / 7);
        
        return weekNumber;
    }    