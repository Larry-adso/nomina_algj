<?php
// Incluir archivo de configuración de la base de datos y otros archivos necesarios
include '../../../conexion/db.php';

// Iniciar sesión (debe ser la primera línea ejecutada antes de cualquier salida)
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TABLA VALOR HORAS EXTRA</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos CSS adicionales si los necesitas */
    </style>
</head>
<body style="background-color: #f9f5f0;">
    <a class="btn btn-success" href="../index.php">INICIO</a>
    <div class="content">
        <div class="container">
            <center>
                <h2 class="mb-5">TABLA VALOR HORAS EXTRA</h2>
            </center>
            <div class="table-responsive">
                <a href="../crear_php/vhe.php" class="btn btn-success">Cargar valor</a>
                <table class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">VALOR</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        <?php
                        // Obtener id_empresa del usuario de sesión
                        if (!isset($_SESSION['id_us'])) {
                            echo '<tr><td colspan="3">Por favor inicie sesión.</td></tr>';
                        } else {
                            $id_us = $_SESSION['id_us'];
                            $stmt = $conexion->prepare("SELECT id_empresa FROM usuarios WHERE id_us = :id_us");
                            $stmt->bindParam(':id_us', $id_us, PDO::PARAM_INT);
                            $stmt->execute();
                            $id_empresa = $stmt->fetchColumn();

                            // Realizar la conexión a la base de datos utilizando mysqli
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Verificar si hay errores en la conexión
                            if ($conn->connect_error) {
                                die("Error de conexión a la base de datos: " . $conn->connect_error);
                            }

                            // Consulta SQL para obtener los valores de horas extra del id_empresa del usuario
                            $sql = "SELECT * FROM v_h_extra WHERE id_empresa = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $id_empresa);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            // Verificar si hay valores de horas extra registrados
                            if ($result->num_rows > 0) {
                                // Iterar sobre los resultados y generar las filas de la tabla
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['ID'] . "</td>";
                                    echo "<td>" . $row['V_H_extra'] . "</td>";
                                    echo "<td><a class='btn btn-primary' href='../editar_php/editar_valor_extra.php?id=" . $row['ID'] . "'>Editar</a> | <a class='btn btn-warning' href='../eliminar_php/eliminar_v_hora_extra.php?id=" . $row['ID'] . "'>Eliminar</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                // Mostrar mensaje si no hay valores de horas extra registrados para ese id_empresa
                                echo "<tr><td colspan='3'>No hay valores de hora extra registrados para su empresa.</td></tr>";
                            }

                            // Cerrar la conexión a la base de datos
                            $conn->close();
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
