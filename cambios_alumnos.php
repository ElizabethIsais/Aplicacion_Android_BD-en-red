<?php
	
	if( !($conexion = mysqli_connect("127.0.0.1", "root", "", "escuela_prog_web") or die(mysql_error())));

	//echo json_encode($conexion);

	//Se confirma el metodo de envio de datos
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		//Se recibe a traves de la funcion file get, se agrega el formato por el cual se va a recibir dicha cadena, en este caso de pho
		$cadena_json = file_get_contents('php://input'); //Recibe datos por http, en este caso es una cadena json

		$datos = json_decode($cadena_json, true);  //Se decodifican los datos en cadena json, decode tambien regresa un vector

		$nc = $datos['nc'];
		$n = $datos['n'];
		$pa = $datos['pa'];
		$sa = $datos['sa'];
		$e = $datos['e'];
		$s = $datos['s'];
		$c = $datos['c'];

		$sql = "UPDATE alumnos SET Nombre_Alumno = '$n', Primer_Ap='$pa', Segundo_Ap ='$sa', Edad_Alumno = $e, Semestre_Alumno = $s, Carrera_Alumno = '$c' WHERE Num_Control = '$nc' ";

		echo json_encode($sql);

		$resultado = mysqli_query($conexion, $sql);

		$respuesta = array();

		if($resultado){
			$respuesta['exito'] = 1;
			$respuesta['msj'] = "Modificacion Correcta";
			echo json_encode($respuesta);
		}
		else{
			$respuesta['exito'] = 0;
			$respuesta['msj'] = "Error en la Modificacion";
			echo json_encode($respuesta);
		}
	}


?>