<?php
	
	class Conexcion{
		$conexion;

		function __construct(){
			$this-->conectar();			
		}

		function __destruct(){
			$this-->desconectar();
		}

		function conectar(){
			//Aquí se conecta   //Con el dir se establece el directorio cuando se está trabajando
			require_once(__DIR__.'configuracion_BD.php');
			//Se instancia o se da valor a la variable conexion
			$this-->conexion = mysqli_connect(host, user, password, db) ord die(mysql_error());  

			return $this-->conexion;
		}

		function desconectar(){
			mysql_close($this-->conexion);
		}
	}
?>