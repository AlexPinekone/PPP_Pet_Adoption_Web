<?php
	require_once "CAD.php";
	session_start();
	$_SESSION['errlog'] = false;
	
	$soyyo=0;
	
	if (isset($_GET['id']))
	{
		$id = $_GET['id'];
		$cad = new CAD();
		
		$infoMascota = [];
		
		$infoMascota = $cad->obtenerMascota($id);
		$idD = $infoMascota[1];
		$_SESSION['otro'] = $idD;
		$_SESSION['mascotaAct']=$id;
		
		if(isset($_SESSION['idUsuario']))
		{
			$idUsuario = $_SESSION['idUsuario'];
			if($idUsuario == $idD)
		{
			$soyyo=1;
		}
		}
		
	}

	

	if(isset($_POST['chat'])) {
        
		$idUsuario = $_SESSION['idUsuario'];
		$otro = $_SESSION['otro'];
		
        header("Location: chat.php?idU=$idUsuario&idD=$otro ");
    }
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
				<div class="postcont">
					<div class="Contenedor" id="postp0">
						<?php
							echo "<img src='data:image/;base64,".base64_encode($infoMascota[7])."' alt='Foto Mascota'>";
						?>
						
					</div>
					<div class="Contenedor" id="postp1">
					<div class="pDato">
						<div class="datoT">Nombre: </div>
						<?php
							echo "<div class='datoD' id='modNom'>$infoMascota[2] </div>";
						?>
					</div>
					
					<div class="pDato">
						<div class="datoT">Sexo: </div>
						<?php
							echo "<div class='datoD' id='modSe'>$infoMascota[3] </div>";
						?>
					</div>
					
					<div class="pDato">
						<div class="datoT">Dirección: </div>
						<?php
							echo "<div class='datoD' id='modDir'>$infoMascota[4] </div>";
						?>
					</div>
					<div class="pDato">
						<div class="datoT">Contacto: </div>
						<?php
							echo "<div class='datoD' id='modTel'>$infoMascota[5] </div>";
						?>
					</div>
					</div>
				</div>
				<div class="Contenedor" id="postp2">
					<div class="tituloDes">
						<h2>Descripción</h2>
					</div>
						<?php
							echo "<div class='textoDes' id='texDes'>$infoMascota[6] </div>";
						?>
					<div class="imagenDes">
						<?php
							echo "<img src='data:image/;base64,".base64_encode($infoMascota[7])."' alt='Foto Mascota'>";
						?>
					</div>
				</div>
				
				<div class="Contenedor" id="etiquetas">
					<div class="cajaEtiquetas">
						<?php
							$etiquetas = str_split($infoMascota[8]);
							
							 $etiquetas_map = array(
								'A' => 'Perro',
								'B' => 'Gato',
								'C' => 'Pajaro',
								'D' => 'Roedor',
								'E' => 'Macho',
								'F' => 'Hembra',
								'G' => 'Juguetón',
								'H' => 'Discapacitado',
								'I' => 'Cariñoso',
								'J' => 'Protector',
								'K' => 'Tranquilo',
								'L' => 'Pequeño',
							
							);
							
							foreach ($etiquetas as $letra) {
								if (array_key_exists($letra, $etiquetas_map)) {
									$etiqueta = $etiquetas_map[$letra];
									echo "<a href='resultadosBusqueda.php?etiqueta=$letra'><div class='etiqueta'>$etiqueta</div></a>";
								}
							}
						
						?>
					</div>
				</div>
				
				<div class="botFin" id="botContactarDue">
				<form id="contactaD" action="postx.php" method="POST">
					<?php if($soyyo==0 && isset($_SESSION['idUsuario'])){
						echo "<button type='submit' name='chat' value='chat'>Contactar al Dueño</button>";
						}
					?>
				</form>
				</div>

				<div class="botFin" id="botEditarPost">
				<button type="editarp">Editar el post</button>
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