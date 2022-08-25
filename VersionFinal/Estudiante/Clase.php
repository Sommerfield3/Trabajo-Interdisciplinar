<?php
	session_start();
	include "Includes/Header.php"
?>

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
	    <h3 style="text-align: center;">Notas Actuales</h3>
		<thead>
			<tr>
				<th>Nombre de la nota</th>
				<th>Valor de la nota</th>
			</tr>
		</thead>
		<tbody>
            <?php
            /* Conexion con la base de datos */
            
            $BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
            $BaseDatos->conectar();
            $codigo = $_GET["clase"];
            $valnotas = $BaseDatos->getCalifEstudiantes($codigo,"est".$_SESSION["usuario"]);
            $nomnotas = $BaseDatos->getEncabezados($codigo."_calificaciones");

            $i = 0;
			if (!is_null($nomnotas)) {
				while($row = mysqli_fetch_assoc($nomnotas)) {
					$nombresnotas[$i] = $row["Field"];
					$i = $i + 1;
				}
			}

            /* Se muestran los datos de los alumnos en una tabla */
            $i = 0;
			if(!is_null($valnotas)){
                while ($row = mysqli_fetch_assoc($valnotas)) {
                	foreach ($row as $key => $value) {
                		if ($nombresnotas[$i] != "cui") {
	                    	echo "<tr>";
	                   		echo "<td>" . $nombresnotas[$i] . "</td>";
	                    	echo "<td>" . $row[$nombresnotas[$i]] . "</td>";
	                    	echo "</tr>";
	                    }
                    	$i = $i + 1;
                    }
                }
            }

            $BaseDatos->cerrar();
            ?>
		</tbody>
	</table>
	<!--Archivo js necesario para mostrar el informe-->
	<script src="../js/getInforme.js"></script>
</body>
</html>