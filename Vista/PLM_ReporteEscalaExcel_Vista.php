<?php
session_start();


// en este reprote se pretende 
// exportar la información de las escalas 

$i=0;
$cont=0;
$floTot=0;
$arrVec3[] = array();
$arrVec2[] = array(); 
$arrAnalisis[]= array();
$aux=0; 
$aux2=0; 
$contF=0;

// se crea u vector y se llena de información para 
// despues llevarlo al excel
while(isset($_SESSION["plm_esca2".$i]))
{
    if($i==0)
    {
        $arrVec[] = array(); 
        $arrVec[0]='Total CNA';
        $k=0;
        $cont=0;
        
        while(isset($_SESSION["plm_esca2".$k]))
        { 
    	  if($k==0)
          {
           $arrVec[$cont]='Total CNA'; 
           $cont++;
          } 
          
           $arrVec[$cont]=($_SESSION["plm_esca2".$k]); 
           $cont++;
          
           $k++;
        }
        
        $arrAnalisis[$contF]=$arrVec;
        
        
    }
    
    if($i==0)
    {
        $arrAnalisis[$contF][6]=" ";
        $arrAnalisis[$contF][7]=utf8_encode("Programa Académico");
        $arrAnalisis[$contF][8]="Sede / Seccional";
        $arrAnalisis[$contF][9]="Nombre Director";
        $arrAnalisis[$contF][10]="Periodo";
        
        $arrAnalisis[$contF+1][0]=" ";
        $arrAnalisis[$contF+1][1]="";
        $arrAnalisis[$contF+1][2]="";
        $arrAnalisis[$contF+1][3]="";
        $arrAnalisis[$contF+1][4]="";
        $arrAnalisis[$contF+1][5]="";
        
        $arrAnalisis[$contF+1][6]=" ";
        $arrAnalisis[$contF+1][7]="".utf8_encode($_SESSION["plm_programa"]);
        $arrAnalisis[$contF+1][8]="".utf8_encode($_SESSION["plm_sede"]);
        $arrAnalisis[$contF+1][9]="".utf8_encode($_SESSION["plm_director"]);
        $arrAnalisis[$contF+1][10]="".utf8_encode($_SESSION["plm_periodo"]);
    }
    else
    {
    }
    

    
    if(isset($_SESSION["plm_esca4".$i]))
    {                
        if($i==0)
        {
           $arrVec2[$aux2]= sprintf('%.2f', $_SESSION["plm_tot"]);
           $aux2++;
        } 
        
        $arrVec2[$aux2] = sprintf('%.2f', $_SESSION["plm_esca4".$i]);
        $aux2++;
        
    }
    if(isset($_SESSION["plm_esca3".$i]))
    {
        if($i==0)
        {
            $arrVec3[$aux]= "100";
            $aux++;
        }
        $arrVec3[$aux]= sprintf('%.2f', ($_SESSION["plm_esca3".$i]))."";
        $aux++;                      
    }                   
    $i++;
}

$arrAnalisis[$contF+2]=$arrVec2;
    
$arrAnalisis[$contF+3]=$arrVec3;

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Europe/London');



require_once dirname(__FILE__) . '../../phpexcel/Classes/PHPExcel.php';


$objPHPExcel = new PHPExcel();
$objWorksheet = $objPHPExcel->getActiveSheet();
$objWorksheet->fromArray(
    		$arrAnalisis
    	
        );



//se hacen consultas sobre el excel para poder graficar la información
$dataseriesLabels2 = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$5:$A$5', NULL, 1)	//	2010
);

$xAxisTickValues2 = array(
	new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1:$F$1', NULL, 4)	//	Q1 to Q4
);

$dataSeriesValues2 = array(
	new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$4:$F$4', NULL, 4)
);

//	Build the dataseries
$series1 = new PHPExcel_Chart_DataSeries(
	PHPExcel_Chart_DataSeries::TYPE_PIECHART,				// plotType
	PHPExcel_Chart_DataSeries::GROUPING_STANDARD,			// plotGrouping
	range(0, count($dataSeriesValues2)-1),					// plotOrder
	$dataseriesLabels2,										// plotLabel
	$xAxisTickValues2,										// plotCategory
	$dataSeriesValues2										// plotValues
);

//	Set up a layout object for the Pie chart
$layout1 = new PHPExcel_Chart_Layout();
$layout1->setShowVal(TRUE);
$layout1->setShowPercent(TRUE);

//	Set the series in the plot area
$plotarea1 = new PHPExcel_Chart_PlotArea($layout1, array($series1));
//	Set the chart legend
$legend1 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

$title1 = new PHPExcel_Chart_Title("".$_SESSION["plm_titulo"]);


//se crea la gráfica
$chart1 = new PHPExcel_Chart(
	'chart1',		// name
	$title1,		// title
	$legend1,		// legend
	$plotarea1,		// plotArea
	true,			// plotVisibleOnly
	0,				// displayBlanksAs
	NULL,			// xAxisLabel
	NULL			// yAxisLabel		- Pie charts don't have a Y-Axis
);

//	Set the position where the chart should appear in the worksheet
$chart1->setTopLeftPosition('A7');
$chart1->setBottomRightPosition('H20');

//	Add the chart to the worksheet
$objWorksheet->addChart($chart1);



// se exporta el excel de manera que no se guarde localmente
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment;filename="Reporte Excel Escala PLM SIA.xlsx"');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$objWriter->save('php://output');
exit;


