<?php
require 'db.php';

// Función para registrar un nuevo alumno
function registrarAlumno($nombre, $rut) {
    global $conn;
    $sql = "INSERT INTO alumnos (nombre, rut) VALUES (:nombre, :rut)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':rut', $rut);
    $stmt->execute();
}

// Función para obtener todos los alumnos
function obtenerAlumnos() {
    global $conn;
    $sql = "SELECT * FROM alumnos";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener un alumno por ID
function obtenerAlumno($id) {
    global $conn;
    $sql = "SELECT * FROM alumnos WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Función para actualizar un alumno
function actualizarAlumno($id, $nombre, $rut) {
    global $conn;
    $sql = "UPDATE alumnos SET nombre = :nombre, rut = :rut WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':rut', $rut);
    $stmt->execute();
}

// Función para eliminar un alumno
function eliminarAlumno($id) {
    global $conn;
    $sql = "DELETE FROM alumnos WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
?>
