//script.js
document.getElementById("form-publicacion").addEventListener("submit", function(event) {
event.preventDefault(); // Evita que el formulario se envíe automáticamente

// Obtener los valores de los campos del formulario
var titulo = document.getElementById("titulo").value;
var contenido = document.getElementById("contenido").value;
var etiquetas = document.getElementById("etiquetas").value;
var archivo = document.getElementById("archivo").files[0];

// Crear un objeto FormData para enviar los datos al servidor
var formData = new FormData();
formData.append("titulo", titulo);
formData.append("contenido", contenido);
formData.append("etiquetas", etiquetas);
formData.append("archivo", archivo);

// Enviar los datos al servidor usando AJAX o Fetch
var xhr = new XMLHttpRequest();
xhr.open("POST", "publicar.php", true);
xhr.onreadystatechange = function() {
if (xhr.readyState === 4 && xhr.status === 200) {
// Procesar la respuesta del servidor si es necesario
console.log(xhr.responseText);
}
};
xhr.send(formData);
});
