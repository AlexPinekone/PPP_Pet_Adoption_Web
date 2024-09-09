<?php
session_start();
require_once "CAD.php";
$cad = new CAD();

$messages = [];

$idChat = $_SESSION['idChat'];

if($messages = $cad->buscarMensajes($idChat))
{
	foreach ($messages as $message) {
		echo "<p>$message</p><br>";
	}
}
?>