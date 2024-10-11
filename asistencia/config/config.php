<?php
// config.php

$servername = "localhost";
$username = "root";
$password = "toto123";
$database = "asistencia";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Comprobar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
