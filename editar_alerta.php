<?php
include 'conexion.php';
include 'AlertaDAO.php';

// Crear instancia del DAO
$alertaDAO = new AlertaDAO($conexion);

// Verificar que el ID de la alerta sea válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $alerta = $alertaDAO->obtenerPorId($id);

    if (!$alerta) {
        echo "Alerta no encontrada.";
        exit();
    }
} else {
    echo "ID de alerta inválido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alerta</title>
    <!-- Enlace a Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Íconos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
        }
        .btn-primary {
            width: 100%;
            margin-top: 20px;
        }
        .back-link {
            text-align: center;
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        #preview {
            display: block;
            margin: 15px auto;
            max-width: 100%;
            max-height: 200px;
            border: 1px dashed #ccc;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="bi bi-pencil-square"></i> Editar Alerta</h1>
        <form id="editarAlertaForm" method="POST" action="procesar_alerta.php" enctype="multipart/form-data">
            <!-- Campo oculto ID -->
            <input type="hidden" name="id" value="<?= $alerta['id'] ?>">

            <!-- Título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="<?= htmlspecialchars($alerta['titulo']) ?>" required>
            </div>

            <!-- Mensaje -->
            <div class="mb-3">
                <label for="mensaje" class="form-label">Mensaje:</label>
                <textarea name="mensaje" id="mensaje" class="form-control" rows="4" required><?= htmlspecialchars($alerta['mensaje']) ?></textarea>
            </div>

            <!-- Tipo de alerta -->
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo:</label>
                <select name="tipo" id="tipo" class="form-select">
                    <option value="Advertencia" <?= $alerta['tipo'] === 'Advertencia' ? 'selected' : '' ?>>Advertencia</option>
                    <option value="Información" <?= $alerta['tipo'] === 'Información' ? 'selected' : '' ?>>Información</option>
                </select>
            </div>

            <!-- Subir imagen -->
            <div class="mb-3">
                <label for="imagen" class="form-label">Subir Imagen:</label>
                <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*" onchange="mostrarVistaPrevia()">
                <img id="preview" src="#" alt="Vista previa de la imagen" style="display: none;">
            </div>

            <!-- Botón de envío -->
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Actualizar Alerta</button>
        </form>

        <!-- Enlace para volver -->
        <a href="admin_alertas.php" class="back-link"><i class="bi bi-arrow-left-circle"></i> Volver a la lista de alertas</a>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Script para vista previa de la imagen -->
    <script>
        function mostrarVistaPrevia() {
            const input = document.getElementById('imagen');
            const preview = document.getElementById('preview');

            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = "none";
            }
        }
    </script>
</body>
</html>
