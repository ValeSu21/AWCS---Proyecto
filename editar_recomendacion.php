<?php
include 'conexion.php';
include 'recomendacionDAO.php';

$recomendacionDAO = new recomendacionDAO($conexion);

$id = isset($_GET['id']) ? intval($_GET['id']) : null;
$recomendacion = null;

if ($id) {
    $recomendacion = $recomendacionDAO->obtenerPorId($id);
}

$esEditar = $recomendacion !== null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $esEditar ? 'Editar Recomendación' : 'Crear Recomendación'; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="admin.css"> <!-- Archivo de personalización adicional -->
</head>
<body>
    <!-- Header -->
    <header class="bg-dark text-white py-3 mb-4">
        <div class="container text-center">
            <h1 class="mb-0"><?php echo $esEditar ? 'Editar Recomendación' : 'Crear Recomendación'; ?></h1>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="container">
        <div class="card shadow p-4">
            <form action="procesar_recomendacion.php" method="POST" enctype="multipart/form-data">
                <!-- Tipo de acción -->
                <input type="hidden" name="accion" value="<?php echo $esEditar ? 'editar' : 'crear'; ?>">
                <?php if ($esEditar): ?>
                    <input type="hidden" name="id" value="<?php echo $recomendacion['id']; ?>">
                <?php endif; ?>

                <!-- Campo: Título -->
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" 
                           value="<?php echo $esEditar ? htmlspecialchars($recomendacion['titulo']) : ''; ?>" required>
                </div>

                <!-- Campo: Contenido -->
                <div class="mb-3">
                    <label for="contenido" class="form-label">Contenido:</label>
                    <textarea class="form-control" id="contenido" name="contenido" rows="5" required><?php echo $esEditar ? htmlspecialchars($recomendacion['contenido']) : ''; ?></textarea>
                </div>

                <!-- Campo: Imagen -->
                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen:</label>
                    <input type="file" class="form-control" id="imagen" name="imagen" <?php echo !$esEditar ? 'required' : ''; ?>>
                </div>

                <!-- Mostrar imagen actual si existe -->
                <?php if ($esEditar && !empty($recomendacion['imagen'])): ?>
                    <div class="mb-3">
                        <p>Imagen actual:</p>
                        <img src="<?php echo $recomendacion['imagen']; ?>" alt="Imagen actual" class="img-thumbnail" width="200">
                    </div>
                <?php endif; ?>

                <!-- Botón de envío -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> <?php echo $esEditar ? 'Guardar Cambios' : 'Crear Recomendación'; ?>
                    </button>
                    <a href="admin_recomendacion.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-3 mt-4">
        <div class="container text-center">
            <p class="mb-0">© 2024 CLIMAtico. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
