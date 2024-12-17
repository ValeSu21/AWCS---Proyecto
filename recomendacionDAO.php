<?php
class recomendacionDAO {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Método para obtener todas las recomendaciones
    public function obtenerTodas() {
        $sql = "SELECT * FROM recomendaciones";
        $resultado = $this->conexion->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Método para crear una recomendación
    public function crear($titulo, $contenido, $imagen) {
        $sql = "INSERT INTO recomendaciones (titulo, contenido, imagen) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sss", $titulo, $contenido, $imagen);
        return $stmt->execute();
    }

    // Método para editar una recomendación
    public function editar($id, $titulo, $contenido, $imagen) {
        $sql = "UPDATE recomendaciones SET titulo = ?, contenido = ?, imagen = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssi", $titulo, $contenido, $imagen, $id);
        return $stmt->execute();
    }

    // Método para eliminar una recomendación
    public function eliminar($id) {
        $sql = "DELETE FROM recomendaciones WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Método para obtener una recomendación específica
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM recomendaciones WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
