<?php
// Incluye la conexión a la base de datos
include 'conexion.php'; // Asegúrate de tener un archivo conexion.php que conecte a la base de datos

// Consulta las alertas desde la base de datos
$sql = "SELECT titulo, mensaje, imagen FROM alerts";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClimaTico - Alertas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
            <li><a href="recomendaciones.php">Recomendaciones</a></li>
            <li><a href="alertas.php">Alertas</a></li>
            <li><a href="publicaciones.php">Comunidad</a></li>
        </ul>
    </nav>
    <p>&nbsp;&nbsp;&nbsp;</p>

    <section class="news-banner">
        <h1>Alertas</h1>
    </section>

    <section class="news">
        <?php
        // Mostrar las alertas dinámicamente
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo '<div class="news-item">';
                echo '<img src="' . htmlspecialchars($fila['imagen']) . '" alt="Alerta">';
                echo '<p>' . htmlspecialchars($fila['mensaje']) . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No hay alertas disponibles.</p>';
        }
        ?>
    </section>

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
