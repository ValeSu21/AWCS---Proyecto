<?php
// Configuración de la conexión a la base de datos
$conexion = new mysqli("localhost", "valeria", "123456", "proyecto");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta SQL para obtener todas las noticias sin la descripción ni el nombre
$sql = "SELECT id, Titulo, Imagen, Fecha FROM noticias";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClimaTico - Noticias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="noticia.css">
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
                <i class="bi bi-person-circle"></i>
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
        <h1>Noticias</h1>
    </section>

    <section class="news">
        <?php
        if ($resultado->num_rows > 0) {
            // Iterar sobre los resultados de la base de datos
            while ($fila = $resultado->fetch_assoc()) {
                echo '<div class="news-item">';
                echo '<img src="' . htmlspecialchars($fila['Imagen']) . '" alt="' . htmlspecialchars($fila['Titulo']) . '">';
                echo '<p>';
                echo '<a href="detalle_noticia.php?id=' . intval($fila['id']) . '" class="news-title">';
                echo '<strong>' . htmlspecialchars($fila['Titulo']) . '</strong>';
                echo '</a>';
                echo '</p>';
                echo '<p><small>Fecha: ' . htmlspecialchars($fila['Fecha']) . '</small></p>';
                echo '</div>';
            }
        } else {
            echo "<p>No hay noticias disponibles en este momento.</p>";
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

<?php
// Cerrar la conexión a la base de datos
$conexion->close();
?>
