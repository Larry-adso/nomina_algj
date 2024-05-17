<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tablas Admin</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .container {
        position: relative;
    }

    .btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
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
</style>
</head>
<body>

<div class="container">
    <button class="btn btn-primary" id="toggleNav">
        <i class="fas fa-bars"></i>
    </button>
    <div class="sidebar" id="sidebar">
        <button class="close-btn" id="closeNav">
            <i class="fas fa-times"></i>
        </button>
        <h3>Tablas Admin</h3>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="tablas/estados.php" class="nav-link"><i class="fas fa-flag"></i> Tabla Estados</a></li>
            <li class="nav-item"><a href="tablas/roles.php" class="nav-link"><i class="fas fa-user-tag"></i> Tabla Roles</a></li>
            <li class="nav-item"><a href="tablas/salud.php" class="nav-link"><i class="fas fa-heartbeat"></i> Tabla Salud</a></li>
            <li class="nav-item"><a href="tablas/pension.php" class="nav-link"><i class="fas fa-money-check-alt"></i> Tabla Pension</a></li>
            <li class="nav-item"><a href="../../RH/form_puestos.php" class="nav-link"><i class="fas fa-briefcase"></i> Tabla Puestos</a></li>
            <li class="nav-item"><a href="../../RH/form_prestamos.php" class="nav-link"><i class="fas fa-hand-holding-usd"></i> Tabla Prestamos</a></li>
            <li class="nav-item"><a href="../../RH/form_permisos.php" class="nav-link"><i class="fas fa-calendar-check"></i> Tabla Permisos</a></li>
            <li class="nav-item"><a href="../../RH/form_empleados.php" class="nav-link"><i class="fas fa-users"></i> Tabla Empleados</a></li>
        </ul>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $("#toggleNav").click(function(){
            $("#sidebar").toggleClass('active');
        });
        $("#closeNav").click(function(){
            $("#sidebar").removeClass('active');
        });
    });
</script>

</body>
</html>
