<?php

require_once "conexion.php";

class CAD
{
	public $con;
	
	static public function agregaPost($usuario,$nombre,$sexo,$direccion,$contacto,$descripcion,$etiquetas,$foto)
	{
		$con = new Conexion();
		$query = $con->conectar()->prepare("INSERT INTO posts(idUsuario,nombre,sexo,direccion,contacto,descripcion,foto,etiquetas) VALUES ($usuario,'$nombre','$sexo','$direccion','$contacto','$descripcion','$foto','$etiquetas')");
	
		if($query->execute())
		{
			return 1;
		}
		else{
			print_r($con->conectar()->errorInfo());
			return 0;
		}
	}
	
	static public function agregaUsuario($nombre,$contrasena,$correo,$tipo,$imagen)
	{
		$con = new Conexion();
		
		$query = $con->conectar()->prepare("SELECT * FROM usuarios WHERE nombreUsuario = '$nombre' ");
		
		if($query->execute())
		{
			
			$row = $query->fetch(PDO::FETCH_NUM);
			if($row[0]=="")
			{
				$query = $con->conectar()->prepare("INSERT INTO usuarios(nombreUsuario, contrasena, correo, tipoUsuario, imagen) VALUES('$nombre','$contrasena','$correo',$tipo,'$imagen')");
		
				if($query->execute())
				{	
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return 0;
			}
			return 1;
		}
		else
		{
			return 0;
		}
		
	}
	
	static public function verificaUsuario($nombre, $contrasena)
	{
		$con = new Conexion();
		$query = $con->conectar()->prepare("SELECT * FROM usuarios WHERE nombreUsuario = '$nombre' AND contrasena = '$contrasena' ");
		if($query->execute())
		{
			$row = $query->fetch(PDO::FETCH_NUM);
			if($row)
			{
				//echo $row[0]." - ".$row[1]." - ".$row[2]." - ".$row[3];
				return $row[0];
			}
			else
			{
				//echo "El usuario no existe";
			}
			
			/*while($row = $query->fetch(PDO::FETCH_ASSOC))
			{
				$datos[] = $row;
			}*/
		}
		else
		{
			return false;
		}
	}
	
	static public function buscaUsuario($id)
	{
		$con = new Conexion();
		$query = $con->conectar()->prepare("SELECT * FROM usuarios WHERE idUsuario = $id ");
		if($query->execute())
		{
			$row = $query->fetch(PDO::FETCH_NUM);
			if($row)
			{
				//echo $row[0]." - ".$row[1]." - ".$row[2]." - ".$row[3];
				return $row;
			}
			else
			{
				return 0;
				//echo "El usuario no existe";
			}
		}
		else
		{
			return 0;
		}
	}
	
	static public function obtenerMascota($id)
	{
		$con = new Conexion();
		$query = $con->conectar()->prepare("SELECT * FROM posts WHERE idPost = $id ");
		if($query->execute())
		{
			$row = $query->fetch(PDO::FETCH_NUM);
			if($row)
			{
				//echo $row[0]." - ".$row[1]." - ".$row[2]." - ".$row[3];
				return $row;
			}
			else
			{
				return 0;
				//echo "El usuario no existe";
			}
		}
		else
		{
			return 0;
		}
	}
	
	static public function obtenerVariasMascotas()
	{
		$con = new Conexion();
		$query = $con->conectar()->prepare("SELECT * FROM posts ");
		if($query->execute())
		{
			$datos = [];
			
			while($row = $query->fetch(PDO::FETCH_ASSOC))
			{
				$datos[] = $row;
			}
			
			if($datos)
			{
				return $datos;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
	
	
	static public function traePosts($idU)
	{
		$con = new Conexion();
		$query = $con->conectar()->prepare("SELECT * FROM posts WHERE idUsuario = $idU ORDER BY idPost ASC");
		if($query->execute())
		{
			$datos = [];
			
			while($row = $query->fetch(PDO::FETCH_ASSOC))
			{
				$datos[] = $row;
			}
			
			return $datos;
		}
		else
		{
			return false;
		}
	}
	
	static public function eliminaPost($idPost)
	{
		$con = new Conexion();
		$query = $con->conectar()->prepare("DELETE FROM posts WHERE idPost = $idPost");
		
		if($query->execute())
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	static public function editarPost($datosModificar,$idPost)
	{
		$con = new Conexion();
		$query = $con->conectar()->prepare("UPDATE posts SET $datosModificar WHERE idPost = $idPost");
		
		if($query->execute())
		{
			return 1;
		}
		else
		{
			echo "Error";
			return 0;
		}
	}
	
	static public function buscarMascotas($termino)
	{
		$con = new Conexion();
		$query = $con->conectar()->prepare("SELECT * FROM posts WHERE nombre LIKE '%$termino%'");
		if($query->execute())
		{
			$datos = [];
			
			while($row = $query->fetch(PDO::FETCH_ASSOC))
			{
				$datos[] = $row;
			}
			
			if($datos)
			{
				return $datos;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
	
	static public function buscarMascotasEtiqueta($etiqueta)
	{
		$con = new Conexion();
		$query = $con->conectar()->prepare("SELECT * FROM posts WHERE etiquetas LIKE '%$etiqueta%'");
		if($query->execute())
		{
			$datos = [];
			
			while($row = $query->fetch(PDO::FETCH_ASSOC))
			{
				$datos[] = $row;
			}
			
			if($datos)
			{
				return $datos;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
	
	
	static public function buscarChat($idUsu, $idDue)
	{
		$con = new Conexion();
		$query = $con->conectar()->prepare("SELECT * FROM chats WHERE idUsuario='$idUsu' AND idDueno='$idDue'");
		if($query->execute())
		{
			$row = $query->fetch(PDO::FETCH_NUM);
			if($row)
			{
				return $row;
			}
			else
			{
				$insertQuery = $con->conectar()->prepare("INSERT INTO chats (idUsuario, idDueno) VALUES ('$idUsu', '$idDue')");
				if($insertQuery->execute())
				{
					
					$query2 = $con->conectar()->prepare("SELECT * FROM chats WHERE idUsuario='$idUsu' AND idDueno='$idDue'");
					$query2->execute();
					$row = $query2->fetch(PDO::FETCH_NUM);
					return $row;
				}
				else
				{
					return 0;
				}
			}
		}
		else
		{
			return 0;
		}
	}
	
	static public function buscarMensajes($idChat)
	{
		$con = new Conexion();
		$query = $con->conectar()->prepare("SELECT mensaje,deQuien FROM mensajes WHERE idChat='$idChat' ORDER BY num ASC");
		if($query->execute())
		{
			$datos = [];
			
			while($row = $query->fetch(PDO::FETCH_ASSOC))
			{
				$datos[] = $row;
			}
			
			if($datos)
			{
				return $datos;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
	
	static public function registrarMensaje($idChat,$mensaje,$deQ)
	{
		$con = new Conexion();
		$query = $con->conectar()->prepare("INSERT INTO mensajes(idChat,mensaje,deQuien) VALUES($idChat,'$mensaje',$deQ) ");
		
		if($query->execute())
		{
			return 1;
		}
		else
		{
			echo "Hubo un error";
			print_r($con->conectar()->errorInfo());
			return 0;
		}
	}
	
	static public function obtenerVariosChats($idU)
	{
		$con = new Conexion();
		$query = $con->conectar()->prepare("SELECT * FROM chats where idDueno=$idU");
		if($query->execute())
		{
			$datos = [];
			
			while($row = $query->fetch(PDO::FETCH_ASSOC))
			{
				$datos[] = $row;
			}
			
			if($datos)
			{
				return $datos;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
}

?>