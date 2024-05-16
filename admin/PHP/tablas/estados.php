<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>TABLA ESTADOS</title>
</head>
<body>
<div class="content">
    <div class="container">
        <h2 class="mb-5">TABLA ESTADOS</h2>
        <div class="table-responsive">
            <table class="table table-striped custom-table">
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
                    // Incluimos el archivo de conexión a la base de datos
                    include '../../../conexion/db.php';

                    // Realizamos la consulta SQL para obtener los estados
                    $sql = "SELECT * FROM estado";
                    $result = $conn->query($sql);

                    // Verificamos si hay estados registrados
                    if ($result->num_rows > 0) {
                        // Iteramos sobre los resultados y generamos las filas de la tabla
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['ID_Es'] . "</td>";
                            echo "<td>" . $row['Estado'] . "</td>";
                            echo "<td><a href='../PHP/editar_php/editar_estados.php?id=" . $row['ID_Es'] . "'>Editar</a> | <a href='../PHP/eliminar_php/eliminar_estado.php?id=" . $row['ID_Es'] . "'>Eliminar</a></td>";
                            echo "<td><a href='../PHP/crear_php/estados.php'>CARGAR</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        // Si no hay estados registrados, mostramos un mensaje
                        echo "<tr><td colspan='4'>No hay estados registrados.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
</body>
</html>
