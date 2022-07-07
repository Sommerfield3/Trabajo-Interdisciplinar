<?php

    header('Content-Type: application/json');
    include("base_datos.php");

    $BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
    $BaseDatos->conectar();


    if(isset($_GET['clase'])){
        $clase = $_GET['clase'];
        $asistencia =  $BaseDatos->getAsistenciaPorDia($clase);
    }

    echo $asistencia;
    return $asistencia;
?>