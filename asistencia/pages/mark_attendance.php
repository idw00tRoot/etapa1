<?php
include('../includes/db.php');
$student_id = $_POST['student_id'];
$status = $_POST['status'];

// Mark attendance
$stmt = $pdo->prepare("INSERT INTO asistencias (student_id, status, fecha) VALUES (?, ?, CURDATE())");
$stmt->execute([$student_id, $status]);

echo json_encode(['success' => true]);
?>