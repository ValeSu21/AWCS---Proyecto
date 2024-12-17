<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $userType = $_POST['userType'];  // Se recibe el tipo de usuario (user o admin)

    if ($password === $confirmPassword) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Encriptamos la contraseña

        // Insertamos el usuario en la base de datos
        $sql = "INSERT INTO users (fullName, email, password, userType) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssss", $fullName, $email, $hashedPassword, $userType);
        
        if ($stmt->execute()) {
            // Redirigir al usuario según su tipo
            if ($userType == 'admin') {
                header("Location: exito.php");  // Redirigir a un dashboard de admin
            } else {
                header("Location: exito.php");  // Redirigir a un dashboard de usuario
            }
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Las contraseñas no coinciden.";
    }
}
?>
