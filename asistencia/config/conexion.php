
<?php
$servername = "localhost"; // Cambia esto si es necesario
$username = "root";   // Reemplaza con tu usuario de base de datos
$password = "toto123"; // Reemplaza con tu contraseña de base de datos
$dbname = "asistencia";    // Reemplaza con el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
