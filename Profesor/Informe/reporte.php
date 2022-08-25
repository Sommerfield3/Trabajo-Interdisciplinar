<!-- Styles -->
<link rel="stylesheet" href="../../css/charts.css">

<!-- Resources -->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>

<!-- Para el grafico de abandonos-->
<div id="totalAsistencia" style="display:none">
    <?php echo $_GET['totalAsistencia']?>
</div>

<section class="content">
    <h2>Asistencia final, abandonos</h2>
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
</section>
<div id="graficoTotalAsistencia" class="chartdiv"></div>

<!--Grafico de barras, de clase por dia-->

<div id="asistenciaPorClase" style="display:none">
    <?php echo $_GET["asistenciaPorClase"]?>
</div>

<section class="content">
    <h2>Asistencia por Clase</h2>
    <table id="tablaAsistenciaPorClase">
        <thead>
            <th>Día</th>
            <th>Presentes</th>
            <th>Faltos</th>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</section>

<div id="graficoAsistenciaPorClase" class="chartdiv"></div>

<!--Grafico de numero de clases tomadas en total-->

<div id="numeroClases" style="display:none">
  <?php echo $_GET['numeroClases']?>
</div>

<section class="content">
    <h2>Clases Realizadas y no Realizadas</h2>
    
    <table id="tablaNumeroClases">
        <thead>
    
        </thead>
        <tbody>
    
        </tbody>
    </table>
</section>
<div id="graficoNumeroClases" class="chartdiv"></div>

<!--Grafico del total de aprobados y desaprobados--> 


<div id="calificacionesFinales" style="display:none">
    <?php echo $_GET['calificacionesFinales']?>
</div>

<section class="content">
    <h2>Calificaciones finales</h2>
    <table id="tablaCalificacionesFinales">
        <thead>
            <th>Aprobados</th>
            <th>Desaprobados</th>
            <th>Sin nota</th>
        </thead>
        <tbody>
    
        </tbody>
    </table>
</section>

<div id="graficoCalificacionesFinales" class="chartdiv"></div>

<!--Tabla Calificaciones-->
<div id="datosCalificaciones" style="display:none" >
    <?php echo $_GET["datosCalificaciones"] ?>
</div>

<section class="content">
    <h2>Calificaciones</h2>
    <table id="tablaDatosCalificaciones">
        <thead>
    
        </thead>
        <tbody>
    
        </tbody>
    </table>
</section>

<!--Limites de Notas-->
<div id="limitesCalificaciones" style="display:none">
    <?php echo $_GET["limitesCalificaciones"] ?>
</div>

<section class="content">
    <h2>Mejor y peor calificacion</h2>
    <table id="tablaLimitesCalificaciones">
        <thead>
            <th>Nota</th>
            <th>Mejor Nota</th>
            <th>Peor Nota</th>
        </thead>
        <tbody>
    
        </tbody>
    </table>
</section>

<!--JS-->
<script src="graficosReporte.js"></script>

<!--PDF-->

<strong>Presiona el siguiente botón para crear un PDF:</strong>
<button id="export">Click aquí</button>
<script src="pdf.js"></script>