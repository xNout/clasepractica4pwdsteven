<?php
// Verifica si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $correo = $_POST["usuario"];
    $cedula = $_POST["contrasena"];

    // Validación básica (puedes mejorarla según tus necesidades)
    if (empty($correo) || empty($cedula)) {
        // Si hay campos vacíos, redirige con un mensaje de error
        header("Location: iniciar_sesion.php?error=campos_vacios");
        exit();
    }

    // Conexión a la base de datos (ajusta los detalles de conexión según tu entorno)
    $conexion = new mysqli("localhost:3307", "root", "admin", "clasepractica4");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta para verificar las credenciales del usuario
    $consulta = $conexion->prepare("SELECT id_estudiante FROM estudiantes WHERE email = ? AND cedula = ?");
    $consulta->bind_param("ss", $correo, $cedula);
    $consulta->execute();
    $consulta->store_result();

    // Verifica si se encontró un usuario con las credenciales proporcionadas
    if ($consulta->num_rows > 0) {

        $consulta->bind_result($id_estudiante);
        $consulta->fetch();
        // Inicio de sesión exitoso, redirige a la página principal o realiza alguna acción adicional
        session_start();
        $_SESSION["id_estudiante"] = $id_estudiante;  // Puedes almacenar más información del usuario en la sesión si es necesario
        header("Location: pagina_principal.php");
        exit();
    } else {
        // Credenciales incorrectas, redirige con un mensaje de error
        header("Location: iniciar_sesion.php?error=credenciales_invalidas");
        exit();
    }

    // Cierra la conexión y la consulta
    $consulta->close();
    $conexion->close();
} else {
    // Si no se han enviado datos por POST, redirige a la página de inicio de sesión
    header("Location: index.php");
}
?>
