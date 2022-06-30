<?php include("base_datos.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>
		<?php
			$clase = $_GET["clase"];
			echo "$clase";
		?>
	</title>
	<link rel="stylesheet" href="../css/formulario_carpeta.css">
</head>
<body>
	<h2 style="text-align: center;">Estudiantes Registrados<br><br></h2>
	<form method="post" action="Proyecto_Calificaciones.php?clase=<?php echo $_GET['clase'] ?>">
		<button type="submit" id="btnTomarAssist"/>Guardar</button>
		<table id="tablaUsuarios" class="tabla">
			<?php
			$BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
			$BaseDatos->conectar();
			$clase = $_GET["clase"];
			$estudiantes = $BaseDatos->getEstudiantes($clase . "_datos");

			echo "<thead>";
			echo "<tr>";
			echo "<th>CUI</th>";
			echo "<th>Nombre</th>";
			echo "<th>Apellidos</th>";

			$notas = $BaseDatos->getColumnasClases($clase . "_calificaciones");
			if(!is_null($notas)) {
				while ($row = mysqli_fetch_assoc($notas)) {
					if ($row['column_name'] != 'cui') {
						echo "<th>" . $row['column_name'] . "</th>";
					}
				}
			}

			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";

			if(!is_null($estudiantes)) {
				while ($row = mysqli_fetch_assoc($estudiantes)) {
					echo "<tr>";
					echo "<td class='CUI'>" . $row["cui"] . "</td>";
					echo "<td class='nombre'>" . $row["nombre"] . "</td>";
					echo "<td class='apellido'>" . $row["apellido"] . "</td>";
					
					$notxest = $BaseDatos->getinfoEstudiantes($clase . "_calificaciones", $row["cui"]);
					if(!is_null($notxest)) {
						$row_nxe = mysqli_fetch_assoc($notxest);
						$notas = $BaseDatos->getColumnasClases($clase . "_calificaciones");
						while ($row_not = mysqli_fetch_assoc($notas)) {
							if ($row_not['column_name'] != 'cui') {
								echo "<td><input name='". $row["cui"] . "_" . $row_not['column_name'] . "' type='text'></td>";
							}
						}
					}
				}
			}

			echo "</tbody>";

			$BaseDatos->cerrar();
			?>

			</tbody>
		</table>
	</form>
</body>
</html>