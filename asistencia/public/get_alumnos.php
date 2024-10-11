<?php
// Conectar a la base de datos
require_once '../config/config.php'; // Usar conexión de la configuración

if (isset($_GET['categoria_id'])) {
    $categoria_id = (int)$_GET['categoria_id'];

    // Obtener los alumnos de la categoría seleccionada
    $alumnos_query = "SELECT a.id, a.nombre FROM alumnos a
                      JOIN categorias_alumnos ca ON a.id = ca.alumno_id
                      WHERE ca.categoria_id = ?";
    
    $stmt = $conn->prepare($alumnos_query);
    $stmt->bind_param("i", $categoria_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($alumno = $result->fetch_assoc()) {
        echo "<option value='" . $alumno['id'] . "'>" . htmlspecialchars($alumno['nombre']) . "</option>";
    }

    $stmt->close();
}

$conn->close();
?>
