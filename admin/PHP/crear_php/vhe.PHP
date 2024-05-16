<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Valor De Hora Extra</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Cargar Valor De Hora Extra</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../../conexion/db.php';

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $v_h_extra = $_POST['v_h_extra'];

                            if ($conexion) {
                                $sql = "INSERT INTO v_h_extra (V_H_extra) VALUES ('$v_h_extra')";

                                if ($conexion->query($sql)) { // Verificar si la consulta se ejecutó correctamente
                                    echo '<script>alert("Valor insertado correctamente"); window.location.href = "../tablas/vhe.php";</script>';
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">Error al insertar el valor: ' . $conexion->errorInfo()[2] . '</div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert">Error al establecer la conexión a la base de datos.</div>';
                            }
                        }
                        ?>
                        <form action="vhe.php" method="post">
                            <div class="form-group">
                                <label for="v_h_extra">Valor de Hora Extra</label>
                                <input type="number" class="form-control" id="v_h_extra" name="v_h_extra" placeholder="Ingrese el valor de hora extra" required>
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
