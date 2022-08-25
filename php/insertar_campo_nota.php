<?php
include("base_datos.php");

$BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
$BaseDatos->conectar();

$nombre = $_POST["nombre"];
$notaSuperior = $_POST["notaSuperior"];
$porcentaje = $_POST["porcentaje"];
$clase = $_GET["clase"];

$BaseDatos->insCampoNota($nombre, $notaSuperior, $porcentaje, $clase);

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