<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Calificaciones</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
        }

        .card {
            margin-top: 30px;
            border: 1px solid #007bff;
        }

        .card-title {
            color: #007bff;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1>Bienvenido al Sistema de Calificaciones</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Acciones</h5>
            <ul>
                <li><a href="registro_estudiantes.php">Registro de Estudiantes</a></li>
                <li><a href="asignacion_lugares.php">Asignación de Estudiantes a Lugares Educativos</a></li>
                <li><a href="ingreso_notas.php">Ingreso de Notas</a></li>
                <li><a href="iniciar_sesion.php">Iniciar Sesión</a> (para estudiantes)</li>
            </ul>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
