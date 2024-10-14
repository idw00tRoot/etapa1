<?php
require 'db.php';

// Función para agregar una nueva categoría
function agregarCategoria($nombre, $rama) {
    global $conn;
    $sql = "INSERT INTO categorias (nombre, rama) VALUES (:nombre, :rama)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':rama', $rama);
    $stmt->execute();
}

// Función para obtener todas las categorías
function obtenerCategorias() {
    global $conn;
    $sql = "SELECT * FROM categorias";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para eliminar una categoría
function eliminarCategoria($id) {
    global $conn;
    $sql = "DELETE FROM categorias WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
?>
