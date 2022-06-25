<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 550px;
}
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<div id="container" style="display:none">
  <?php echo $_GET['datos']?>
</div>

<!-- Chart code -->
<script src="../js/graficoSemiCirculo.js"></script>

<div id="chartdiv"></div>