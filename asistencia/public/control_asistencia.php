<?php
require_once '../config/config.php'; // Asegúrate de que la ruta sea correcta

// La conexión ya se ha establecido en config.php, no necesitas crearla de nuevo

// Obtener las categorías
$sql_categorias = "SELECT * FROM categorias";
$result_categorias = $conn->query($sql_categorias);

// Obtener la fecha actual
$fecha_actual = date('Y-m-d');

// Manejar el envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoria_id = $_POST['categoria'];
    $fecha_asistencia = $_POST['fecha_asistencia'];
    $alumnos_presente = $_POST['presente'] ?? [];
    
    // Guardar la asistencia
    foreach ($alumnos_presente as $alumno_id) {
        $sql_insert = "INSERT INTO categorias_alumnos (alumno_id, categoria_id, presente, fecha_asistencia) 
                       VALUES (?, ?, 1, ?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param("iis", $alumno_id, $categoria_id, $fecha_asistencia);
        $stmt->execute();
    }
}

// Obtener alumnos para la categoría seleccionada
$alumnos = [];
if (isset($_POST['categoria'])) {
    $categoria_id = $_POST['categoria'];
    $sql_alumnos = "SELECT a.id, a.nombre FROM alumnos a 
                    JOIN categorias_alumnos ca ON a.id = ca.alumno_id 
                    WHERE ca.categoria_id = ?";
    $stmt = $conn->prepare($sql_alumnos);
    $stmt->bind_param("i", $categoria_id);
    $stmt->execute();
    $result_alumnos = $stmt->get_result();
    
    while ($row = $result_alumnos->fetch_assoc()) {
        $alumnos[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Control de Asistencia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Control de Asistencia</h1>
        <form method="POST">
            <div class="form-group">
                <label for="categoria">Seleccione Categoría:</label>
                <select name="categoria" id="categoria" class="form-control" onchange="this.form.submit()">
                    <option value="">Seleccione...</option>
                    <?php if ($result_categorias->num_rows > 0): ?>
                        <?php while ($row = $result_categorias->fetch_assoc()): ?>
                            <option value="<?= htmlspecialchars($row['id']) ?>"><?= htmlspecialchars($row['nombre']) ?></option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_asistencia">Fecha:</label>
                <input type="date" name="fecha_asistencia" class="form-control" value="<?= $fecha_actual ?>">
            </div>
            <h3>Alumnos:</h3>
            <div class="form-check">
                <?php foreach ($alumnos as $alumno): ?>
                    <input type="checkbox" class="form-check-input" name="presente[]" value="<?= htmlspecialchars($alumno['id']) ?>" id="alumno_<?= htmlspecialchars($alumno['id']) ?>">
                    <label class="form-check-label" for="alumno_<?= htmlspecialchars($alumno['id']) ?>"><?= htmlspecialchars($alumno['nombre']) ?></label><br>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
        </form>
    </div>
</body>
</html>
