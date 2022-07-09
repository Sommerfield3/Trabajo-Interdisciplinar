<?php
    require_once "../dompdf/autoload.inc.php";
    use Dompdf\Dompdf;

    $dom = new Dompdf();
    $dom->loadHtml("holaaa");
    $dom->setPaper("letter");
    $dom->render();

    $dom->stream("archivo.pdf",array("Attachment" => false));

?>