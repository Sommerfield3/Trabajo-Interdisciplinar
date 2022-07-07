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
		<input type="text" name="curso" placeholder="nombre del curso">
		<input type="text" name="turno" placeholder="turno o grupo">
		<input type="file" name="lista-alumnos">
		<button type="submit" id="btnAgregar">Crear</button>
	</form>
		<?php
		$BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
		$BaseDatos->conectar();
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$curso = $_POST["curso"];
			$turno = $_POST["turno"];
			$BaseDatos->crear($curso . "_" . $turno,$_FILES['lista-alumnos']);
		}
		
		$BaseDatos->cerrar();
		?>
</body>
</html>