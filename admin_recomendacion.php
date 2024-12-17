<?php
include 'conexion.php'; // Archivo de conexión a la base de datos
include 'recomendacionDAO.php';

$recomendacionDAO = new recomendacionDAO($conexion);

// Obtener todas las recomendaciones
$recomendaciones = $recomendacionDAO->obtenerTodas();

// Verificar si se solicitó eliminar una recomendación
if (isset($_GET['eliminar'])) {
    $idEliminar = intval($_GET['eliminar']);
    $recomendacionDAO->eliminar($idEliminar);

    // Redirigir para evitar reenvío del formulario
    header('Location: admin_recomendacion.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClimaTico</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="logoPagina.png" alt="CLIMAtico logo">
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Buscar">
                <button><i class="bi bi-search"></i></button>
            </div>
            <div class="user-cart">
                <i class="bi bi-person-circle"></i>
            </div>
        </div>
    </header>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 1rem 0;
        }

        header img {
            width: 120px;
        }

        nav {
            display: flex;
            justify-content: center;
            background-color: #007bff;
        }

        nav a {
            text-decoration: none;
            color: white;
            margin: 0 1rem;
            font-weight: bold;
        }

        h1, h2 {
            text-align: center;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 2rem auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 0.8rem;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        table a:hover {
            color: #0056b3;
        }

        footer {
            background-color: #000;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
    <nav>
        <ul>
            <li><a href="index.html">Inicio</a></li>
            <li><a href="crud_noticias.php">Noticias</a></li>
            <li><a href="admin_recomendacion.php">Recomendaciones</a></li>
            <li><a href="admin_alertas.php">Alertas</a></li>
            <li><a href="crud.php">Comunidad</a></li>
        </ul>
    </nav>
    </header>

    <!-- Contenedor principal -->
    <div class="container">
        <h1>Administrar Recomendaciones</h1>

        <!-- Botón para crear nueva recomendación -->
        <div class="d-flex justify-content-end mb-3">
            <a href="editar_recomendacion.php" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Crear Nueva Recomendación
            </a>
        </div>

        <!-- Tabla de recomendaciones -->
        <h2>Recomendaciones Existentes</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Contenido</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recomendaciones as $recomendacion): ?>
                    <tr>
                        <td><?= $recomendacion['id']; ?></td>
                        <td><?= htmlspecialchars($recomendacion['titulo']); ?></td>
                        <td><?= htmlspecialchars($recomendacion['contenido']); ?></td>
                        <td>
                            <?php if (!empty($recomendacion['imagen'])): ?>
                                <img src="<?= $recomendacion['imagen']; ?>" alt="Imagen" style="max-width: 100px;">
                            <?php else: ?>
                                Sin imagen
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="editar_recomendacion.php?id=<?= $recomendacion['id']; ?>">Editar</a> |
                            <a href="admin_recomendacion.php?eliminar=<?= $recomendacion['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta recomendación?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="social-icons">
                <a href="#" class="icon" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="icon" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="icon" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
            </div>
            <p class="copyright">Copyright © 2024 CLIMAtico. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
