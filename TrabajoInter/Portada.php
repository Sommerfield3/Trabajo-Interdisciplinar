<?php include("base_datos.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Clases</title>
	<link rel="stylesheet" href="formulario_carpeta.css">
	<script type="text/javascript" src="formulario_carpeta.js"></script>
</head>
<body>
	<h2 style="text-align: center;">Estudiantes Registrados<br><br></h2>
	<form action="http://localhost/TrabajoInter/Proyecto.php" method="get">
		<p>Elegir Clase</p>
		<select name="clase">
			<option value="Elegir clase">Elegir Clase</option>;
			<?php
			$BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
			$BaseDatos->conectar();

			$clases = $BaseDatos->getClases("cursos");

			if(!is_null($clases)) {
				while ($row = mysqli_fetch_assoc($clases)) {
					echo "<option value='" . $row["nombre"] . "'>" . $row["nombre"] . "</option>";
				}
			}
			?>
		</select>
		<button id="btnAgregar" class="btn" type="submit">Enviar</button>
	</form>
</body>
</html>