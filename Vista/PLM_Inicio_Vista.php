<?php     
class Inicio_Vista
{
    //aqui se muestran las graficas de los factores y actividaddes
    function graficar($actividades, $factores)
    {
        global $objComponentes;
        $this->elementos();
    
    
        $datos=array("tipo"=>"bloque dos-columnas columna-derecha",
                    "titulo"=>utf8_encode("Gráfica de Actividades de Mejoramiento"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        if($actividades[0][1]!=0)
        {
            ?>
            <div align="center">
                <canvas id="Gráfica de Actividades de Mejoramiento" class="chart-holder" width="500" height="400">
                
                </canvas>
            </div>
            
            <?php
            
            
            $this->mostGraf($actividades,("Gráfica de Actividades de Mejoramiento"),"#F38630");
        }
        else
        {
            $this->mensaje("No hay Actividades de mejoramiento registradas !!");
        } 
        $objComponentes->cerrar_div_bloque_principal();
            
            
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Gráfica de Consolidación de factores"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        if($factores[0][0])
        {
            ?>
            
            <div align="center">
                <canvas id="Gráfica de Consolidación de factores" class="chart-holder" width="900" height="600">
                
                </canvas>
            </div>
            <?php
            
            $this->mostGraf($factores,("Gráfica de Consolidación de factores"),"#46BFBD");
        
        }
        else
        {
            $this->mensaje("No hay factores consolidados !!");
        } 
        
        $objComponentes->cerrar_div_bloque_principal();
        
    
    }
    
    //mensaje de advertencias
    function mensaje($strMensaje)
    {
        global $objComponentes;
        $this->elementos();
        
        echo "<br />";
        echo "<br />";
        echo "<h3>";
        echo utf8_encode($strMensaje);
        echo "</h3>";
        
    }
    
    //se declara un objeto a la vista general
    function elementos()
    {
        global $objComponentes;   
        require_once("../Vista/VIS_Elementos_Vista.php");
        $objComponentes=new Elementos();
        
    }
    
    // se declara una funcion general para gráficar
    function mostGraf($arrData, $strTitulo,$rgb)
    {
        global $objComponentes;
        $this->elementos();
        
        $datos=array("id"=>"grafica".($strTitulo));
                    
        $objComponentes->form($datos);
        
         
        $strCaract="";
        $strCaract2="";
        for($i=0; $i<count($arrData); $i++)
        {
            if($i==0)
            {
                $strCaract="\"".$arrData[$i][0];
                $strCaract2="".$arrData[$i][1];                
            }
            else
            {
                $strCaract=$strCaract."\",\"".$arrData[$i][0];
                $strCaract2=$strCaract2.",".$arrData[$i][1];
                
            }
        }
        $strCaract=$strCaract."\"";
        $strCaract2=$strCaract2.",";
        
        
               
        
        ?>
            <br />
            <br />
                <script>
                
                        var barChartData = {
                            labels: [<?php echo ($strCaract);?>],
                            
                            datasets: [
                				{
                				    fillColor: "<?php echo $rgb; ?>",
                				    strokeColor: "rgba(151,187,205,1)",
                				    data: [<?php echo $strCaract2;?> ]
                				}
                			]                
                        }
                
                    var myLine = new Chart(document.getElementById("<?php echo $strTitulo;?>").getContext("2d")).Bar(barChartData);

                </script>
                
        <?php
        $objComponentes->cerrar_form();
    }
    
}	
?>