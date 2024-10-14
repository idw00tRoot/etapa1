<?php
// Incluye el archivo de configuración de la base de datos
require_once 'db.php';

// Consulta para obtener la asistencia
$query = "SELECT a.fecha, a.presente, al.nombre AS alumno, c.nombre AS categoria, c.serie, p.nombre AS profesor 
          FROM asistencia a 
          JOIN alumnos al ON a.alumno_id = al.id 
          JOIN categorias c ON a.categoria_id = c.id 
          JOIN profesores p ON c.id = p.id 
          ORDER BY a.fecha DESC";

$stmt = $conn->prepare($query);
$stmt->execute();
$asistencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Asistencia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Registro de Asistencia</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Alumno</th>
                    <th>Categoría</th>
                    <th>Serie</th>
                    <th>Presente</th>
                    <th>Profesor</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($asistencias)): ?>
                    <?php foreach ($asistencias as $asistencia): ?>
                        <tr>
                            <td><?php echo $asistencia['fecha']; ?></td>
                            <td><?php echo $asistencia['alumno']; ?></td>
                            <td><?php echo $asistencia['categoria']; ?></td>
                            <td><?php echo $asistencia['serie']; ?></td>
                            <td><?php echo $asistencia['presente'] ? 'Sí' : 'No'; ?></td>
                            <td><?php echo $asistencia['profesor']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No hay registros de asistencia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
