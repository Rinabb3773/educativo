<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "ddseu2";
$password = "ddseu2_123456";
$dbname = "nombre_base_de_datos";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los valores del formulario
$titulo = $_POST['titulo'];
$contenido = $_POST['contenido'];
$etiquetas = $_POST['etiquetas'];
$archivo = $_FILES['archivo'];

// Procesar el archivo adjunto si se seleccionó uno
if ($archivo['name']) {
    // Ruta de destino para guardar el archivo
    $ruta = "ruta/del/destino/" . basename($archivo['name']);

    // Mover el archivo a la ruta de destino
    if (move_uploaded_file($archivo['tmp_name'], $ruta)) {
        echo "Archivo adjunto subido correctamente.";
    } else {
        echo "Error al subir el archivo adjunto.";
    }
}

// Insertar los datos en la base de datos
$sql = "INSERT INTO publicaciones (titulo, contenido, etiquetas, archivo) VALUES ('$titulo', '$contenido', '$etiquetas', '$ruta')";

if ($conn->query($sql) === TRUE) {
    echo "Publicación creada correctamente.";
} else {
    echo "Error al crear la publicación: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
