<?php

session_start();
define('FPDF_FONTPATH','../fpdf/font/');
require('../fpdf/fpdf.php');

$proceso = $_GET['proceso'];

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
        $this->Ln(16);
        $this->AddFont('Arial','','Arial.php');
        $this->SetFont('Arial','',12);
        $this->Cell(80);
        $this->Cell(80);
        $this->Ln(4);
        $this->Cell(25);
        $this->Cell(20,20,''.'PLAN DE MEJORAMIENTO',0,0,'C');
        $this->Ln(9);
        
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->AddFont('Arial','','Arial.php');
        $this->SetFont('Arial','',12);
        //$this->Cell(0,10,''.$this->PageNo(),0,0,'C');
    
    }
    
}

require_once('../Modelo/PLM_Plan_Modelo.php');
$instancia = new  Plan();

$datos = $instancia->cargar_tabla_plan($proceso);
$pro = $instancia->NombreProceso($proceso);

$pdf=new PDF();

$pdf->Open();
$pdf->AddPage();
$pdf->SetMargins(15,15,15);
$pdf->Ln(15);
$pdf->SetWidths(array(65,65, 65, 65,65, 70, 80));
$pdf->AddFont('Arial','','Arial.php');
$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(5,147,5);
$pdf->SetTextColor(255);
$pdf->Image("../imagenes/ESCUDO_UDEC.png", 20 ,10, 35 , 18,'png'); 
$pdf->SetWidths(array(180));
$pdf->AddFont('Arial','','Arial.php');
$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(5,147,5);
$pdf->SetTextColor(255);
$pdf ->Row(array(utf8_decode('Proceso autoevaluación: '.$pro[0]['nombre'])));
$pdf ->Ln(2);

foreach($datos as &$resultado)
{
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);
    $pdf->Ln(10);
    $pdf->SetWidths(array(50,130));
    $pdf->AddFont('Arial','','Arial.php');
    $pdf->SetFont('Arial','',12);
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);
    $pdf->Row(array("Factor: ",$resultado['fk_factor']));

    $pdf->SetWidths(array(50,130));
    $pdf->AddFont('Arial','','Arial.php');
    $pdf->SetFont('Arial','',12);
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);
    $pdf->Row(array("Nombre: ",$resultado['nombre']));

    $pdf->SetWidths(array(50,130));
    $pdf->AddFont('Arial','','Arial.php');
    $pdf->SetFont('Arial','',12);
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);
    $pdf->Row(array("Fecha fnicio: ",$resultado['fecha_inicio']));

    $pdf->SetWidths(array(50,130));
    $pdf->AddFont('Arial','','Arial.php');
    $pdf->SetFont('Arial','',12);
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);
    $pdf->Row(array("Fecha fin: ",$resultado['fecha_fin']));

    $pdf->SetWidths(array(50,130));
    $pdf->AddFont('Arial','','Arial.php');
    $pdf->SetFont('Arial','',12);
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);
    $pdf->Row(array("Peso: ",$resultado['peso']));
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);

    $pdf->SetWidths(array(50,130));
    $pdf->AddFont('Arial','','Arial.php');
    $pdf->SetFont('Arial','',12);
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);
    $pdf->Row(array("Indicador: ",$resultado['indicador']));
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);

    $pdf->SetWidths(array(50,130));
    $pdf->AddFont('Arial','','Arial.php');
    $pdf->SetFont('Arial','',12);
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);
    $pdf->Row(array("Responsable: ",$resultado['responsable']));
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);

    $pdf->SetWidths(array(50,130));
    $pdf->AddFont('Arial','','Arial.php');
    $pdf->SetFont('Arial','',12);
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);
    $pdf->Row(array("Cargo: ",$resultado['cargo']));
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);

        $pdf->SetWidths(array(50,130));
    $pdf->AddFont('Arial','','Arial.php');
    $pdf->SetFont('Arial','',12);
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);
    $pdf->Row(array(utf8_decode("Descripción:"),utf8_decode($resultado['descripcion'])));
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);


        $pdf->SetWidths(array(50,130));
    $pdf->AddFont('Arial','','Arial.php');
    $pdf->SetFont('Arial','',12);
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);
    $pdf->Row(array("Recursos: ",$resultado['recursos']));
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);

        $pdf->SetWidths(array(50,130));
    $pdf->AddFont('Arial','','Arial.php');
    $pdf->SetFont('Arial','',12);
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);
    $pdf->Row(array("Meta: ",$resultado['meta']));
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);

        $pdf->SetWidths(array(50,130));
    $pdf->AddFont('Arial','','Arial.php');
    $pdf->SetFont('Arial','',12);
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);
    $pdf->Row(array("Evidencias: ",$resultado['evidencias']));
    $pdf->SetFillColor(250,250,250);
    $pdf->SetTextColor(0);


    // $pdf->Ln(10);
    // $pdf->Cell(40,10,'Nombre: ',1,0,'L');
    // $pdf->Cell(140,10,$resultado['nombre'],1,0,'L');
    // $pdf->Ln(10);
    // $pdf->Cell(40,10,'Fecha Inicio: ',1,0,'L');
    // $pdf->Cell(140,10,$resultado['fecha_inicio'],1,0,'L');
    // $pdf->Ln(10);
    // $pdf->Cell(40,10,'Fecha Fin: ',1,0,'L');
    // $pdf->Cell(140,10,$resultado['fecha_fin'],1,0,'L');
    // $pdf->Ln(10);
    // $pdf->Cell(40,10,'Peso: ',1,0,'L');
    // $pdf->Cell(140,10,$resultado['peso'],1,0,'L');
    // $pdf->Ln(10);
    // $pdf->Cell(40,30,'Indicador: ',1,0,'L');
    // $pdf->Cell(140,30,$resultado['indicador'],1,0,'L');

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(255,255,255);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array($resultado['fk_factor']));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(250,250,250);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array("Nombre proyecto"));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(255,255,255);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array($resultado['nombre']));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(250,250,250);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array("Fecha Inicio"));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(255,255,255);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array($resultado['fecha_inicio']));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(250,250,250);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array("Fecha fin"));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(255,255,255);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array($resultado['fecha_fin']));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(250,250,250);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array("Peso"));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(255,255,255);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array($resultado['peso']));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(250,250,250);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array("Indicador"));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(255,255,255);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array($resultado['indicador']));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(250,250,250);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array("Responsable"));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(255,255,255);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array($resultado['responsable']));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(250,250,250);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array("Cargo"));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(255,255,255);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array($resultado['cargo']));

    //     $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(250,250,250);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array("Cargo"));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(255,255,255);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array($resultado['cargo']));

    //     $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(250,250,250);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array("descripcion"));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(255,255,255);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array($resultado['descripcion']));

    //     $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(250,250,250);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array("recursos"));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(255,255,255);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array($resultado['recursos']));

    //     $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(250,250,250);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array("meta"));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(255,255,255);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array($resultado['meta']));


    //     $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(250,250,250);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array("evidencias"));

    // $pdf->SetWidths(array(180));
    // $pdf->AddFont('Arial','','Arial.php');
    // $pdf->SetFont('Arial','',12);
    // $pdf->SetFillColor(255,255,255);
    // $pdf->SetTextColor(0);
    // $pdf ->Row(array($resultado['evidencias']));
}



$pdf->Output();
            
?>