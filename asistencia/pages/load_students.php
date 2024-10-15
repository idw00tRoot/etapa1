<?php
include('../includes/db.php');
$series_id = $_POST['series_id'];

// Get students for the selected series
$stmt = $pdo->prepare("SELECT * FROM alumnos WHERE series_id = ?");
$stmt->execute([$series_id]);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<table class="table table-bordered"><thead><tr><th>Nombre</th><th>Acción</th></tr></thead><tbody>';
foreach ($students as $student) {
    echo '<tr>';
    echo '<td>' . $student['nombre'] . '</td>';
    echo '<td>';
    echo '<button class="btn btn-success attendance-btn" data-id="' . $student['id'] . '" data-status="1"><i class="fa fa-check"></i> Presente</button>';
    echo '<button class="btn btn-danger attendance-btn" data-id="' . $student['id'] . '" data-status="0"><i class="fa fa-times"></i> Ausente</button>';
    echo '</td>';
    echo '</tr>';
}
echo '</tbody></table>';
?>