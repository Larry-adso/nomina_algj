<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rol</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7fd910d257.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Editar Rol</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../../conexion/db.php';

                        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                            $id = $_GET['id'];

                            $sql = "SELECT * FROM roles WHERE ID = :id";
                            $stmt = $conexion->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                            $stmt->execute();
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);

                            if ($result) {
                                $valor = $result['Tp_user'];
                        ?>

                        <form action="editar_roles.php" method="post">
                            <div class="form-group">
                                <label for="valor">Nuevo Rol</label>
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                <input type="text" class="form-control" id="Tp_user" name="Tp_user" placeholder="Nuevo Rol" value="<?php echo htmlspecialchars($valor); ?>" required>
                            </div>
                            <button type="submit" name="update" class="btn btn-primary">Actualizar Rol</button>
                        </form>

                        <?php
                            } else {
                                echo '<script>alert("No se encontró el Rol con el ID proporcionado.");</script>';
                            }
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
                            $id = $_POST['id'];
                            $valor = $_POST['Tp_user'];

                            $sql = "UPDATE roles SET Tp_user = :Tp_user WHERE ID = :id";
                            $stmt = $conexion->prepare($sql);
                            $stmt->bindParam(':Tp_user', $valor, PDO::PARAM_STR);
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                            if ($stmt->execute()) {
                                echo '<script>alert("El Rol ha sido actualizado correctamente."); window.location.href = "../index.php";</script>';
                                exit();
                            } else {
                                $mensaje = "Error al actualizar el Rol: " . $stmt->errorInfo()[2];
                                echo '<script>alert("' . $mensaje . '");</script>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
