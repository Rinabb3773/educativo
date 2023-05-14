<?php
// Obtener los valores ingresados por el usuario
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Conectar a la base de datos
$conexion = mysqli_connect('localhost', 'ddseu2', 'ddseu2_123456', 'basedatos');

// Verificar si la conexión se realizó correctamente
if (mysqli_connect_errno()) {
    // Si hubo un error en la conexión, mostrar un mensaje de error y terminar el script
    echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    exit();
}

// Buscar al usuario en la base de datos
$query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
$resultado = mysqli_query($conexion, $query);

// Verificar si se encontró al usuario
if (mysqli_num_rows($resultado) > 0) {
    // Si se encontró al usuario, iniciar sesión y redirigir al usuario a una página segura
    session_start();
    $_SESSION['usuario'] = $usuario;
    header("Location: pagina-segura.php");
    exit();
} else {
    // Si las credenciales son incorrectas, mostrar un mensaje de error y redirigir al usuario a la página de inicio de sesión
    header("Location: index.php?error=1");
    exit();
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
