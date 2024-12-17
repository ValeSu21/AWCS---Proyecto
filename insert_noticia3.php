<?php

$conexion = new mysqli("localhost", "valeria", "123456", "proyecto");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa";
}

$Titulo = "Gobierno decreta emergencia nacional por fuertes lluvias";

$Descripcion = " El Gobierno de Costa Rica decretó emergencia nacional por las intensas lluvias que afectan el país y la probabilidad de inundaciones y deslizamientos en las zonas más afectadas, especialmente el Pacífico, con alerta roja desde el martes. El Valle Central, la región Norte y el Caribe norte de este país permanecen bajo alerta naranja, mientras que el Caribe sur está con alerta amarilla.

El presidente Rodrigo Chaves y la ministra de la Presidencia, Laura Fernández, firmaron el decreto que se publicó este miércoles en el diario oficial La Gaceta.

La declaratoria señala que la medida obedece a las intensas precipitaciones producto de varios factores, entre ellos, la influencia indirecta del huracán Rafael, la cercanía de la zona de convergencia intertropical y los remanentes del paso de la onda tropical N°45. El decreto rige desde este miércoles en 20 cantones, la mayoría en las provincias de Guanacaste y Puntarenas, en la vertiente del Pacífico.";

$imagen = "https://media.cnn.com/api/v1/images/stellar/prod/cnne-1781030-costa-rica-lluvias.jpg?c=16x9&q=h_653,w_1160,c_fill/f_webp";

$fecha = "2024-11-14";

$Nombre = "Mathias Pereira";

$sql = "INSERT INTO noticias(Titulo, Descripcion, Imagen, Fecha, Nombre) VALUES (?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssss", $Titulo, $Descripcion, $imagen, $fecha, $Nombre);
$stmt->execute();

echo "Nuevo registro creado.";
?>

