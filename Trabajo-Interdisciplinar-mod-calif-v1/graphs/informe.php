<!-- Styles -->
<link rel="stylesheet" href="../css/charts.css">

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Para el grafico de abandonos-->
<div id="Abandonos" style="display:none">
    <?php echo $_GET['Abandonos']?>
</div>

<div id="Asistentes" style="display:none">
    <?php echo $_GET['Asistentes']?>
</div>

<h1>Asistencia final, abandonos</h1>
<div id="asistenciaFinal"></div>
<script src="graficoPie.js"></script>



<!--Grafico de barras, de clase por dia-->
<div id="container" style="display:none">
    <?php echo $_GET["objeto"]?>
</div>

<h1>Asistencia por Clase</h1>
<div id="asistenciaPorClase"></div>
<script src="graficoBarras.js"></script>


<!--Grafico de numero de clases tomadas en total-->
<div id="container2" style="display:none">
  <?php echo $_GET['datos']?>
</div>

<h1>Clases Realiadas y no Realizadas</h1>
<div id="clasesTomadas"></div>
<script src="graficoSemiCirculo.js"></script>


<!-- HTML -->