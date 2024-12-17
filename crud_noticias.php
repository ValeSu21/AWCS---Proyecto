<?php
// Configuración de la conexión a la base de datos
$conexion = new mysqli("localhost", "valeria", "123456", "proyecto");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Lógica para manejar el formulario (Crear, Editar, Eliminar)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['crear'])) {
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $imagen = $_POST['imagen'];
        $fecha = $_POST['fecha'];
        $nombre = $_POST['nombre'];

        $conexion->query("INSERT INTO noticias (Titulo, Descripcion, Imagen, Fecha, Nombre) 
                          VALUES ('$titulo', '$descripcion', '$imagen', '$fecha', '$nombre')");
    } elseif (isset($_POST['editar'])) {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $imagen = $_POST['imagen'];
        $fecha = $_POST['fecha'];
        $nombre = $_POST['nombre'];

        $conexion->query("UPDATE noticias SET Titulo='$titulo', Descripcion='$descripcion', Imagen='$imagen', Fecha='$fecha', 
                          Nombre='$nombre' WHERE id=$id");
    } elseif (isset($_POST['eliminar'])) {
        $id = $_POST['id'];
        $conexion->query("DELETE FROM noticias WHERE id=$id");
    }
}

// Consultar las noticias
$resultado = $conexion->query("SELECT * FROM noticias");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Noticias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        form {
            display: inline-block;
            text-align: left;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="date"] {
            width: 300px;
            margin: 5px;
            padding: 8px;
            font-size: 14px;
        }
        textarea {
            width: 500px;
            height: 100px;
        }
        button {
            padding: 8px 12px;
            font-size: 14px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[name="crear"] {
            background-color: green;
            color: white;
        }
        button[name="editar"] {
            background-color: gold;
            color: black;
        }
        button[name="eliminar"] {
            background-color: red;
            color: white;
        }
        table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid black;
            text-align: center;
        }
        img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Administrar Noticias</h1>

    <!-- Formulario -->
    <form method="POST">
        <input type="hidden" name="id" id="id">
        <label>Título: <input type="text" name="titulo" id="titulo" required></label><br>
        <label>Descripción: <textarea name="descripcion" id="descripcion" required></textarea></label><br>
        <label>Imagen (URL): <input type="text" name="imagen" id="imagen" required></label><br>
        <label>Fecha: <input type="date" name="fecha" id="fecha" required></label><br>
        <label>Nombre: <input type="text" name="nombre" id="nombre" required></label><br>
        <button type="submit" name="crear">Crear</button>
        <button type="submit" name="editar">Editar</button>
    </form>

    <!-- Tabla de noticias -->
    <h2>Lista de Noticias</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descripción</th>
            <th>Imagen</th>
            <th>Fecha</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?php echo $fila['id']; ?></td>
                <td><?php echo htmlspecialchars($fila['Titulo']); ?></td>
                <td><?php echo htmlspecialchars($fila['Descripcion']); ?></td>
                <td><img src="<?php echo htmlspecialchars($fila['Imagen']); ?>" alt="Imagen"></td>
                <td><?php echo $fila['Fecha']; ?></td>
                <td><?php echo htmlspecialchars($fila['Nombre']); ?></td>
                <td>
                    <button type="button" style="background-color: gold; color: black;" 
                            onclick="editar('<?php echo $fila['id']; ?>', '<?php echo $fila['Titulo']; ?>', 
                            '<?php echo $fila['Descripcion']; ?>', '<?php echo $fila['Imagen']; ?>', 
                            '<?php echo $fila['Fecha']; ?>', '<?php echo $fila['Nombre']; ?>')">Editar</button>
                    <form method="POST" style="display:inline-block;">
                        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                        <button type="submit" name="eliminar" onclick="return confirm('¿Estás seguro?');">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <!-- Script para editar registros -->
    <script>
        function editar(id, titulo, descripcion, imagen, fecha, nombre) {
            document.getElementById('id').value = id;
            document.getElementById('titulo').value = titulo;
            document.getElementById('descripcion').value = descripcion;
            document.getElementById('imagen').value = imagen;
            document.getElementById('fecha').value = fecha;
            document.getElementById('nombre').value = nombre;
        }
    </script>
</body>
</html>

<?php $conexion->close(); ?>
