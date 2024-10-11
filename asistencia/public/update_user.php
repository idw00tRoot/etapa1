<?php
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $rol = $_POST['rol'];

    // Actualizar el usuario
    $update_sql = "UPDATE usuarios SET nombre = '$nombre', rol = '$rol' WHERE id = $id";
    if ($conn->query($update_sql) === TRUE) {
        // Obtener las categorías del usuario actualizado
        $categorias_sql = "SELECT GROUP_CONCAT(c.nombre) AS categorias 
                           FROM alumno_categoria ac 
                           LEFT JOIN categorias c ON ac.categoria_id = c.id 
                           WHERE ac.alumno_id = $id";
        $categorias_result = $conn->query($categorias_sql);
        $categorias_row = $categorias_result->fetch_assoc();

        // Devolver datos actualizados como JSON
        echo json_encode([
            'changed' => true,
            'id' => $id,
            'nombre' => $nombre,
            'rol' => $rol,
            'categorias' => $categorias_row['categorias'] ?? 'Ninguna'
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['changed' => false, 'error' => 'Error al actualizar: ' . $conn->error]);
    }
}
$conn->close();
?>
