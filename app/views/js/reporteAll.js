/******************************************************
 * reporteAll.js – Sistema de Reportes Completos
 * Compatible con:
 *  - Multi-reportes (OT, usuarios, herramientas, etc.)
 *  - Vista previa dinámica
 *  - Paginación
 *  - Exportación PDF/Excel
 *  - Gráficos con Chart.js
 *  - Filtros dinámicos
 ******************************************************/

// ===============================================
//  VARIABLES GLOBALES
// ===============================================

// Página actual para paginación
let paginaActual = 1;

// Cantidad de registros por página
let porPagina = 20;

// Base URL del sistema (se obtiene del input hidden con id="url")
const apiBase = document.getElementById('url')?.value || './';

// Variable global Chart.js
let chartReporte = null;


// ===============================================
//  INICIALIZACIÓN DEL SCRIPT
// ===============================================
document.addEventListener('DOMContentLoaded', function () {

    // Ocultar filtros hasta elegir un tipo de reporte
    $("#filtros_ot").hide();

    // Cargar filtros para los combos (área, sitio, estados, etc.)
    cargarFiltros();

    // Cuando se cambia el tipo de reporte
    $("#tipo_reporte").on("change", function () {

        let tipo = $(this).val();

        // Mostrar mensaje temporal mientras carga
        $("#vista_previa").html("<p class='text-muted'>Cargando vista previa...</p>");

        // Mostrar filtros SOLO si son reportes basados en OT
        if (tipo === "reporte_ot" || tipo === "reporte_detalle_ot") {
            $("#filtros_ot").slideDown();
        } else {
            $("#filtros_ot").slideUp();
        }

        // Reiniciar página cuando se cambia reporte
        paginaActual = 1;

        // Generar vista previa con el nuevo tipo
        generarVistaPrevia();
    });

    // Detectar cambios en cualquier filtro
    $('#f_area, #f_sitio, #f_ini, #f_fin, #f_estado, #f_turno, #f_tec, #f_ot, #f_miembro')
        .on('change keyup', function () {
            paginaActual = 1; // Reiniciar a página 1
            generarVistaPrevia();
        });

    // Botón generar reporte completo (exportador)
    $("#btn_generar").on("click", function () {
        generarReporteFinal();
    });

    // Botón PDF
    $("#btn_pdf").on("click", function () {
        exportarReporte("pdf");
    });

    // Botón Excel
    $("#btn_excel").on("click", function () {
        exportarReporte("excel");
    });

});


// ===============================================
//  FUNCIÓN PRINCIPAL: CARGAR VISTA PREVIA
// ===============================================
function generarVistaPrevia() {

    let tipo = $("#tipo_reporte").val();

    // Si no ha seleccionado reporte
    if (tipo === "") {
        $("#vista_previa").html("<p class='text-muted'>Seleccione un reporte...</p>");
        return;
    }

    // Obtiene los filtros seleccionados
    let filtros = obtenerFiltros();
    filtros["tipo"] = tipo;
    filtros["page"] = paginaActual;
    filtros["per_page"] = porPagina;

    // Petición AJAX al backend
    $.ajax({
        url: `${apiBase}app/controllers/cargarDatosReporte.php`,
        method: "POST",
        data: filtros,
        success: function (resp) {

            let res = JSON.parse(resp);
            let data = res.data || [];

            // Si no hay registros
            if (!Array.isArray(data) || data.length === 0) {
                $("#vista_previa").html("<p class='text-danger'>No hay datos para mostrar.</p>");
                $("#paginacion_reporte").html("");
                return;
            }

            // Mostrar tabla
            $("#vista_previa").html(convertirTabla(data));

            // Dibujar paginación
            dibujarPaginacion(res.total, res.page, res.per_page);

            // Dibujar gráfico
            actualizarGrafico(tipo, data);
        },

        error: function () {
            $("#vista_previa").html("<p class='text-danger'>Error al cargar reporte.</p>");
        }
    });
}


// ===============================================
//  FUNCIÓN PARA EXPORTAR PDF/EXCEL
// ===============================================
function exportarReporte(formato) {

    let tipo = $("#tipo_reporte").val();

    if (tipo === "") {
        mostrarAlerta("warning", "Seleccione un tipo de reporte", "");
        return;
    }

    let filtros = obtenerFiltros();
    filtros["tipo"] = tipo;
    filtros["export"] = formato;

    window.open(`${apiBase}app/controllers/exportarReporte.php?` + new URLSearchParams(filtros));
}



// ===============================================
//  CARGAR COMBOS DE FILTROS DESDE PHP
// ===============================================
function cargarFiltros() {

    $.ajax({
        url: `${apiBase}app/controllers/cargarFiltrosReporte.php`,
        method: "GET",
        dataType: "json",

        success: function (data) {
            llenarSelect("#f_area", data.area);
            llenarSelect("#f_sitio", data.sitio);
            llenarSelect("#f_estado", data.estado);
            llenarSelect("#f_turno", data.turno);
            llenarSelect("#f_tec", data.tecnicos);
            llenarSelect("#f_miembro", data.miembros);
        }
    });

}

// Llenar combos dinámicamente
function llenarSelect(id, data) {
    let el = $(id);
    el.html('<option value="">Todos</option>');
    data.forEach(d => {
        el.append(`<option value="${d.id}">${d.nombre}</option>`);
    });
}



// ===============================================
//  SISTEMA DE PAGINACIÓN
// ===============================================
function dibujarPaginacion(total, page, per_page) {

    let totalPaginas = Math.ceil(total / per_page);

    // Si solo hay una página, no mostrar paginación
    if (totalPaginas <= 1) {
        $("#paginacion_reporte").html("");
        return;
    }

    let html = "";

    // Botón anterior
    html += `<button class="btn btn-sm btn-secondary me-2" ${page <= 1 ? 'disabled' : ''} onclick="cambiarPagina(${page - 1})">Anterior</button>`;

    // Texto central
    html += `<span>Página ${page} de ${totalPaginas}</span>`;

    // Botón siguiente
    html += `<button class="btn btn-sm btn-secondary ms-2" ${page >= totalPaginas ? 'disabled' : ''} onclick="cambiarPagina(${page + 1})">Siguiente</button>`;

    $("#paginacion_reporte").html(html);
}

// Cambiar página
function cambiarPagina(nuevaPagina) {
    paginaActual = nuevaPagina;
    generarVistaPrevia();
}



// ===============================================
//  OBTENER TODOS LOS FILTROS SELECCIONADOS
// ===============================================
function obtenerFiltros() {
    return {
        area: $("#f_area").val(),
        sitio: $("#f_sitio").val(),
        ini: $("#f_ini").val(),
        fin: $("#f_fin").val(),
        estado: $("#f_estado").val(),
        turno: $("#f_turno").val(),
        tec: $("#f_tec").val(),
        ot: $("#f_ot").val(),
        miembro: $("#f_miembro").val()
    };
}



// ===============================================
//  GENERAR TABLA HTML
// ===============================================
function convertirTabla(data) {

    // Validación por seguridad
    if (!Array.isArray(data) || data.length === 0) {
        return "<p class='text-danger'>No hay datos para mostrar.</p>";
    }

    // Obtener las columnas de la primera fila
    let columnas = Object.keys(data[0]);

    // Construir tabla
    let html = "<table class='table table-sm table-bordered'><thead><tr>";

    columnas.forEach(c => html += `<th>${c}</th>`);
    html += "</tr></thead><tbody>";

    // Filas
    data.forEach(reg => {
        html += "<tr>";
        columnas.forEach(c => html += `<td>${reg[c]}</td>`);
        html += "</tr>";
    });

    html += "</tbody></table>";
    return html;
}




// ===============================================
//  GRÁFICO CHART.JS – REPRESENTACIÓN VISUAL
// ===============================================
function actualizarGrafico(tipo, data) {

    // No generar gráfico si no hay datos
    if (!Array.isArray(data) || data.length === 0) return;

    let labels = [];
    let valores = [];

    /**********************************************
     *  Diferentes tipos de gráficos según reporte
     **********************************************/
    if (tipo === 'reporte_ot') {

        // Contar cuántas OT por estado
        let estados = {};
        data.forEach(r => {
            let est = r.nombre_estado || "Sin estado";
            estados[est] = (estados[est] || 0) + 1;
        });

        labels = Object.keys(estados);
        valores = Object.values(estados);

    } else if (tipo === 'reporte_herramientas') {

        labels = data.map(r => r.nombre_herramienta);
        valores = data.map(r => parseInt(r.cantidad || 0));

    } else {
        // Si no aplica gráfico, limpiarlo
        if (chartReporte !== null) chartReporte.destroy();
        return;
    }

    // Obtener canvas
    let ctx = document.getElementById('chart_reporte').getContext('2d');

    // Destruir gráfico previo
    if (chartReporte !== null) {
        chartReporte.destroy();
    }

    // Crear gráfico tipo barras
    chartReporte = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Cantidad',
                data: valores,
                backgroundColor: 'rgba(54, 162, 235, 0.5)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

}

