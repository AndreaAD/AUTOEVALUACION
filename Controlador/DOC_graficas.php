<?php 
error_reporting(0);
session_start();
include_once '../Modelo/DOC_Autoevaluacion_Modelo.php';
    

class Grafica{

    /**
     * [__construct constructor]
     */
    public function __construct(){
        $this->autoevaluacion = new Autoevaluacion_Modelo;
    }
    
    /**
     * [porcentajeProcesos retorna el porcentaje realizado en todos los procesos existentes]
     * @return [int] [procetaje realizado procesos]
     */
    public function porcentajeProcesos(){
        $porcentaje_procesos = $this->autoevaluacion->porcentajeProcesos();
        return $porcentaje_procesos;
    }
}


$grafica = new Grafica();
$datos = $grafica->porcentajeProcesos();
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
        $nombre = substr($nombres[$i], 0, 20); 
        $strCaract="\"".$nombre;
        $strCaract2="".$porcentajes[$i];                
    }
    else
    {
        $nombre = substr($nombres[$i], 0, 20);
        $strCaract=$strCaract."\",\"".$nombre;
        $strCaract2=$strCaract2.",".$porcentajes[$i];
        
    }
}
$strCaract=$strCaract."\"";
$strCaract2=$strCaract2.",";


?>

<br />
<br />

<div align="center">
    <canvas id="bar-chart" class="chart-holder" width="900" height="600">
    
    </canvas>
</div>
<script>

        var barChartData = {
            labels: [<?php echo $strCaract;?>],
            datasets: [
                {

                    fillColor: "rgba(151,187,205,0.5)",
                    strokeColor: "rgba(151,187,205,1)",
                    data: [<?php echo $strCaract2;?>]
                }
            ]                
        }

    myLine = new Chart(document.getElementById("bar-chart").getContext("2d")).Bar(barChartData);
    
</script>
<script src="../Js/chart.min.js" type="text/javascript"></script>
<script src="../Js/Chart.js" type="text/javascript"></script>
