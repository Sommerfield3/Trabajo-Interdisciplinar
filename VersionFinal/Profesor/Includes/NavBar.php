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
                    <a href="#" class="nav__link" >Asistencia</a>
                </div>
                <ul class="list__show">

                <li class="list__inside">
                        <a href="#" class="nav__link nav__link--inside" id="btnAsistencia" onclick ="location='Asistencia.php?clase=<?php echo $_GET['clase'] ?>'"/>Ver asistencia</a>
                    </li>
                    <li class="list__inside">
                        <a href="#" class="nav__link nav__link--inside" id="btnTomarAssist" onclick ="location='Proyecto_tomar-asist.php?clase=<?php echo $_GET['clase'] ?>'"/>Tomar asitencia</a>
                    </li>
                     </ul>

            </li>

            <li class="list__item list__item--click">
                <div class="list__button list__button--click">
                    <img src="../../img/tomar-nota.png" width="30" height="30">
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
                    </li>href="#" class="nav__link nav__link--inside">Editar/Agregar Coampos</a>
                    </li>
                </ul>

            </li>
            <li class="list__item">
                <div class="list__button">
                    <img src="../../img/informe-de-ganancias.png" width="30" height="30">
                    <a href="#" id="btnInforme" class="'<?php echo $_GET['clase'] ?>' nav_link"/>Informe</a>
                </div>
            </li>


            <li class="list__item">
                <div class="list__button">
                    <img src="../../img/cerrar-sesion.png" width="30" height="30">
                    <a href="../Portada.php" class="nav__link">Salir</a>
                </div>
            </li>

        </ul>
    </nav>
		<label for="btn-menu"><img src="../../img/eliminar.png" width="30" height="30"></label>
	</div>
</div>
<script src="Includes/menu.js"></script>
<br>
