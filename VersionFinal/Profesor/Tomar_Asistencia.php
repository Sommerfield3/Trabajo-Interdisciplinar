<?php include "Includes/Header.php" ?>

<body>
	<h2 style="text-align: center;">Estudiantes Registrados<br><br></h2>
	<button style="margin: 0 auto;" onclick ="location='Asistencia.php?clase=<?php echo $_GET['clase'] ?>'">Volver</button>

	<form method="post" action="Proyecto_Asistencia.php?clase=<?php echo $_GET['clase'] ?>">
		<button type="submit" id="btnTomarAssist">Guardar</button>
		<table id="tablaUsuarios" class="tabla">
			<?php
	
			/* Conexion con la base de datos */
			$BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
			$BaseDatos->conectar();

			/* Se extreae la información de los estudiantes y sus asistencia */
			$clase = strtolower($_GET["clase"]);
			$estudiantes = $BaseDatos->getEstudiantes($clase);
			$sesiones = $BaseDatos->getColumnasClases($clase);
			$Date = date('d_m_Y',time());

			echo "<thead>";
			echo "<tr>";
			echo "<th>CUI</th>";
			echo "<th>Nombre</th>";
			echo "<th>Apellidos</th>";
			
			if(!is_null($sesiones)) {
				while ($row = mysqli_fetch_assoc($sesiones)) {
					if ($row['column_name'] != 'cui') {
						echo "<th>" . $row['column_name'] . "</th>";
					}
				}
			}

			echo "<th>$Date</th>";
			
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";

			if(!is_null($estudiantes)) {
				while ($row = mysqli_fetch_assoc($estudiantes)) {
					echo "<tr>";
					echo "<td class='CUI'>" . $row["cui"] . "</td>";
					echo "<td class='nombre'>" . $row["nombre"] . "</td>";
					echo "<td class='apellido'>" . $row["apellido"] . "</td>";

					$asisxest = $BaseDatos->getAsistEstudiantes($clase, $row["cui"]);
					if(!is_null($asisxest)) {
						$row_axe = mysqli_fetch_assoc($asisxest);
						$sesiones = $BaseDatos->getColumnasClases($clase);
						while ($row_ses = mysqli_fetch_assoc($sesiones)) {
							if ($row_ses['column_name'] != 'cui') {
								echo "<td>".$row_axe[$row_ses['column_name']]."</td>";
							}
						}
					}

					echo "<td>
						<select name='". $row["cui"] . "'>
						<option value=' '> </option>
						<option value='P'>P</option>
						<option value='F'>F</option>
						</select>
						</td>";

					echo "</tr>";
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