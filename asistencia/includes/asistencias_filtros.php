<?php
include 'db.php';

// Obtener categorías, series y ramas para los filtros
$query = "SELECT DISTINCT nombre, serie, rama FROM categorias";
$stmt = $conn->prepare($query);
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar Asistencia</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Filtrar Asistencia</h1>

    <form action="asistencia_resultados.php" method="GET">
        <label for="categoria">Categoría:</label>
        <select name="categoria" id="categoria">
            <?php foreach ($categorias as $cat): ?>
                <option value="<?php echo $cat['nombre']; ?>">
                    <?php echo $cat['nombre']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="serie">Serie:</label>
        <select name="serie" id="serie">
            <?php foreach ($categorias as $cat): ?>
                <option value="<?php echo $cat['serie']; ?>">
                    <?php echo $cat['serie']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="rama">Rama:</label>
        <select name="rama" id="rama">
            <option value="masculina">Masculina</option>
            <option value="femenina">Femenina</option>
        </select>

        <button type="submit">Filtrar</button>
    </form>
</body>
</html>
