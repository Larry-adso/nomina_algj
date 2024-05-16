<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <title>Formulario</title>
</head>

<body>
    <div class="container-form sign-up">
        <div class="welcome-back">
            <div class="message" id="welcomeMessage">
               <h2>Bienvenido a ALG S.A.S</h2>
                <a onclick="showTerms()" class="btn">leer términos</a>
            </div>
        </div>
    </div>
    <div class="container-form sign-in">
        <form class="formulario" action="login1.php" method="POST">
            <h2 class="create-account">Iniciar Sesión</h2>
            <input type="text" name="id_us" placeholder="Documento" pattern="[0-9]{10}" maxlength="10" required>
            <input type="password" placeholder="Contraseña" id="password" name="pass" require>
            <input class="form-check-input" onclick="togglePasswordVisibility()" name="" id="" type="checkbox" value="checkedValue" aria-label="Text for screen reader" />

            <button class="b_estilo">iniciar sesión</button>
            <a class="b_estilo" href="metodos.php">Olvide mi contraseña</a>
        </form>
        <div class="welcome-back">
            <div class="message">
                <h2>Bienvenido de nuevo</h2>
                <p>"Si necesitas asistencia para acceder a tu cuenta o tienes <br> cualquier otro problema relacionado con el inicio de sesión, por favor comunícate con tu administrador."</p>
            </div>
        </div>
    </div>

    <div class="session1" id="session1" style="display: none;">
    <div class="terminos">
    Al utilizar este software, usted acepta estar sujeto a estos términos de uso. Si no está de acuerdo con alguno de estos términos, por favor, no utilice el software.

Aceptación de los Términos de Uso: Al utilizar este software, usted acepta estar sujeto a estos términos de uso. Si no está de acuerdo con alguno de estos términos, por favor, no utilice el software.

Licencia de Uso: El software está protegido por derechos de autor y se le otorga una licencia limitada, no exclusiva, intransferible y revocable para utilizar el software de acuerdo con estos términos.

Uso Aceptable: Usted acepta utilizar el software de manera legal y ética, y se compromete a no utilizarlo para actividades ilegales, fraudulentas o que infrinjan los derechos de terceros.

Propiedad Intelectual: Todos los derechos de propiedad intelectual sobre el software y su contenido pertenecen a ALGJ S.A.S. o a sus licenciantes. Usted acepta no copiar, modificar, distribuir, vender ni realizar ingeniería inversa sobre el software.

Actualizaciones y Mantenimiento: ALGJ S.A.S. puede proporcionar actualizaciones periódicas del software para mejorar su funcionamiento. Usted acepta recibir estas actualizaciones automáticamente.

Privacidad: Al utilizar el software, usted acepta nuestra Política de Privacidad, que describe cómo recopilamos, utilizamos y compartimos su información personal.

Limitación de Responsabilidad: El software se proporciona "tal cual" y ALGJ S.A.S. no ofrece garantías de ningún tipo sobre su funcionamiento. En ningún caso ALGJ S.A.S. será responsable por daños indirectos, incidentales o consecuentes derivados del uso del software.

Modificaciones de los Términos de Uso: ALGJ S.A.S. se reserva el derecho de modificar estos términos en cualquier momento. Las modificaciones entrarán en vigencia al ser publicadas en este documento.

Rescisión: ALGJ S.A.S. puede rescindir su licencia para utilizar el software si viola estos términos de uso. En caso de rescisión, usted deberá dejar de utilizar el software y destruir todas las copias que haya realizado.

Ley Aplicable: Estos términos de uso se regirán e interpretarán de acuerdo con las leyes de Colombia sin tener en cuenta sus conflictos de principios legales.

Al utilizar este software, usted reconoce haber leído, comprendido y aceptado estos términos de uso. Si tiene alguna pregunta o inquietud, por favor contáctenos a SyscPay@gmail.com.

Es importante personalizar estos términos según las características específicas de tu software y la legislación aplicable en tu país o región. Te sugiero buscar asesoramiento legal para asegurarte de que tus términos de uso sean adecuados y cumplidores.
</div>
        <button class="sign-up-btn" onclick="acceptTerms()" id="btn">aceptar términos</button>
        
    </div>

<script src="js/login.js"></script>
<script>
function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}
function showTerms() {
    var welcomeMessage = document.getElementById("welcomeMessage");
    welcomeMessage.style.display = "none";
    var session1 = document.getElementById("session1");
    session1.style.display = "block";
}
</script>
</body>

</html>
