<?php
class base_datos {
	private $host;
	private $usua;
	private $pass;
	private $bd;

	private $conexion;

	function __construct($host, $usua, $pass, $bd) {
		$this->host = $host;
		$this->usua = $usua;
		$this->pass = $pass;
		$this->bd = $bd;
	}

	function conectar() {
		$this->conexion = mysqli_connect($this->host,$this->usua,$this->pass,$this->bd);
		$this->conexion->set_charset("utf8");
		if (mysqli_connect_errno()) {
			echo "Error al conectarse!";
		}
	}

	//Esta funcion crea tablas si le damos el nombre del curso
	function crear($curso) {
		$comand = "CREATE TABLE " . $curso . "_asistencia (cui INT(8) PRIMARY KEY, nombres VARCHAR(100), apellidos VARCHAR(100), hora_1 VARCHAR(100), hora_2 VARCHAR(100));";
		mysqli_query($this->conexion, $comand);
		$error = mysqli_error($this->conexion);

		$comand = "CREATE TABLE " . $curso . "_calificaciones (cui INT(8) PRIMARY KEY, nombres VARCHAR(100), apellidos VARCHAR(100), EP_1 FLOAT(20), EP_2 FLOAT(20), EP_3 FLOAT(20), EC_1FLOAT(20), EC_2 FLOAT(20), EC_3 FLOAT(20), NF FLOAT(20));";
		mysqli_query($this->conexion, $comand);
		$error = mysqli_error($this->conexion);

		$comand = "INSERT INTO `cursos`(`nombre`) VALUES ('". $curso . "')";
		mysqli_query($this->conexion, $comand);
		$error = mysqli_error($this->conexion);

		if (empty($error)) {
			return true;
		}
		echo "Error al crear tabla!";
		return false;
	}

	//Obtiene todos los datos de los estudiantes de la tabla de datos, se le brinda el código del curso y el turno
	function getEstudiantes($codcursoturn) {
		$result = mysqli_query($this->conexion, "SELECT * FROM `".$codcursoturn."_datos`");
		$error = mysqli_error($this->conexion);
		if (empty($error)) {
			if (mysqli_num_rows($result) > 0) {
				return $result;
			}
		} else {
			echo "Error al obtener estudiantes!";
		}
		return null;
	}

	//Obtiene los usuarios de la base de datos
	function getUsuarios() {
		$result = mysqli_query($this->conexion, "SELECT * FROM usuarios");
		$error = mysqli_error($this->conexion);
		if (empty($error)) {
			if (mysqli_num_rows($result) > 0) {
				return $result;
			}
		} else {
			echo "Error al obtener usuarios!";
		}
		return null;
	}

	//Insertamos un nuevo día para tomar asistencia y aumentamos las horas en la tabla cursos
	function inssesion($codcursoturn) {
		$Date = date('d_m_Y',time());
		mysqli_query($this->conexion, "ALTER TABLE $codcursoturn" . "_asistencia" ." ADD $Date CHARACTER NULL");
		mysqli_query($this->conexion, "UPDATE cursos SET total_Horas = total_Horas + 1 WHERE codigo = '$codcursoturn'");
		$error = mysqli_error($this->conexion);

		if (empty($error)) {
			return true;
		}
		echo "Error al ingresar sesion!";
		return false;
	}

	//Inserta la asistencia de un alumno en una clase
	function insasistenciaclase($codcursoturn, $valor, $sesion, $ident) {
		$comand = "UPDATE $codcursoturn" . "_asistencia " . "SET $sesion = '$valor' WHERE cui = '$ident'";
		mysqli_query($this->conexion, $comand);
		$error = mysqli_error($this->conexion);

		
		if ($valor == 'P') {
			$comand = "UPDATE $codcursoturn" . "_datos " . " SET total_Asistencia = total_Asistencia + 1 WHERE cui = '$ident'";
			mysqli_query($this->conexion, $comand);
			$error = mysqli_error($this->conexion);
		}

		if (empty($error)) {
			return true;
		}
		echo "Error al insertar valores!";
		return false;
	}

	//Ingresa una sola nota de un alumno a un solo campo, además compara con las mayor y menor nota
	function insnota($codcursoturn, $valor, $campo, $ident) {
		if ($valor === NULL) {
			$comand = "UPDATE $codcursoturn" . "_calificaciones SET $campo = NULL WHERE cui = '$ident'";
		} else {
			$comand = "UPDATE $codcursoturn" . "_calificaciones SET $campo = '$valor' WHERE cui = '$ident'";
		}
		mysqli_query($this->conexion, $comand);
		
		if ($valor !== NULL) {
			$result = mysqli_query($this->conexion, "SELECT mejorNota, peorNota FROM `".$codcursoturn."_informacion_y_estadistica` WHERE notas ='".$campo."'");
			$maxmin = mysqli_fetch_assoc($result);

					if ($maxmin["mejorNota"]!== NULL && $maxmin["peorNota"]!== NULL) {
						if ($maxmin["mejorNota"] < $valor) {
							$nom = mysqli_query($this->conexion, "SELECT nombre FROM `".$codcursoturn."_datos` WHERE cui = '$ident'");
							$nombre = mysqli_fetch_assoc($nom);
							$comand = "UPDATE `".$codcursoturn."_informacion_y_estadistica` SET `mejorNota` = '$valor', `nomMejorNota` = '".$nombre["nombre"]."', `cuiMejorNota` = '$ident' WHERE notas = '$campo'";
							mysqli_query($this->conexion, $comand);
						} else if ($maxmin["peorNota"] > $valor) {
							$nom = mysqli_query($this->conexion, "SELECT nombre FROM `".$codcursoturn."_datos` WHERE cui = '$ident'");
							$nombre = mysqli_fetch_assoc($nom);
							$comand = "UPDATE `".$codcursoturn."_informacion_y_estadistica` SET `peorNota` = '$valor', `nomPeorNota` = '".$nombre["nombre"]."', `cuiPeorNota` = '$ident' WHERE notas = '$campo'";
							mysqli_query($this->conexion, $comand);
						}
					} else {
						$nom = mysqli_query($this->conexion, "SELECT nombre FROM `".$codcursoturn."_datos` WHERE cui = '$ident'");
						$nombre = mysqli_fetch_assoc($nom);
						$comand = "UPDATE `".$codcursoturn."_informacion_y_estadistica` SET `mejorNota` = '$valor', `nomMejorNota` = '".$nombre["nombre"]."', `cuiMejorNota` = '$ident' WHERE notas = '$campo'";
						mysqli_query($this->conexion, $comand);
						$nom = mysqli_query($this->conexion, "SELECT nombre FROM `".$codcursoturn."_datos` WHERE cui = '$ident'");
						$nombre = mysqli_fetch_assoc($nom);
						$comand = "UPDATE `".$codcursoturn."_informacion_y_estadistica` SET `peorNota` = '$valor', `nomPeorNota` = '".$nombre["nombre"]."', `cuiPeorNota` = '$ident' WHERE notas = '$campo'";
						mysqli_query($this->conexion, $comand);
					}
		}

		$error = mysqli_error($this->conexion);
		if (empty($error)) {
			return true;
		}
		echo "Error al insertar valores!";
		return false;
	}

	//Obtiene los campos nota, nota superior y porcentaje de la tabla de de informacion y estadistica de un curso
	function getInfoNotas($codcursoturn) {
		$result = mysqli_query($this->conexion, "SELECT notas,notaSuperior,porcentaje FROM `" . $codcursoturn . "__informacion_y_estadistica`");
		$error = mysqli_error($this->conexion);
		if (empty($error)) {
			if (mysqli_num_rows($result) > 0) {
				return $result;
			}
		} else {
			echo "Error al obtener campos de Notas!";
		}
		return null;
	}

	//Inserta una nueva nota secundaria
	function insCampoNota($nombrenota,$notaSup,$porcentaje,$codcursoturn) {
		$comand = "INSERT INTO `". $codcursoturn ."_informacion_y_estadistica` (`notas`, `notaSuperior`, `porcentaje`) VALUES ('".$notaSup."_".$nombrenota."', '$notaSup', '$porcentaje')";
		mysqli_query($this->conexion, $comand);
		$comand = "ALTER TABLE `".$codcursoturn."_calificaciones` ADD `".$notaSup."_".$nombrenota."` FLOAT(4,2) NULL";
		mysqli_query($this->conexion, $comand);

		$error = mysqli_error($this->conexion);
		if (empty($error)) {
			return true;
		}
		echo "Error al insertar nuevo campo de nota!";
		return false;
	}

	//Obtiene todas las notas secundarias de una nota
	function getCamposNota($nota,$codcursoturn) {
		$result = mysqli_query($this->conexion, "SELECT notas,notaSuperior,porcentaje FROM `".$codcursoturn."_informacion_y_estadistica` WHERE notaSuperior ='".$nota."'");
		$error = mysqli_error($this->conexion);
		if (empty($error)) {
			if (mysqli_num_rows($result) > 0) {
				return $result;
			}
		} else {
			echo "Error al obtener clases!";
		}
		return null;
	}

	//Obtiene la cantidad de Clases de un curso
	function getCantClases($codcursoturn) {
		$result = mysqli_query($this->conexion, "SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='".$codcursoturn."_asistencia'");
		$error = mysqli_error($this->conexion);
		if (empty($error)) {
			if (mysqli_num_rows($result) > 0) {
				return $result;
			}
		} else {
			echo "Error al obtener número de clases!";
		}
		return null;
	}

	//Obtiene los nombres de columna (dias de asistencia) de un curso
	function getColumnasClases($codcursoturn) {
		$result = mysqli_query($this->conexion, "SELECT column_name FROM information_schema.columns WHERE table_name='".$codcursoturn."_asistencia'");
		$error = mysqli_error($this->conexion);
		if (empty($error)) {
			if (mysqli_num_rows($result) > 0) {
				return $result;
			}
		} else {
			echo "Error al obtener clases!";
		}
		return null;
	}

	//Obtiene las calificaciones de un estudiante según su CUI
	//function getInfoEstudiantes
	function getCalifEstudiantes($codcursoturn, $cui) {
		$result = mysqli_query($this->conexion, "SELECT * FROM `" . $codcursoturn . "_calificaciones` WHERE cui = '" . $cui . "';");
		$error = mysqli_error($this->conexion);
		if (empty($error)) {
			if (mysqli_num_rows($result) > 0) {
				return $result;
			}
		} else {
			echo "Error al obtener clases!";
		}
		return null;
	}

	function getAsistEstudiantes($codcursoturn, $cui){
		$result = mysqli_query($this->conexion, "SELECT * FROM `" . $codcursoturn . "_asistencia` WHERE cui = '" . $cui . "';");
		$error = mysqli_error($this->conexion);
		if (empty($error)) {
			if (mysqli_num_rows($result) > 0) {
				return $result;
			}
		} else {
			echo "Error al obtener clases!";
		}
		return null;
	}

	//Obtiene la informacion de un nota, todo lo que tenga en su fila
	function getInfoRowEstadistica($codcursoturn, $nota) {
		$result = mysqli_query($this->conexion, "SELECT * FROM `" . $codcursoturn . "_informacion_y_estadistica` WHERE notas = '" . $nota . "';");
		$error = mysqli_error($this->conexion);
		if (empty($error)) {
			if (mysqli_num_rows($result) > 0) {
				return $result;
			}
		} else {
			echo "Error al obtener informacion de la nota!";
		}
		return null;
	}
	/**/

	//Obtiene toda la informacion de la tabla de notas y estadistica
	function getNotasEstadistica($codcursoturn) {
		$result = mysqli_query($this->conexion,"SELECT notas,mejorNota,cuiMejorNota,nomMejorNota,peorNota,cuiPeorNota,nomPeorNota FROM `".$codcursoturn."_informacion_y_estadistica`");
		$error = mysqli_error($this->conexion);
		if (empty($error)) {
			if (mysqli_num_rows($result) > 0) {
				return $result;
			}
		} else {
			echo "Error al obtener estadísticas de Notas!";
		}
		return null;
	}

	//Obtiene la informacion de un curso de la tabla general de cursos
	function getInfoCursos($codcursoturn) {/*Agregado*/
		$result = mysqli_query($this->conexion, "SELECT * FROM cursos WHERE codigo = '" . $codcursoturn . "';");
		$error = mysqli_error($this->conexion);
		if (empty($error)) {
			if (mysqli_num_rows($result) > 0) {
				return $result;
			}
		} else {
			echo "Error al obtener clases!";
		}
		return null;
	}

	function getClases($tabla) {
		$result = mysqli_query($this->conexion, "SELECT * FROM `$tabla`");
		$error = mysqli_error($this->conexion);
		if (empty($error)) {
			if (mysqli_num_rows($result) > 0) {
				return $result;
			}
		} else {
			echo "Error al obtener clases!";
		}
		return null;
	}

	function getEncabezados($tabla){
		
		$result = mysqli_query($this->conexion, "SHOW COLUMNS FROM $tabla");
		$error = mysqli_error($this->conexion);

		if (empty($error)) {
			if (mysqli_num_rows($result) > 0) {
				return $result;
			}
		} else {
			echo "Error al obtener clases!";
		}
		return null;
	}


	function getNombreClase($codcursoturn){
		$result = mysqli_query($this->conexion, "SELECT * FROM cursos");
		$error = mysqli_error($this->conexion);
		
		if (empty($error)) {
			while ($row = mysqli_fetch_assoc($result)){
				if($row["codigo"] == $codcursoturn){
					return $row["nombre"]." ".$row["turno"];
				}
			}
		} else {
			echo "Error al obtener clases!";
		}
		return null;

	}

	// retornará todos los datos de una tabla


	function getTabla($codcursoturn,$tabla){
		$result = mysqli_query($this->conexion,"SELECT * FROM ".$codcursoturn."_".$tabla);
		$error = mysqli_error($this->conexion);
		$i = 0;
		if(empty($error)){
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)){
					$array[$i] = $row;
					$i = $i + 1;
				}
			}
			return json_encode($array);
		}else{
			echo "Error";
		}
		return null;
	}

	
	function getTablaCurso($codcursoturn){
		$result = mysqli_query($this->conexion,"SELECT * FROM cursos WHERE codigo = '$codcursoturn'");
		$error = mysqli_error($this->conexion);
		if(empty($error)){
			$i = 0;
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_assoc($result)){
					$array[$i] = $row;
					$i = $i + 1;
				}
			}
		}
		echo json_encode($array);
		return json_encode($array);
	}

	function cerrar() {
		mysqli_close($this->conexion);
	}
}
?>