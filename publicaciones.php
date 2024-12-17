<?php

$conexion = new mysqli("localhost", "valeria", "123456", "proyecto");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$sql = "SELECT id, Titulo, Imagen, Fecha, Nombre_Completo FROM publicaciones_comunidad";
$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClimaTico - Comunidad</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
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


    <section class="community">
        
    <div class="header-comunidad">COMUNIDAD</div>

        <div class="cards-container">
            <?php        
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    ?>
                    <div class="card-comunidad">
                        <img src="<?php echo $fila['Imagen']; ?>" alt="Imagen de <?php echo $fila['Titulo']; ?>" class="image-comunidad">
                        <div class="text-comunidad">
                        <h3><a href="detalle.php?id=<?php echo $fila['id']; ?>"><?php echo $fila['Titulo']; ?></a></h3>
                            <p class="date"><?php echo date("d F Y", strtotime($fila['Fecha'])); ?> - <?php echo $fila['Nombre_Completo']; ?></p>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No hay publicaciones disponibles.</p>";
            }
            ?>
        </div>
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
            <p class="copyright">Copyright © 2024 CLIMATico. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>

<?php
$conexion->close();
?>
