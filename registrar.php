<?php
function ConnectionToDB() {
    $servername = 'localhost';
    $dbname = 'ddseu2'; // Reemplaza con el nombre de tu base de datos
    $charset = "utf8";
    $username = 'ddseu2'; // Reemplaza con tu nombre de usuario
    $password = 'ddseu2_123456'; // Reemplaza con tu contraseña
    $db = new PDO("mysql:host=$servername;dbname=$dbname;charset=$charset", $username, $password, 
      array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $db->exec("set names utf8");
    return $db;
}

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$conexion = ConnectionToDB();

$query = "INSERT INTO usuarios (usuario, contrasena) VALUES (:usuario, :contrasena)";
$stmt = $conexion->prepare($query);
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':contrasena', $contrasena);

if ($stmt->execute()) {
    echo "El usuario ha sido registrado correctamente en la base de datos.";
} else {
    echo "Error al registrar al usuario: " . $stmt->errorInfo()[2];
}

$conexion = null;
?>
