<?php 
error_reporting(0);
include_once '../Modelo/DOC_Autoevaluacion_Modelo.php';
    

class Grafica2{

    /**
     * [__construct construnctor de la clase]
     */
	public function __construct(){
        $this->autoevaluacion = new Autoevaluacion_Modelo;
    }
    
    /**
     * [porcentajeProcesos2 description]
     * @return [type] [description]
     */
    public function porcentajeProcesos2(){
        $porcentaje_pro = $this->autoevaluacion->porcentajeProcesosIndividial();
        return $porcentaje_pro;
    }
}

$grafica = new Grafica2();
$datos = $grafica->porcentajeProcesos2();
$porcentajes = array();
$nombres = array();


for($i=0; $i<count($datos); $i++){
    array_push($porcentajes , $datos[$i]['porcentaje']);
    array_push($nombres , $datos[$i]['nombre']);
}


$strCaract="";
$strCaract2="";
for($i=0; $i<count($nombres); $i++)
{
    if($i==0)
    {
        $strCaract="\"".$nombres[$i];
        $strCaract2="".$porcentajes[$i];                
    }
    else
    {
        $strCaract=$strCaract."\",\"".$nombres[$i];
        $strCaract2=$strCaract2.",".$porcentajes[$i];
        
    }
}
$strCaract=$strCaract."\"";
$strCaract2=$strCaract2.",";

?>

<script src="../Js/chart.min.js" type="text/javascript"></script>
<script src="../Js/Chart.js" type="text/javascript"></script>
    <div align="center">
        <canvas id="bar-chart2" class="chart-holder" width="450" height="451" style="float: left; ">
        </canvas>
    </div>

    <script>
    
            var barChartData = {
                labels: [<?php echo utf8_encode($strCaract);?>],
                
                datasets: [
                    {
                        fillColor: "rgba(150,150,150,0.5)",
                        strokeColor: "rgba(150,150,150,1)",
                        data: [<?php echo $strCaract2;?>]
                    }
                ]                
            }
    
        var myLine = new Chart(document.getElementById("bar-chart2").getContext("2d")).Bar(barChartData);


    </script>
    <br><br>