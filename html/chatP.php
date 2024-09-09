<?php
	session_start();
	require_once "CAD.php";
	$_SESSION['errlog'] = false;
	
	$cad = new CAD();
	
	if (isset($_GET['idU']))
	{
		$idU = $_GET['idU'];
		$_SESSION['idU'] = $idU;
	}
	
	if (isset($_GET['idD']))
	{
		$idD = $_GET['idD'];
		$_SESSION['idD'] = $idD;
	}
	
	if(isset($_GET['idU']) && isset($_GET['idD']))
	{
		$idChat = $cad->buscarChat($idU,$idD);
		
		if($idChat)
		{										
		$_SESSION['idChat'] = $idChat[0];																			
		}
	}
	
	if(isset($_SESSION['idChat']))
	{
	
	$idChat = $_SESSION['idChat'];
	if(isset($_POST['enviar']))
		{
		unset($_POST['enviar']);
		if (isset($_POST['message'])) {
			$message = $_POST['message'];
			$deQ = $_SESSION['idUsuario'];
			//echo $message;
			if($cad->registrarMensaje($idChat,$message,$deQ))
			{
				$idU= $_SESSION['idU'];
				$idD= $_SESSION['idD'];
				header("Location: chatP.php?idU=$idU&idD=$idD");
			}
			
		}
	}	
	}
	
	if(isset($_POST['actualiza'])){
		$idU= $_SESSION['idU'];
		$idD= $_SESSION['idD'];
		header("Location: chatP.php?idU=$idU&idD=$idD");
	}
	
?>
<html>
	<head>
		<link href="../css/estilo.css" rel="stylesheet" type="text/css">
		<link href="../css/estilo2.css" rel="stylesheet" type="text/css">
		<link href="../css/estilo3.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="../js/funcion.js"></script>
		
		<style>
			#chat-box {
				height: 300px;
				overflow-y: scroll;
				border: 1px solid #ccc;
				padding: 10px;
				background-color:white;
				line-height:30px;
				color:black;
			}
			#messageB{
				width:100%;
				height:40px;
			}
			.me{
				margin-bottom:12px;
				font-weight: bold;
				width:300px;
				border-radius:25px;
				padding:5px;
				padding-left:20px;
				Color:white;
			}
			#enviar{
				width:80%;
			}
			#actualiza{
				width:18%
			}
			
		</style>
		
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

				window.onload = toggleBotones();
			</script>
			<div class="Espacio"></div>
			<div class="Espacio2"></div>
				<div class="Intermedio">
				
				<?php
					
					$datosDueno = $cad->buscaUsuario($idU);
				?>
				<div class="ContHori">
				<div class="Mascota">
					<a href="<?php echo 'perfil.php?idD='.$datosDueno[0] ?>">
						<?php
							echo "<img src='data:image/;base64,".base64_encode($datosDueno[5])."' alt='Mascota'>";
						?>
						<p><?php echo $datosDueno[1]; ?></p>
					</a>
				</div>
				</div>
				
				<div class="Contenedor" id="postp2">
					
					<div id="chat-box">
					
						<?php
						if(isset($_SESSION['idChat']))
						{
						$idChat = $_SESSION['idChat'];
						
						$messages = [];
						
						$cn = 0;

						if($messages = $cad->buscarMensajes($idChat))
						{
							$yo = $_SESSION['idUsuario'];
							foreach ($messages as $message) {
								$men = $message['mensaje'];
								$quien = $message['deQuien'];
								if($quien==$yo)
								{
									echo "<div class='me' style='margin-right:0; margin-left:auto; background-color:#E02900;'>$men</div>";
								}
								else
								{
									echo "<div class='me' style='margin-right:auto; margin-left:0; background-color:#3EBEFA;'>$men</div>";
								}
								
							}
						}
						}
						?>		
					
					</div>
					<form id="enviaMensaje" action="chatP.php" method="POST">
						<input type="text" name="message" id="messageB" placeholder="Escribe tu mensaje">
						<button type="submit" name="enviar" id="enviar">Enviar</button>
						<button type="submit" name="actualiza" id="actualiza">⟳</button>
					</form>
					
					<script>
						var chatBox = document.getElementById('chat-box');
						chatBox.scrollTop = chatBox.scrollHeight;
					</script>
					
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