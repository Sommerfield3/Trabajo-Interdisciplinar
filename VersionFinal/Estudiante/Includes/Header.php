<?php include("../Utils/base_datos.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>
		<?php
		$BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
		$BaseDatos->conectar();

		$clase = $BaseDatos->getNombreClase($_GET["clase"]);
		echo "$clase";

		$BaseDatos->cerrar();
		?>
	</title>
	<link rel="stylesheet" href="../../css/clase.css">
	<link rel="stylesheet" href="../../css/formulario_carpeta.css">
</head>


<header class="header">
		<div class="container">
		<div class="btn-menu">
			<label for="btn-menu" > <img src="../../img/lista.png" width="50" height="50"></label>
		</div>
			<div class="logo">
				<img src="../../img/imagen_logo.png" width="200" height="100">
			</div>
		</div>
</header>

<input type="checkbox" id="btn-menu">
<div class="container-menu">
	<div class="cont-menu">
		<nav class="nav">
        <ul class="list">
            <li class="list__item">
                <div class="list__button">
                    <img src="../../img/casa-icono-silueta.png" width="30" height="30">
                    <a href="#" class="nav__link" onclick ="location='Clase.php?clase=<?php echo $_GET['clase'] ?>'" >Inicio</a>
                </div>
            </li>

            <li class="list__item list__item--click">
                <div class="list__button list__button--click">
                    <img src="../../img/seguro.png" width="30" height="30">
                    <a href="#" class="nav__link" onclick ="location='Historico_notas.php?clase=<?php echo $_GET['clase'] ?>'" >Historico de Notas</a>
                </div>
            </li>

            <li class="list__item list__item--click">
                <div class="list__button list__button--click">
                    <img src="../../img/tomar-nota.png" width="30" height="30">
                    <a href="#" class="nav__link" onclick ="location='Cursos_falta.php?clase=<?php echo $_GET['clase'] ?>'">Cursos por año</a>
                </div>
            </li>

            <li class="list__item">
                <div class="list__button">
                    <img src="../../img/informe-de-ganancias.png" width="30" height="30">
                   <a href="#" class="nav__link" onclick ="location='Cursos_sigsemest.php?clase=<?php echo $_GET['clase'] ?>'">Cursos próximos</a>
                </div>
            </li>


            <li class="list__item">
                <div class="list__button">
                    <img src="../../img/cerrar-sesion.png" width="30" height="30">
                    <a href="../Profesor/Portada.php" class="nav__link">Salir</a>
                </div>
            </li>

        </ul>
    </nav>
		<label for="btn-menu"><img src="../../img/eliminar.png" width="30" height="30"></label>
	</div>
</div>

<script src="Includes/menu.js"></script>

<br>
