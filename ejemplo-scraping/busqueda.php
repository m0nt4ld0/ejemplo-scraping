<?php
    require 'simple_html_dom.php';
    require 'scraping.php';
    
    //Obtengo los datos del formulario
    $mes = $_REQUEST["mes"];
    $h   = $_REQUEST["hora"];
   
    mostrarTabla(scrap($mes, $h));
    
?>