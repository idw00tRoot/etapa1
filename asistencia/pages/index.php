<?php
include('../includes/db.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Asistencia - Escuelas Deportivas</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script> <!-- Adding Font Awesome -->
    <script src="../assets/js/scripts.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">Escuelas Deportivas</a>
    </nav>
    <div class="container">
        <h1 class="mt-5">Gestión de Asistencia</h1>

        <!-- Select category -->
        <div class="category-select card">
            <div class="card-header">Selecciona una Categoría</div>
            <div class="card-body">
                <label for="category-select">Categorías:</label>
                <select id="category-select" class="form-control">
                    <option value="">Seleccione una categoría</option>
                    <?php
                    // Fetch categories
                    $stmt = $pdo->query("SELECT * FROM categorias");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Select series -->
        <div class="series-select card">
            <div class="card-header">Selecciona una Serie</div>
            <div class="card-body">
                <label for="series-select">Series:</label>
                <select id="series-select" class="form-control">
                    <option value="">Seleccione una serie</option>
                </select>
            </div>
        </div>

        <!-- Student list -->
        <div id="student-list" class="student-list card">
            <div class="card-header">Lista de Alumnos</div>
            <div class="card-body">
                <!-- Student data will be loaded here -->
            </div>
        </div>
    </div>
</body>
</html>
