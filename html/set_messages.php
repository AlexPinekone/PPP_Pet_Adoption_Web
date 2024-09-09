<?php
session_start();
require_once "CAD.php";

$idChat = $_SESSION['idChat'];

if (isset($_POST['message'])) {
	$cad = new CAD();

    $message = $_POST['message'];
    		
	$cad->registrarMensajes($idChat,$message);
}
?>