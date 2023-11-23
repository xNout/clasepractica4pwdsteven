<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso de Notas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>

<!-- Agrega esta sección después del formulario de ingreso de notas -->

<div class="container mt-5">
    <h2>Ingreso de Notas</h2>

    <?php
    // Verifica si hay parámetros en la URL
    if (isset($_GET['exito']) && $_GET['exito'] === 'ingreso_exitoso') {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Ingreso de notas exitoso!',
                    text: 'Las notas han sido registradas correctamente.'
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

    if (isset($_GET['error']) && $_GET['error'] === 'ingreso_error') {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al ingresar las notas. Por favor, inténtalo nuevamente.'
                });
             </script>";
    }
    ?>

    <form action="procesar_ingreso_notas.php" method="post" onsubmit="return validarFormulario();">
        <div class="form-group">
            <label for="estudiante">Estudiante:</label>
            <select class="form-control" id="estudiante" name="estudiante" required>
                <?php
                // Código PHP para cargar la lista de estudiantes desde la base de datos
                $conexion = new mysqli("localhost:3307", "root", "admin", "clasepractica4");

                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }

                $consulta_estudiantes = "SELECT id_estudiante, CONCAT(apellidos, ', ', nombres) AS nombre_completo FROM estudiantes";
                $result_estudiantes = $conexion->query($consulta_estudiantes);

                while ($row = $result_estudiantes->fetch_assoc()) {
                    echo "<option value='" . $row['id_estudiante'] . "'>" . $row['nombre_completo'] . "</option>";
                }

                $conexion->close();
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="asignatura">Asignatura:</label>
            <select class="form-control" id="asignatura" name="asignatura" required>
                <?php
                // Código PHP para cargar la lista de asignaturas desde la base de datos
                $conexion = new mysqli("localhost:3307", "root", "admin", "clasepractica4");

                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }

                $consulta_asignaturas = "SELECT id_asignatura, nombre_asignatura FROM asignaturas";
                $result_asignaturas = $conexion->query($consulta_asignaturas);

                while ($row = $result_asignaturas->fetch_assoc()) {
                    echo "<option value='" . $row['id_asignatura'] . "'>" . $row['nombre_asignatura'] . "</option>";
                }

                $conexion->close();
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="nota_teoria">Nota de Teoría:</label>
            <input type="number" class="form-control" id="nota_teoria" name="nota_teoria" min="0" max="20" step="0.1" required>
        </div>

        <div class="form-group">
            <label for="nota_practica">Nota de Práctica:</label>
            <input type="number" class="form-control" id="nota_practica" name="nota_practica" min="0" max="20" step="0.1" required>
        </div>

        <button type="submit" class="btn btn-primary">Ingresar Notas</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
function validarFormulario() {
    // Puedes agregar lógica de validación adicional aquí si es necesario
    return true; // Retorna true para permitir el envío del formulario
}
</script>

</body>
</html>
