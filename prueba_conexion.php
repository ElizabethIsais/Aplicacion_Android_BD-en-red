<?php
	
	//require_once('conexion_BD.php');  //archivo de conexion;

	//$conexion = new Conexion();

	$conexion = mysqli_connect("127.0.0.1", "root", "", "escuela_prog_web") or die(mysql_error());

	$respuesta = array();

	$sql = "SELECT * FROM  Alumnos";
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
		$respuesta['msj'] = "No hay Registros";
		echo json_encode($respuesta);
	}
?>