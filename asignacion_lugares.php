<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Estudiantes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>
<!-- Agrega esta sección después del formulario de registro -->

<div class="container mt-5">
    <h2>Asignación de Estudiantes a Lugares Educativos</h2>

    <?php
    // Verifica si hay parámetros en la URL
    if (isset($_GET['exito']) && $_GET['exito'] === 'asignacion_exitosa') {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Asignación exitosa!',
                    text: 'El estudiante ha sido asignado correctamente al lugar educativo.'
                });
             </script>";
    }

    if (isset($_GET['error']) && $_GET['error'] === 'campos_vacios') {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Todos los campos son obligatorios. Por favor, completa el formulario.'
                });
             </script>";
    }

    if (isset($_GET['error']) && $_GET['error'] === 'ya_asignado') {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El estudiante ya fue asignado a un lugar educativo'
                });
             </script>";
    }


    if (isset($_GET['error']) && $_GET['error'] === 'asignacion_error') {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al asignar al estudiante. Por favor, inténtalo nuevamente.'
                });
             </script>";
    }
    ?>

    <form action="procesar_asignacion.php" method="post">
        <div class="form-group">
            <label for="estudiante">Estudiante:</label>
            <select class="form-control" id="estudiante" name="estudiante" required>
                <?php
                // Conexión a la base de datos (ajusta los detalles de conexión según tu entorno)
                $conexion = new mysqli("localhost:3307", "root", "admin", "clasepractica4");

                // Verifica la conexión
                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }

                // Consulta para obtener la lista de estudiantes desde la base de datos
                $consulta_estudiantes = "SELECT id_estudiante, CONCAT(apellidos, ', ', nombres) AS nombre_completo FROM estudiantes";
                $result_estudiantes = $conexion->query($consulta_estudiantes);

                // Muestra opciones del menú desplegable con los estudiantes
                while ($row = $result_estudiantes->fetch_assoc()) {
                    echo "<option value='" . $row['id_estudiante'] . "'>" . $row['nombre_completo'] . "</option>";
                }

                // Cierra la conexión
                $conexion->close();
                ?>
            </select>
        </div>
        <!-- Agrega esta sección después del menú desplegable de estudiantes -->

        <div class="form-group">
            <label for="lugar">Lugar Educativo:</label>
            <select class="form-control" id="lugar" name="lugar" required>
                <?php
                // Conexión a la base de datos (ajusta los detalles de conexión según tu entorno)
                $conexion = new mysqli("localhost:3307", "root", "admin", "clasepractica4");

                // Verifica la conexión
                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }

                // Consulta para obtener la lista de lugares educativos desde la base de datos
                $consulta_lugares = "SELECT id_lugar, nombre_lugar FROM lugares_educativos";
                $result_lugares = $conexion->query($consulta_lugares);

                // Muestra opciones del menú desplegable con los lugares educativos
                while ($row = $result_lugares->fetch_assoc()) {
                    echo "<option value='" . $row['id_lugar'] . "'>" . $row['nombre_lugar'] . "</option>";
                }

                // Cierra la conexión
                $conexion->close();
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Asignar</button>
    </form>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
