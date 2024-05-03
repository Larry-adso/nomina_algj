<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>TABLAS ADMIN</title>
</head>
<body>
    
<div class="content">
    <div class="container">
        <h2 class="mb-5">TABLA ESTADOS</h2>
        <div class="table-responsive">
            <table class="table table-striped custom-table">
            <div class="button"><a href='PHP/crear_php/estados.php'>CARGAR ESTADOS</a></div>  
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col">Acciones</th>
                    <th scope="col">CARGAR</th>
                </tr>
                </thead>
                <tbody class="tbody">
                <?php
                include 'conexion/db.php';

                $sql = "SELECT * FROM estado";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['ID_Es'] . "</td>";
                        echo "<td>" . $row['Estado'] . "</td>";
                        echo "<td><a href='PHP/editar_php/editar_estados.php?id=" . $row['ID_Es'] . "'>Editar</a> | <a href='PHP/eliminar_php/eliminar_estado.php?id=" . $row['ID_Es'] . "'>Eliminar</a></td>";
                        echo "<td><a href='PHP/crear_php/estados.php'>CARGAR</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay estados registrados.</td></tr>";
                }
                ?>
                </tbody>
            </table>
            <!-- Botón CARGAR siempre activo -->
          
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <h2 class="mb-5">TABLA ROLES</h2>
        <div class="table-responsive">
            <table class="table table-striped custom-table">
            <div class="button"><a href='PHP/crear_php/roles.php'>CARGAR ROLES</a></div>  
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ROL</th>
                    <th scope="col">Acciones</th>
                    <th scope="col">CARGAR</th>
                </tr>
                </thead>
                <tbody class="tbody">
                <?php
                include 'conexion/db.php';

                $sql = "SELECT * FROM roles";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['TP_user'] . "</td>";
                        echo "<td><a href='PHP/editar_php/editar_roles.php?id=" . $row['ID'] . "'>Editar</a> | <a href='PHP/eliminar_php/eliminar_rol.php?id=" . $row['ID'] . "'>Eliminar</a></td>";
                        echo "<td><a href='PHP/crear_php/roles.php'>CARGAR</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay ROLES registrados.</td></tr>";
                }
                ?>
                </tbody>
            </table>
            <!-- Botón CARGAR siempre activo -->
          
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <h2 class="mb-5">TABLA SALUD</h2>
        <div class="table-responsive">
            <table class="table table-striped custom-table">
            <div class="button"><a href='PHP/crear_php/salud.php'>CARGAR SALUD</a></div>  
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">VALOR</th>
                    <th scope="col">Acciones</th>
                    <th scope="col">CARGAR</th>
                </tr>
                </thead>
                <tbody class="tbody">
                <?php
                include 'conexion/db.php';

                $sql = "SELECT * FROM salud";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['valor'] . " %"."</td>";
                        echo "<td><a href='PHP/editar_php/editar_salud.php?id=" . $row['ID'] . "'>Editar</a> | <a href='PHP/eliminar_php/eliminar_salud.php?id=" . $row['ID'] . "'>Eliminar</a></td>";
                        echo "<td><a href='PHP/crear_php/salud.php'>CARGAR</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay SALUD registrados.</td></tr>";
                }
                ?>
                </tbody>
            </table>
            
          
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <h2 class="mb-5">TABLA PENSION</h2>
        <div class="table-responsive">
            <table class="table table-striped custom-table">
            <div class="button"><a href='PHP/crear_php/pension.php'>CARGAR PENSION</a></div>  
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">VALOR</th>
                    <th scope="col">Acciones</th>
                    <th scope="col">CARGAR</th>
                </tr>
                </thead>
                <tbody class="tbody">
                <?php
                include 'conexion/db.php';

                $sql = "SELECT * FROM pension";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['valor'] . " %"."</td>";
                        echo "<td><a href='PHP/editar_php/editar_pension.php?id=" . $row['ID'] . "'>Editar</a> | <a href='PHP/eliminar_php/eliminar_pension.php?id=" . $row['ID'] . "'>Eliminar</a></td>";
                        echo "<td><a href='PHP/crear_php/pension.php'>CARGAR</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay pension registrados.</td></tr>";
                }
                ?>
                </tbody>
            </table>
            
          
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <h2 class="mb-5">TABLA VALOR HORAS EXTRA</h2>
        <div class="table-responsive">
            <table class="table table-striped custom-table">
            <div class="button"><a href='PHP/crear_php/vhe.php'>CARGAR VALOR</a></div>  
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">VALOR</th>
                    <th scope="col">Acciones</th>
                    <th scope="col">CARGAR</th>
                </tr>
                </thead>
                <tbody class="tbody">
                <?php
                include 'conexion/db.php';

                $sql = "SELECT * FROM v_h_extra";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['V_H_extra'] ."</td>";
                        echo "<td><a href='PHP/editar_php/editar_valor_extra.php?id=" . $row['ID'] . "'>Editar</a> | <a href='PHP/eliminar_php/eliminar_v_hora_extra.php?id=" . $row['ID'] . "'>Eliminar</a></td>";
                        echo "<td><a href='PHP/crear_php/vhe.php'>CARGAR</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay valores de hora extra registrados.</td></tr>";
                }
                ?>
                </tbody>
            </table>
            
          
        </div>
    </div>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
