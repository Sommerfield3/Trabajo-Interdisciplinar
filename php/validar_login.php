<?php
include("base_datos.php");

session_start();

$BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
$BaseDatos->conectar();

$usua = $_POST["usuario"];
$clav = $_POST["clave"];

$usuarios = $BaseDatos->getUsuarios();
$mensaje = "Mensaje que enviara";
if(!is_null($usuarios)) {
	while ($row = mysqli_fetch_assoc($usuarios)) {
		if ($row["usuario"] == $usua) {
			if ($row["clave"] == md5($clav)) {
				$_SESSION["usuario"] = $usua;
				$BaseDatos->cerrar();
				$mensaje = "OK";
				echo $mensaje;
				return;
			} else {
				$mensaje = "Clave Incorrecta";
				break;
			}
		} else {
			$mensaje = "Usuario no encontrado";
		}
	}
} else {
	$mensaje = "Usuario no encontrado";
}
echo $mensaje;
session_unset();
session_destroy();
$BaseDatos->cerrar();
?>