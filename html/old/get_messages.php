<?php
session_start();
require_once "CAD.php";

$cad = new CAD();

$idU = $_SESSION['idU'];
$idD = $_SESSION['idD'];
		
$idChat = $cad->buscarChat($idU,$idD);
$messages = [];

if($idChat)
{
	$_SESSION['idChat'] = $idChat;
	$messages = $cad->buscarMensajes($idChat);
}

foreach ($messages as $message) {
    echo "<p>$message</p><br>";
}
?>