<?php
include 'conexion.php';
include 'AlertaDAO.php';

$alertaDAO = new AlertaDAO($conexion);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $mensaje = $_POST['mensaje'];
    $tipo = $_POST['tipo'];
    $imagen = null;

    // Manejar la subida de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['imagen']['name'];
        $rutaTemporal = $_FILES['imagen']['tmp_name'];
        $directorioDestino = 'uploads/';

        // Crear el directorio si no existe
        if (!is_dir($directorioDestino)) {
            mkdir($directorioDestino, 0777, true);
        }

        // Generar un nombre único para la imagen
        $rutaDestino = $directorioDestino . uniqid() . '_' . $nombreArchivo;

        // Mover el archivo al directorio de destino
        if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
            $imagen = $rutaDestino;
        } else {
            echo "Error al subir la imagen.";
            exit();
        }
    }

    if (empty($id)) {
        // Crear nueva alerta
        $alertaDAO->crear($titulo, $mensaje, $tipo, $imagen);
    } else {
        // Actualizar alerta existente
        $alertaDAO->actualizar($id, $titulo, $mensaje, $tipo, $imagen);
    }

    header("Location: admin_alertas.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $alertaDAO->eliminar($id);
    header("Location: admin_alertas.php");
    exit();
}
?>
