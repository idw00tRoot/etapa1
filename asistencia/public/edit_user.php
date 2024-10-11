<?php
// Configuración de la conexión
$servername = "localhost";
$username = "root";
$password = "toto123";
$database = "asistencia";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Comprobar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del usuario
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Obtener el usuario
$sql = "SELECT * FROM usuarios WHERE id = $id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Actualizar usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $rol = $_POST['rol'];

    $update_sql = "UPDATE usuarios SET nombre = '$nombre', rol = '$rol' WHERE id = $id";
    if ($conn->query($update_sql) === TRUE) {
        header("Location: list_users.php");
        exit;
    } else {
        $error = "Error al actualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <style>
        body { font-family: Arial, sans-serif; }
        form { width: 40%; margin: auto; }
        input, select { width: 100%; padding: 10px; margin: 10px 0; }
        .button { padding: 10px; background-color: blue; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Editar Usuario</h2>
    <form method="POST" action="">
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <input type="text" name="nombre" value="<?php echo $user['nombre']; ?>" required>
        <select name="rol" required>
            <option value="Alumno" <?php echo $user['rol'] === 'Alumno' ? 'selected' : ''; ?>>Alumno</option>
            <option value="Profesor" <?php echo $user['rol'] === 'Profesor' ? 'selected' : ''; ?>>Profesor</option>
        </select>
        <button type="submit" class="button">Actualizar</button>
    </form>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
