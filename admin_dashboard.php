<?php
session_start();

if ($_SESSION['userType'] != 'admin') {
    header("Location: admin_dashboard.php"); // Si no es administrador, redirigir al login
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- Para iconos -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            text-align: center;
        }

        .card-title {
            font-size: 22px;
            font-weight: bold;
            color: #007bff;
        }

        .card-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h3 class="text-center text-white">Admin Panel</h3>
        <a href="admin_alertas.php"><i class="fas fa-exclamation-circle"></i> Administrar Alertas</a>
        <a href="admin_recomendacion.php"><i class="fas fa-bullhorn"></i> Administrar Recomendaciones</a>
        <a href="crud.php"><i class="fas fa-bullhorn"></i> Administrar Comunidad</a>
        <a href="crud_noticias.php"><i class="fas fa-bullhorn"></i> Administrar Noticias</a>
        <a href="registro.html"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
    </div>

    <div class="content">
        <div class="header text-center">
            <h2>Bienvenido al Panel de Administración</h2>
            <p>Gestiona ClimaTico desde aca.</p>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-exclamation-circle fa-3x mb-3" style="color: #007bff;"></i>
                        <h5 class="card-title">Administrar Alertas</h5>
                        <p>Gestiona todas las alertas de emergencia aquí.</p>
                        <a href="admin_alertas.php" class="btn btn-primary">Ir a Alertas</a>
                    </div>
                    <div class="card-footer">
                        <small>Última actualización hace 5 minutos</small>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-exclamation-circle fa-3x mb-3" style="color: #007bff;"></i>
                        <h5 class="card-title">Administrar Comunidad</h5>
                        <p>Gestiona las comunidad aquí.</p>
                        <a href="crud.php" class="btn btn-primary">Ir a Comunidad</a>
                    </div>
                    <div class="card-footer">
                        <small>Última actualización hace 5 minutos</small>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-exclamation-circle fa-3x mb-3" style="color: #007bff;"></i>
                        <h5 class="card-title">Administrar Noticias</h5>
                        <p>Gestiona todas noticias aquí.</p>
                        <a href="crud_noticias.php" class="btn btn-primary">Ir a Noticias</a>
                    </div>
                    <div class="card-footer">
                        <small>Última actualización hace 5 minutos</small>
                    </div>
                </div>
            </div>




            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-bullhorn fa-3x mb-3" style="color: #007bff;"></i>
                        <h5 class="card-title">Administrar Recomendaciones</h5>
                        <p>Configura y administra las recomendaciones aquí.</p>
                        <a href="admin_recomendacion.php" class="btn btn-primary">Ir a Recomendaciones</a>
                    </div>
                    <div class="card-footer">
                        <small>Última actualización hace 10 minutos</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
