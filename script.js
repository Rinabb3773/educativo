document.getElementById("form-publicacion").addEventListener("submit", function(event) {
  event.preventDefault(); // Evita que el formulario se envíe automáticamente

  // Obtener los valores de los campos del formulario
  var titulo = document.getElementById("titulo").value;
  var contenido = document.getElementById("contenido").value;
  var etiquetas = document.getElementById("etiquetas").value;
  var archivo = document.getElementById("archivo").files[0];

  // Crear un objeto FormData para enviar
