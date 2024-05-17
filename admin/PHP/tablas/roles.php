<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>TABLA ROLES</title>
</head>

<body>
    <div class="content">
        <div class="container">
            <h2 class="mb-5">TABLA ROLES</h2>
            <div class="table-responsive">
                <a href="../crear_php/roles.php" class="btn btn-success">Cargar Rol</a>
                <table class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">ROL</th>
                            <th scope="col">Acciones</th>

                        </tr>
                    </thead>
                    <tbody class="tbody">
                        <?php
                        // Incluimos el archivo de conexión a la base de datos
                        include '../../../conexion/db.php';

                        // Realizamos la conexión a la base de datos utilizando mysqli
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Verificamos si hay errores en la conexión
                        if ($conn->connect_error) {
                            die("Error de conexión a la base de datos: " . $conn->connect_error);
                        }

                        // Realizamos la consulta SQL para obtener los roles
                        $sql = "SELECT * FROM roles";
                        $result = $conn->query($sql);

                        // Verificamos si hay roles registrados
                        if ($result->num_rows > 0) {
                            // Iteramos sobre los resultados y generamos las filas de la tabla
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['ID'] . "</td>";
                                echo "<td>" . $row['Tp_user'] . "</td>";
                                echo "<td><a  class='btn btn-success' href='../editar_php/editar_roles.php?id=" . $row['ID'] . "'>Editar</a> | <a   class='btn btn-warning' href='../eliminar_php/eliminar_rol.php?id=" . $row['ID'] . "'>Eliminar</a></td>";

                                echo "</tr>";
                            }
                        } else {
                            // Si no hay roles registrados, mostramos un mensaje
                            echo "<tr><td colspan='4'>No hay ROLES registrados.</td></tr>";
                        }

                        // Cerramos la conexión
                        $conn->close();
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