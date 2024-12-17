<?php
$conexion = new mysqli("localhost", "valeria", "123456", "proyecto");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    error_log("Conexión exitosa", 0);
}
?>