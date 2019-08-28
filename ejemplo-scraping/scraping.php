<?php
    // EJEMPLO DE SCRAPING 
    // Obtengo nombre, fecha, lugar y horario de las carreras de calle proximas.
    require 'simple_html_dom.php';
    
    function scrap($mes, $h){
        $url = 'https://sportsfacilities.com.ar/carreras/';
        $pagina = file_get_html( $url );
        $carreras = array();
        $contenido = $pagina->find('div[class=span12 modern_style]');
        
        // Lleno un array con la info obtenida quedandome solo con las carreras del mes pedido
        
        foreach( $contenido as $post ){
            $fecha   = $post->find('div[class=date-counter]span',0)->innertext;
            $lugar   = $post->find('span[class=mapgg]',0)->innertext;
            $hora    = $post->find('span[class=time-span]',0)->innertext;
            $titulo  = $post->find('h3 a',0)->innertext;
            $url     = $post->find('h3 a',0)->attr['href'];
            $carrera = array("nombre"=> $titulo,
                             "lugar" => $lugar,
                             "fecha" => $fecha,
                             "hora"  => $hora,
                             "link"  => $url);
            
            //Filtro por mes de la carrera o si no se filtra, cargo todo
            
            if(isset($mes) && trim($mes) !== '')
            {
                if(strcmp($fecha,$mes)==0)
                    array_push($carreras,$carrera);
            } else 
                array_push($carreras,$carrera);
        }
        asort($carreras);
        return $carreras;
    }
    
    function mostrarTabla($carreras){

    //Imprimo en pantalla la tabla

        echo "<table class='scraping'>
                <tr>
                    <th>Nombre</th>
                    <th>Lugar</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Link (+Info)</th>
                </tr>";
        foreach( $carreras as $c ){
            echo "<tr>
                    <td>".$c["nombre"]."</td>
                    <td>".$c['lugar']."</td>
                    <td>".$c['fecha']."</td>
                    <td>".$c['hora']."</td>
                    <td><a href='".$c['link']."'>".$c['link']."</a></td>
                 </tr>";
        }
        echo "</table>";
    }

?>