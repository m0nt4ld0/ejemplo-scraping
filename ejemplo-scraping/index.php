<! DOCTYPE html>
<head>
    <title>Carreras de calle :: Ejemplo de Scraping</title>
    <meta charset="utf-8">
    <meta name="description" content="Ejemplo basico de scraping">
    <meta name="author" content="Mariela Silvana Montaldo">
    
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script>
                function filtrarTabla(strMes, strHora) {
                    if (strMes.length == 0) {
                        document.getElementById("tabla").innerHTML = "";
                        return;
                    } else {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("tabla").innerHTML = this.responseText;
                            }
                        };
                        xmlhttp.open("GET", "busqueda.php?mes=" + strMes + "&hora=" + strHora, true);
                        xmlhttp.send();
                    }
                }
            </script>
</head>
<body>
<div id="main">
    <div id="wrapper">
        <div id="content">
            <h2>Scraping</h2>
            <p>Sencillo ejemplo de la t&eacute;cnica de Scraping mediante la cual obtengo las pr&oacute;ximas carreras de calle
               de manera din&aacute;mica.</p>
            <h3>Carreras de calle</h3>
            <form class="filter">Filtrar por
                Mes 
                <select name="mes" id="mes">
                   <option value="Ene">Ene</option> 
                   <option value="Mar">Mar</option> 
                   <option value="Abr">Abr</option> 
                   <option value="May">May</option> 
                   <option value="Jun">Jun</option> 
                   <option value="Jul">Jul</option> 
                   <option value="Ago">Ago</option> 
                   <option value="Sep">Sep</option> 
                   <option value="Oct">Oct</option> 
                   <option value="Nov">Nov</option> 
                   <option value="Dic">Dic</option> 
                   <!-- Agregar boton de quitar filtros -->
                </select>
                Horario
                <select name="hora">
                    <option value="AM">AM</option> 
                   <option value="PM">PM</option>
                </select>
                <input type="button" value="Filtrar" onclick="filtrarTabla(mes.options[mes.selectedIndex].text, hora.options[hora.selectedIndex].text)" />
                <input type="button" value="Quitar filtro" onclick="filtrarTabla('Todos','Todos')" />
            </form>
            <div id="tabla">
                <?php
                    // EJEMPLO DE SCRAPING 
                    // Obtengo nombre, fecha, lugar y horario de las carreras de calle proximas.
                    require 'simple_html_dom.php';
                    require 'scraping.php';
                    
                    // Mes y hora nulos trae toda la tabla
                    mostrarTabla(scrap(null, null));
                    
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</pagina>
