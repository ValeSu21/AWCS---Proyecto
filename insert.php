<?php

$conexion = new mysqli("localhost", "valeria", "123456", "proyecto");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa";
}

$Titulo = "Madre de 2 hijas pide ayuda";

$Descripcion = "En medio de los estragos provocados por las fuertes lluvias que azotaron Guanacaste, Ana María Rojas, madre soltera de dos niñas de 5 y 8 años, vive días de incertidumbre. 
                Su casa, ubicada en una zona de alto riesgo, fue arrasada por el agua hace apenas una semana.

Declaraciones de Ana María Rojas:

'Perdí todo... la casa, mis cosas, lo que con tanto esfuerzo había construido para mis hijas. Ahora estoy aquí en el albergue, pero no sé qué voy a hacer después. Solo quiero que mis niñas tengan algo para comer y un lugar donde sentirse seguras.'";

$imagen = "https://c.files.bbci.co.uk/DEB9/production/_120871075_7cc715a8-a1ca-4bd1-8c59-23baccb9cb8e.jpg";

$fecha = "2024-11-07";

$Nombre = "Ana María Rojas";

$Contacto = "8256-2222";

$sql = "INSERT INTO publicaciones_comunidad(Titulo, Descripcion, Imagen, Fecha, Nombre_Completo, Contacto_Telefonico) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssssss", $Titulo, $Descripcion, $imagen, $fecha, $Nombre, $Contacto);
$stmt->execute();

echo "Nuevo registro creado.";
?>