<!-- Styles -->
<link rel="stylesheet" href="../css/charts.css">

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Para el grafico de abandonos-->
<div id="totalAsistencia" style="display:none">
    <?php echo $_GET['totalAsistencia']?>
</div>

<h1>Asistencia final, abandonos</h1>

<section>
    <table id="tablaTotalAsistencia">
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

<div id="graficoTotalAsistencia" class="chartdiv"></div>
</section>
<script src="graficoPie.js"></script>



<!--Grafico de barras, de clase por dia-->

<div id="asistenciaPorClase" style="display:none">
    <?php echo $_GET["asistenciaPorClase"]?>
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

<div id="graficoAsistenciaPorClase" class="chartdiv"></div>
<script src="graficoBarras.js"></script>


<!--Grafico de numero de clases tomadas en total-->

<div id="numeroClases" style="display:none">
  <?php echo $_GET['numeroClases']?>
</div>

<h1>Clases Realizadas y no Realizadas</h1>

<table id="tablaNumeroClases">
    <thead>

    </thead>
    <tbody>

    </tbody>
</table>


<div id="graficoNumeroClases" class="chartdiv"></div>
<script src="graficoSemiCirculo.js"></script>


<!--Grafico del total de aprobados y desaprobados--> 


<div id="calificacionesFinales" style="display:none">
    <?php echo $_GET['calificacionesFinales']?>
</div>

<table id="tablaCalificacionesFinales">
    <thead>
        <th>Aprobados</th>
        <th>Desaprobados</th>
        <th>Sin nota</th>
    </thead>
    <tbody>

    </tbody>
</table>

<div id="graficoCalificacionesFinales" class="chartdiv"></div>
<script src="graficoPieAprobados.js"></script>

<!-- HTML -->


<script src="toPdf/html2pdf.bundle.min.js"></script>
<script src="toPdf/reporte.js"></script>
<strong>Presiona el siguiente botón para crear un PDF:</strong>
    <button id="btnCrearPdf">Click aquí</button>