<?php include("../Utils/base_datos.php"); ?>

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
	<link rel="stylesheet" href="../css/clase.css">
	<link rel="stylesheet" href="../css/formulario_carpeta.css">
</head>

<body>
    
    <?php include "Includes/NavBar.php" ?>

    <h2 style="text-align: center;">Estudiantes Registrados<br><br></h2>
	<table id="tablaUsuarios" class="tabla">
		<?php

		/* Conexion con la base de datos */
		$BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
		$BaseDatos->conectar();

		/* Se obtiene la clase en la que nos encontramos */
		$clase = $_GET["clase"];
		/* Se obtiene lista de estudiantes */
		$estudiantes = $BaseDatos->getEstudiantes($clase . "_datos");
		/* Se obtiene la fecha */
		$Date = date('d_m_Y',time());

		/* Se itera dentro de la lista de estudiantes */
		if(!is_null($estudiantes)) {
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$BaseDatos->inssesion($clase);

				while ($row = mysqli_fetch_assoc($estudiantes)) {
					$valor = $_POST[$row["cui"]];
					$cui = $row["cui"];
					/* Se inserta la nueva asistencia según la fecha correspondiente */
					$BaseDatos->insasistenciaclase($clase, $valor, $Date, (int)$cui);
				}

				/* Se actualiza la lista de asistencia */
				$estudiantes = $BaseDatos->getEstudiantes($clase . "_datos");
			}
		}

		/* Estructuración de la tabla de la lista de alumnos */

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
		echo "<th>Mostrar Porcentaje</th>";
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

				echo '<td><button id="'.$row["cui"].'" class="btnAsistenciaPorAlumno '.$_GET['clase'].'">Asistencia</button></td>';

				echo "</tr>";
			}
		}

		echo "</tbody>";

		$BaseDatos->cerrar();
		?>
	</table>

</body>
	<!--Archivo js necesario para mostrar los graficos de asistencia por alumno-->
	<script src="../js/porAlumno.js"></script>
	<!--Archivo js necesario para mostrar el informe-->
	<script src="../js/getInforme.js"></script>
</html>