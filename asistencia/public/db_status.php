<?php
require_once '../config/config.php';

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Registrar en un log
$log_file = '../logs/db_changes.log';

function logChange($message) {
    global $log_file;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$timestamp] $message" . PHP_EOL, FILE_APPEND);
}

// Obtener el total de usuarios
$total_result = $conn->query("SELECT COUNT(*) AS total FROM usuarios");
$total_row = $total_result->fetch_assoc();
$total_users = $total_row['total'];

// Estado de la conexión
$status = [
    'Conexión' => $conn->connect_error ? 'Fallida' : 'Exitosa',
    'Total de usuarios' => $total_users,
];

// Muestra el estado
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de la Conexión</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        h2 { text-align: center; }
        .container { width: 90%; margin: auto; }
        table { width: 100%; margin: 20px 0; border-collapse: collapse; background: white; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #4CAF50; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Estado de la Conexión a la Base de Datos</h2>
        <table>
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($status as $description => $value): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($description); ?></td>
                        <td><?php echo htmlspecialchars($value); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Registro de Cambios</h3>
        <pre><?php echo file_exists($log_file) ? file_get_contents($log_file) : 'No hay registros.'; ?></pre>
    </div>
</body>
</html>

<?php
$conn->close();
?>
