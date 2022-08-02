<!-- Styles -->
<link rel="stylesheet" href="../css/charts.css">

<!-- Resources -->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

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

<!--Tabla Calificaciones-->
<div id="datosCalificaciones" style="display:none" >
    <?php echo $_GET["datosCalificaciones"] ?>
</div>

<table id="tablaDatosCalificaciones">
    <thead>

    </thead>
    <tbody>

    </tbody>
</table>

<!--Limites de Notas-->
<div id="limitesCalificaciones" style="display:none">
    <?php echo $_GET["limitesCalificaciones"] ?>
</div>
<table id="tablaLimitesCalificaciones">
    <thead>
        <th>Nota</th>
        <th>Mejor Nota</th>
        <th>Peor Nota</th>
    </thead>
    <tbody>

    </tbody>
</table>

<!--JS-->
<script src="graficosReporte.js"></script>

<!--PDF-->
<script src="toPdf/html2pdf.bundle.min.js"></script>
<script src="toPdf/reporte.js"></script>
<strong>Presiona el siguiente botón para crear un PDF:</strong>
    <button id="btnCrearPdf">Click aquí</button>