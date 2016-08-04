
<?php
require('../fpdf/fpdf.php');

// se establece una clase para 
//generar datos de forma de tabla en pdf
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
    		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    	$h=5*$nb;
    	//Issue a page break first if needed
    	$this->CheckPageBreak($h);
    	//Draw the cells of the row
    	for($i=0;$i<count($data);$i++)
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
    			}
    			else
    				$i=$sep+1;
    			$sep=-1;
    			$j=$i;
    			$l=0;
    			$nl++;
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
    	 
    	 $this->SetFont('Arial','B',13);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
    	 $this->Cell(80);
    	$this->Ln(1);
    	 $this->Cell(80);
        $this->Cell(50,16,''.("Comparativo de los resultados Históricos de Autoevaluación del Programa"),0,0,'C');
        $this->Ln(9);
    	
       
    }
    function Footer()
    {
    	$this->SetY(-15);
    	
    	$this->SetFont("Arial", "B", 9); 
        $this->Cell(0,10,''.$this->PageNo(),0,0,'C');
    
    }
    
    }

    session_start();
        
    
    
	$pdf=new PDF();
    
	$pdf->Open();
	$pdf->AddPage();
	$pdf->SetMargins(20,20,20);
	$pdf->Ln(10);
	
	 
	$pdf->SetWidths(array(60,25, 30, 20,20, 26, 36));
	$pdf->SetFont('Arial','B',10);
	$pdf->SetFillColor(5,147,5);
    $pdf->SetTextColor(255);
    
    
    $pdf->Image("../imagenes/ESCUDO_UDEC.png", 20 ,10, 35 , 18,'png');
    
    
    $temp1=0;
    $cont2=0;
    //se agrag información de un proceso
    $pdf ->Row(array('FACTORES','AÑO','CALIFICACIÓN','COD PROCESO','PROCESO','SEDE'));
    $pdf->SetFont('Arial','',10);
    $pdf->SetFillColor(192,217,192);
    $pdf->SetTextColor(0);
    while(isset($_SESSION["plm_histo".($temp1)]))
    {
        $cont2=$temp1;
        $pdf ->Row(array(''.$_SESSION["plm_histo".$cont2],''.$_SESSION["plm_histo".($cont2+1)],''.$_SESSION["plm_histo".($cont2+2)],''.$_SESSION["plm_histo".($cont2+3)],''.$_SESSION["plm_histo".($cont2+4)],''.$_SESSION["plm_histo".($cont2+5)]));
        $temp1+=6;
    }
    
            
    $pdf ->Ln(2);
    
    //se crea una imagen, por medio de est libreria
    include("../pChart/pChart/pData.class");  
    include("../pChart/pChart/pChart.class");  
    
    // Dataset definition   
    $DataSet = new pData;  
    $i=0;
    $cont2=0;
    $temp1=0;
    $n=0;
    $vec[]=array();
    while(isset($_SESSION["plm_histoFac".$i]))
    {
        $n=0;
        $cont2=0;
        $temp1=0;
        while(isset($_SESSION["plm_histo".($temp1)]))
        {
            $cont2=$temp1;
            if($_SESSION["plm_histoFac".$i] == $_SESSION["plm_histo".$cont2] )
            {
                $vec[$n]=   $_SESSION["plm_histo".($cont2+2)];
                $n++;                
            }
            $temp1+=6;
        }
        if($n>0)
        {
            $DataSet->AddPoint( $vec,"".$_SESSION["plm_histoFac".$i]);
        }
        else
        {
            $DataSet->AddPoint( array(0),"".$_SESSION["plm_histoFac".$i]);
        }
        $i++;
    }
    
     
     $DataSet->AddAllSeries();  
     $DataSet->SetAbsciseLabelSerie();  
     //$DataSet->SetSerieName("January","Serie1");  
      
     // Initialise the graph  
     $Test = new pChart(740,230);  
     $Test->setFontProperties("../pChart/Fonts/tahoma.ttf",8);  
     $Test->setGraphArea(50,30,580,200);  
     $Test->drawFilledRoundedRectangle(7,7,700,223,5,240,240,240);  
     $Test->drawRoundedRectangle(5,5,700,225,5,230,230,230);  
     $Test->drawGraphArea(255,255,255,TRUE);  
     $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,TRUE);     
     $Test->drawGrid(4,TRUE,230,230,230,50);  
      
     // Draw the 0 line  
     $Test->setFontProperties("../pChart/Fonts/tahoma.ttf",6);  
     $Test->drawTreshold(0,143,55,72,TRUE,TRUE);  
      
     // Draw the bar graph  
     $Test->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE);  
      
     // Finish the graph  
     $Test->setFontProperties("../pChart/Fonts/tahoma.ttf",8);  
     $Test->drawLegend(590,10,$DataSet->GetDataDescription(),255,255,255);  
     $Test->setFontProperties("../pChart/Fonts/tahoma.ttf",10);  
     $Test->drawTitle(50,22,"Grafica de Históricos",50,50,50,585);              
    //se exporta la imagen creda
     $Test->Render("../imagenes/reporteHistorico".$_SESSION['pk_proceso'].".png");  
    
            
            
    $pdf ->Ln();
    $pdf->Cell(50,50,'Grafica de Históricos','C');
    
    //se importa la imagen creda
    $pdf->Image("../imagenes/reporteHistorico".$_SESSION['pk_proceso'].".png", 20 ,170, 170 , 50,'png');
            
            
    
    $pdf ->Ln();
    $pdf ->Ln();
    $pdf->Cell(56,7,'','C');
    $pdf ->Ln();
    $pdf->Cell(56,7,'','C');
    $pdf ->Ln();
    $pdf->Cell(56,7,'','C');
    $pdf ->Ln();
    $pdf->Cell(56,7,'','C');
    $pdf ->Ln();
    $pdf->Cell(56,7,'','C');
    $pdf ->Ln();
    $pdf->Cell(56,7,'','C');
    $pdf ->Ln();
    $pdf->Cell(56,7,'','C');
    $pdf ->Ln();
    $pdf->Cell(56,7,'','C');    
    $pdf->Cell(56,7,'UNIVERSIDAD DE CUNADINAMARCA','C');
    $pdf ->Ln();
    $pdf->Cell(60,7,'','C');
    $pdf->Cell(60,7,'Consolidación de Resultados','C');
    $pdf ->Ln();
    $hoy = getdate();
    $pdf->Cell(60,7,'','C');
    $pdf->Cell(60,5,'Fecha de impresión: '.$hoy["year"]."/".$hoy["mon"]."/".$hoy["mday"],'C');
    
        
    $pdf->Output();
            
?>