<?php
// Verifica si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $apellidos = $_POST["apellidos"];
    $nombres = $_POST["nombres"];
    $cedula = $_POST["cedula"];
    $email = $_POST["email"];

    // Validación básica (puedes mejorarla según tus necesidades)
    if (empty($apellidos) || empty($nombres) || empty($cedula) || empty($email)) {
        // Si hay campos vacíos, redirige con un mensaje de error
        header("Location: registro_estudiantes.php?error=campos_vacios");
        exit();
    }

    // Conexión a la base de datos (ajusta los detalles de conexión según tu entorno)
    $conexion = new mysqli("localhost:3307", "root", "admin", "clasepractica4");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta para insertar el estudiante en la base de datos
    $consulta = $conexion->prepare("INSERT INTO estudiantes (apellidos, nombres, cedula, email, fecha_creacion) VALUES (?, ?, ?, ?, NOW())");
    $consulta->bind_param("ssss", $apellidos, $nombres, $cedula, $email);

    // Ejecuta la consulta
    if ($consulta->execute()) {
        // Registro exitoso, redirige con un mensaje de éxito
        header("Location: registro_estudiantes.php?exito=registro_exitoso");
        exit();
    } else {
        // Error al registrar, redirige con un mensaje de error
        header("Location: registro_estudiantes.php?error=registro_error");
        exit();
    }

    // Cierra la conexión y la consulta
    $consulta->close();
    $conexion->close();
} else {
    // Si no se han enviado datos por POST, redirige a la página de inicio
    header("Location: index.php");
}
?>
