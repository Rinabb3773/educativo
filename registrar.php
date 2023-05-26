<?php
function ConnectionToDB() {
    $servername = 'localhost';
    $dbname = 'valero'; // Reemplaza con el nombre de tu base de datos
    $charset = "utf8";
    $username = 'ddseu2'; // Reemplaza con tu nombre de usuario
    $password = 'ddseu2_123456'; // Reemplaza con tu contraseña
    $db = new PDO("mysql:host=$servername;dbname=$dbname;charset=$charset", $username, $password, 
      array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $db->exec("set names utf8");
    return $db;
}

function select_row_by_clause($table, $clause){
    $db = ConnectionToDB();
    $stmt = $db->prepare("SELECT * FROM $table WHERE $clause");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(!$rows){
        $row = array();
        return $row;
    } else {
        $row = $rows[0];
        return $row;
    }
}

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$conexion = ConnectionToDB();

$query = "INSERT INTO mathcoachusuario (usuario, clave) VALUES (:usuario, :contrasena)";
$stmt = $conexion->prepare($query);
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':contrasena', $contrasena);
if ($stmt->execute()) {
    header("Location: index.html");
    exit();
} else {
    echo "Error al registrar al usuario: " . $conexion->errorInfo()[2];
}

$conexion = null;
?>
