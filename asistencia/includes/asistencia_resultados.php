<?php
include 'db.php';

$categoria = $_GET['categoria'];
$serie = $_GET['serie'];
$rama = $_GET['rama'];

// Consulta para obtener asistencia filtrada
$query = "SELECT a.fecha, al.nombre AS alumno, c.nombre AS categoria, c.serie, c.rama, a.presente 
          FROM asistencia a 
          JOIN alumnos al ON a.alumno_id = al.id 
          JOIN categorias c ON a.categoria_id = c.id 
          WHERE c.nombre = :categoria AND c.serie = :serie AND c.rama = :rama";
$stmt = $conn->prepare($query);
$stmt->bindParam(':categoria', $categoria);
$stmt->bindParam(':serie', $serie);
$stmt->bindParam(':rama', $rama);
$stmt->execute();
$asistencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Asistencia</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Resultados de Asistencia</h1>

    <table border="1">
        <tr>
            <th>Fecha</th>
            <th>Alumno</th>
            <th>Categoría</th>
            <th>Serie</th>
            <th>Rama</th>
            <th>Presente</th>
        </tr>
        <?php foreach ($asistencias as $asistencia): ?>
            <tr>
                <td><?php echo $asistencia['fecha']; ?></td>
                <td><?php echo $asistencia['alumno']; ?></td>
                <td><?php echo $asistencia['categoria']; ?></td>
                <td><?php echo $asistencia['serie']; ?></td>
                <td><?php echo $asistencia['rama']; ?></td>
                <td><?php echo $asistencia['presente'] ? 'Sí' : 'No'; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
