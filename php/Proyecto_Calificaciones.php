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
	<link rel="stylesheet" href="../css/clase.css">
	<link rel="stylesheet" href="../css/formulario_carpeta.css">
</head>
<body>
	<header class="header">
		<div class="container">
		<div class="btn-menu">
			<label for="btn-menu" > <img src="../img/lista.png" width="50" height="50"></label>
		</div>
			<div class="logo">
				<img src="../img/imagen_logo.png" width="200" height="100">
			</div>
		</div>
	</header>

<h2 style="text-align: center;">Clase de
		<?php
		$clase = $_GET["clase"];
		echo "$clase";
		?><br><br>
	</h2>
	<div class="capa"></div>
<!--	--------------->
<input type="checkbox" id="btn-menu">
<div class="container-menu">
	<div class="cont-menu">
		<nav class="nav">
        <ul class="list">
            <li class="list__item">
                <div class="list__button">
                    <img src="../img/casa-icono-silueta.png" width="30" height="30">
                    <a href="#" class="nav__link">Inicio</a>
                </div>
            </li>

            <li class="list__item list__item--click">
                <div class="list__button list__button--click">
                    <img src="../img/seguro.png" width="30" height="30">
                    <a href="#" class="nav__link" >Asistencia</a>
                </div>
                <ul class="list__show">

                <li class="list__inside">
                        <a href="#" class="nav__link nav__link--inside" id="btnAsistencia" onclick ="location='Proyecto_Asistencia.php?clase=<?php echo $_GET['clase'] ?>'"/>Ver asistencia</a>
                    </li>
                    <li class="list__inside">
                        <a href="#" class="nav__link nav__link--inside" id="btnTomarAssist" onclick ="location='Proyecto_tomar-asist.php?clase=<?php echo $_GET['clase'] ?>'"/>Tomar asitencia</a>
                    </li>
                </ul>

            </li>

            <li class="list__item list__item--click">
                <div class="list__button list__button--click">
                    <img src="../img/tomar-nota.png" width="30" height="30">
                    <a href="#" class="nav__link" >Notas</a>
                </div>

                <ul class="list__show">
                	<li class="list__inside">
                        <a href="#" class="nav__link nav__link--inside" id="btnCalificaciones" onclick ="location='Proyecto_Calificaciones.php?clase=<?php echo $_GET['clase'] ?>'"/>Ver Notas</a>
                    </li>
                    <li class="list__inside">
                        <a href="#" class="nav__link nav__link--inside" id="btnTomarAssist" onclick ="location='Proyecto_ingr-notas.php?clase=<?php echo $_GET['clase'] ?>'"/>Ingresar Notas</a>
                    </li>

                    <li class="list__inside">
                        <a href="#" class="nav__link nav__link--inside" id="btnTomarAssist" onclick ="location='Proyecto_camb-notas.php?clase=<?php echo $_GET['clase'] ?>'"/>Editar/Agregar Campos</a>
                    </li>
                </ul>

            </li>
            <li class="list__item">
                <div class="list__button">
                    <img src="../img/informe-de-ganancias.png" width="30" height="30">
                    <a href="#" id="btnInforme" class="'<?php echo $_GET['clase'] ?>' nav_link"/>Informe</a>
                </div>
            </li>


            <li class="list__item">
                <div class="list__button">
                    <img src="../img/cerrar-sesion.png" width="30" height="30">
                    <a href="#" class="nav__link">Salir</a>
                </div>
            </li>

        </ul>
    </nav>
		<label for="btn-menu"><img src="../img/eliminar.png" width="30" height="30"></label>
	</div>
</div>
<script src="../js/menu_01.js"></script>
<br>

	<h2 style="text-align: center;">Estudiantes Registrados<br><br></h2>
	<table id="tablaNotasEstudiantes" class="tabla">
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
		$contador=$BaseDatos->getCantClases($clase . "_calificaciones");
		$cant_contador=mysqli_fetch_assoc($contador);
		if ($cant_contador['COUNT(*)']>8){
			$notas = $BaseDatos->getColumnasClases($clase . "_calificaciones");
			if(!is_null($notas)) {
				$notasPorcent= $BaseDatos->getColumnasClases($clase . "_informacion_y_estadistica");
				while ($row4=mysqli_fetch_assoc($notas)){
					if (!is_null($estudiantes)){
						while ($row5= mysqli_fetch_assoc($estudiantes)){
							$NC1campos = $BaseDatos->getCamposNota('NC_1', $clase);
							$NC2campos = $BaseDatos->getCamposNota('NC_2', $clase);
							$NC3campos = $BaseDatos->getCamposNota('NC_3', $clase);
							if (!is_null($NC1campos)){
								$NC1=0;
							}
							if (!is_null($NC2campos)){
								$NC2=0;
							}
							if (!is_null($NC3campos)){
								$NC3=0;
							}
							$notasDelEstudiante=$BaseDatos->getinfoEstudiantes($clase. "_calificaciones",$row5["cui"]);
							if (!is_null($notasDelEstudiante)){
								$row_notasDelEstudiante=mysqli_fetch_assoc($notasDelEstudiante);
								$notas = $BaseDatos->getColumnasClases($clase . "_calificaciones");
								while ($row_notas=mysqli_fetch_assoc($notas)){
									if ($row_notas['column_name']!='cui' && $row_notas['column_name'] != 'NF' && $row_notas['column_name'] != 'NC_1'  && $row_notas['column_name'] != 'NC_2'  && $row_notas['column_name'] != 'NC_3'  && $row_notas['column_name'] != 'EX_1' && $row_notas['column_name'] != 'EX_2' && $row_notas['column_name'] != 'EX_3'){
										if (floatval($row_notasDelEstudiante[$row_notas['column_name']])!=NULL){
											$datosNotas=$BaseDatos->getInfoRowEstadistica($clase . "_informacion_y_estadistica", $row_notas['column_name']);
											if (!is_null($datosNotas)){
												$row_datosNotas=mysqli_fetch_assoc($datosNotas);
												if ($row_datosNotas['notaSuperior']=='NC_1'){
													$NC1=$NC1+(floatval($row_notasDelEstudiante[$row_notas['column_name']])*floatval(floatval($row_datosNotas['porcentaje'])/100));
												}
												if ($row_datosNotas['notaSuperior']=='NC_2'){
													$NC2=$NC2+(floatval($row_notasDelEstudiante[$row_notas['column_name']])*floatval(floatval($row_datosNotas['porcentaje'])/100));
												}
												if ($row_datosNotas['notaSuperior']=='NC_3'){
													$NC3=$NC3+(floatval($row_notasDelEstudiante[$row_notas['column_name']])*floatval(floatval($row_datosNotas['porcentaje'])/100));
												}
											}
										}
									}
								}
							}
							if (!is_null($NC1campos)){
								$cui = $row5["cui"];
								if ($NC1==0){
									$BaseDatos->insnota($clase, NULL, "NC_1", (int)$cui);
								}
								else if ($NC1>0){
									$BaseDatos->insnota($clase, (float)$NC1, "NC_1", (int)$cui);
								}
							}
							if (!is_null($NC2campos)){
								$cui = $row5["cui"];
								if ($NC2==0){
									$BaseDatos->insnota($clase, NULL, "NC_2", (int)$cui);
								}
								else if ($NC2>0){
									$BaseDatos->insnota($clase, (float)$NC2, "NC_2", (int)$cui);
								}
							}
							if (!is_null($NC3campos)){
								$cui = $row5["cui"];
								if ($NC3==0){
									$BaseDatos->insnota($clase, NULL, "NC_3", (int)$cui);
								}
								else if ($NC3>0){
									$BaseDatos->insnota($clase, (float)$NC3, "NC_3", (int)$cui);
								}
							}
						}
					}
				}
				$notasPorcent= $BaseDatos->getColumnasClases($clase . "_informacion_y_estadistica");	
			}
		}
		$estudiantes = $BaseDatos->getEstudiantes($clase . "_datos");
		/*Agregado*/
		$notas = $BaseDatos->getColumnasClases($clase . "_calificaciones");
		if(!is_null($notas)) {
			$porcentajesNotas=$BaseDatos->getInfoCursos("cursos",$clase);
			/**/
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
					/*EXTRA VLHADSA*/
					$cont=0;
					$row_nxe = mysqli_fetch_assoc($notxest);
					$notas = $BaseDatos->getColumnasClases($clase . "_calificaciones");
					while ($row_not = mysqli_fetch_assoc($notas)) {
						if ($row_not['column_name'] != 'cui') {
							if($row_nxe[$row_not['column_name']]!=NULL){
								if ($row_not['column_name']=='NC_1'){
									$cont++;
								}
								else if ($row_not['column_name']=='EX_1'){
									$cont++;
								}
								else if ($row_not['column_name']=='NC_2'){
									$cont++;
								}
								else if ($row_not['column_name']=='EX_2'){
									$cont++;
								}
								else if ($row_not['column_name']=='NC_3'){
									$cont++;
								}
								else if ($row_not['column_name']=='EX_3'){
									$cont++;
								}
							}
						}
					}
					$color="";
					if ($row10["NF"]!=NULL){
						if (((float)($row10["NF"]))>=10.5) {
							$color="#D4FFCB";
						}
						else{
							$color="#FE6D61";
						}
					}
					else{
						if (cont>=2){
							$notas = $BaseDatos->getColumnasClases($clase . "_calificaciones");
							$porcentajesNotas=$BaseDatos->getInfoCursos("cursos",$clase);
							while($row=mysqli_fetch_assoc($notas)){
								if(!is_null($porcentajesNotas)) {
									while ($row2=mysqli_fetch_assoc($porcentajesNotas)){
										$par1porc=floatval($row2['EP_1']);
										$par2porc=floatval($row2['EP_2']);
										$par3porc=floatval($row2['EP_3']);
										$cont1porc=floatval($row2['EC_1']);
										$cont2porc=floatval($row2['EC_2']);
										$cont3porc=floatval($row2['EC_3']);
									}
								}
							}
							$notaParcialTotal=0.00;
							$PorcentajeCumplido=0.00;
							$row_notas_del_estudiante=mysqli_fetch_assoc($notxest);
							$notas = $BaseDatos->getColumnasClases($clase . "_calificaciones");
							while ($row_notas=mysqli_fetch_assoc($notas)){
								if (floatval($row_notas_del_estudiante[$row_notas['column_name']])!=NULL){
									if ($row_notas['column_name']=='NC_1'){
										$notaParTotal+=floatval(floatval($row_notas_del_estudiante[$row_notas['column_name']])*floatval($cont1porc/100));
										$PorcentajeCumplido+=floatval($cont1porc);

									}else if ($row_notas['column_name']=='EX_1'){
										$notaParcialTotal+=floatval(floatval($row_notas_del_estudiante[$row_notas['column_name']])*floatval($par1porc/100));
										$PorcentajeCumplido+=floatval($par1porc);
									}else if ($row_notas['column_name']=='NC_2'){
										$notaParcialTotal+=floatval(floatval($row_notas_del_estudiante[$row_notas['column_name']])*floatval($cont2porc/100));
										$PorcentajeCumplido+=floatval($cont2porc);
									}else if ($row_notas['column_name']=='EX_2'){
										$notaParcialTotal+=floatval(floatval($row_notas_del_estudiante[$row_notas['column_name']])*floatval($par2porc/100));
										$PorcentajeCumplido+=floatval($par2porc);
									}else if ($row_notas['column_name']=='NC_3'){
										$notaParcialTotal+=floatval(floatval($row_notas_del_estudiante[$row_notas['column_name']])*floatval($cont3porc/100));
										$PorcentajeCumplido+=floatval($cont3porc);
									}else if ($row_notas['column_name']=='EX_3'){
										$notaParcialTotal+=floatval(floatval($row_notas_del_estudiante[$row_notas['column_name']])*floatval($par3porc/100));
										$PorcentajeCumplido+=floatval($par3porc);
									}
								}	
							}
							$notaParcialTotal=floatval(round($notaFinalAux*2.00)/2.00);
							$puede_desaprob=FALSE;
							$parcial_vs_total=floatval(floatval(($notaParcialTotal)*5)+floatval((100-floatval($PorcentajeCumplido))/1.25));/*Nota actual + 80% (16 en todo) del total de nota restante.*/
							if ($parcial_vs_total<52.5){
								$puede_desaprob=TRUE;
							}
							if ($puede_desaprob==TRUE){
								$color="#FFF1A5";
							}
						}
					}
					/*EXTRA VLHADSA*/
					$row_nxe = mysqli_fetch_assoc($notxest);
					$notas = $BaseDatos->getColumnasClases($clase . "_calificaciones");
					while ($row_not = mysqli_fetch_assoc($notas)) {
						if ($row_not['column_name'] != 'cui') {
							echo "<td bgcolor='$color'>".$row_nxe[$row_not['column_name']]."</td>";
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
	<br><br>
	<table id="tablaDatosRelevantes" class="tabla">
		<thead>
			<tr>
				<th>Nota</th>
				<th>Mejor Nota</th>
				<th>CUI</th>
				<th>Nombre</th>
				<th>Peor Nota</th>
				<th>CUI</th>
				<th>Nombre</th>
			</tr>
		</thead>
		<tbody id="contenido">
		<?php
			$BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
			$BaseDatos->conectar();
			$clase = $_GET["clase"];
			$datosestadisticos = $BaseDatos->getNotasEstadistica($clase);
			echo "<tbody>";
			if(!is_null($datosestadisticos)) {
				while ($row = mysqli_fetch_assoc($datosestadisticos)) {
					echo "<tr>";
					echo "<td>" . $row["notas"] . "</td>";
					echo "<td class='nota'>" . $row["mejorNota"] . "</td>";
					echo "<td class='CUI'>" . $row["cuiMejorNota"] . "</td>";
					echo "<td class='nombre'>" . $row["nomMejorNota"] . "</td>";
					echo "<td>" . $row["peorNota"] . "</td>";
					echo "<td class='nota'>	" . $row["cuiPeorNota"] . "</td>";
					echo "<td class='nombre'>" . $row["nomPeorNota"] . "</td>";
					echo "</tr>";
				}
			}
			echo "</tbody>";
			$BaseDatos->cerrar();
		?>
		</tbody>
	</table>
	<!--Archivo js necesario para mostrar el informe-->
	<script src="../js/getInforme.js"></script>
</body>
</html>