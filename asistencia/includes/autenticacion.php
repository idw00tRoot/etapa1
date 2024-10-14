<?php
$host = "localhost"; // Cambia esto según tu configuración
$db_name = "asistencia"; // Nombre de tu base de datos
$username = "root"; // Tu nombre de usuario de la base de datos
$password = "toto123"; // Tu contraseña de la base de datos

try {
    // Establecer conexión a la base de datos usando PDO
    $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Manejo de errores
    echo "Conexión fallida: " . $e->getMessage();
}
