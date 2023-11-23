<?php
// Verifica si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $id_estudiante = $_POST["estudiante"];
    $id_lugar = $_POST["lugar"];

    // Validación básica (puedes mejorarla según tus necesidades)
    if (empty($id_estudiante) || empty($id_lugar)) {
        // Si hay campos vacíos, redirige con un mensaje de error
        header("Location: asignacion_lugares.php?error=campos_vacios");
        exit();
    }

    // Conexión a la base de datos (ajusta los detalles de conexión según tu entorno)
    $conexion = new mysqli("localhost:3307", "root", "admin", "clasepractica4");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Verifica si el estudiante ya está asignado al lugar educativo
    $consulta_verificacion = $conexion->prepare("SELECT id_asignacion FROM asignaciones WHERE id_estudiante = ? AND id_lugar = ?");
    $consulta_verificacion->bind_param("ii", $id_estudiante, $id_lugar);
    $consulta_verificacion->execute();
    $consulta_verificacion->store_result();

    if ($consulta_verificacion->num_rows > 0) {
        // El estudiante ya está asignado, redirige con un mensaje de error
        header("Location: asignacion_lugares.php?error=ya_asignado");
        exit();
    }

    // Consulta para insertar la asignación en la base de datos
    $consulta = $conexion->prepare("INSERT INTO asignaciones (id_estudiante, id_lugar, fecha_asignacion) VALUES (?, ?, NOW())");
    $consulta->bind_param("ii", $id_estudiante, $id_lugar);

    // Ejecuta la consulta
    if ($consulta->execute()) {
        // Asignación exitosa, redirige con un mensaje de éxito
        header("Location: asignacion_lugares.php?exito=asignacion_exitosa");
        exit();
    } else {
        // Error al asignar, redirige con un mensaje de error
        header("Location: asignacion_lugares.php?error=asignacion_error");
        exit();
    }

    // Cierra la conexión y las consultas
    $consulta_verificacion->close();
    $consulta->close();
    $conexion->close();
} else {
    // Si no se han enviado datos por POST, redirige a la página de inicio
    header("Location: index.php");
}
?>
