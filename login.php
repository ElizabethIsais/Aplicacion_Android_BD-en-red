<?php
	if( !($conexion = mysqli_connect("127.0.0.1", "root", "", "usuarios_prog_web_escuela") or die(mysql_error())));

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		//Se recibe a traves de la funcion file get, se agrega el formato por el cual se va a recibir dicha cadena, en este caso de pho
		$cadena_json = file_get_contents('php://input'); //Recibe datos por http, en este caso es una cadena json

		$datos = json_decode($cadena_json, true);  //Se decodifican los datos en cadena json, decode tambien regresa un vector

		$nombre = $datos['n'];
		$password = $datos['p'];

	$sql = "SELECT * FROM registro WHERE Nombre_Usuario = '$nombre' AND Password_Usuario = '$password'"; 
	$resultado = mysqli_query($conexion, $sql);

	$respuesta = array();

		if($resultado){
			$respuesta['exito'] = 1;
			$respuesta['msj'] = "Acceso Correcta";
			echo json_encode($respuesta);
		}
		else{
			$respuesta['exito'] = 0;
			$respuesta['msj'] = "Acceso Incorrecto";
			echo json_encode($respuesta);
		}




	/*if(mysqli_num_rows($resultado)==1){
		$respuesta['exito'] = 1;
			$respuesta['msj'] = "Acceso Correcto";
			echo json_encode($respuesta);
		/*session_start();
		$_SESSION['activo'] = 1; 
		$_SESSION['Nombre_Usuario'] = strtoupper($nombre); //strtoupper
		header("Location: ../../paginas_html/Menu_ABCC.html"); 
	} 
	else{ 
    			$respuesta['exito'] = 0;
			$respuesta['msj'] = "Error en el acceso";
			echo json_encode($respuesta);
	} */
 }
?>
