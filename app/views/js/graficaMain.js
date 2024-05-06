$(document).ready(function () {
    // Realizar la solicitud Ajax al servidor
    $.ajax({
        url: 'http://localhost/app_metro/app/controllers/cargarGraficaMain.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            // Llenar los datos para la gráfica
            const labels = data.map(item => item.nombre_estado);
            const valores = data.map(item => item.total_registros);
            const cantidadCategorias = labels.length;

            // Generar colores aleatorios con transparencia
            const backgroundColor = generateRandomColors(cantidadCategorias, 0.6);
            // Obtener el color de fondo sin transparencia
            const borderColor = backgroundColor.map(color => color.replace(/,[^,]+(?=\))/, ', 1')); // Reemplazar la última parte de la cadena (la transparencia) por 1

            const chartData = {
                labels: labels,
                datasets: [{
                    label: 'Grafica',
                    data: valores,
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
                    hoverOffset: 6, // El hover tiene el mismo color que el fondo
                }]
            };

            const options = {
                responsive: true,
                maintainAspectRatio: false, // Esto evita que la gráfica mantenga una relación de aspecto específica
                title: {
                    display: true,
                    text: 'doughnut'
                }
            };

            // Obtener el contexto del elemento canvas
            const ctx = document.getElementById('ChartOt').getContext('2d');

            // Crear la gráfica
            const myChart = new Chart(ctx, {
                type: 'doughnut',
                data: chartData,
                options: options
            });
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener los datos:', error);
        }
    });

    $.ajax({
        url: 'http://localhost/app_metro/app/controllers/cargarDatosGraficaTurno.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            // Llenar los datos para la gráfica
            const labels = data.map(item => item.nombre_turno);
            const valores = data.map(item => item.total_registros);
            const cantidadCategorias = labels.length;

            // Generar colores aleatorios con transparencia
            const backgroundColor = generateRandomColors(cantidadCategorias, 0.6);
            // Obtener el color de fondo sin transparencia
            const borderColor = backgroundColor.map(color => color.replace(/,[^,]+(?=\))/, ', 1')); // Reemplazar la última parte de la cadena (la transparencia) por 1

            const chartData = {
                labels: labels,
                datasets: [{
                    label: 'Grafica',
                    data: valores,
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
                    hoverOffset: 6, // El hover tiene el mismo color que el fondo
                }]
            };

            const options = {
                responsive: true,
                maintainAspectRatio: false, // Esto evita que la gráfica mantenga una relación de aspecto específica
                title: {
                    display: true,
                    text: 'doughnut'
                }
            };

            // Obtener el contexto del elemento canvas
            const ctx = document.getElementById('ChartTurno').getContext('2d');

            // Crear la gráfica
            const myChart = new Chart(ctx, {
                type: 'doughnut',
                data: chartData,
                options: options
            });
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener los datos:', error);
        }
    });

    const container1 = $('#graficas-container1');
    // Realizar la solicitud Ajax para obtener la lista de estados
    $.ajax({
        url: 'http://localhost/app_metro/app/controllers/cargarGraficaArea.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            // Iterar sobre cada estado
            data.forEach(function (area) {
                const areaId = area.id_area;
                const areaNombre = area.nombre_area;
                // Crear un nuevo div para contener la gráfica
                const cardDiv = $('<div></div>');
                cardDiv.addClass('card mb-4 text-white p-3 m-2');
                // Crear un nuevo elemento canvas
                const canvas = $('<canvas></canvas>');
                canvas.attr('id', `myChart1-${areaId}`);
                // Agregar el canvas al div de la tarjeta
                cardDiv.append(canvas);
                // Agregar el div de la tarjeta al contenedor
                container1.append(cardDiv);

                // Realizar una solicitud Ajax para obtener los datos del estado actual
                $.ajax({
                    url: 'http://localhost/app_metro/app/controllers/cargarDatosGraficaArea.php',
                    method: 'GET',
                    dataType: 'json',
                    data: { id: areaId }, // Pasar el id_estado como parámetro
                    success: function (estadoData) {
                        // Obtener los datos para la gráfica
                        const labels = estadoData.map(item => `${item.nombre_estado}%`);
                        const valores = estadoData.map(item => item.porcentaje_total);
                        const cantidadCategorias = labels.length;
                        // Generar colores aleatorios con transparencia
                        const backgroundColor = generateRandomColors(cantidadCategorias, 0.6);
                        // Obtener el color de fondo sin transparencia
                        const borderColor = backgroundColor.map(color => color.replace(/,[^,]+(?=\))/, ', 1')); // Reemplazar la última parte de la cadena (la transparencia) por 1

                        const chartData = {
                            labels: labels,                            
                            datasets: [{
                                label : `${areaNombre}`,
                                data: valores,
                                backgroundColor: backgroundColor,
                                borderColor: borderColor,
                                hoverOffset: 6, // El hover tiene el mismo color que el fondo
                            }]
                        };

                        const options = {
                            responsive: true,
                            maintainAspectRatio: false, // Esto evita que la gráfica mantenga una relación de aspecto específica
                            title: {
                                display: true,
                                text: `Gráfica de ${areaNombre}`
                            }
                        };

                        // Obtener el contexto del elemento canvas
                        const ctx = document.getElementById(`myChart1-${areaId}`).getContext('2d');

                        // Crear la gráfica
                        const myChart = new Chart(ctx, {
                            type: 'bar',
                            data: chartData,
                            options: options
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(`Error al obtener los datos del estado ${areaNombre}:`, error);
                    }
                });
            });
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener la lista de estados:', error);
        }
    });

    const container2 = $('#graficas-container2');
    // Realizar la solicitud Ajax para obtener la lista de estados
    $.ajax({
        url: 'http://localhost/app_metro/app/controllers/cargarGraficaTurno.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            // Iterar sobre cada estado
            data.forEach(function (turno) {
                const turnoId = turno.id_turno;
                const turnoNombre = turno.nombre_turno;
                // Crear un nuevo div para contener la gráfica
                const cardDiv = $('<div></div>');
                cardDiv.addClass('card mb-4 text-white p-3 m-2');
                // Crear un nuevo elemento canvas
                const canvas = $('<canvas></canvas>');
                canvas.attr('id', `myChart2-${turnoId}`);
                // Agregar el canvas al div de la tarjeta
                cardDiv.append(canvas);
                // Agregar el div de la tarjeta al contenedor
                container2.append(cardDiv);

                // Realizar una solicitud Ajax para obtener los datos del estado actual
                $.ajax({
                    url: 'http://localhost/app_metro/app/controllers/cargarDatosGraficaTurno2.php',
                    method: 'GET',
                    dataType: 'json',
                    data: { id: turnoId }, // Pasar el id_estado como parámetro
                    success: function (estadoData) {
                        // Obtener los datos para la gráfica
                        const labels = estadoData.map(item => `${item.nombre_estado}%`);
                        const valores = estadoData.map(item => item.porcentaje_total);
                        const cantidadCategorias = labels.length;
                        // Generar colores aleatorios con transparencia
                        const backgroundColor = generateRandomColors(cantidadCategorias, 0.6);
                        // Obtener el color de fondo sin transparencia
                        const borderColor = backgroundColor.map(color => color.replace(/,[^,]+(?=\))/, ', 1')); // Reemplazar la última parte de la cadena (la transparencia) por 1

                        const chartData = {
                            labels: labels,                            
                            datasets: [{
                                label : `${turnoNombre}`,
                                data: valores,
                                backgroundColor: backgroundColor,
                                borderColor: borderColor,
                                hoverOffset: 6, // El hover tiene el mismo color que el fondo
                            }]
                        };

                        const options = {
                            responsive: true,
                            maintainAspectRatio: false, // Esto evita que la gráfica mantenga una relación de aspecto específica
                            title: {
                                display: true,
                                text: `Gráfica de ${turnoNombre}`
                            }
                        };

                        // Obtener el contexto del elemento canvas
                        const ctx = document.getElementById(`myChart2-${turnoId}`).getContext('2d');

                        // Crear la gráfica
                        const myChart = new Chart(ctx, {
                            type: 'bar',
                            data: chartData,
                            options: options
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(`Error al obtener los datos del estado ${areaNombre}:`, error);
                    }
                });
            });
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener la lista de estados:', error);
        }
    });
    
});

// Función para generar colores aleatorios
function generateRandomColors(numColors, opacity) {
    const colors = [];
    for (let i = 0; i < numColors; i++) {
        const color = `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${opacity})`;
        colors.push(color);
    }
    return colors;
}
