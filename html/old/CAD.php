<?php

require_once "conexion.php";

class CAD
{
	public $con;
	
	static public function agregaPost($nombre,$sexo,$direccion,$contacto,$descripcion,$etiquetas,$foto)
	{
		
	}
	
	static public function agregaUsuario($nombre,$contrasena,$correo,$tipo,$imagen)
	{
		$con = new Conexion();
		$query = $con->conectar()->prepare("INSERT INTO usuarios(nombreUsuario,contrasena,correo,tipoUsuario,imagen) VALUES('$nombre','$contrasena','$correo','$tipo','$imagen')");
		
		if($query->execute)
		{
			echo "El usuario $nombre se ha agregado correctamente";
			return 1;
		}
		else
		{
			echo "Hubo un error";
			print_r($con->conectar()->errorInfo());
			return 0;
		}
	}
	
	static public function verificaUsuario($nombre,$contrasena)
	{
		$con = new Conexion();
		$query = $con->conectar()->prepare("SELECT * FROM usuario WHERE nombre = '$nombre' and contrasena = '$contrasena' ");
		if($query->execute())
		{
			$row = $query->fetch(PDO::FETCH_NUM);
			if($row)
			{
				return true;
			}
			else
			{
				echo "El usuario no existe";
			}
		}
		else
		{
			return false;
		}
	}
}

?>