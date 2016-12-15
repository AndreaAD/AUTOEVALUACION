<?php

session_start();
define('FPDF_FONTPATH','../fpdf/font/');
require('../fpdf/fpdf.php');

$factor = $_GET['id_factor'];

//esta es una clase para mostrar datos en un pdf.
class PDF extends FPDF
{
        
    var $widths;
    var $aligns;
    
    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths=$w;
    }
    
    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns=$a;
    }
    
    function Row($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            if(isset($data[$i]))
            {
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
            }
        $h=5*$nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            if(isset($data[$i]))
            {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            
            $this->Rect($x,$y,$w,$h);
    
            $this->MultiCell($w,5,$data[$i],0,$a,'true');
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
            }
        }
        //Go to the next line
        $this->Ln($h);
    }
    
    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }
    
    function NbLines($w,$txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                    else
                        $i++;
                        
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                $i++;
            }
            else
                $i++;
        }
        return $nl;
    }
    
    function Header()
    {
         // Salto de línea
        $this->Ln(16);
         
         $this->AddFont('Arial','','Arial.php');
        $this->SetFont('Arial','',12);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
         $this->Cell(80);
        $this->Ln(1);
         $this->Cell(130);
        $this->Cell(20,20,''.utf8_decode('REPORTE ANÁLISIS DE RESULTADOS POR CARACTERISTICA'),0,0,'C');
        $this->Ln(9);
        
       
    }
    function Footer()
    {
        $this->SetY(-15);
        
        $this->AddFont('Arial','','Arial.php');
    $this->SetFont('Arial','',12);
        $this->Cell(0,10,''.$this->PageNo(),0,0,'C');
    
    }
    
}


$pdf=new PDF('L','mm','A4');

$pdf->Open();
$pdf->AddPage();
$pdf->SetMargins(15,15,15);
$pdf->Ln(15);
$pdf->Ln(8);

$pdf->SetWidths(array(65,65, 65, 65,65, 70, 80));
$pdf->AddFont('Arial','','Arial.php');
$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(5,147,5);
$pdf->SetTextColor(255);


$pdf->Image("../imagenes/ESCUDO_UDEC.png", 20 ,10, 35 , 18,'png');

for($i=0;$i<1;$i++)
{
    $pdf ->Row(array(utf8_decode('PROGRAMA ACADÉMICO'),'SEDE','DIRECTOR','PERIODO'));
    $pdf->AddFont('Arial','','Arial.php');
    $pdf->SetFont('Arial','',12);
    $pdf->SetFillColor(192,217,192);
    $pdf->SetTextColor(0);
    $pdf ->Row(array(''.utf8_decode($_SESSION["plm_programa"]),''.utf8_decode($_SESSION["plm_sede"]),''.utf8_decode($_SESSION["plm_director"]),''.utf8_decode($_SESSION["plm_periodo"])));
}
    
$i=0;
$cont=0;
$floTot=0;
$vec[][]=array();


$pdf ->Ln(8);
$pdf->SetWidths(array(30,60,30,40,60,45));
$pdf->AddFont('Arial','','Arial.php');
$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(5,147,5);
$pdf->SetTextColor(255);
$pdf ->Row(array('Codigo','Nombre',utf8_decode('Ponderación'),utf8_decode('Calificación'),'Porcentaje Cumplimiento','Escala cualitativa'));


$pdf->SetFillColor(192,217,192);
$pdf->SetTextColor(0);

// for($i=0; $i<1; $i++){
//     $pdf ->Row(array('ds','rt','sad','fdg','ffdggfd','fdghh'));
// }       

require_once('../Modelo/PLM_PrincipalAnalisis_Modelo.php');
$instancia = new  Analisis();

$arrInfo = $instancia->buscarProceso($_SESSION["pk_proceso"],$_SESSION["pk_usuario"]);
if(isset($arrInfo[0][0]))
{

    $_SESSION["plm_facultad"]=$arrInfo[0];
    $_SESSION["plm_programa"]=$arrInfo[1];
    $_SESSION["plm_sede"]=$arrInfo[2];
    $_SESSION["plm_director"]=$arrInfo[4];
    $_SESSION["plm_periodo"]=$arrInfo[3];
    
    //busca todos los factores
    $arrFactor[][]=array();
    $arrFactor = $instancia->buscaFactor();
    $floCal = 0;
    $temp=0;
    $arrCalFactor[][]=array();
    $arrCarac[] =array();
    $arrAspectos[] =array();
    $datos[] =array();
    $resultados_tabla =array();

    $arrCarac =  $instancia->listaCaracteristicasProceso($factor);
    foreach ($arrCarac as &$caracteristica){
        $datos =  $instancia->obtenerDatosPonderacion($caracteristica[0], $_SESSION["pk_proceso"]);
        $factor_ = $instancia->buscarFactor_($factor);

        $datos_ponderacion_caracteristica =  $instancia->obtenerPonderacionCaracteristica($caracteristica[0], $_SESSION["pk_proceso"]);


        $escala_cualitativa =  $instancia->obtenerEscalaCualitativa();

        $tamaño = count($datos);
        $promedio1 = 0;
        $promedio2 = 0;
        $promedio_modulo5 = 0;
        $promedio_modulo6 = 0;
        $promedio = 0;

        if($tamaño == 0){
            $glo_objViewAnali->mensaje("EL PROCESO ACTUAL NO SE HA CONSOLIDADO!");

        }else if($tamaño == 1){

            $promedio = $datos[0]['calificacion'];
            if($datos[0]['fk_modulo'] == 5){
                $promedio_modulo5 = $promedio;
            }else{
                $promedio_modulo6 = $promedio;
            }


            $porcentaje_cumplimiento = ( $promedio * 100 ) / ( $datos_ponderacion_caracteristica[0]['ponderacion_porcentual'] * 100 );

        }else if($tamaño == 2){

            $promedio1 = $datos[0]['calificacion'] != NULL ? $datos[0]['calificacion']  : 0 ;
            $promedio2 = $datos[1]['calificacion'] != NULL ? $datos[1]['calificacion']  : 0 ;

            if($datos[0]['fk_modulo'] == 5){
                $promedio_modulo5 = $promedio1;
            }else{
                $promedio_modulo6 = $promedio1;
            }


            if($datos[1]['fk_modulo'] == 5){
                $promedio_modulo5 = $promedio2;
            }else{
                $promedio_modulo6 = $promedio2;
            }

            $resultados_promedio = $promedio1 + $promedio2;
            $promedio = $resultados_promedio / 2;


            $porcentaje_cumplimiento = ( $promedio * 100 ) / ( $datos_ponderacion_caracteristica[0]['ponderacion_porcentual'] * 100 );

        }   


        $p = $promedio * 10 ;
        $p_2 = $p / 2;

        $consulta_escala = $instancia->ConsultarEscala($p_2);

        //$promedio = number_format ($promedio ,2);

        $resultados_carc = array(
            'caracteristica_id' => $caracteristica['pk_caracteristica'],
            'factor' => $factor_[0][5],
            'pk_factor' => $factor_[0][0],
            'nombre' => $factor_[0][1],
            'caracteristica' => $caracteristica['codigo'],
            'ponderacion_porcentual' => $datos_ponderacion_caracteristica[0]['ponderacion_porcentual'] * 100,
            'valor_modulo_5' => $promedio_modulo5,
            'valor_modulo_6' => $promedio_modulo6,
            'promedio' => $promedio  * 100,
            'porcentaje_cumplimiento' => number_format($porcentaje_cumplimiento *100, 2),
            'escala' => $consulta_escala[0][0],
        );


        $pond_porcentual_db = $datos_ponderacion_caracteristica[0]['ponderacion_porcentual'] * 100;
        $prom_db = $promedio * 100;

        $consulta = $instancia->BuscarPonderacionCaracteristicaPlm($factor_[0][0],$caracteristica['pk_caracteristica'], $_SESSION["pk_proceso"]);
        if($consulta[0] > 0){
            $consulta = $instancia->GuardarPonderacionCaracteristicaPlm($factor_[0][0],$_SESSION["pk_proceso"], $caracteristica['pk_caracteristica'], $pond_porcentual_db, $prom_db, 2);
        }else{
            $consulta = $instancia->GuardarPonderacionCaracteristicaPlm($factor_[0][0],$_SESSION["pk_proceso"], $caracteristica['pk_caracteristica'],$pond_porcentual_db , $prom_db, 1);
        }

        array_push($resultados_tabla, $resultados_carc);

    }
}


$pdf->SetFillColor(255,255,255);
foreach($resultados_tabla as &$resultado){

    $pdf ->Row(array($resultado['factor'],utf8_decode($resultado['caracteristica']),$resultado['ponderacion_porcentual'],$resultado['promedio'],$resultado['porcentaje_cumplimiento'],$resultado['escala']));
}


// $datos_grafica = $instancia->buscaCalCarac($factor, $_SESSION['pk_proceso']);
 
// include("../pChart/pChart/pData.class");  
// include("../pChart/pChart/pChart.class");  
      
// $arregloDatos = array();
// $arregloTitulos = array();
// $DataSet = new pData;

// foreach ($datos_grafica as &$value) {
//     array_push($arregloDatos, $value[1]);
//     array_push($arregloTitulos, $value[0]);
// }

// $DataSet->AddPoint(array($arregloDatos),"Factores");
// $DataSet->AddAllSeries();  
// $DataSet->SetAbsciseLabelSerie();  



//  //Initialise the graph
//  $Test = new pChart(740,230);
//  $Test->setFontProperties("../pChart/Fonts/Tahoma.ttf",8);  
//  $Test->setGraphArea(50,30,580,200);  
//  $Test->drawFilledRoundedRectangle(7,7,700,223,5,240,240,240);  
//  $Test->drawRoundedRectangle(5,5,700,225,5,230,230,230);  
//  $Test->drawGraphArea(255,255,255,TRUE);  
//  $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,300,150,50,TRUE,0,2,TRUE);     
//  $Test->drawGrid(4,TRUE,230,230,230,50);  
  
//  // Draw the 0 line  
//  $Test->setFontProperties("../pChart/Fonts/Tahoma.ttf",6);  
//  $Test->drawTreshold(0,143,55,72,TRUE,TRUE);  
  
//  // Draw the bar graph  
//  $Test->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE);  
  
//  // Finish the graph  
//  $Test->setFontProperties("../pChart/Fonts/Tahoma.ttf",8);  
//  $Test->drawLegend(590,10,$DataSet->GetDataDescription(),255,255,255);  
//  $Test->setFontProperties("../pChart/Fonts/Tahoma.ttf",10);  
//  $Test->drawTitle(50,22,"Grafica de Calificación",50,50,50,585);           

// // se genera un imagen 
// $Test->Render("../imagenes/reporteAnalisisCarac".$_SESSION['pk_proceso'].".png"); 
            
//     $pdf ->Ln();
//     $pdf ->Ln();
//     $pdf ->Ln();
//     $pdf ->Ln();
//     $pdf ->Ln();
//     $pdf ->Ln();
//         $pdf ->Ln();
//     $pdf ->Ln();
//     $pdf ->Ln();
//     $pdf ->Ln();
//     $pdf ->Ln();
//     $pdf ->Ln();
//         $pdf ->Ln();
//     $pdf ->Ln();
//     $pdf ->Ln();
//     $pdf ->Ln();
//     $pdf ->Ln();
//     $pdf ->Ln();
//         $pdf ->Ln();
//     $pdf ->Ln();
//     $pdf ->Ln();
//     $pdf ->Ln();
//     $pdf ->Ln();
//     $pdf ->Ln(50);
    
//     $pdf->Cell(50,50,'','C');
//     //se inserta la imagen en el documento pdf
//     $pdf->Image("../imagenes/reporteAnalisisCarac".$_SESSION['pk_proceso'].".png", 65 ,70, 0 , 0,'png');
//     $pdf ->Ln();
//     $pdf->Cell(56,7,'','C');
//     $pdf->Cell(56,7,'','C');
//     $pdf->Cell(56,7,'','C');
//     $pdf->Cell(56,7,'','C');    
//     $pdf ->Ln();
//     $pdf->Cell(60,7,'','C');
//     $pdf ->Ln();
//     $pdf->Cell(60,7,'','C');
$pdf->Output();
            
?>