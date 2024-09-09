<?php
	#class
	class Conexion{
		#Atributos
		private $host;
		private $db;
		private $usuario;
		private $pass;
		private $charset;
		
		#Constructor
		public function __construct()
		{
			$this->host = 'localhost';
			$this->db = 'pawspiespets';
			$this->usuario ='root';
			$this->pass = '';
			$this->charset = 'utf8';
		}
		
		#Metodo Conectar
		public function conectar()
		{
			#Conectar a la BD -> PDO
			$com = "mysql:host".$this->host.";dbname=".$this->db.";charset=".$this->charset;
			$enlace = new PDO($com,$this->usuario,$this->pass);
			return $enlace;
		}
		
	}
?>