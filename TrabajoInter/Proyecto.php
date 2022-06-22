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
	<link rel="stylesheet" href="formulario_carpeta.css">
	<script type="text/javascript" src="formulario_carpeta.js"></script>
</head>
<body>
	<h2 style="text-align: center;">Estudiantes Registrados<br><br></h2>
	<button type="button" id="btnTomarAssist" onclick ="location='/TrabajoInter/Proyecto_tomar-asist.php?clase=trabajo_interdisciplinar_a'"/>Tomar Asistencia</button>
	<table id="tablaUsuarios" class="tabla">
		<?php
		$BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
		$BaseDatos->conectar();
		$clase = $_GET["clase"];
		$estudiantes = $BaseDatos->getEstudiantes($clase . "_datos");
		$Date = date('d_m_Y',time());

		if(!is_null($estudiantes)) {
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$BaseDatos->inssesion($clase);

				while ($row = mysqli_fetch_assoc($estudiantes)) {
					$valor = $_POST[$row["cui"]];
					$cui = $row["cui"];
					$BaseDatos->insasistenciaclase($clase, $valor, $Date, (int)$cui);
				}
				$estudiantes = $BaseDatos->getEstudiantes($clase . "_datos");
			}
		}

		echo "<thead>";
		echo "<tr>";
		echo "<th>CUI</th>";
		echo "<th>Nombre</th>";
		echo "<th>Apellidos</th>";

		$sesiones = $BaseDatos->getColumnasClases($clase . "_asistencia");
		if(!is_null($sesiones)) {
			while ($row = mysqli_fetch_assoc($sesiones)) {
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
				
				$asisxest = $BaseDatos->getinfoEstudiantes($clase . "_asistencia", $row["cui"]);
				if(!is_null($asisxest)) {
					$row_axe = mysqli_fetch_assoc($asisxest);
					$sesiones = $BaseDatos->getColumnasClases($clase . "_asistencia");
					while ($row_ses = mysqli_fetch_assoc($sesiones)) {
						if ($row_ses['column_name'] != 'cui') {
							echo "<td>".$row_axe[$row_ses['column_name']]."</td>";
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