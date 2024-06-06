<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Contactenos</title>
	<link rel="stylesheet" href="../css/styles.css" />

</head>

<body>
	<header>
		<div class="container-hero">
			<div class="container hero">
				<div class="customer-support">
					<i class="fa-solid fa-headset"></i>
					<div class="content-customer-support">
						<span class="text">Soporte al cliente</span>
						<span class="number">+58 318 773 86 47</span>
					</div>
				</div>

				<div class="container-logo">
					<h1 class="logo"><a href="/">NOMINAS SYNCPAY</a></h1>
				</div>

				<div class="container-user">
					<a href="../dev/PHP/login.php"><i class="fa-solid fa-user"></i></a>

				</div>
			</div>
		</div>
		</div>

		<div class="container-navbar">
			<nav class="navbar container">
				<i class="fa-solid fa-bars"></i>
				<ul class="menu">
					<li><a href="../index.php">Inicio</a></li>
					<li><a href="sobre_n.php">Sobre nosotros</a></li>
					<li><a href="contactenos.php">Contactenos</a></li>
				</ul>

				<ul class="menu">
					<li>
						<a href="">Manual</a><i class="fa-solid fa-circle-question"></i>
					</li>
				</ul>
			</nav>
		</div>
	</header>

	<main class="main-content">
		<section class="container container-features">
			<div class="card-feature">
				<i class="fa-solid fa-phone"></i>
				<div class="feature-content">
					<span>+57 318 773 86 47</span>
					<p>Llama cuando quieras</p>
				</div>
			</div>
			<div class="card-feature">
				<i class="fa-solid fa-map"></i>
				<div class="feature-content">
					<span>SENA </span>
					<p>centro de industria y construcción</p>
				</div>
			</div>
			<div class="card-feature">
				<i class="fa-solid fa-envelope"></i>
				<div class="feature-content">
					<span>SyscPay@gmail.com</span>
					<p>Atencion Personalizada</p>
				</div>
			</div>

		</section>

		<section class="container top-categories">
			<h1 class="heading-1">¡Ubicanos!</h1>
			<div class="container-map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3978.048260414706!2d-75.15231862521023!3d4.402072895572057!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e38daac36ef33ef%3A0xc4167c4b60b14a15!2sSENA%20Centro%20de%20Industria%20y%20de%20la%20Construcci%C3%B3n!5e0!3m2!1ses!2sco!4v1715348500820!5m2!1ses!2sco" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
		</section>

		<section class="container top-categories">
			<h1 class="heading-1">Consulta con nosotros!</h1>
			<div class="container-com">
				<form action="contacto.php" method="POST">
					<label for="nombres">
						<h2>Nombres:</h2>
					</label>
					<input type="text" id="nombres" name="nombres" required>
					<label for="correo">
						<h2>Correo:</h2>
					</label>
					<input type="text" id="correo" name="correo" required>
					<label for="telefono">
						<h2>Telefono:</h2>
					</label>
					<input type="text" id="telefono" name="telefono" required>
					<label for="comentario">
						<h2>Comentario:</h2>
					</label>
					<textarea id="comentario" name="comentario" rows="4" required></textarea>
					<button type="submit">Enviar</button>
				</form>

			</div>
		</section>
	</main>

	<footer class="footer">
		<div class="container container-footer">
			<div class="menu-footer">
				<div class="contact-info">
					<p class="title-footer">Información de Contacto</p>
					<ul>
						<li>
							Dirección: 71 Pennington Lane Vernon Rockville, CT
							06066
						</li>
						<li>Teléfono: 123-456-7890</li>
						<li>Fax: 55555300</li>
						<li>EmaiL: baristas@support.com</li>
					</ul>
					<div class="social-icons">
						<span class="facebook">
							<i class="fa-brands fa-facebook-f"></i>
						</span>
						<span class="twitter">
							<i class="fa-brands fa-twitter"></i>
						</span>
						<span class="youtube">
							<i class="fa-brands fa-youtube"></i>
						</span>
						<span class="pinterest">
							<i class="fa-brands fa-pinterest-p"></i>
						</span>
						<span class="instagram">
							<i class="fa-brands fa-instagram"></i>
						</span>
					</div>
				</div>

				<div class="information">
					<p class="title-footer">Información</p>
					<ul>
						<li><a href="#">Acerca de Nosotros</a></li>
						<li><a href="#">Información Delivery</a></li>
						<li><a href="#">Politicas de Privacidad</a></li>
						<li><a href="#">Términos y condiciones</a></li>
						<li><a href="#">Contactános</a></li>
					</ul>
				</div>

				<div class="my-account">
					<p class="title-footer">Mi cuenta</p>

					<ul>
						<li><a href="#">Mi cuenta</a></li>
						<li><a href="#">Historial de ordenes</a></li>
						<li><a href="#">Lista de deseos</a></li>
						<li><a href="#">Boletín</a></li>
						<li><a href="#">Reembolsos</a></li>
					</ul>
				</div>

				<div class="newsletter">
					<p class="title-footer">Boletín informativo</p>

					<div class="content">
						<p>
							Suscríbete a nuestros boletines ahora y mantente al
							día con nuevas colecciones y ofertas exclusivas.
						</p>
						<input type="email" placeholder="Ingresa el correo aquí...">
						<button>Suscríbete</button>
					</div>
				</div>
			</div>

			<div class="copyright">
				<p>
					Desarrollado por Programación para el mundo &copy; 2022
				</p>

				<img src="img/payment.png" alt="Pagos">
			</div>
		</div>
	</footer>

	<script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
</body>

</html>