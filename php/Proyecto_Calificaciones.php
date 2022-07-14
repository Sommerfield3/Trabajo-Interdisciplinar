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
							if ($row_not['column_name'] != 'cui' && $row_not['column_name'] != 'NF') {
								$campo = $row_not['column_name'];
								$cui = $row["cui"];
								if ($row_not['column_name'] == 'NC_1') {
									$camposxnot = $BaseDatos->getCamposNota($row_not['column_name'], $clase);
									if(!is_null($camposxnot)) {
										$BaseDatos->insnota($clase, NULL, $campo, (int)$cui);
									} else {
										$valor = $_POST[$row["cui"] . "_" .  $row_not['column_name']];
										if ($valor != NULL) {
											$BaseDatos->insnota($clase, (float)$valor, $campo, (int)$cui);
										} else {
											$BaseDatos->insnota($clase, NULL, $campo, (int)$cui);
										}
									}
								} else if ($row_not['column_name'] == 'NC_2') {
									$camposxnot = $BaseDatos->getCamposNota($row_not['column_name'], $clase);
									if(!is_null($camposxnot)) {
										$BaseDatos->insnota($clase, NULL, $campo, (int)$cui);
									} else {
										$valor = $_POST[$row["cui"] . "_" .  $row_not['column_name']];
										if ($valor != NULL) {
											$BaseDatos->insnota($clase, (float)$valor, $campo, (int)$cui);
										} else {
											$BaseDatos->insnota($clase, NULL, $campo, (int)$cui);
										}
									}
								} else if ($row_not['column_name'] == 'NC_3') {
									$camposxnot = $BaseDatos->getCamposNota($row_not['column_name'], $clase);
									if(!is_null($camposxnot)) {
									} $camposxnot = $BaseDatos->getCamposNota($row_not['column_name'], $clase);
									if(!is_null($camposxnot)) {
										$BaseDatos->insnota($clase, NULL, $campo, (int)$cui);
									} else {
										$valor = $_POST[$row["cui"] . "_" .  $row_not['column_name']];
										if ($valor != NULL) {
											$BaseDatos->insnota($clase, (float)$valor, $campo, (int)$cui);
										} else {
											$BaseDatos->insnota($clase, NULL, $campo, (int)$cui);
										}
									}
								} else {
									$valor = $_POST[$row["cui"] . "_" .  $row_not['column_name']];
									if ($valor != NULL) {
										$BaseDatos->insnota($clase, (float)$valor, $campo, (int)$cui);
									} else {
										$BaseDatos->insnota($clase, NULL, $campo, (int)$cui);
									}
								}
							}
						}
					}
				}
				$estudiantes = $BaseDatos->getEstudiantes($clase . "_datos");
			}
		}
		/*Agregado*/
		$notas = $BaseDatos->getColumnasClases($clase . "_calificaciones");
		if(!is_null($notas)) {
			$porcentajesNotas=$BaseDatos->getInfoCursos("cursos",$clase);
			/*if(!is_null($porcentajesNotas)) {
				while ($row2=mysqli_fetch_assoc($porcentajesNotas)){
					$parcial1porc=floatval($row2['EP_1']);
					$parcial2porc=floatval($row2['EP_2']);
					$parcial3porc=floatval($row2['EP_3']);
					$continua1porc=floatval($row2['EC_1']);
					$continua2porc=floatval($row2['EC_2']);
					$continua3porc=floatval($row2['EC_3']);
				}
				}*/
				while($row=mysqli_fetch_assoc($notas)){
					if(!is_null($porcentajesNotas)) {/*Por si se actualiza.*/
						while ($row2=mysqli_fetch_assoc($porcentajesNotas)){
							$parcial1porc=floatval($row2['EP_1']);
							$parcial2porc=floatval($row2['EP_2']);
							$parcial3porc=floatval($row2['EP_3']);
							$continua1porc=floatval($row2['EC_1']);
							$continua2porc=floatval($row2['EC_2']);
							$continua3porc=floatval($row2['EC_3']);
						}
					}/*Por si se actualiza*/
					if(!is_null($estudiantes)) { 
						while ($row3 = mysqli_fetch_assoc($estudiantes)) {
							$notaFinalAux=0.00;/*Por cada alumno.*/
							$notasDelEstudiante=$BaseDatos->getinfoEstudiantes($clase. "_calificaciones",$row3["cui"]);
							if (!is_null($notasDelEstudiante)){
								$row_notasDelEstudiante=mysqli_fetch_assoc($notasDelEstudiante);
								$notas = $BaseDatos->getColumnasClases($clase . "_calificaciones");
								while ($row_notas=mysqli_fetch_assoc($notas)){
									if ($row_notas['column_name']!='cui' && $row_notas['column_name'] != 'NF'){
										if (floatval($row_notasDelEstudiante[$row_notas['column_name']])!=NULL){
											if ($row_notas['column_name']=='NC_1'){
												$notaFinalAux+=floatval(floatval($row_notasDelEstudiante[$row_notas['column_name']])*floatval($continua1porc/100));
											}else if ($row_notas['column_name']=='EX_1'){
												$notaFinalAux+=floatval(floatval($row_notasDelEstudiante[$row_notas['column_name']])*floatval($parcial1porc/100));
											}else if ($row_notas['column_name']=='NC_2'){
												$notaFinalAux+=floatval(floatval($row_notasDelEstudiante[$row_notas['column_name']])*floatval($continua2porc/100));
											}else if ($row_notas['column_name']=='EX_2'){
												$notaFinalAux+=floatval(floatval($row_notasDelEstudiante[$row_notas['column_name']])*floatval($parcial2porc/100));
											}else if ($row_notas['column_name']=='NC_3'){
												$notaFinalAux+=floatval(floatval($row_notasDelEstudiante[$row_notas['column_name']])*floatval($continua3porc/100));
											}else if ($row_notas['column_name']=='EX_3'){
												$notaFinalAux+=floatval(floatval($row_notasDelEstudiante[$row_notas['column_name']])*floatval($parcial3porc/100));
											}
										}
										else{
											break;
										}
									}else if ($row_notas['column_name'] == 'NF'){
										$notaFinalAux=floatval(round($notaFinalAux*2.00)/2.00);
										$cui = $row3["cui"];
										$BaseDatos->insnota($clase, (float)$notaFinalAux, "NF", (int)$cui);
									}
								}
							}
						}
					}
				}
			$estudiantes = $BaseDatos->getEstudiantes($clase . "_datos");
		}
		/*Agregado*/
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