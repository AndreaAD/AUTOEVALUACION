<?php
require('../fpdf/fpdf.php');

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
    	 
    	 $this->SetFont('Arial','B',13);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
    	 $this->Cell(80);
    	$this->Ln(1);
    	 $this->Cell(80);
        $this->Cell(50,16,''.utf8_decode($_SESSION["plm_titulo"]),0,0,'C');
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
	$pdf->Ln(15);
	
	 
	$pdf->Ln(8);
	
	$pdf->SetWidths(array(60,30, 40, 33,19, 46, 36));
	$pdf->SetFont('Arial','B',10);
	$pdf->SetFillColor(5,147,5);
    $pdf->SetTextColor(255);
    
    
    $pdf->Image("../imagenes/ESCUDO_UDEC.png", 20 ,10, 35 , 18,'png');
    
    for($i=0;$i<1;$i++)
    {
        //se muestra a información de un proceso en especifico, por dedio de variables de sesión
        $pdf ->Row(array('PROGRAMA ACADÉMICO','SEDE','NOMBRE DIRECTOR','PERIODO'));
	    $pdf->SetFont('Arial','',10);
	    $pdf->SetFillColor(192,217,192);
        $pdf->SetTextColor(0);
        $pdf ->Row(array(''.$_SESSION["plm_programa"],''.$_SESSION["plm_sede"],''.$_SESSION["plm_director"],''.$_SESSION["plm_periodo"]));
    }
    
    
    //se muestra un tabla con los datos ya sea de un factor, 
    //característica y aspecto 
    $i=0;
    $cont=0;
    $floTot=0;
    $vec[][]=array();
    while(isset($_SESSION["plm_id".$i]))
    {
        if($i==0)
        {
   	        $pdf ->Ln(5);
            
            if(isset($_SESSION["plm_ponde".$i]))
            {
            	$pdf->SetWidths(array(15,40, 25, 24,45, 45));
            	$pdf->SetFont('Arial','B',10);
            	$pdf->SetFillColor(5,147,5);
                $pdf->SetTextColor(255);   
                $pdf ->Row(array('Codigo','Nombre','Ponderación','Calificación','Porcentaje Cumplimiento','Escala cualitativa'));
            }
            else
            {
            	$pdf->SetWidths(array(15,40, 20, 25,30,30));
            	$pdf->SetFont('Arial','B',10);
            	$pdf->SetFillColor(5,147,5);
                $pdf->SetTextColor(255);   
                $pdf ->Row(array('Codigo','Nombre','Calificación','Porcentaje Cumplimiento','Escala cualitativa'));
                
            }
            
        }                
        $vec[$i][0]=$_SESSION["plm_id".$i];
        $vec[$i][1]=$_SESSION["plm_nombre".$i];
        
        
        
        if(isset($_SESSION["plm_ponde".$i]))
        {
			$vec[$i][2]=sprintf('%.2f',$_SESSION["plm_ponde".$i])."%";
        }
        
        $vec[$i][3]=sprintf('%.2f', $_SESSION["plm_cal".$i]);
		if( (((($_SESSION["plm_cal".$i])-1)/4)*100) < 0)
		{
			$vec[$i][4]="0%";
		}
		else
		{
			$vec[$i][4]=sprintf('%.2f', (((($_SESSION["plm_cal".$i])-1)/4)*100))."%";
		}
		
        $vec[$i][5]=$_SESSION["plm_esca".$i];
        
        if($i==0)
        {
            $cont=0;
        }
        
        
        if(isset($_SESSION["plm_ponde".$i]))
        {
            $floTot=$floTot + ($_SESSION["plm_cal".$i]*$_SESSION["plm_ponde".$i])/100;
        }
        else
        {
            $floTot=$floTot + ($_SESSION["plm_cal".$i]);            
        }
        $i++;
    }
    
    $pdf->SetFont('Arial','',10);
    $pdf->SetFillColor(192,217,192);
    $pdf->SetTextColor(0);
    
	$conT=0;
    for($i=0; $i<count($vec); $i++)
    {
         $pdf ->Row($vec[$i]); 
		 $conT ++;
    }

    $pdf ->Ln(2);

	$pdf->SetWidths(array(20,20));
	$pdf->SetFont('Arial','B',10);
	$pdf->SetFillColor(5,147,5);
    $pdf->SetTextColor(255);   
	$pdf ->Row(array("Total"));
    
    $pdf->SetFont('Arial','',10);
    $pdf->SetFillColor(192,217,192);
    $pdf->SetTextColor(0);
    
	$pdf ->Row(array(''.sprintf('%.2f',$floTot)));
               
     include("../pChart/pChart/pData.class");  
     include("../pChart/pChart/pChart.class");  
      
     // Dataset definition   
     $DataSet = new pData;  
     
     $vec[]=array();
     $vec2[]=array();
	 $n=0;
	 while(isset($_SESSION["plm_id".$n]))
     {
		 if($_SESSION["plm_cal".$n]!=0)
		 {
			$DataSet->AddPoint( $_SESSION["plm_cal".$n],"".$_SESSION["plm_nombre".$n]."");  
	
		 }		
		 $n++;
     }
     
     
     // se llena un data set para mostrar una imagen
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
     $Test->drawTitle(50,22,"Grafica de Calificación",50,50,50,585);              

    // se genera un imagen 
     $Test->Render("../imagenes/reporteAnalisis".$_SESSION['pk_proceso'].".png");  
    
            
            
	$pdf ->Ln();
	$pdf ->Ln();
	$pdf ->Ln();
	$pdf ->Ln();
	$pdf ->Ln();
	$pdf ->Ln();
	
    $pdf->Cell(50,50,'Grafica de Calificación','C');
    //se inserta la imagen en el documento pdf
    $pdf->Image("../imagenes/reporteAnalisis".$_SESSION['pk_proceso'].".png", 20 ,170, 170 , 50,'png');
    
    $pdf ->Ln();
    $pdf ->Ln();
    $pdf ->Ln();
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