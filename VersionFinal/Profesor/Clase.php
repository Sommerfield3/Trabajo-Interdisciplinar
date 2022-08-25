<?php include "Includes/Header.php" ?>

<body>

    <h2 style="text-align: center;">Clase de
		<?php
		$BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
		$BaseDatos->conectar();

		$clase = $BaseDatos->getNombreClase($_GET["clase"]);
		echo "$clase";

		$BaseDatos->cerrar();
		?><br><br>
	</h2>


	<div class="capa"></div>
<!--	--------------->

	<table id="tablaUsuarios" class="tabla">
	    <h3 style="text-align: center;">Estudiantes Registrados</h3>
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
            $codigo = $_GET["clase"];
            $estudiantes = $BaseDatos->getEstudiantes(strtolower($codigo));
			
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

	<?php
		echo "<button id='btn-informe' class=".$_GET["clase"].">Informe</button>";
	?>
	<!--Archivo js necesario para mostrar el informe-->
	<script src="Informe/getInforme.js"></script>
</body>
</html>