<form action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="file" name="fichero">
    <button type="submit">Enviar</button>
</form>

<?php
    
    $dir = $_FILES["fichero"]["tmp_name"]


    /*
    function leer($fichero){
        if($archivo = fopen($fichero,"r")){
            while(!feof($archivo)){
                $line = fgets($archivo);
                $arr = explode(",",$line);
                echo "<p>".$arr[0]."  <b>".$arr[1]."</b><p>";
            }
        }

        fclose($archivo);
    }

    leer("lista.txt");
    */
?>