<?php
require_once '../config/config.php'; // Asegúrate de que la conexión esté bien configurada

// Conexión a la base de datos
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para obtener la lista de asistencia de los alumnos
$sql = "SELECT a.id AS alumno_id, a.nombre AS alumno_nombre, c.nombre AS categoria_nombre, 
        c.tipo_deporte, c.rama, ca.presente, ca.fecha_asistencia 
        FROM alumnos a
        JOIN categorias_alumnos ca ON a.id = ca.alumno_id
        JOIN categorias c ON ca.categoria_id = c.id";

$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<thead><tr>
            <th>ID Alumno</th>
            <th>Nombre Alumno</th>
            <th>Categoría</th>
            <th>Deporte</th>
            <th>Rama</th>
            <th>Presente</th>
            <th>Fecha de Asistencia</th>
          </tr></thead>";
    echo "<tbody>";
    
    // Recorrer los resultados y mostrarlos en la tabla
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['alumno_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['alumno_nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['categoria_nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tipo_deporte']) . "</td>";
        echo "<td>" . htmlspecialchars($row['rama']) . "</td>";
        echo "<td>" . ($row['presente'] ? 'Sí' : 'No') . "</td>";
        echo "<td>" . htmlspecialchars($row['fecha_asistencia']) . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "No se encontraron registros de asistencia.";
}

$conn->close();
?>
