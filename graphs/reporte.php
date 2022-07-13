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

<section>
    <table id="tablaAbandonos">
        <thead>
            <th>Clases</th>
            <th>Alumnos Asistentes</th>
            <th>Alumnos en sitación de Abandono</th>
        </thead>
        <tbody>
            <td>Nro. Alumnos</td>
            <td></td>
            <td></td>
        </tbody>
    </table>

    <div id="asistenciaFinal" class="chartdiv"></div>
</section>
<script src="graficoPie.js"></script>



<!--Grafico de barras, de clase por dia-->

<div id="container" style="display:none">
    <?php echo $_GET["objeto"]?>
</div>

<h1>Asistencia por Clase</h1>
<table id="tablaAsistenciaPorClase">
    <thead>
        <th>Día</th>
        <th>Presentes</th>
        <th>Faltos</th>
    </thead>
    <tbody>
        
    </tbody>
</table>

<div id="asistenciaPorClase" class="chartdiv"></div>
<script src="graficoBarras.js"></script>


<!--Grafico de numero de clases tomadas en total-->

<div id="container2" style="display:none">
  <?php echo $_GET['datos']?>
</div>

<h1>Clases Realizadas y no Realizadas</h1>

<table id="tablaTotalClases">
    <thead>

    </thead>
    <tbody>

    </tbody>
</table>


<div id="clasesTomadas" class="chartdiv"></div>
<script src="graficoSemiCirculo.js"></script>


<!--Grafico del total de aprobados y desaprobados--> 


<div id="container3" style="display:none">
    <?php echo $_GET['aprobados']?>
</div>

<table id="tablaAprobados">
    <thead>
        <th>Aprobados</th>
        <th>Desaprobados</th>
        <th>Sin nota</th>
    </thead>
    <tbody>

    </tbody>
</table>

<div id="aprobados" class="chartdiv"></div>
<script src="graficoPieAprobados.js"></script>

<!-- HTML -->


<script src="toPdf/html2pdf.bundle.min.js"></script>
<script src="toPdf/reporte.js"></script>
<strong>Presiona el siguiente botón para crear un PDF:</strong>
    <button id="btnCrearPdf">Click aquí</button>