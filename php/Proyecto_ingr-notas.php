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
					if ($row['column_name'] != 'cui' && $row['column_name'] != 'NF') {
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
							if ($row_not['column_name'] != 'cui' && $row_not['column_name'] != 'NF') {
								if ($row_not['column_name'] == 'NC_1') {
									$camposxnot = $BaseDatos->getCamposNota($row_not['column_name'], $clase);
									if(!is_null($camposxnot)) {
										echo "<td>";
										if ($row_nxe[$row_not['column_name']] != NULL) {
											echo floatval($row_nxe[$row_not['column_name']]);
										}
										echo "</td>";
									} else {
										echo "<td><input name='". $row["cui"] . "_" . $row_not['column_name'] . "'value='". "' type='text'></td>";
									}
								} else if ($row_not['column_name'] == 'NC_2') {
									$camposxnot = $BaseDatos->getCamposNota($row_not['column_name'], $clase);
									if(!is_null($camposxnot)) {
										echo "<td>";
										if ($row_nxe[$row_not['column_name']] != NULL) {
											echo floatval($row_nxe[$row_not['column_name']]);
										}
										echo "</td>";
									} else {
										echo "<td><input name='". $row["cui"] . "_" . $row_not['column_name'] . "'value='". "' type='text'></td>";
									}
								} else if ($row_not['column_name'] == 'NC_3') {
									$camposxnot = $BaseDatos->getCamposNota($row_not['column_name'], $clase);
									if(!is_null($camposxnot)) {
										echo "<td>";
										if ($row_nxe[$row_not['column_name']] != NULL) {
											echo floatval($row_nxe[$row_not['column_name']]);
										}
										echo "</td>";
									} else {
										echo "<td><input name='". $row["cui"] . "_" . $row_not['column_name'] . "'value='". "' type='text'></td>";
									}
								} else {
									if ($row_nxe[$row_not['column_name']]!=NULL){
										echo "<td><input name='". $row["cui"] . "_" . $row_not['column_name'] . "'value='". floatval($row_nxe[$row_not['column_name']]) ."' type='text'></td>";//Convertimos el valor recibido a flotante
									} else {
										echo "<td><input name='". $row["cui"] . "_" . $row_not['column_name'] . "'value='". "' type='text'></td>";//Si es nulo, no escribe nada, porque no hay nota, si no se usa esto, va a convertir el NULL en 0 y entonces ese valor pasa a la base de datos como numérico.
									}
								}
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