<?php 
$conexion = new mysqli("localhost", "valeria", "123456", "proyecto");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    // Consulta a la tabla 'noticias' utilizando el id
    $sql = "SELECT * FROM noticias WHERE id = $id";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $noticia = $resultado->fetch_assoc();
    } else {
        echo "No se encontró la noticia.";
        exit;
    }
} else {
    echo "ID de noticia no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($noticia['Titulo']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
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

<main class="centrar-contenido">
    <h1><?php echo htmlspecialchars($noticia['Titulo']); ?></h1>
    <img src="<?php echo htmlspecialchars($noticia['Imagen']); ?>" alt="Imagen de la noticia" class="img-fluid">
    <p><strong>Fecha:</strong> <?php echo date("d F Y", strtotime($noticia['Fecha'])); ?></p>
    <p><?php echo nl2br(htmlspecialchars($noticia['Descripcion'])); ?></p>
    <p><strong>Autor:</strong> <?php echo htmlspecialchars($noticia['Nombre']); ?></p>
</main>

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

<?php
$conexion->close();
?>
