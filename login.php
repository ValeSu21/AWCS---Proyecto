<?php
session_start();
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Buscamos al usuario en la base de datos
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verificamos la contraseña
        if (password_verify($password, $user['password'])) {
            $_SESSION['userId'] = $user['id'];
            $_SESSION['userType'] = $user['userType'];
            $_SESSION['email'] = $user['email'];

            // Redirigimos según el tipo de usuario
            if ($user['userType'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: index.html");
            }
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>
