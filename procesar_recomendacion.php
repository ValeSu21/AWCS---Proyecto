<?php
include 'conexion.php'; // Archivo de conexión a la base de datos
include 'RecomendacionDAO.php';

$recomendacionDAO = new recomendacionDAO($conexion);

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion']; // 'crear' o 'editar'

    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;

    // Manejo de la imagen
    $imagen = null;
    if (!empty($_FILES['imagen']['name'])) {
        $carpeta = 'recomendaciones/';
        $nombreArchivo = time() . '_' . $_FILES['imagen']['name'];
        $rutaDestino = $carpeta . $nombreArchivo;
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
            $imagen = $rutaDestino;
        }
    }

    // Procesar la acción
    if ($accion === 'crear') {
        $recomendacionDAO->crear($titulo, $contenido, $imagen);
    } elseif ($accion === 'editar') {
        $recomendacionDAO->editar($id, $titulo, $contenido, $imagen);
    }

    // Redirigir a la página principal de recomendaciones
    header('Location: admin_recomendacion.php');
    exit();
}

// Si no se envió el formulario, redirigir al inicio
header('Location: admin_recomendacion.php');
exit();
?>
