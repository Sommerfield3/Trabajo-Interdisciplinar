<?php
   header('Content-Type: application/json');
    include("base_datos.php");  
    $BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
    $BaseDatos->conectar();
    

    $datos = $BaseDatos->numeroClases("hola");

    $BaseDatos->cerrar();
    return $d1atos;

?>