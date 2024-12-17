<?php

class AlertaDAO {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Obtener todas las alertas
    public function obtenerTodas() {
        $query = "SELECT * FROM alerts ORDER BY fecha DESC";
        $result = $this->conexion->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener una alerta por ID
    public function obtenerPorId($id) {
        $stmt = $this->conexion->prepare("SELECT * FROM alerts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Crear una nueva alerta con imagen
    public function crear($titulo, $mensaje, $tipo, $imagen) {
        $stmt = $this->conexion->prepare("INSERT INTO alerts (titulo, mensaje, tipo, imagen) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $titulo, $mensaje, $tipo, $imagen);
        return $stmt->execute();
    }

    // Actualizar una alerta existente con imagen
    public function actualizar($id, $titulo, $mensaje, $tipo, $imagen = null) {
        if ($imagen) {
            // Si se proporciona una nueva imagen
            $stmt = $this->conexion->prepare("UPDATE alerts SET titulo = ?, mensaje = ?, tipo = ?, imagen = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $titulo, $mensaje, $tipo, $imagen, $id);
        } else {
            // Si no se actualiza la imagen
            $stmt = $this->conexion->prepare("UPDATE alerts SET titulo = ?, mensaje = ?, tipo = ? WHERE id = ?");
            $stmt->bind_param("sssi", $titulo, $mensaje, $tipo, $id);
        }
        return $stmt->execute();
    }

    // Eliminar una alerta
    public function eliminar($id) {
        $stmt = $this->conexion->prepare("DELETE FROM alerts WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

?>
