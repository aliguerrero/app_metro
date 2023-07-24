
var optTipo = document.getElementById('comboTipo')
optTipo.onchange = function () {
  if (this.value == 1) {
    cargarContenido('componente/componente_campo.php', '#tipo');
  } else {
    cargarContenido('componente/componente_rango.php', '#tipo');
  }
}


function cargarContenido(url, elemento) {
  // Realiza una solicitud AJAX para cargar contenido actualizado desde una URL específica y actualizar un elemento HTML específico.

  // Parámetros:
  // - url (string): La URL del archivo PHP que devuelve el contenido actualizado.
  // - elemento (string): El identificador del elemento HTML donde se actualizará el contenido.
  $.ajax({
    url: url,
    type: 'GET',
    success: function (response) {
      // Si la solicitud es exitosa, actualiza el contenido del elemento HTML con la respuesta recibida.
      $(elemento).html(response);
    },
    error: function () {
      // Si hay un error en la solicitud, muestra una alerta con el mensaje "Error al cargar el contenido".
      alert('Error al cargar el contenido');
    }
  });
}