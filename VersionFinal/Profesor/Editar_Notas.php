<?php include "Includes/Header.php" ?>

<body>
	<h2 style="text-align: center;">Notas del Curso<br><br></h2>
		<button onclick ="location='Calificaciones.php?clase=<?php echo $_GET['clase'] ?>'">Volver</button>

		<form>
			<h2>Añadir nota</h2>
			<div>
				<label>Nombre de la nota</label>
				<input id="nombrenewnota" type="text"/>
			</div>
			<div>
				<label>Nota Superior</label>
				<select name="notaSuperiornewnota" id="notaSuperiornewnota">
					<option value="NC_1">NC_1</option>
					<option value="NC_2">NC_2</option>
					<option value="NC_3">NC_3</option>
				</select>
			</div>
			<div>
				<label>Porcentaje</label>
				<select name="porcentajenewnota" id="porcentajenewnota">
					<?php
						for ($i = 1; $i <= 100; $i++) {
							echo "<option value='$i'>$i</option>";
						}
					?>
				</select>
			</div>
			<button id="btnAgregar" type="button">Agregar</button>
		</form>
			
	<!-- <form method="post" action="Proyecto_Calificaciones.php?clase=<?php echo $_GET['clase'] ?>"> -->
		<h2>Notas Existentes</h2>
		<table id="tablaEstudiantes" class="tabla">
			<thead>
				<tr>
					<th>Nota</th>
					<th>Nota Superior</th>
					<th>Porcentaje</th>
				</tr>
			</thead>
			<tbody id="contenido">
			<?php
				$BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
				$BaseDatos->conectar();
				$clase = $_GET["clase"];

				$campnotas = $BaseDatos->getInfoNotas("notas","notaSuperior","porcentaje",$clase . "_informacion_y_estadistica");
				if(!is_null($campnotas)) {
					while ($row = mysqli_fetch_assoc($campnotas)) {
						echo "<tr>";
						echo "<td>" . $row["notas"] . "</td>";
						echo "<td>" . $row["notaSuperior"] . "</td>";
						echo "<td>" . $row["porcentaje"] . "%</td>";
						echo "</tr>";
					}
				}
				$BaseDatos->cerrar();
			?>
			</tbody>
		</table>
<!-- 		<button type="submit" id="btnTomarAssist"/>Guardar</button>
	</form> -->
</body>
	<script src="../js/Proyecto_camb-notas.js"></script>
	<!--Archivo js necesario para mostrar el informe-->
	<script src="../js/getInforme.js"></script>
</html>