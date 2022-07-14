<?php include("base_datos.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Clases</title>
	<link rel="stylesheet" href="../css/formulario_carpeta.css">
</head>
<body>
	<h2 style="text-align: center;">Estudiantes Registrados<br><br></h2>
	<form action="Clase.php" method="get">
		<p>Elegir Clase</p>
		<select name="clase">
			<option value="Elegir clase">Elegir Clase</option>;
			<?php

			/* Conexion con la base de datos */
			$BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
			$BaseDatos->conectar();

			$clases = $BaseDatos->getClases("cursos");
			
			/* Se genera el menú de opciones de clases disponibles*/
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