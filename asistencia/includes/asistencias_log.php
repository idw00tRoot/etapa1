<?php
require 'db.php';

// Función para registrar un log de asistencia
function registrarLogAsistencia($accion, $alumno_id, $fecha) {
    global $conn;
    $sql = "INSERT INTO asistencia_logs (accion, alumno_id, fecha) VALUES (:accion, :alumno_id, :fecha)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':accion', $accion);
    $stmt->bindParam(':alumno_id', $alumno_id);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->execute();
}

// Función para obtener los logs de asistencia
function obtenerLogsAsistencia() {
    global $conn;
    $sql = "SELECT * FROM asistencia_logs ORDER BY fecha DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
