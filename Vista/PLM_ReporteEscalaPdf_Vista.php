<?php
require('../fpdf/fpdf.php');

////esta es una clase para generar tablas en un pdf
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
        {
            if(isset($this->widths[$i]))
            {
                if($this->widths[$i])
                {                        
            	   $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
                }
            }            
   	    }
                    
    	$h=5*$nb;
    	//Issue a page break first if needed
    	$this->CheckPageBreak($h);
    	//Draw the cells of the row
    	for($i=0;$i<count($data);$i++)
    	{
    	   if(isset($this->widths[$i]))
            {
                if($this->widths[$i])
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
        $this->Ln(30);
    	 
    	 $this->SetFont('Arial','B',16);
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
   
    $pdf->SetFont('Arial','',10);
	
	 
	$pdf->Ln(8);
	
	$pdf->SetWidths(array(60,30, 40, 33,19, 46, 36));
	$pdf->SetFont('Arial','B',10);
	$pdf->SetFillColor(5,147,5);
    $pdf->SetTextColor(255);
    
    
    $pdf->Image("../imagenes/ESCUDO_UDEC.png", 20 ,10, 35 , 18,'png');
    
    
    
    for($i=0;$i<1;$i++)
    {
        $pdf ->Row(array('PROGRAMA ACADÉMICO','SEDE','NOMBRE DIRECTOR','PERIODO'));
	    $pdf->SetFont('Arial','',10);
	    $pdf->SetFillColor(192,217,192);
        $pdf->SetTextColor(0);
        $pdf ->Row(array(''.$_SESSION["plm_programa"],''.$_SESSION["plm_sede"],''.$_SESSION["plm_director"],''.$_SESSION["plm_periodo"]));
    }
    
    
    
    $i=0;
    $cont=0;
    $floTot=0;
    $arrVec3[] = array();
    $arrVec2[] = array(); 
    $aux=0; 
    $aux2=0; 
    while(isset($_SESSION["plm_esca2".$i]))
    {
        if($i==0)
        {
   	        $pdf ->Ln();
   	        $pdf ->Ln();
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
            $pdf->SetWidths(array(24,25, 35, 35,38, 25));
            $pdf->SetFont('Arial','B',10);
        	$pdf->SetFillColor(5,147,5);
            $pdf->SetTextColor(255);
            
            $pdf ->Row($arrVec);
            
            
        }
        
        
	    $pdf->SetFont('Arial','',10);
	    $pdf->SetFillColor(192,217,192);
        $pdf->SetTextColor(0);
        
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
                $arrVec3[$aux]= "100%";
                $aux++;
            }
            $arrVec3[$aux]= sprintf('%.2f', ($_SESSION["plm_esca3".$i]))."%";
            $aux++;                      
        }                   
        $i++;
    }
    
    $pdf ->Row($arrVec2);   
    $pdf ->Row($arrVec3);   

    $pdf ->Ln();
    $pdf ->Ln();
    
    //se genera la forma de crear una imagen 
    // y de inclirla en el pdf
     $pdf->SetTextColor(0);
     include("../pChart/pChart/pData.class");  
     include("../pChart/pChart/pChart.class");
     // Dataset definition   
     $DataSet = new pData;  
     $i=0;
     $arrPor[]=array();
     while(isset($_SESSION["plm_esca3".$i]))
     {
        $arrPor[$i]=$_SESSION["plm_esca3".$i];
        $i++;
     }
     unset($arrVec[0]);
     // se llenan los data set
     $DataSet->AddPoint($arrPor,"Serie1");  
     $DataSet->AddPoint($arrVec,"Serie2");  
     $DataSet->AddAllSeries();  
     $DataSet->SetAbsciseLabelSerie("Serie2");  
      
     // Initialise the graph  
     $Test = new pChart(480,200);  
     $Test->drawFilledRoundedRectangle(7,7,373,193,5,240,240,240);  
     $Test->drawRoundedRectangle(5,5,375,195,5,230,230,230);  
      
     // Draw the pie chart  
     $Test->setFontProperties("../pChart/Fonts/tahoma.ttf",8);  
     $Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),150,90,110,PIE_PERCENTAGE,TRUE,50,20,5);  
     $Test->drawPieLegend(310,15,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);  
      
      //y se genera la imagen png
     $Test->Render("../imagenes/reporteEscalas".$_SESSION['pk_proceso'].".png");  
     
     
 
 
            
    $pdf ->Ln(5);
    
    $pdf->Cell(50,50,'Grafica de Calificación','C');
    //aqui se importa la gráfic a en el documento pdf 
    $pdf->Image("../imagenes/reporteEscalas".$_SESSION['pk_proceso'].".png", 20 ,170, 130 , 60,'png');
    
    $pdf ->Ln();
    $pdf ->Ln();
    $pdf->Cell(66,7,'','C');
    $pdf ->Ln();
    $pdf->Cell(66,7,'','C');
    $pdf ->Ln();
    $pdf->Cell(66,7,'','C');
    $pdf ->Ln();
    $pdf->Cell(66,7,'','C');    
    $pdf->Cell(66,7,'UNIVERSIDAD DE CUNADINAMARCA','C');
    $pdf ->Ln();
    $pdf->Cell(70,7,'','C');
    $pdf->Cell(70,7,'Consolidación de Resultados','C');
    $pdf ->Ln();
    $hoy = getdate();
    $pdf->Cell(70,7,'','C');
    $pdf->Cell(70,5,'Fecha de impresión: '.$hoy["year"]."/".$hoy["mon"]."/".$hoy["mday"],'C');
        
    $pdf->Output();
            
?>