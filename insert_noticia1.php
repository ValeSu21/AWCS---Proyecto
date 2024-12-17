<?php

$conexion = new mysqli("localhost", "valeria", "123456", "proyecto");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa";
}

$Titulo = "Costa Rica registró las temperaturas más bajas del año el fin de semana, con valores bajo cero en varios sectores";

$Descripcion = "Durante el fin de semana, Costa Rica vivió el día más frío de 2024, alcanzándose temperaturas bajo cero en más de un lugar por primera vez en el año.

Daniel Poleo, de la Unidad de Climatología del Instituto Meteorológico Nacional (IMN), confirmó que “no solamente son las más frías en lo que va del mes, sino que son las más bajas en todo el año”.

Entre los puntos más fríos estuvieron:

Cerro de la Muerte con −0.5 °C
Volcán Turrialba con −0.2 °C
Volcán Irazú con 0.6 °C
Sin embargo, Poleo aclaró que “a pesar de que son las más bajas del año, no representan récords históricos.  Se encuentran entre las temperaturas más bajas registradas, pero no son las más extremas de la historia”.

Además, zonas urbanas también reportaron temperaturas notablemente bajas, por ejemplo:

La Unión de Cartago 8.6 °C
Rancho Redondo de Goicoechea 11.6 °C
Coronado 12 °C
Ochomogo 13 °C
Turrialba 15.9 °C";

$imagen = "https://observador.cr/wp-content/uploads/2021/02/frio.png";

$fecha = "2024-12-10";

$Nombre = "Lucas Hernandez";

$sql = "INSERT INTO noticias(Titulo, Descripcion, Imagen, Fecha, Nombre) VALUES (?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssss", $Titulo, $Descripcion, $imagen, $fecha, $Nombre);
$stmt->execute();

echo "Nuevo registro creado.";
?>