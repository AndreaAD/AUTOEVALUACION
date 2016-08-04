<?php

session_start();

$arrAnalisis[][]= array();

// el reporte en excel se genera con variables de sessión 
// y aqui vamos a llenar un vector con todos los datos
$i=0;
while(isset($_SESSION["plm_id".$i]))
{
    if($i==0)
    {
        
        $arrAnalisis[$i][0]="Código";
        $arrAnalisis[$i][1]="Nombre";
        $arrAnalisis[$i][2]=utf8_encode("Ponderación");
        $arrAnalisis[$i][3]=utf8_encode("Calificación");
        $arrAnalisis[$i][4]="Procentaje de cumplimiento";
        $arrAnalisis[$i][5]="Escala cualitativa";
        $arrAnalisis[$i][6]=" ";
        $arrAnalisis[$i][7]="Programa Académico";
        $arrAnalisis[$i][8]="Sede / Seccional";
        $arrAnalisis[$i][9]="Nombre Director";
        $arrAnalisis[$i][10]="Periodo";
    }
    $arrAnalisis[$i+1][0]="".$_SESSION["plm_id".$i];
    $arrAnalisis[$i+1][1]="".utf8_encode($_SESSION["plm_nombre".$i]);
	if(isset($_SESSION["plm_ponde".$i]))
	{
		$arrAnalisis[$i+1][2]="".$_SESSION["plm_ponde".$i];
	}
	else
	{
		$arrAnalisis[$i+1][2]="0";
	}
    $arrAnalisis[$i+1][3]="".sprintf('%.2f', $_SESSION["plm_cal".$i]);
	if(((($_SESSION["plm_cal".$i]-1)/4)*100) < 0)
	{
		$arrAnalisis[$i+1][4]=sprintf('%.2f',0)."%"; 
	}
	else
	{
		$arrAnalisis[$i+1][4]="".sprintf('%.2f', ((($_SESSION["plm_cal".$i]-1)/4)*100))."%"; 
	}
    $arrAnalisis[$i+1][5]="".utf8_encode($_SESSION["plm_esca".$i]);
    
    
    if($i==0)
    {
        $arrAnalisis[$i+1][6]=" ";
        $arrAnalisis[$i+1][7]="".utf8_encode($_SESSION["plm_programa"]);
        $arrAnalisis[$i+1][8]="".utf8_encode($_SESSION["plm_sede"]);
        $arrAnalisis[$i+1][9]="".utf8_encode($_SESSION["plm_director"]);
        $arrAnalisis[$i+1][10]="".utf8_encode($_SESSION["plm_periodo"]);
    }
    else
    {
        
        $arrAnalisis[$i+1][6]=" ";
        $arrAnalisis[$i+1][7]="";
        $arrAnalisis[$i+1][8]="";
        $arrAnalisis[$i+1][9]="";
        $arrAnalisis[$i+1][10]="";
    }
    
    $i++;
}

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Europe/London');



require_once dirname(__FILE__) . '../../phpexcel/Classes/PHPExcel.php';


//aqui se le envia el vector con todos los datos al vector
$objPHPExcel = new PHPExcel();
$objWorksheet = $objPHPExcel->getActiveSheet();
$objWorksheet->fromArray(
		$arrAnalisis
        );



//	Set the Labels for each data series we want to plot
//		Datatype
//		Cell reference for data
//		Format Code
//		Number of datapoints in series
//		Data values
//		Data Marker
$arrTemp[]=array();
for($i=0; $i<count($arrAnalisis); $i++)
{
	$str = 'Worksheet!$B$'.($i+2);
	$str = $str.':$B$'.($i+2);
	$arrTemp[$i]= new PHPExcel_Chart_DataSeriesValues('String', $str, NULL, 1);	//	2010
}
$dataseriesLabels2 = $arrTemp;
//	Set the X-Axis Labels
//		Datatype
//		Cell reference for data
//		Format Code
//		Number of datapoints in series
//		Data values
//		Data Marker

$arrTemp2[]=array();
for($i=0; $i<count($arrAnalisis); $i++)
{
	$str = 'Worksheet!$A$'.($i+2);
	$str = $str.':$A$'.($i+2);
	$arrTemp2[$i]= new PHPExcel_Chart_DataSeriesValues('String', $str, NULL, 4);	
}
$xAxisTickValues2 = $arrTemp2;

//	Set the Data values for each data series we want to plot
//		Datatype
//		Cell reference for data
//		Format Code
//		Number of datapoints in series
//		Data values
//		Data Marker
$arrTemp3[]=array();
for($i=0; $i<count($arrAnalisis); $i++)
{
	$str = 'Worksheet!$D$'.($i+2);
	$str = $str.':$D$'.($i+2);
	$arrTemp3[$i]= new PHPExcel_Chart_DataSeriesValues('String', $str, NULL, 4);	
}

$dataSeriesValues2 = $arrTemp3;

//	Build the dataseries
$series2 = new PHPExcel_Chart_DataSeries(
	PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
	PHPExcel_Chart_DataSeries::GROUPING_STANDARD,	// plotGrouping
	range(0, count($dataSeriesValues2)-1),			// plotOrder
	$dataseriesLabels2,								// plotLabel
	$xAxisTickValues2,								// plotCategory
	$dataSeriesValues2								// plotValues
);
//	Set additional dataseries parameters
//		Make it a vertical column rather than a horizontal bar graph
$series2->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

//	Set the series in the plot area
$plotarea2 = new PHPExcel_Chart_PlotArea(NULL, array($series2));
//	Set the chart legend
$legend2 = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

$title2 = new PHPExcel_Chart_Title(''.$_SESSION["plm_titulo"]);
$yAxisLabel2 = new PHPExcel_Chart_Title('');


//	Create the chart
$chart2 = new PHPExcel_Chart(
	'chart2',		// name
	$title2,		// title
	$legend2,		// legend
	$plotarea2,		// plotArea
	true,			// plotVisibleOnly
	0,				// displayBlanksAs
	NULL,			// xAxisLabel
	$yAxisLabel2	// yAxisLabel
);

//	Set the position where the chart should appear in the worksheet
$chart2->setTopLeftPosition('I7');
$chart2->setBottomRightPosition('P20');

//	Add the chart to the worksheet
$objWorksheet->addChart($chart2);


// se esta generan do el excel detal manera que sea de forma 
//temporal y se pueda descargar directamente por el usuario
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment;filename="Reporte Excel PLM SIA.xlsx"');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$objWriter->save('php://output');

exit;

