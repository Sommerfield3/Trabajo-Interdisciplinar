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
	<button type="button" id="btnTomarAssist" onclick ="location='Proyecto_ingr-notas.php?clase=<?php echo $_GET['clase'] ?>'"/>Ingresar Notas</button>
	<button type="button" id="btnTomarAssist" onclick ="location='Proyecto_camb-notas.php?clase=<?php echo $_GET['clase'] ?>'"/>Agregar/Editar Campos</button>
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

		if(!is_null($estudiantes)) {
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				while ($row = mysqli_fetch_assoc($estudiantes)) {
					$notas = $BaseDatos->getColumnasClases($clase . "_calificaciones");
					if(!is_null($notas)) {
						while ($row_not = mysqli_fetch_assoc($notas)) {
							if ($row_not['column_name'] != 'cui') {
								$valor = $_POST[$row["cui"] . "_" .  $row_not['column_name']];

								if ($valor != NULL) {
									$campo = $row_not['column_name'];
									$cui = $row["cui"];
									$BaseDatos->insnota($clase, (int)$valor, $campo, (int)$cui);
								}
							}
						}
					}
				}
				$estudiantes = $BaseDatos->getEstudiantes($clase . "_datos");
			}
		}

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
							echo "<td>".$row_nxe[$row_not['column_name']]."</td>";
						}
					}
				}

				echo "</tr>";
			}
		}

		echo "</tbody>";

		$BaseDatos->cerrar();
		?>
	</table>
</body>
</html>