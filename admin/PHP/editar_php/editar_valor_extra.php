<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Valor De Hora Extra</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/7fd910d257.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/admin.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Editar Valor De Hora Extra</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../../conexion/db.php';

                        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                            $id = $_GET['id'];

                            $sql = "SELECT * FROM v_h_extra WHERE ID = :id";
                            $stmt = $conexion->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                            $stmt->execute();
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);

                            if ($result) {
                                $valor = $result['V_H_extra'];
                        ?>

                                <form id="editarValorHoraExtraForm" action="editar_valor_extra.php" method="post">
                                    <div class="form-group">
                                        <label for="v_h_extra">Nuevo Valor de Hora Extra</label>
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                        <input type="number" class="form-control" id="v_h_extra" name="v_h_extra" placeholder="Nuevo Valor de Hora Extra" value="<?php echo htmlspecialchars($valor); ?>" required>
                                        <small id="v_h_extra_error" class="text-danger"></small>
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary" id="actualizarValorBtn">Actualizar Valor</button>
                                </form>

                        <?php
                            } else {
                                echo '<script>alert("No se encontró la hora extra con el ID proporcionado.");</script>';
                            }
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
                            $id = $_POST['id'];
                            $v_h_extra = $_POST['v_h_extra'];

                            $sql = "UPDATE v_h_extra SET V_H_extra = :v_h_extra WHERE ID = :id";
                            $stmt = $conexion->prepare($sql);
                            $stmt->bindParam(':v_h_extra', $v_h_extra, PDO::PARAM_STR);
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                            if ($stmt->execute()) {
                                echo '<script>alert("El valor de la hora extra ha sido actualizado correctamente."); window.location.href = "../index.php";</script>';
                                exit();
                            } else {
                                $mensaje = "Error al actualizar el valor de la hora extra: " . $stmt->errorInfo()[2];
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
        const editarValorHoraExtraForm = document.getElementById('editarValorHoraExtraForm');
        const v_h_extraInput = document.getElementById('v_h_extra');
        const actualizarValorBtn = document.getElementById('actualizarValorBtn');

        v_h_extraInput.addEventListener('input', validarValorHoraExtra);

        function validarValorHoraExtra() {
            const valor = v_h_extraInput.value.trim();
            if (!/^\d+(\.\d{1,2})?$/.test(valor)) {
                v_h_extraInput.classList.add('is-invalid');
                document.getElementById('v_h_extra_error').textContent = 'Ingrese un valor válido para la hora extra.';
                actualizarValorBtn.disabled = true;
            } else {
                v_h_extraInput.classList.remove('is-invalid');
                document.getElementById('v_h_extra_error').textContent = '';
                actualizarValorBtn.disabled = false;
            }
        }
    </script>
</body>


</html>