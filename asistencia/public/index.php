<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Explorer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 0.9rem;
        }
        #sidebar {
            height: 100vh;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse show">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <?php
                    // Directorios que se listarán
                    $directories = ['config', 'controllers', 'logs', 'models', 'public', 'uploads', 'views'];

                    // Genera enlaces para cada directorio
                    foreach ($directories as $dir) {
                        echo "<li class='nav-item'><a class='nav-link' href='?dir=$dir'>" . ucfirst($dir) . "</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </nav>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <h2 class="my-3">Archivos en el directorio seleccionado</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nombre del archivo</th>
                            <th>Tamaño</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Muestra archivos del directorio seleccionado
                        if (isset($_GET['dir'])) {
                            $dir = $_GET['dir'];
                            $path = __DIR__ . '/' . $dir;

                            echo "<tr><td colspan='3'><strong>Ruta evaluada: $path</strong></td></tr>"; // Depuración: muestra la ruta evaluada

                            if (is_dir($path)) {
                                $files = scandir($path);

                                // Verifica que se encontraron archivos en el directorio
                                if ($files !== false && count($files) > 2) { // Ignora '.' y '..'
                                    foreach ($files as $file) {
                                        if ($file != '.' && $file != '..') {
                                            $filePath = $path . '/' . $file;
                                            if (is_file($filePath)) {
                                                echo "<tr>
                                                        <td>$file</td>
                                                        <td>" . filesize($filePath) . " bytes</td>
                                                        <td><a href='$dir/$file' target='_blank' class='btn btn-sm btn-primary'>Abrir</a></td>
                                                      </tr>";
                                            } else {
                                                echo "<tr><td colspan='3'><em>$file (no es un archivo válido)</em></td></tr>";
                                            }
                                        }
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>No se encontraron archivos en el directorio</td></tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>Directorio no válido: $dir</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>Selecciona un directorio para ver los archivos</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
