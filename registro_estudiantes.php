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

<div class="container mt-5">
    <h2>Registro de Estudiantes</h2>

    <?php
    // Verifica si hay parámetros en la URL
    if (isset($_GET['exito']) && $_GET['exito'] === 'registro_exitoso') {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Registro exitoso!',
                    text: 'El estudiante ha sido registrado correctamente.'
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

    if (isset($_GET['error']) && $_GET['error'] === 'registro_error') {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al registrar al estudiante. Por favor, inténtalo nuevamente.'
                });
             </script>";
    }
    ?>

    <form action="procesar_registro.php" method="post">
        <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
        </div>
        <div class="form-group">
            <label for="nombres">Nombres:</label>
            <input type="text" class="form-control" id="nombres" name="nombres" required>
        </div>
        <div class="form-group">
            <label for="cedula">Cédula:</label>
            <input type="text" class="form-control" id="cedula" name="cedula" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
