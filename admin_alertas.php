<?php
include 'conexion.php';
include 'AlertaDAO.php';

// Crear instancia del DAO
$alertaDAO = new AlertaDAO($conexion);

// Obtener todas las alertas
$alertas = $alertaDAO->obtenerTodas();
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
        /* Estilos generales */
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

        /* Contenedor principal */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 2rem auto;
        }

        /* Estilos del formulario */
        form {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        form label {
            display: block;
            margin: 0.5rem 0 0.2rem;
            font-weight: bold;
        }

        form input, form textarea, form select {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }

        form button:hover {
            background-color: #0056b3;
        }

        /* Tabla de alertas */
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

        /* Footer */
        footer {
            background-color: #000;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
        }

        footer img {
            width: 30px;
            margin: 0 0.5rem;
        }

        footer p {
            margin: 0.5rem 0;
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
        <h1>Administrar Alertas</h1>

        <!-- Formulario para crear/editar alertas -->
        <form id="alertaForm" method="POST" action="procesar_alerta.php" enctype="multipart/form-data">
    <input type="hidden" name="id" id="alertaId" value="<?= isset($alerta['id']) ? $alerta['id'] : '' ?>">

    <label for="titulo">Título:</label>
    <input type="text" name="titulo" id="titulo" value="<?= isset($alerta['titulo']) ? $alerta['titulo'] : '' ?>" required>

    <label for="mensaje">Mensaje:</label>
    <textarea name="mensaje" id="mensaje" required><?= isset($alerta['mensaje']) ? $alerta['mensaje'] : '' ?></textarea>

    <label for="tipo">Tipo:</label>
    <select name="tipo" id="tipo">
        <option value="Advertencia" <?= isset($alerta['tipo']) && $alerta['tipo'] === 'Advertencia' ? 'selected' : '' ?>>Advertencia</option>
        <option value="Información" <?= isset($alerta['tipo']) && $alerta['tipo'] === 'Información' ? 'selected' : '' ?>>Información</option>
    </select>

    <label for="imagen">Imagen (opcional):</label>
    <input type="file" name="imagen" id="imagen" accept="image/*">

    <!-- Si estamos editando una alerta y tiene imagen, mostrar una vista previa -->
    <?php if (isset($alerta['imagen']) && $alerta['imagen']): ?>
        <p>Imagen actual:</p>
        <img src="<?= $alerta['imagen'] ?>" alt="Imagen de la alerta" style="max-width: 200px;">
    <?php endif; ?>

    <button type="submit">Guardar Alerta</button>
</form>

        <!-- Tabla de alertas -->
        <h2>Alertas Existentes</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Mensaje</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alertas as $alerta): ?>
                    <tr>
                        <td><?= $alerta['id'] ?></td>
                        <td><?= $alerta['titulo'] ?></td>
                        <td><?= $alerta['mensaje'] ?></td>
                        <td><?= $alerta['tipo'] ?></td>
                        <td><?= $alerta['fecha'] ?></td>
                        <td><?= $alerta['imagen'] ?></td>
                        <td>
                            <a href="editar_alerta.php?id=<?= $alerta['id'] ?>">Editar</a> |
                            <a href="procesar_alerta.php?delete=<?= $alerta['id'] ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
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
                    <a href="#" class="icon" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="icon" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="icon" aria-label="TikTok">
                        <i class="bi bi-tiktok"></i>
                    </a>
                </div>
                <p class="copyright">Copyright © 2024 CLIMATico. Todos los derechos reservados.</p>
            </div>
        </footer>
</body>
</html>
