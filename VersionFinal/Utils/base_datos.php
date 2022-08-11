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
	function crearcurso($codigo,$turno,$semestre,$year,$curso,$ep_1,$ep_2,$ep_3,$ec_1,$ec_2,$ec_3,$key_1,$key_2,$key_3) {
		$comand = "CREATE TABLE " . $codigo . $turno . "_asistencia (cui VARCHAR(11) PRIMARY KEY);";
		mysqli_query($this->conexion, $comand);
		$error = mysqli_error($this->conexion);

		$comand = "CREATE TABLE " . $codigo . $turno . "_calificaciones (cui VARCHAR(11) PRIMARY KEY, NC_1 FLOAT(4,2), EX_1 FLOAT(4,2), NC_2 FLOAT(4,2), EX_2 FLOAT(4,2), NC_3 FLOAT(4,2), EX_3 FLOAT(4,2), NF FLOAT(4,2));";
		mysqli_query($this->conexion, $comand);
		$error = mysqli_error($this->conexion);

		$comand = "CREATE TABLE " . $codigo . $turno . "_datos (cui VARCHAR(11) PRIMARY KEY, nombre VARCHAR(100), apellido VARCHAR(100), total_Asistencia int(3));";
		mysqli_query($this->conexion, $comand);
		$error = mysqli_error($this->conexion);

		$comand = "CREATE TABLE " . $codigo . $turno . "_informacion_y_estadistica (
		  `ID` INT PRIMARY KEY AUTO_INCREMENT,
		  `notas` varchar(100) NOT NULL,
		  `notaSuperior` varchar(100) NOT NULL,
		  `porcentaje` float(4,1) DEFAULT NULL,
		  `mejorNota` int(2) DEFAULT NULL,
		  `nomMejorNota` varchar(100) NOT NULL,
		  `cuiMejorNota` varchar(11) NOT NULL,
		  `peorNota` int(2) DEFAULT NULL,
		  `nomPeorNota` varchar(100) NOT NULL,
		  `cuiPeorNota` varchar(11) NOT NULL,
		  `notaPromedio` int(2) DEFAULT NULL
		)";
		mysqli_query($this->conexion, $comand);
		$error = mysqli_error($this->conexion);

		$comand = "INSERT INTO `cursos` (`codigo`, `semestre`, `año`, `nombre`, `turno`, `total_Horas`, `EP_1`, `EP_2`, `EP_3`, `EC_1`, `EC_2`, `EC_3`, `NF`, `cui_docente_1`, `cui_docente_2`, `curso_1`, `curso_2`, `curso_3`) VALUES ('" . $codigo . $turno . "', '$semestre', '$year', '$curso', '$turno', '0', '$ep_1', '$ep_2', '$ep_3', '$ec_1', '$ec_2', '$ec_3', '100', NULL, NULL, '$key_1', '$key_2', '$key_3');";
		mysqli_query($this->conexion, $comand);
		$error = mysqli_error($this->conexion);

		$comand = "ALTER TABLE `semestre_actual` ADD `". $codigo . $turno . "` BOOLEAN NOT NULL;";
		mysqli_query($this->conexion, $comand);
		$error = mysqli_error($this->conexion);

		if (empty($error)) {
			return true;
		}
		echo "Error al crear tabla!";
		return false;
	}

	//Obtiene toda a información de estudiantes de una tabla
	function getEstudiantes($tabla) {
		$result = mysqli_query($this->conexion, "SELECT * FROM `$tabla`");
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

	//Insertamos un nuevo día para tomar asistencia
	function inssesion($curso) {
		$Date = date('d_m_Y',time());
		mysqli_query($this->conexion, "ALTER TABLE $curso" . "_asistencia" ." ADD $Date CHARACTER NULL");
		mysqli_query($this->conexion, "UPDATE cursos SET total_Horas = total_Horas + 1 WHERE nombre = '$curso'");
		$error = mysqli_error($this->conexion);

		if (empty($error)) {
			return true;
		}
		echo "Error al ingresar sesion!";
		return false;
	}

	//Inserta la asistencia de un alumno en una clase
	function insasistenciaclase($curso, $valor, $sesion, $ident) {
		$comand = "UPDATE $curso" . "_asistencia " . "SET $sesion = '$valor' WHERE cui = '$ident'";
		mysqli_query($this->conexion, $comand);
		$error = mysqli_error($this->conexion);

		
		if ($valor == 'P') {
			$comand = "UPDATE $curso" . "_datos " . " SET total_Asistencia = total_Asistencia + 1 WHERE cui = '$ident'";
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
	function insnota($curso, $valor, $campo, $ident) {
		if ($valor === NULL) {
			$comand = "UPDATE $curso" . "_calificaciones SET $campo = NULL WHERE cui = '$ident'";
		} else {
			$comand = "UPDATE $curso" . "_calificaciones SET $campo = '$valor' WHERE cui = '$ident'";
		}
		mysqli_query($this->conexion, $comand);
		
		if ($valor !== NULL) {
			$result = mysqli_query($this->conexion, "SELECT mejorNota, peorNota FROM `".$curso."_informacion_y_estadistica` WHERE notas ='".$campo."'");
			$maxmin = mysqli_fetch_assoc($result);

					if ($maxmin["mejorNota"]!== NULL && $maxmin["peorNota"]!== NULL) {
						if ($maxmin["mejorNota"] < $valor) {
							$nom = mysqli_query($this->conexion, "SELECT nombre FROM `".$curso."_datos` WHERE cui = '$ident'");
							$nombre = mysqli_fetch_assoc($nom);
							$comand = "UPDATE `".$curso."_informacion_y_estadistica` SET `mejorNota` = '$valor', `nomMejorNota` = '".$nombre["nombre"]."', `cuiMejorNota` = '$ident' WHERE notas = '$campo'";
							mysqli_query($this->conexion, $comand);
						} else if ($maxmin["peorNota"] > $valor) {
							$nom = mysqli_query($this->conexion, "SELECT nombre FROM `".$curso."_datos` WHERE cui = '$ident'");
							$nombre = mysqli_fetch_assoc($nom);
							$comand = "UPDATE `".$curso."_informacion_y_estadistica` SET `peorNota` = '$valor', `nomPeorNota` = '".$nombre["nombre"]."', `cuiPeorNota` = '$ident' WHERE notas = '$campo'";
							mysqli_query($this->conexion, $comand);
						}
					} else {
						$nom = mysqli_query($this->conexion, "SELECT nombre FROM `".$curso."_datos` WHERE cui = '$ident'");
						$nombre = mysqli_fetch_assoc($nom);
						$comand = "UPDATE `".$curso."_informacion_y_estadistica` SET `mejorNota` = '$valor', `nomMejorNota` = '".$nombre["nombre"]."', `cuiMejorNota` = '$ident' WHERE notas = '$campo'";
						mysqli_query($this->conexion, $comand);
						$nom = mysqli_query($this->conexion, "SELECT nombre FROM `".$curso."_datos` WHERE cui = '$ident'");
						$nombre = mysqli_fetch_assoc($nom);
						$comand = "UPDATE `".$curso."_informacion_y_estadistica` SET `peorNota` = '$valor', `nomPeorNota` = '".$nombre["nombre"]."', `cuiPeorNota` = '$ident' WHERE notas = '$campo'";
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

	//Obtiene la info de una nota, nota superior y porcentaje
	function getInfoNotas($campo1,$campo2,$campo3,$tabla) {
		$result = mysqli_query($this->conexion, "SELECT ".$campo1.",".$campo2.",".$campo3." FROM `$tabla`");
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

	//Inserta una nueva nota secuandaria
	function insCampoNota($nombre,$notaSup,$porcentaje,$clase) {
		$comand = "INSERT INTO `".$clase."_informacion_y_estadistica` (`notas`, `notaSuperior`, `porcentaje`) VALUES ('".$notaSup."_".$nombre."', '$notaSup', '$porcentaje')";
		mysqli_query($this->conexion, $comand);
		$comand = "ALTER TABLE `".$clase."_calificaciones` ADD `".$notaSup."_".$nombre."` FLOAT(4,2) NULL";
		mysqli_query($this->conexion, $comand);

		$error = mysqli_error($this->conexion);
		if (empty($error)) {
			return true;
		}
		echo "Error al insertar nuevo campo de nota!";
		return false;
	}

	//Obtiene todas las notas secundarias de una nota
	function getCamposNota($campo,$clase) {
		$result = mysqli_query($this->conexion, "SELECT notas,notaSuperior,porcentaje FROM `".$clase."_informacion_y_estadistica` WHERE notaSuperior ='".$campo."'");
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

	//Obtiene la cantidad de Clases
	function getCantClases($tabla) {
		$result = mysqli_query($this->conexion, "SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='$tabla'");
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

	function getColumnasClases($tabla) {
		$result = mysqli_query($this->conexion, "SELECT column_name FROM information_schema.columns WHERE table_name='$tabla';");
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

	function getInfoEstudiantes($tabla, $cui) {
		$result = mysqli_query($this->conexion, "SELECT * FROM `$tabla` WHERE cui = '" . $cui . "';");
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
	/**/
	function getInfoRowEstadistica($tabla, $nota) {
		$result = mysqli_query($this->conexion, "SELECT * FROM `$tabla` WHERE notas = '" . $nota . "';");
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
	/**/

	function getNotasEstadistica($curso) {
		$result = mysqli_query($this->conexion,"SELECT notas,mejorNota,cuiMejorNota,nomMejorNota,peorNota,cuiPeorNota,nomPeorNota FROM `".$curso."_informacion_y_estadistica`");
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

	function getInfoCursos($tabla, $curso) {/*Agregado*/
		$result = mysqli_query($this->conexion, "SELECT * FROM `$tabla` WHERE nombre = '" . $curso . "';");
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

	// retornará todos los datos de una tabla

	function getTabla($curso,$tabla){
		$result = mysqli_query($this->conexion,"SELECT * FROM ".$curso."_".$tabla);
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

	
	function getTablaCurso($curso){
		$result = mysqli_query($this->conexion,"SELECT * FROM cursos WHERE nombre = '$curso'");
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