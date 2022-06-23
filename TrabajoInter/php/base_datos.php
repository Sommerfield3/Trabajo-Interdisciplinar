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

		$comand = "CREATE TABLE " . $curso . "_calificaciones (cui INT(8) PRIMARY KEY, nombres VARCHAR(100), apellidos VARCHAR(100));";
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

	function getAsistenciaFinal($curso){
		$result = mysqli_query($this->conexion,"SELECT cui, total_Asistencia FROM $curso");
		$error = mysqli_error($this->conexion);
		if(empty($error)){
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)){
					$array[$row['cui']] = (int)$row['total_Asistencia'];
				}
			}

			return json_encode($array);
		}else{
			echo "Error";
		}
		return null;
	}

	function getAsistenciaPorDia($curso){
		$result = mysqli_query($this->conexion,"SHOW COLUMNS FROM trabajo_interdisciplinar_a_asistencia");
		$error = mysqli_error($this->conexion);
		if(empty($error)){
			if (mysqli_num_rows($result) > 0) {
				$i = 0;
				while ($row = mysqli_fetch_assoc($result)){
					$array[$i] = $row["Field"];
					$i += 1;
				}
			}
		}

		$values = array_values($array);
		foreach($values as $valor){
			$result = mysqli_query($this->conexion,"SELECT $valor FROM trabajo_interdisciplinar_a_asistencia");
			$error = mysqli_error($this->conexion);
			if(empty($error)){
				if(mysqli_num_rows($result) > 0){
					$i = 0;
					while($row = mysqli_fetch_assoc($result)){
						foreach($row as $dato){
							$datos[$i] = $dato;
							$i++;
						}
					}
					$obj[$valor] = $datos;
					foreach($datos as $j => $dato){
						unset($datos[$j]);
					}
				}
			}
		}

		return json_encode($obj);
	}

	function cerrar() {
		mysqli_close($this->conexion);
	}
}
?>