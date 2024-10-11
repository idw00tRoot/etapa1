<?php
// Conectar a la base de datos
require_once '../config/config.php'; // Usar conexión de la configuración

// Validar y obtener los parámetros de la URL
if (isset($_GET['alumno_id']) && isset($_GET['categoria_id']) && isset($_GET['estado']) && isset($_GET['fecha'])) {
    $alumno_id = (int)$_GET['alumno_id']; // Convertir a entero para evitar inyecciones
    $categoria_id = (int)$_GET['categoria_id']; // Convertir a entero para evitar inyecciones
    $estado = $_GET['estado'];
    $fecha = $_GET['fecha']; // Obtenemos la fecha directamente

    // Validar estado
    if ($estado !== 'Presente' && $estado !== 'Ausente') {
        die("Estado de asistencia inválido.");
    }

    // Insertar el registro de asistencia
    $insert_query = "INSERT INTO asistencia (alumno_id, categoria_id, fecha, estado) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("iiss", $alumno_id, $categoria_id, $fecha, $estado);

    if ($stmt->execute()) {
        echo "Asistencia registrada correctamente.";
    } else {
        echo "Error al registrar la asistencia: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
} else {
    die("Parámetros inválidos.");
}

$conn->close();

// Redirigir de vuelta al control de asistencia
header("Location: control_asistencia.php");
exit();
?>
