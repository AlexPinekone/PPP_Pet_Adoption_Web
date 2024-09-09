	<?php
	require_once "CAD.php";
	session_start();

	if(isset($_POST['username']) && isset($_POST['password']))
	{
		$nombre = $_POST['username'];
		$contrasena = $_POST['password'];
		
		$cad = new CAD();
		if($idU = $cad->verificaUsuario($nombre, $contrasena))
		{
			$_SESSION['usuario'] = $nombre;
			$_SESSION['iniciada'] = true;
			$_SESSION['idUsuario'] = $idU;
			header("Location: ../index.php");
		}
		else
		{
			$_SESSION['errlog'] = true;
			header("login.php");
		}
	}

	unset($_POST['username']);
	unset($_POST['password']);

	?>

<html>
	<head>
		<link href="../css/estilo.css" rel="stylesheet" type="text/css">
		<link href="../css/estilo2.css" rel="stylesheet" type="text/css">
		<link href="../css/estilo3.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="../js/funcion.js"></script>
	</head>
	<body>
		
		<div class="Principal">
			<div class="Menu">
				<div class="Logo">
					<a href="../index.php"><img src="../img/LogoP.png"/></a>
				</div>
				<button id="menu-btn" aria-label="Menú desplegable">&#9776;</button>
				<nav id="menu">
				<div class="Enlaces" id="en1">
					<ul class="ListaB">
						<li><a href="../index.php"><div class="b">Inicio</div></a></li>
						<li><a href="posts.php"><div class="b">Posts</div></a></li>
						<li><a href="buscar.php"><div class="b">Buscar</div></a></li>
					</ul>
					
					</div>
					<div class="Enlaces" id="en2">
					
					<ul class="ListaB">
						<li id="creapostbot"><a href="crearpost.php"><div class="b">Crear Post</div></a></li>
						<li id="perfilboton"><a href="perfilpersonal.php"><div class="b">Perfil</div></a></li>
						<li id="botEscon1"><a href="login.php"><div class="b">Ingresar</div></a></li>
						<li id="botEscon2"><a href="register.php"><div class="b">Registrarse</div></a></li>
					</ul>
				</div>
				</nav>
			</div>
			<script>
				// Verifica si la sesión está iniciada
				var sesionIniciada = <?php echo isset($_SESSION['iniciada']) && $_SESSION['iniciada'] ? 'true' : 'false'; ?>;

				// Función para mostrar u ocultar los botones
				function toggleBotones() {
					var bot1 = document.getElementById('botEscon1');
					var bot2 = document.getElementById('botEscon2');
					var crea = document.getElementById('creapostbot');
					var perfil = document.getElementById('perfilboton');
					
					if (sesionIniciada) {
						crea.style.display = 'block';
						perfil.style.display = 'block';
						bot1.style.display = 'none';
						bot2.style.display = 'none';
					} else {
						bot1.style.display = 'block';
						bot2.style.display = 'block';
						crea.style.display = 'none';
						perfil.style.display = 'none';
					}
				}

				// Llama a la función cuando la página se carga
				window.onload = toggleBotones();
			</script>
			<div class="Espacio"></div>
			<div class="Espacio2"></div>
				<div class="Intermedio">
					
				<div class="Contenedor" id="log">
					<h2>Inicio de Sesión</h2>
					
					<form id="loginForm" action="login.php" method="POST">
						<div class="input-group">
							<label for="username">Usuario</label>
							<input type="text" id="username" name="username" placeholder="Introduce el usuario">
						</div>
						<div class="input-group">
							<label for="password">Contraseña</label>
							<input type="password" id="password" name="password" placeholder="Introduce la contraseña">
						</div>
						<?php
							if($_SESSION['errlog']){
								echo "<span style='color:white; font-weight:bold;'>Datos Incorrectos</span><br>";
							}
						?>
						<button type="submit" value="Iniciar Sesion">Iniciar Sesión</button>
					</form>
				</div>
					
				</div>
				<script type="text/javascript" src="../js/menudes.js"></script>
			<div class="Pie">
				<div class="Informacion">
					<h3>Contacto</h3>
					<p>Correo electrónico: info@pawspiespets.com</p>
					<p>Teléfono: +42 123 1234</p>
					<p>Dirección: #42 Calle Juan, San Luis Potosí, México</p>
				</div>
				<div class="EnlacesPie">
					<h3>Enlaces útiles</h3>
					<ul>
						<li><a href="pdp.html">Política de privacidad</a></li>
						<li><a href="tyc.html">Términos y condiciones</a></li>
						<li><a href="pf.html">Preguntas Frecuentes</a></li>
					</ul>
				</div>
				<div class="RedesSociales">
					<h3>Síguenos en redes sociales</h3>
					<ul>
						<li><a href="www.facebook.com"><img src="../img/facebook.png" alt="Facebook"></a></li>
						<li><a href="www.x.com"><img src="../img/x.png" alt="X"></a></li>
						<li><a href="www.instagram.com"><img src="../img/instagram.png" alt="Instagram"></a></li>
					</ul>
				</div>
			</div>
		</div>
		</div>
	</body>	
</html>