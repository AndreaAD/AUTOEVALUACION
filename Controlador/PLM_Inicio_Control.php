
<!-- se hace la inclusi�n de las librerias para gr�ficar-->
<script src="../Js/chart.min.js" type="text/javascript"></script>
<script src="../Js/Chart.js" type="text/javascript"></script>
<?php       
        
//se incluyen las librerias del modelo y la vista        
include('../Modelo/PLM_Inicio_Modelo.php');
include('../Vista/PLM_Inicio_Vista.php');

$glo_objModelIni = new Inicio_Model();
$glo_objModelIni->conectar();

//se duscan la cantidad de actividades de mejoramiento
$actividades=$glo_objModelIni->buscarActividades($_SESSION["pk_proceso"]);
//se buscan los factores y su calificaci�n
$factores=$glo_objModelIni->buscaCalFac($_SESSION["pk_proceso"]);

//se muestran las gr�ficas de las actividades y factores
$glo_objVistaIni = new Inicio_Vista();
$glo_objVistaIni->graficar($actividades,$factores);

?>
