<?php
session_start();
if (!isset($_SESSION['id_us']) || ($_SESSION['id_rol'] != 5 && $_SESSION['id_rol'] != 7)) {
    echo '
            <script>
                alert("Por favor inicie sesión e intente nuevamente");
                window.location = "../../modulo_larry/PHP/login.php";
            </script>
            ';
    session_destroy();
    die();
}
?>
