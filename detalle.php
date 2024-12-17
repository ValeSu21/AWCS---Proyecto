<?php
$conexion = new mysqli("localhost", "valeria", "123456", "proyecto");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    $sql = "SELECT * FROM publicaciones_comunidad WHERE id = $id";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $publicacion = $resultado->fetch_assoc();
    } else {
        echo "No se encontró la publicación.";
        exit;
    }
} else {
    echo "ID de publicación no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $publicacion['Titulo']; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClimaTico - Comunidad</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="comunidad">
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
    <h1><?php echo $publicacion['Titulo']; ?></h1>
    <img src="<?php echo $publicacion['Imagen']; ?>" alt="Imagen de <?php echo $publicacion['Titulo']; ?>">
    <p><strong>Fecha:</strong> <?php echo date("d F Y", strtotime($publicacion['Fecha'])); ?></p>
    <p><?php echo $publicacion['Descripcion']; ?></p>
    <p><strong>Nombre Solicitante:</strong> <?php echo $publicacion['Nombre_Completo']; ?></p>
    <p><strong>Contacto:</strong> <?php echo $publicacion['Contacto_Telefonico']; ?></p>
</main>

</body>

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
</html>

<?php
// Cerrar la conexión
$conexion->close();
?>
