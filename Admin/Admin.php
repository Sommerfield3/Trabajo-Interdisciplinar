<?php include("base_datos.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Administrador</title>
	<link rel="stylesheet" href="formulario_carpeta.css">
	<script type="text/javascript" src="formulario_carpeta.js"></script>
</head>
<body>
	<h2 style="text-align: center;">Ingresar Clase<br><br></h2>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form1">
		<input type="text" name="codigo" placeholder="Codigo del curso">
		<br>
		<input type="text" name="semestre" placeholder="Semestre">
		<br>
		<input type="text" name="year" placeholder="Año">
		<br>
		<input type="text" name="curso" placeholder="Nombre del curso">
		<br>
		<label>Turno o Grupo:</label>
		<fieldset id="turnos" >
			<legend>Turnos</legend>
			<input id="A" name="turnos[]" type="checkbox" value="A"/>A<br>
			<input id="B" name="turnos[]" type="checkbox" value="B"/>B<br>
			<input id="C" name="turnos[]" type="checkbox" value="C"/>C<br>
		</fieldset>
		<br>
		<input type="text" name="EP_1" placeholder="EP_1">
		<br>
		<input type="text" name="EP_2" placeholder="EP_2">
		<br>
		<input type="text" name="EP_3" placeholder="EP_3">
		<br>
		<input type="text" name="EC_1" placeholder="EC_1">
		<br>
		<input type="text" name="EC_2" placeholder="EC_2">
		<br>
		<input type="text" name="EC_3" placeholder="EC_3">
		<br>
		<input type="text" name="curso_1" placeholder="Llave al curso...">
		<br>
		<input type="text" name="curso_2" placeholder="Llave al curso...">
		<br>
		<input type="text" name="curso_3" placeholder="Llave al curso...">
		<br>
		<!-- <input type="file" name="lista-alumnos"> -->
		<button type="submit" id="btnAgregar">Crear</button>
	</form>
		<?php
		$BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
		$BaseDatos->conectar();
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$codigo = $_POST["codigo"];
			$semestre = $_POST["semestre"];
			$year = $_POST["year"];
			$curso = $_POST["curso"];
			$ep_1 = $_POST["EP_1"];
			$ep_2 = $_POST["EP_2"];
			$ep_3 = $_POST["EP_3"];
			$ec_1 = $_POST["EC_1"];
			$ec_2 = $_POST["EC_2"];
			$ec_3 = $_POST["EC_3"];
			$key_1 = $_POST["curso_1"];
			$key_2 = $_POST["curso_2"];
			$key_3 = $_POST["curso_3"];
			$turnos = $_POST["turnos"];
			for ($i = 0; $i < count($turnos); $i++) {
				$BaseDatos->crearcurso($codigo, $turnos[$i], $semestre, $year, $curso, $ep_1, $ep_2, $ep_3, $ec_1, $ec_2, $ec_3, $key_1, $key_2, $key_3);
			}
			
		}
		
		$BaseDatos->cerrar();
		?>
</body>
</html>