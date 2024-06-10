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
                        <h3 class="text-center">Cargar Valor Salud</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../../conexion/db.php';

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $valor = $_POST['valor'];

                            if ($conexion) {
                                $sql = "INSERT INTO salud (valor) VALUES ('$valor')";

                                if ($conexion->query($sql)) {
                                    echo '<script>alert("El valor de Salud \'' . $valor . '%\' ha sido insertado correctamente."); window.location.href = "../index.php";</script>';
                                } else {
                                    echo '<script>alert("Error al insertar el valor: ' . $conexion->errorInfo()[2] . '"); window.location.href = "../index.php";</script>';
                                }
                            } else {
                                echo '<script>alert("Error al establecer la conexión a la base de datos."); window.location.href = "salud.php";</script>';
                            }
                        }
                        ?>
                        <form id="cargarSaludForm" action="salud.php" method="post">
                            <div class="form-group">
                                <label for="valor">Valor de Salud</label>
                                <input type="number" class="form-control" id="valor" name="valor" placeholder="Ingrese el valor de Salud" required>
                                <small id="valor_error" class="text-danger"></small>
                            </div>
                            <button type="submit" class="btn btn-primary" id="registrarValorBtn">Registrar Valor</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const cargarSaludForm = document.getElementById('cargarSaludForm');
        const valorInput = document.getElementById('valor');
        const registrarValorBtn = document.getElementById('registrarValorBtn');

        valorInput.addEventListener('input', validarValorSalud);

        function validarValorSalud() {
            const valor = valorInput.value.trim();
            if (!/^(\d+(\.\d{1,2})?)$/.test(valor)) {
                valorInput.classList.add('border', 'border-danger');
                document.getElementById('valor_error').textContent = 'Ingrese un valor de salud válido (puede contener hasta 2 decimales).';
                registrarValorBtn.disabled = true;
            } else {
                valorInput.classList.remove('border', 'border-danger');
                document.getElementById('valor_error').textContent = '';
                registrarValorBtn.disabled = false;
            }
        }
    </script>
</body>


</html>