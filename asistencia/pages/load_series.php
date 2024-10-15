<?php
include('../includes/db.php');
$category_id = $_POST['category_id'];

// Get series for the selected category
$stmt = $pdo->prepare("SELECT * FROM series WHERE category_id = ?");
$stmt->execute([$category_id]);
$series = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<option value="">Seleccione una serie</option>';
foreach ($series as $serie) {
    echo '<option value="' . $serie['id'] . '">' . $serie['nombre'] . '</option>';
}
?>