<?php
// Verifica si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $id_estudiante = $_POST["estudiante"];
    $id_asignatura = $_POST["asignatura"];
    $nota_teoria = $_POST["nota_teoria"];
    $nota_practica = $_POST["nota_practica"];

    // Validación básica (puedes mejorarla según tus necesidades)
    if (empty($id_estudiante) || empty($id_asignatura) || empty($nota_teoria) || empty($nota_practica)) {
        // Si hay campos vacíos, redirige con un mensaje de error
        header("Location: ingreso_notas.php?error=campos_vacios");
        exit();
    }

    // Conexión a la base de datos (ajusta los detalles de conexión según tu entorno)
    $conexion = new mysqli("localhost:3307", "root", "admin", "clasepractica4");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Verifica si ya existe una nota para el estudiante y la asignatura seleccionados
    $consulta_verificacion = $conexion->prepare("SELECT id_nota FROM notas WHERE id_estudiante = ? AND id_asignatura = ?");
    $consulta_verificacion->bind_param("ii", $id_estudiante, $id_asignatura);
    $consulta_verificacion->execute();
    $consulta_verificacion->store_result();

    if ($consulta_verificacion->num_rows > 0) {
        // Ya existe una nota para el estudiante y asignatura seleccionados, redirige con un mensaje de error
        header("Location: ingreso_notas.php?error=nota_existente");
        exit();
    }

    // Consulta para insertar la nota en la base de datos
    $consulta = $conexion->prepare("INSERT INTO notas (id_estudiante, id_asignatura, nota_teoria, nota_practica) VALUES (?, ?, ?, ?)");
    $consulta->bind_param("iidd", $id_estudiante, $id_asignatura, $nota_teoria, $nota_practica);

    // Ejecuta la consulta
    if ($consulta->execute()) {
        // Ingreso de notas exitoso, redirige con un mensaje de éxito
        header("Location: ingreso_notas.php?exito=ingreso_exitoso");
        exit();
    } else {
        // Error al ingresar notas, redirige con un mensaje de error
        header("Location: ingreso_notas.php?error=ingreso_error");
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
