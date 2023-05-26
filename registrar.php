<?php
function ConnectionToDB() {
    $servername = 'localhost';
    $dbname = 'ddseu2';
    $charset = "utf8";
    $username = 'ddseu2';
    $password = 'ddseu2_123456';
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

// End of select_row_by_clause ------------------------------------------------$
        $Email = $_POST["Email"];
        $UserPassword = $_POST["Password"];
        $row = select_row_by_clause("mathcoachusuario","email = '$Email'");
        $TablePassword = $row["clave"];
        $StudentNumber = $row['id'];

// Obtener los valores ingresados por el usuario

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Conectar a la base de datos
$conexion = ConnectionToDB();

// Insertar al usuario en la base de datos
$query = "INSERT INTO usuarios (usuario, contrasena) VALUES (:usuario, :contrasena)";
$stmt = $conexion->prepare($query);
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':contrasena', $contrasena);
if ($stmt->execute()) {
    // Si el usuario fue insertado correctamente, redirigir al usuario a la página de inicio de sesión
    header("Location: index.html");
    exit();
} else {
    // Si hubo un error al insertar al usuario, mostrar un mensaje de error
    echo "Error al registrar al usuario: " . $conexion->errorInfo()[2];
}

// Cerrar la conexión a la base de datos
$conexion = null;
?>
