<?php
    echo "hola";
    $str_json = file_get_contents('php://input');
    $res = json_decode($str_json);
    echo $res;
?>

<!-- Styles -->
<link rel="stylesheet" href="../css/charts.css">

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Chart code -->
<script src="../js/graficoBarras.js"></script>


<!-- HTML -->
<div id="chartdiv"></div>