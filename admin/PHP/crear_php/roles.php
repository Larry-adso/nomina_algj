<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Salud</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Cargar Rol</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../../conexion/db.php';

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $valor = $_POST['tp_user'];

                            if ($conexion) {
                                $sql = "INSERT INTO roles (TP_user) VALUES ('$valor')";

                                if ($conexion->query($sql)) {
                                    echo '<script>alert("el Rol \'' . $valor . '\' ha sido insertado correctamente."); window.location.href = "../index.php";</script>';
                                } else {
                                    echo '<script>alert("Error al insertar el rol: ' . $conexion->errorInfo()[2] . '"); window.location.href = "../index.php";</script>';
                                }
                            } else {
                                echo '<script>alert("Error al establecer la conexión a la base de datos."); window.location.href = "../index.php";</script>';
                            }
                        }
                        ?>
                        <form action="roles.php" method="post">
                            <div class="form-group">
                                <label for="valor">ROL</label>
                                <input type="text" class="form-control" id="tp_user" name="tp_user" placeholder="Ingrese el Rol" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar Rol</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
