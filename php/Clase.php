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
	<h2 style="text-align: center;">Clase de
		<?php
		$clase = $_GET["clase"];
		echo "$clase";
		?><br><br>
	</h2>
	<p>Elegir acción</p>

	<!--
		Botones :
		- Apartado de asistencia
		- Apartado de calificaciones
		- Mostrar el informe total del curso
	-->
	<button type="button" id="btnAsistencia" onclick ="location='Proyecto_Asistencia.php?clase=<?php echo $_GET['clase'] ?>'"/>Asistencia</button>
	<button type="button" id="btnCalificaciones" onclick ="location='Proyecto_Calificaciones.php?clase=<?php echo $_GET['clase'] ?>'"/>Calificaciones</button>
	<button type="button" id="btnInforme" class="'<?php echo $_GET['clase'] ?>'">Informe</button>
	

	<table id="tablaUsuarios" class="tabla">
		<h3>Estudiantes Registrados</h3>
		<thead>
			<tr>
				<th>CUI</th>
				<th>Nombre</th>
				<th>Apellidos</th>
			</tr>
		</thead>
		<tbody>
		<?php
		
		/* Conexion con la base de datos */
		
		$BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
		$BaseDatos->conectar();
		$clase = $_GET["clase"];
		$estudiantes = $BaseDatos->getEstudiantes($clase . "_datos");
		
		/* Se muestran los datos de los alumnos en una tabla */
		if(!is_null($estudiantes)) {
			while ($row = mysqli_fetch_assoc($estudiantes)) {
				echo "<tr>";
				echo "<td class='CUI'>" . $row["cui"] . "</td>";
				echo "<td class='nombre'>" . $row["nombre"] . "</td>";
				echo "<td class='apellido'>" . $row["apellido"] . "</td>";
				echo "</tr>";
			}
		}

		$BaseDatos->cerrar();
		?>
		</tbody>
	</table>
</body>
	<!--Archivo js necesario para mostrar el informe-->
	<script src="../js/getInforme.js"></script>
</html>