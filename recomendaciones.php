<?php
// Incluye la conexión a la base de datos
include 'conexion.php'; // Archivo con $conexion

// Consulta para obtener las recomendaciones
$sql = "SELECT titulo, contenido, imagen FROM recomendaciones";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClimaTico - Alertas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="alertas.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="logoPagina.png" alt="CLIMAtico logo">
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Buscar" class="search-input">
                <button class="search-button"><i class="bi bi-search"></i></button>
            </div>            
            <div class="user-cart">
            <a href="registro.html"><i class="bi bi-person-circle"></i></a>
            </div>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="index.html">Inicio</a></li>
            <li><a href="noticias.php">Noticias</a></li>
            <li><a href="recomendaciones.html">Recomendaciones</a></li>
            <li><a href="alertas.php">Alertas</a></li>
            <li><a href="publicaciones.php">Comunidad</a></li>
        </ul>
    </nav>
    <p>&nbsp;&nbsp;&nbsp;</p>

    <!-- Banner de Recomendaciones -->
    <section class="news-banner">
        <h1>Recomendaciones</h1>
    </section>

    <!-- Recomendaciones Dinámicas -->
    <section class="container my-5">
        <div class="row">
            <?php
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '    <div class="card h-100 shadow-sm">';
                    if (!empty($fila['imagen'])) {
                        echo '        <img src="' . htmlspecialchars($fila['imagen']) . '" class="card-img-top" alt="' . htmlspecialchars($fila['titulo']) . '">';
                    } else {
                        echo '        <img src="placeholder.jpg" class="card-img-top" alt="Imagen no disponible">';
                    }
                    echo '        <div class="card-body">';
                    echo '            <h5 class="card-title">' . htmlspecialchars($fila['titulo']) . '</h5>';
                    echo '            <p class="card-text">' . htmlspecialchars($fila['contenido']) . '</p>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-12">';
                echo '    <p class="text-center">No hay recomendaciones disponibles en este momento.</p>';
                echo '</div>';
            }
            ?>
        </div>
    </section>

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
            <p class="copyright">Copyright © 2024 CLIMAtico. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
