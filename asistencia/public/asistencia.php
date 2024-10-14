<?php
include('../config/conexion.php'); // Asegúrate de que la ruta sea correcta
include('../header.php'); // Asegúrate de que la ruta sea correcta

// Función para registrar asistencia
function registrarAsistencia($conn, $idEstudiante, $fecha) {
    $sql = "INSERT INTO asistencia (id_estudiante, fecha) VALUES (?, ?)";
    
    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    
    // Vincular los parámetros
    $stmt->bind_param('is', $idEstudiante, $fecha); // 'i' para entero, 's' para string

    return $stmt->execute(); // Ejecutar la consulta
}

// Manejo de la solicitud
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idEstudiante = $_POST['idEstudiante'];
    $fecha = $_POST['fecha'];

    // Validar entrada
    if (empty($idEstudiante) || empty($fecha)) {
        $mensaje = "Todos los campos son requeridos.";
    } else {
        if (registrarAsistencia($conn, $idEstudiante, $fecha)) {
            $mensaje = "Asistencia registrada correctamente.";
        } else {
            $mensaje = "Error al registrar asistencia.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Color de fondo suave */
        }
        .container {
            margin-top: 50px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #343a40; /* Color del texto */
        }
        .btn-primary {
            background-color: #007bff; /* Color del botón */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registro de Asistencia</h1>
        <?php if (isset($mensaje)) echo "<div class='alert alert-info'>$mensaje</div>"; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="idEstudiante">ID Estudiante:</label>
                <input type="number" class="form-control" id="idEstudiante" name="idEstudiante" required>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
        </form>
    </div>
    <?php include('../footer.php'); // Asegúrate de que la ruta sea correcta ?>
</body>
</html>
