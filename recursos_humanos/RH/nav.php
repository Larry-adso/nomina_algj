<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
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
            transition: width 0.5s;
            padding-top: 60px;
            z-index: 1;
            color: #fff;
        }

        .sidebar.active {
            width: 250px;
            margin-right: 120px;
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


        .btn-sm {
            background-color: #111;
        }

        .active-sidebar {
            margin-left: 250px;
        }
    </style>
</head>

<body>
    <button class="btn btn-toggle" id="toggleNav">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar" id="sidebar">
        <h3>Tablas RH</h3>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="form_prestamos2.php" class="nav-link"><i class="fas fa-hand-holding-usd"></i> Tabla Prestamos</a></li>
            <li class="nav-item"><a href="form_permisos.php" class="nav-link"><i class="fas fa-calendar-check"></i> Tabla Permisos</a></li>
            <li class="nav-item"><a href="php/empleados.php" class="nav-link"><i class="fas fa-users"></i> Tabla Empleados</a></li>
            <li class="nav-item"><a href="nomina.php" class="nav-link"><i class="fas fa-file-invoice-dollar"></i> Tabla Nominas</a></li>
            <li class="nav-item">

                <a type="submit" name="logout" class="nav-link fas fa-sign-out-alt" style="background: none; border: none; padding: 0; cursor: pointer; color:#fff;" href="../../dev/PHP/cerrar.php" role="button">Cerrar sesion</a>
            </li>
        </ul>

    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#toggleNav").click(function() {
                $("#sidebar").toggleClass('active');
                $("#main-content").toggleClass('active-sidebar');
            });
        });
    </script>
</body>

</html>