<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Valor De Salud</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7fd910d257.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/admin.css">

</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Editar Valor De Salud</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../../conexion/db.php';

                        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                            $id = $_GET['id'];

                            $sql = "SELECT * FROM salud WHERE ID = :id";
                            $stmt = $conexion->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                            $stmt->execute();
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);

                            if ($result) {
                                $valor = $result['Valor'];
                        ?>

                                <form id="editarSaludForm" action="editar_salud.php" method="post">
                                    <div class="form-group">
                                        <label for="valor">Nuevo Valor de salud</label>
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                        <input type="number" class="form-control" id="valor" name="valor" placeholder="Nuevo Valor de Pensión" value="<?php echo htmlspecialchars($valor); ?>" required>
                                        <small id="valor_error" class="text-danger"></small>
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary" id="actualizarValorBtn">Actualizar Valor</button>
                                </form>

                        <?php
                            } else {
                                echo '<script>alert("No se encontró el valor de la salud con el ID proporcionado.");</script>';
                            }
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
                            $id = $_POST['id'];
                            $valor = $_POST['valor'];

                            $sql = "UPDATE salud SET valor = :valor WHERE ID = :id";
                            $stmt = $conexion->prepare($sql);
                            $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                            if ($stmt->execute()) {
                                echo '<script>alert("El valor de la salud ha sido actualizado correctamente."); window.location.href = "../index.php";</script>';
                                exit();
                            } else {
                                $mensaje = "Error al actualizar el valor de la salud: " . $stmt->errorInfo()[2];
                                echo '<script>alert("' . $mensaje . '");</script>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const editarSaludForm = document.getElementById('editarSaludForm');
        const valorInput = document.getElementById('valor');
        const actualizarValorBtn = document.getElementById('actualizarValorBtn');

        valorInput.addEventListener('input', validarValorSalud);

        function validarValorSalud() {
            const valor = valorInput.value.trim();
            if (!/^(\d+(\.\d{1,2})?)$/.test(valor)) {
                valorInput.classList.add('border', 'border-danger');
                document.getElementById('valor_error').textContent = 'Ingrese un valor de salud válido (puede contener hasta 2 decimales).';
                actualizarValorBtn.disabled = true;
            } else {
                valorInput.classList.remove('border', 'border-danger');
                document.getElementById('valor_error').textContent = '';
                actualizarValorBtn.disabled = false;
            }
        }
    </script>
</body>


</html>