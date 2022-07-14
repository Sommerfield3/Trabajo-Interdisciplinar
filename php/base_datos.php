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

	function insnota($curso, $valor, $campo, $ident) {
		$comand = "UPDATE $curso" . "_calificaciones " . "SET $campo = '$valor' WHERE cui = '$ident'";
		mysqli_query($this->conexion, $comand);
		$error = mysqli_error($this->conexion);

		if (empty($error)) {
			return true;
		}
		echo "Error al insertar valores!";
		return false;
	}

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

	// retornará todos los datos de la tabla asistencia de un curso
	function getTablaAsistencia($curso){
		$result = mysqli_query($this->conexion,"SELECT * FROM ".$curso."_asistencia");
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

	function getTablaDatos($curso){
		$result = mysqli_query($this->conexion,"SELECT * FROM ".$curso."_datos");
		$error = mysqli_error($this->conexion);
		if(empty($error)){
			$i = 0;
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_assoc($result)){
					$array[$i] = $row;
					$i = $i + 1;
				}
			}
			return json_encode($array);
		}

		return null;
	}


	function getTablaCalificaciones($curso){
		$result = mysqli_query($this->conexion,"SELECT * FROM ".$curso."_calificaciones");
		$error = mysqli_error($this->conexion);
		$i = 0;
		if(empty($error)){
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_assoc($result)){
					$array[$i] = $row;
					$i = $i +1;
				}
			}
			return json_encode($array);
		}

		return null;
	}

	function cerrar() {
		mysqli_close($this->conexion);
	}
}
?>