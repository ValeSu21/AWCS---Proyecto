<?php

$conexion = new mysqli("localhost", "valeria", "123456", "proyecto");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa";
}

$Titulo = "¿A partir de cuándo mejorará el tiempo?";

$Descripcion = "El Instituto Meteorológico Nacional (IMN) proyecta un patrón lluvioso debido a la influencia indirecta por la tormenta tropical Sara hasta este sábado en la región sur del territorio nacional, mientras que se mantendrá hasta el domingo en la vertiente del Pacífico y en partes del Valle Central.

Pero la pregunta más frecuente de los costarricenses es: ¿cuándo mejorará el estado del tiempo con la merma de las precipitaciones?

Costa Rica viene experimentando fuertes aguaceros desde el 5 de noviembre, producto de las influencias indirectas por el Huracán Rafael y la Tormenta Tropical Sara.

De acuerdo con la meteoróloga Gabriela Chinchilla, el tiempo comenzará a mejorar en suelo costarricense a partir de este próximo domingo 17 y lunes 18 de noviembre en el Pacífico Central y Sur.

A mediados de octubre, el IMN indicó que el período de transición a la época seca arrancaría este domingo en la región Pacífico Norte; mientras que para el Valle Central está programado para este miércoles 20 de noviembre y en el Caribe el día 22.";

$imagen = "https://www.crhoy.com/wp-content/uploads/2024/11/IMN-LLUVIAS-SARA.png";

$fecha = "2024-12-13";

$Nombre = "Pedro Pascal";

$sql = "INSERT INTO noticias(Titulo, Descripcion, Imagen, Fecha, Nombre) VALUES (?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssss", $Titulo, $Descripcion, $imagen, $fecha, $Nombre);
$stmt->execute();

echo "Nuevo registro creado.";
?>

