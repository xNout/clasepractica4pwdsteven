<?php

session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION["id_estudiante"])) {
    // Si no hay sesión activa, redirige a la página de inicio de sesión
    header("Location: iniciar_sesion.php?error=no_sesion_iniciada");
    exit();
}

// Recupera el ID del estudiante desde la sesión
$id_estudiante = $_SESSION["id_estudiante"];

// Aquí puedes realizar consultas a la base de datos para obtener las notas del estudiante según su ID
// Ajusta los detalles de conexión y consulta según tu entorno y estructura de la base de datos

// Supongamos que tienes una tabla llamada 'notas' con campos 'id_estudiante', 'nota_teoria' y 'nota_practica'
// Realiza la consulta para obtener las notas del estudiante actual
$conexion = new mysqli("localhost:3307", "root", "admin", "clasepractica4");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$consulta_notas = $conexion->prepare("SELECT m.nombre_asignatura, n.nota_teoria, n.nota_practica
                                      FROM notas n
                                      INNER JOIN asignaturas m ON n.id_asignatura = m.id_asignatura
                                      WHERE n.id_estudiante = ?");
$consulta_notas->bind_param("i", $id_estudiante);
$consulta_notas->execute();
$consulta_notas->bind_result($nombre_asignatura, $nota_teoria, $nota_practica);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Bienvenido a tu Página Principal</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Materia</th>
                <th>Nota de Teoría</th>
                <th>Nota de Práctica</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Muestra las notas del estudiante en una tabla
            while ($consulta_notas->fetch()) {
                echo "<tr>
                        <td>$nombre_asignatura</td>
                        <td>$nota_teoria</td>
                        <td>$nota_practica</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="cerrar_sesion.php" class="btn btn-primary">Cerrar Sesión</a>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
