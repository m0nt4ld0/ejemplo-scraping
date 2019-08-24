<! DOCTYPE html>
<head>
    <title>Carreras de calle :: Ejemplo de Scraping</title>
    <meta charset="utf-8">
    <meta name="description" content="Ejemplo basico de scraping">
    <meta name="author" content="Mariela Silvana Montaldo">
</head>
<body>
<div id="main">
    <div id="wrapper">
        <div id="content">
            <h2>Scraping</h2>
            <p>Sencillo ejemplo de la t&eacute;cnica de Scraping mediante la cual obtengo las pr&oacute;ximas carreras de calle
               de manera din&aacute;mica.</p>
            <h3>Carreras de calle</h3>
            <table class="scraping">
                <tr>
                    <th>Nombre</th>
                    <th>Lugar</th>
                    <th>Hora</th>
                    <th>Link (+Info)</th>
                </tr>
                <tr>
                <?php
                    // EJEMPLO DE SCRAPING 
                    // Obtengo nombre, fecha, lugar y horario de las carreras de calle proximas.
                    require 'simple_html_dom.php';
                    
                    $url = 'https://sportsfacilities.com.ar/carreras/';
                    $pagina = file_get_html( $url );
                    $carreras = array();
                    $contenido = $pagina->find('div[class=span12 modern_style]');
                    // Lleno un array con la info obtenida
                    foreach( $contenido as $post ){
                        $mes = $post->find('span',0)->innertext;
                        $lugar= $post->find('span[class=mapgg]',0)->innertext;
                        $hora = $post->find('span[class=time-span]',0)->innertext;
                        $titulo = $post->find('h3 a',0)->innertext;
                        $url = $post->find('h3 a',0)->attr['href'];
                        $carrera = array("nombre"=>$titulo,
                                      "lugar"=>$lugar,
                                      "hora"=>$hora,
                                      "link"=>$url);
                        array_push($carreras,$carrera);
                    }
                    asort($carreras);
                    //Imprimo en pantalla la tabla
                    foreach( $carreras as $c ){
                        echo "<tr>
                                <td>".$c["nombre"]."</td>
                                <td>".$c['lugar']."</td>
                                <td>".$c['hora']."</td>
                                <td><a href='".$c['link']."'>".$c['link']."</a></td>
                             </tr>";
                    }

                ?>
            </table>
        </div>
    </div>
</div>
</body>
</pagina>
