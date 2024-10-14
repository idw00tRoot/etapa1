<?php
require 'db.php';

// Función para registrar asistencia
function registrarAsistencia($alumno_id, $categoria_id, $fecha, $presente) {
    global $conn;
    $sql = "INSERT INTO asistencias (alumno_id, categoria_id, fecha, presente) VALUES (:alumno_id, :categoria_id, :fecha, :presente)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':alumno_id', $alumno_id);
    $stmt->bindParam(':categoria_id', $categoria_id);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':presente', $presente);
    $stmt->execute();
}

// Función para obtener la asistencia de un alumno en una categoría
function obtenerAsistencia($alumno_id, $categoria_id) {
    global $conn;
    $sql = "SELECT * FROM asistencias WHERE alumno_id = :alumno_id AND categoria_id = :categoria_id ORDER BY fecha DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':alumno_id', $alumno_id);
    $stmt->bindParam(':categoria_id', $categoria_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener todas las asistencias de un alumno
function obtenerTodasLasAsistencias($alumno_id) {
    global $conn;
    $sql = "SELECT a.*, c.nombre AS categoria_nombre FROM asistencias a 
            JOIN categorias c ON a.categoria_id = c.id 
            WHERE a.alumno_id = :alumno_id ORDER BY a.fecha DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':alumno_id', $alumno_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener todas las asistencias por categoría
function obtenerAsistenciasPorCategoria($categoria_id) {
    global $conn;
    $sql = "SELECT a.*, al.nombre AS alumno_nombre FROM asistencias a 
            JOIN alumnos al ON a.alumno_id = al.id 
            WHERE a.categoria_id = :categoria_id ORDER BY a.fecha DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':categoria_id', $categoria_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para eliminar un registro de asistencia
function eliminarAsistencia($id) {
    global $conn;
    $sql = "DELETE FROM asistencias WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
?>
