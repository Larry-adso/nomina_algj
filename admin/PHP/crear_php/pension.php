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
                        <h3 class="text-center">Cargar Valor pension</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../../conexion/db.php';

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $valor = $_POST['pension'];

                            if ($conexion) {
                                $sql = "INSERT INTO pension (valor) VALUES ('$valor')";

                                if ($conexion->query($sql)) {
                                    echo '<script>alert("El valor de pension  ha sido insertado correctamente."); window.location.href = "../index.php";</script>';
                                } else {
                                    echo '<script>alert("Error al insertar el valor: ' . $conexion->errorInfo()[2] . '"); window.location.href = "../index.php";</script>';
                                }
                            } else {
                                echo '<script>alert("Error al establecer la conexión a la base de datos."); window.location.href = "pension.php";</script>';
                            }
                        }
                        ?>
                        <form action="pension.php" method="post">
                            <div class="form-group">
                                <label for="valor">Valor de pension</label>
                                <input type="number" class="form-control" id="pension" name="pension" placeholder="Ingrese el valor de pension" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar Valor</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
