<?php
    header('Content-Type: application/json');
    include("base_datos.php");  
    $BaseDatos = new base_datos("localhost", "root", "", "ti_ciencias_computacion");
    $BaseDatos->conectar();
        
    if(isset($_GET['clase'])){

        $clase = $_GET['clase'];

        if(isset($_GET['tabla'])){
            $tabla = $_GET['tabla'];
    
            $datos = $BaseDatos->getTabla($clase,$tabla);
            $BaseDatos->cerrar();
            echo $datos; 
        }

        else{
            $datos = $BaseDatos->getTablaCurso($clase);
            $BaseDatos->cerrar();
        }
            
    }
    return $datos;
?>  