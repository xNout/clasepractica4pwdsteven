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

<?php

    if (isset($_GET['error']) && $_GET['error'] === 'no_sesion_iniciada') {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Debes iniciar sesión primero.'
                });
            </script>";
    }
    // Verifica si hay parámetros en la URL
    if (isset($_GET['error']) && $_GET['error'] === 'campos_vacios') {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Todos los campos son obligatorios. Por favor, completa el formulario.'
                });
             </script>";
    }

    if (isset($_GET['error']) && $_GET['error'] === 'credenciales_invalidas') {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Credenciales incorrectas. Verifica tu correo y cédula e intenta nuevamente.'
                });
             </script>";
    }

    if (isset($_GET['exito']) && $_GET['exito'] === 'inicio_exitoso') {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Inicio de sesión exitoso!',
                    text: 'Has iniciado sesión correctamente.'
                });
             </script>";
    }

    if (isset($_GET['exito']) && $_GET['exito'] === 'cierre_sesion_exitoso') {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Informacion',
                    text: 'Has cerrado sesión'
                });
             </script>";
    }
    ?>

<div class="container mt-5">
    <h2>Iniciar Sesión</h2>
    <form action="procesar_login.php" method="post">
        <div class="form-group">
            <label for="usuario">Usuario:</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required>
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña (Cedula):</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
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
