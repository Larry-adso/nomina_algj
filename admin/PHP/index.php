<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nomina_algj";

try {
    $conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Establecer el modo de error PDO en excepción
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Establecer el conjunto de caracteres a UTF-8
    $conexion->exec("SET CHARACTER SET utf8");

    // Consulta SQL para seleccionar usuarios con id_rol mayores o iguales a 6
    $sql = "SELECT * FROM usuarios WHERE id_rol >= 6";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        img {
            max-width: 100px;
            max-height: 100px;
        }

        .container {
            position: relative;
            margin-left: 9%;
        }

        .btn-toggle {
            background-color: black;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 999;
        }

        .sidebar {
            width: 0;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            z-index: 1;
            color: #fff;
        }

        .sidebar.active {
            width: 250px;
        }

        .sidebar h3 {
            padding: 20px;
            text-align: center;
        }

        .sidebar ul li {
            padding: 10px 20px;
        }

        .sidebar a {
            text-decoration: none;
            color: #fff;
        }

        .sidebar a:hover {
            color: #ccc;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: #fff;
            cursor: pointer;
        }

        table {
            width: 70%;
        }

        .btn-sm {
            background-color: #111;
        }
    </style>
</head>

<body>

    <button class="btn btn-toggle" id="toggleNav">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar" id="sidebar">

        <h3>Tablas Admin</h3>
        <ul class="nav flex-column">
        <li class="nav-item"><a href="tablas/vhe.php" class="nav-link"><i class="fas fa-user-tag"></i> Tabla Horas Extra</a></li>
        <li class="nav-item"><a href="tablas/roles.php" class="nav-link"><i class="fas fa-user-tag"></i> Tabla Roles</a></li>
        <li class="nav-item"><a href="tablas/salud.php" class="nav-link"><i class="fas fa-heartbeat"></i> Tabla Salud</a></li>
        <li class="nav-item"><a href="tablas/pension.php" class="nav-link"><i class="fas fa-money-check-alt"></i> Tabla Pension</a></li>
        <li class="nav-item"><a href="../../RH/form_puestos.php" class="nav-link"><i class="fas fa-briefcase"></i> Tabla Puestos</a></li>
        <li class="nav-item"><a href="../../RH/form_prestamos.php" class="nav-link"><i class="fas fa-hand-holding-usd"></i> Tabla Prestamos</a></li>
        <li class="nav-item"><a href="../../RH/form_permisos.php" class="nav-link"><i class="fas fa-calendar-check"></i> Tabla Permisos</a></li>
        <li class="nav-item"><a href="../../RH/form_empleados.php" class="nav-link"><i class="fas fa-users"></i> Tabla Empleados</a></li>
        <li class="nav-item">
            <form method="post" style="margin: 0;">
                <button type="submit" name="logout" class="nav-link" style="background: none; border: none; padding: 0; cursor: pointer; color:#fff;">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </li>
    </ul>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
        session_start();
        session_unset();
        session_destroy();
        header("Location:../../index.php"); // Redirigir a la página de inicio de sesión después de cerrar sesión
        exit();
    }
    ?>
    </div>

    <div class="container">
        <div class="container mt-5">
            <h2 class="mb-4">Trabajadores</h2>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Foto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP loop to populate table -->
                    <?php foreach ($usuarios as $usuario) : ?>
                        <tr>
                            <td><?php echo $usuario['id_us']; ?></td>
                            <td><?php echo $usuario['nombre_us']; ?></td>
                            <td><?php echo $usuario['apellido_us']; ?></td>
                            <td><?php echo $usuario['correo_us']; ?></td>
                            <td><?php echo $usuario['tel_us']; ?></td>
                            <td><?php if (!empty($usuario['foto'])) : ?><img src="data:image/jpeg;base64,<?php echo base64_encode($usuario['foto']); ?>" alt="Foto"><?php endif; ?></td>
                            <td>
                                <a href="editar.php?id=<?php echo $usuario['id_us']; ?>" class="btn btn-primary btn-sm">Editar</a>
                                <a href="eliminar.php?id=<?php echo $usuario['id_us']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#toggleNav").click(function() {
                $("#sidebar").toggleClass('active');
                $(".container").toggleClass('active');
            });
            $("#closeNav").click(function() {
                $("#sidebar").removeClass('active');
                $(".container").removeClass('active');
            });
        });
    </script>

</body>

</html>