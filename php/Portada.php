<?php include("base_datos.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Clases</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/portada_in.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<body>
	<div class="container">
		<div class="img">
			<img src="../img/inicio_profesor.png">
		</div>
		<div class="login-content">
			<form action="Clase.php" method="get">
				<h2 class="title">Bienvenido</h2>
           		<select name="clase" class="elegir">
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
			<i></i>
		<button id="btnAgregar" class="btn" type="submit">Enviar</button>
            </form>
        </div>
    </div>
</body>
</html>