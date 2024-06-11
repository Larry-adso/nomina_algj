<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estados</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/admin.css">

</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Editar Estados</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        require '../../../conexion/db.php';

                        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                            $id = $_GET['id'];

                            $sql = "SELECT * FROM estado WHERE ID_Es = :id";
                            $stmt = $conexion->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                            $stmt->execute();
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);

                            if ($result) {
                                $valor = $result['Estado'];
                        ?>

                        <form action="editar_estados.php" method="post">
                            <div class="form-group">
                                <label for="Estado">Nuevo Estado</label>
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                <input type="text" class="form-control" id="Estado" name="Estado" placeholder="Nuevo Estado" value="<?php echo htmlspecialchars($valor); ?>" required>
                            </div>
                            <button type="submit" name="update" class="btn btn-primary">Actualizar Estado</button>
                        </form>

                        <?php
                            } else {
                                echo '<div class="alert alert-danger" role="alert">No se encontró el estado con el ID proporcionado.</div>';
                            }
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
                            $id = $_POST['id'];
                            $valor = $_POST['Estado'];

                            $sql = "UPDATE estado SET Estado = :estado WHERE ID_Es = :id";
                            $stmt = $conexion->prepare($sql);
                            $stmt->bindParam(':estado', $valor, PDO::PARAM_STR);
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                            if ($stmt->execute()) {
                                $mensaje = "El Estado ha sido actualizado correctamente.";
                                echo '<script>alert("' . $mensaje . '"); window.location.href = "../index.php";</script>';
                                exit();
                            } else {
                                $mensaje = "Error al actualizar el Estado: " . $stmt->errorInfo()[2];
                                echo '<div class="alert alert-danger" role="alert">' . $mensaje . '</div>';
                            }
                        }

                        if (isset($_GET['mensaje'])) {
                            echo '<div class="alert alert-info" role="alert">' . urldecode($_GET['mensaje']) . '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
