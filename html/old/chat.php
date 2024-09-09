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
	
	$idChat = $cad->buscarChat($idU,$idD);
	
	if($idChat)
	{										
	$_SESSION['idChat'] = $idChat[0];																			
	}
	
	$_SESSION['A'] = 0;
?>
<html>
	<head>
		<link href="../css/estilo.css" rel="stylesheet" type="text/css">
		<link href="../css/estilo2.css" rel="stylesheet" type="text/css">
		<link href="../css/estilo3.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="../js/funcion.js"></script>
		
		<style>
        /* Estilos CSS para el chat */
        #chat-box {
            height: 300px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
			background-color:white;
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

				// Llama a la función cuando la página se carga
				window.onload = toggleBotones();
			</script>
			<div class="Espacio"></div>
			<div class="Espacio2"></div>
				<div class="Intermedio">
			
				<div class="Contenedor" id="postp2">
					
					<div id="chat-box"></div>
					<input type="text" id="message" placeholder="Escribe tu mensaje">
					<button onclick="sendMessage()">Enviar</button>
					
					<?php
					
						
					?>
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
					<script type="text/javascript">
					
						function loadMessages() {
							$.ajax({
								type: "GET",
								url: "get_messages.php",
								success: function(response) {
									$("#chat-box").html(response);
									var idU = <?php echo isset($_SESSION['A']) ? $_SESSION['A'] : 'null'; ?>;
									console.log("AYUDA "+idU);
								}
							});
						}

						function sendMessage() {
							var message = document.getElementById("message").value;
							if (message !== "") {
								$.ajax({
									type: "POST",
									url: "set_messages.php",
									data: { message: message },
									success: function(response) {
										document.getElementById("message").value = "";
									}
								});
							}
						}

						//setInterval(recibirMensajes, 1000);

						$(document).ready(function() {
							loadMessages();
							setInterval(loadMessages, 3000);
						});
					
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