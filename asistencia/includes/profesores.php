<?php
require 'db.php';

// Función para registrar un nuevo profesor
function registrarProfesor($nombre) {
    global $conn;
    $sql = "INSERT INTO profesores (nombre) VALUES (:nombre)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->execute();
}

// Función para obtener todos los profesores
function obtenerProfesores() {
    global $conn;
    $sql = "SELECT * FROM profesores";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener un profesor por ID
function obtenerProfesor($id) {
    global $conn;
    $sql = "SELECT * FROM profesores WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Función para actualizar un profesor
function actualizarProfesor($id, $nombre) {
    global $conn;
    $sql = "UPDATE profesores SET nombre = :nombre WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->execute();
}

// Función para eliminar un profesor
function eliminarProfesor($id) {
    global $conn;
    $sql = "DELETE FROM profesores WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
?>
