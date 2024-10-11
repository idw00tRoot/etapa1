<?php
require_once '../config/config.php';

// Configuración de paginación
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10; // Registros por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Número de página
$offset = ($page - 1) * $limit;

// Obtener el total de usuarios
$total_result = $conn->query("SELECT COUNT(*) AS total FROM usuarios");
$total_row = $total_result->fetch_assoc();
$total_users = $total_row['total'];
$total_pages = ceil($total_users / $limit);

// Obtener los usuarios
$sql = "SELECT u.*, GROUP_CONCAT(c.nombre) AS categorias 
        FROM usuarios u
        LEFT JOIN alumno_categoria ac ON u.id = ac.alumno_id
        LEFT JOIN categorias c ON ac.categoria_id = c.id
        GROUP BY u.id
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

// Actualizar usuario si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $id = $_POST['id'];
    if ($_POST['action'] === 'update') {
        $nombre = $_POST['nombre'];
        $rol = $_POST['rol'];

        $update_sql = "UPDATE usuarios SET nombre = '$nombre', rol = '$rol' WHERE id = $id";
        if ($conn->query($update_sql) === TRUE) {
            header("Location: list_users.php?limit=$limit&page=$page");
            exit;
        } else {
            $error = "Error al actualizar: " . $conn->error;
        }
    } elseif ($_POST['action'] === 'delete') {
        $delete_sql = "DELETE FROM usuarios WHERE id = $id";
        if ($conn->query($delete_sql) === TRUE) {
            header("Location: list_users.php?limit=$limit&page=$page");
            exit;
        } else {
            $error = "Error al eliminar: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { background-color: #f4f4f4; }
        .container { margin-top: 20px; }
        .card { margin-bottom: 15px; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Lista de Usuarios</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Usuario ID: <?php echo $row['id']; ?></h5>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="rol">Rol:</label>
                                <select class="form-control" name="rol" required>
                                    <option value="Alumno" <?php echo $row['rol'] === 'Alumno' ? 'selected' : ''; ?>>Alumno</option>
                                    <option value="Profesor" <?php echo $row['rol'] === 'Profesor' ? 'selected' : ''; ?>>Profesor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Categorías:</label>
                                <p><?php echo $row['categorias'] ? htmlspecialchars($row['categorias']) : 'Ninguna'; ?></p>
                            </div>
                            <button type="submit" name="action" value="update" class="btn btn-success">Actualizar</button>
                        </form>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="action" value="delete" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="alert alert-warning text-center">No hay usuarios registrados.</div>
        <?php endif; ?>

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php 
                $max_visible = 5; 
                $start = max(1, $page - floor($max_visible / 2)); 
                $end = min($total_pages, $start + $max_visible - 1); 

                if ($start > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?page=1&limit='.$limit.'">1</a></li>';
                    if ($start > 2) echo '<li class="page-item disabled"><span class="page-link">...</span></li>'; 
                }

                for ($i = $start; $i <= $end; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; 

                if ($end < $total_pages) {
                    if ($end < $total_pages - 1) echo '<li class="page-item disabled"><span class="page-link">...</span></li>'; 
                    echo '<li class="page-item"><a class="page-link" href="?page='.$total_pages.'&limit='.$limit.'">'.$total_pages.'</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
