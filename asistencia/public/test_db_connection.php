<?php
// Configuración de la conexión
$servername = "localhost";
$username = "root"; // Cambia si es necesario
$password = "toto123"; // Contraseña actualizada
$database = "asistencia"; // Nombre de la base de datos

// Inicializar variables
$status = "";
$button_class = "";

// Crear conexión
try {
    $conn = new mysqli($servername, $username, $password, $database);
    // Comprobar conexión
    if ($conn->connect_error) {
        throw new Exception("Error de conexión: " . $conn->connect_error);
    } else {
        $status = "Conexión exitosa a la base de datos " . $database;
        $button_class = "success"; // Verde
    }
} catch (Exception $e) {
    $status = $e->getMessage(); // Capturar el mensaje de error
    $button_class = "error"; // Rojo
} finally {
    // Cerrar la conexión si fue exitosa
    if (isset($conn) && $conn->ping()) {
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de Conexión a MySQL</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 50%; margin: 20px auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #f2f2f2; }
        .button { padding: 10px 15px; border: none; color: white; cursor: pointer; }
        .success { background-color: green; }
        .error { background-color: red; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Resultado de la Conexión a MySQL</h2>
    <table>
        <tr>
            <th>Estado</th>
            <th>Descripción</th>
        </tr>
        <tr>
            <td>
                <button class="button <?php echo $button_class; ?>">
                    <?php echo ($button_class === "error") ? "Error" : "Éxito"; ?>
                </button>
            </td>
            <td><?php echo $status; ?></td>
        </tr>
    </table>
</body>
</html>
