<?php
	session_start();
	include "Includes/Header.php"
?>

<body>

    <h2 style="text-align: center;">Histórico de notas<br><br></h2>

	<div class="capa"></div>
<!--	--------------->

	<table id="tablaUsuarios" class="tabla">
	    <h3 style="text-align: center;">Notas del estudiante <?php echo $_SESSION["usuario"]; ?></h3>
	    <h3 style="text-align: center;">UNIVERSIDAD NACIONAL DE SAN AGUSTÍN</h3>
		<thead>
			<tr>
				<th>Nombre del curso</th>
				<th>Nota final del curso</th>
			</tr>
		</thead>
		<tbody>
            <?php
            /* Conexion con la base de datos */
            
            $BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
            $BaseDatos->conectar();
            $valcursos = $BaseDatos->getHistoricoest("est".$_SESSION["usuario"]);
            $codcursos = $BaseDatos->getEncabezados("historico_notas");

            $i = 0;
			if (!is_null($codcursos)) {
				while($row = mysqli_fetch_assoc($codcursos)) {
					$nombrescursos[$i] = $row["Field"];
					//echo "<p>".$nombrescursos[$i]."</p>";
					$i = $i + 1;
				}
			}

            /* Se muestran los datos de los alumnos en una tabla */
            $i = 0;
			if(!is_null($valcursos)){
                while ($row = mysqli_fetch_assoc($valcursos)) {
                	foreach ($row as $key => $value) {
                		if ($nombrescursos[$i] != "cui" && $row[$nombrescursos[$i]] != NULL) {
	                    	echo "<tr>";
	                   		echo "<td>" . $nombrescursos[$i] . "</td>";
	                    	echo "<td>" . $row[$nombrescursos[$i]] . "</td>";
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