<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Salud</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/admin.css">

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
                                    echo '<script>alert("El valor de pension ha sido insertado correctamente."); window.location.href = "../index.php";</script>';
                                } else {
                                    echo '<script>alert("Error al insertar el valor: ' . $conexion->errorInfo()[2] . '"); window.location.href = "../index.php";</script>';
                                }
                            } else {
                                echo '<script>alert("Error al establecer la conexión a la base de datos."); window.location.href = "pension.php";</script>';
                            }
                        }
                        ?>
                        <form id="cargarValorForm" action="pension.php" method="post">
                            <div class="form-group">
                                <label for="valor">Valor de pensión</label>
                                <input type="number" class="form-control" id="pension" name="pension" placeholder="Ingrese el valor de pensión" required>
                                <small id="pension_error" class="text-danger"></small>
                            </div>
                            <button type="submit" class="btn btn-primary" id="registrarValorBtn">Registrar Valor</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const cargarValorForm = document.getElementById('cargarValorForm');
        const pensionInput = document.getElementById('pension');
        const registrarValorBtn = document.getElementById('registrarValorBtn');

        pensionInput.addEventListener('input', validarPension);

        function validarPension() {
            const valor = pensionInput.value.trim();
            if (!/^\d+$/.test(valor)) {
                pensionInput.classList.add('border', 'border-danger');
                document.getElementById('pension_error').textContent = 'Ingrese un valor de pensión válido (solo números).';
                registrarValorBtn.disabled = true;
            } else {
                pensionInput.classList.remove('border', 'border-danger');
                document.getElementById('pension_error').textContent = '';
                registrarValorBtn.disabled = false;
            }
        }
    </script>
</body>


</html>
