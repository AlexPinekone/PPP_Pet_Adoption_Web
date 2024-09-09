<?php
	require_once "CAD.php";
	session_start();
	$_SESSION['errlog'] = false;
	
	
	$cad = new CAD();
	if(isset($_POST['nombre']) && isset($_POST['sexo']) && isset($_POST['ciudad']) && isset($_POST['contacto']) && isset($_POST['descripcion']))
	{
		if(!empty($_FILES['imagen']['tmp_name']))
		{
			$imagen = $_FILES['imagen']['tmp_name'];
			$imagenContent = addslashes(file_get_contents($imagen));
			
			$idUsuario = $_SESSION['idUsuario'];
			$nombre = $_POST['nombre'];
			$sexo = $_POST['sexo'];
			$ciudad = $_POST['ciudad'];
			$contacto = $_POST['contacto'];
			$descripcion = $_POST['descripcion'];
			
			$etiquetas = "";
			
			$etiquetasArray = array(
				'etiquetaA' => 'A',
				'etiquetaB' => 'B',
				'etiquetaC' => 'C',
				'etiquetaD' => 'D',
				'etiquetaE' => 'E',
				'etiquetaF' => 'F',
				'etiquetaG' => 'G',
				'etiquetaH' => 'H',
				'etiquetaI' => 'I',
				'etiquetaJ' => 'J',
				'etiquetaK' => 'K',
				'etiquetaL' => 'L'
			);
			
			foreach ($etiquetasArray as $nombreEtiqueta => $valor) {
				
				if(isset($_POST[$nombreEtiqueta])) {
					$etiquetas .= $valor;
				}
			}
			
			if($cad->agregaPost($idUsuario,$nombre,$sexo,$ciudad,$contacto,$descripcion,$etiquetas,$imagenContent))
			{
				header("Location: ../index.php");
			}
			else
			{
				header("crearpost.php");
			}
		}
	}
	
	unset($_POST['nombre']);
	unset($_POST['sexo']);
	unset($_POST['ciudad']);
	unset($_POST['contacto']);
	unset($_POST['descripcion']);

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
					<div class="Contenedor" id="npos">
						<h2>Nuevo Post</h2>
						<form id="formularioPost" enctype="multipart/form-data" action="crearpost.php" method="POST">
							<div class="input-group">
								<label for="nombre">Nombre:</label>
								<input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre">
							</div>
							<div class="input-group">
								<label for="sexo">Sexo:</label>
								<select id="sexo" name="sexo">
									<option value="macho">Macho</option>
									<option value="hembra">Hembra</option>
								</select>
							</div>
							<div class="input-group">
								<label for="ciudad">Ciudad:</label>
								<input type="text" id="ciudad" name="ciudad" placeholder="Ingrese la ciudad">
							</div>
							<div class="input-group">
								<label for="contacto">Contacto:</label>
								<input type="text" id="contacto" name="contacto" placeholder="Ingrese el número de contacto">
							</div>
							<div class="input-group">
								<label for="descripcion">Descripción:</label>
								<textarea id="descripcion" name="descripcion" placeholder="Ingrese una descripción"></textarea>
							</div>
								<label>Etiquetas:</label>
							<div class="input-group etiquetaF">
								
								<input type="checkbox" id="etiquetaA" name="etiquetaA" value="etiquetaA">
								<label for="etiqueta1">Perro</label>

								<input type="checkbox" id="etiquetaB" name="etiquetaB" value="etiquetaB">
								<label for="etiqueta2">Gato</label>
								
								<input type="checkbox" id="etiquetaC" name="etiquetaC" value="etiquetaC">
								<label for="etiqueta2">Pajaro</label>
								
								<input type="checkbox" id="etiquetaD" name="etiquetaD" value="etiquetaD">
								<label for="etiqueta2">Roedor</label>
								
								<input type="checkbox" id="etiquetaE" name="etiquetaE" value="etiquetaE">
								<label for="etiqueta2">Macho</label>
								
								<input type="checkbox" id="etiquetaF" name="etiquetaF" value="etiquetaF">
								<label for="etiqueta2">Hembra</label>
								
								<input type="checkbox" id="etiquetaG" name="etiquetaG" value="etiquetaG">
								<label for="etiqueta2">Juguetón</label>

								<input type="checkbox" id="etiquetaH" name="etiquetaH" value="etiquetaH">
								<label for="etiqueta2">Discapacitado</label>
								
								<input type="checkbox" id="etiquetaI" name="etiquetaI" value="etiquetaI">
								<label for="etiqueta2">Cariñoso</label>
								
								<input type="checkbox" id="etiquetaJ" name="etiquetaJ" value="etiquetaJ">
								<label for="etiqueta2">Protector</label>
								
								<input type="checkbox" id="etiquetaK" name="etiquetaK" value="etiquetaK">
								<label for="etiqueta2">Tranquilo</label>
								
								<input type="checkbox" id="etiquetaL" name="etiquetaL" value="etiquetaL">
								<label for="etiqueta2">Pequeño</label>
							</div>
							
							<div class="input-group">
								<label for="imagen">Imagen:</label>
								<input type="file" id="imagen" name="imagen">
							</div>
							<button type="submit" value="crear post">Crear post</button>
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
						<li><a href="pdp.php">Política de privacidad</a></li>
						<li><a href="tyc.php">Términos y condiciones</a></li>
						<li><a href="pf.php">Preguntas Frecuentes</a></li>
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