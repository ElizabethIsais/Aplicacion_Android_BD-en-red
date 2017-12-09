<?php
	
	if( !($conexion = mysqli_connect("127.0.0.1", "root", "", "escuela_prog_web") or die(mysql_error())));

	//echo json_encode($conexion);
	$respuesta = array();



	//Se confirma el metodo de envio de datos
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		//Se recibe a traves de la funcion file get, se agrega el formato por el cual se va a recibir dicha cadena, en este caso de pho
		$cadena_json = file_get_contents('php://input'); //Recibe datos por http, en este caso es una cadena json

		$datos = json_decode($cadena_json, true);  //Se decodifican los datos en cadena json, decode tambien regresa un vector

		$nc = $datos['nc'];
		$n = $datos['n'];
		$pa = $datos['pa'];

		$sql = "SELECT * FROM  Alumnos WHERE Num_Control = '$nc' OR Nombre_Alumno = '$n' OR Primer_Ap = '$pa'";
		echo json_encode($sql);

		$consulta = mysqli_query($conexion, $sql);


			//Contamos los resultados que haya traido la columna
		//Si el num de filas de la consulta es mayor a 0, es decir, que si encontro registros
		if(mysqli_num_rows($consulta) > 0){
		//Se crea  la cadena que va a ser decodificada en json
		//Se crea un arreglo de arreglos

		$respuesta["alumnos"] = array();

		//Mientras fila tenga valor, entra al ciclo
		while ($fila = mysqli_fetch_assoc($consulta) ) {

			//Se crean pequeños arreglos dentro del arreglo alumnos, para almacenar cada uno de los alumnos
			$alumno = array();

			$alumno["nc"] = $fila['Num_Control'];
			$alumno["n"] = $fila['Nombre_Alumno'];
			$alumno["pa"] = $fila['Primer_Ap'];
			$alumno["sa"] = $fila['Segundo_Ap'];
			$alumno["e"] = $fila['Edad_Alumno'];
			$alumno["s"] = $fila['Semestre_Alumno'];
			$alumno["c"] = $fila['Carrera_Alumno'];

			array_push($respuesta["alumnos"], $alumno);  //Se llena vector respues, con los arreglos de cada alumno
		}

		$respuesta['exito'] = 1;
		echo json_encode($respuesta);
	}
		else{
			$respuesta['exito'] = 0;
			$respuesta['msj'] = "No hay registros";
			echo json_encode($respuesta);
		}
	}


?>