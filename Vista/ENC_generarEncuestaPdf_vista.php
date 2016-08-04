<?php
//header('Content-Type: text/html; charset=iso-8859-1');
require_once('../fpdf/fpdf.php');
$pdf=new FPDF();
$pdf->SetTitle('Formato de encuesta en pdf');
$pdf->SetMargins(20, 20);

$pdf->AddPage();
$pdf->SetFont('Helvetica','B',14);

$pdf->Image('../imagenes/ESCUDO_UDEC.png', 20, 23, 40, 0, 'PNG');

$pdf->SetXY(95,20);
$pdf->Cell(40,0,strtoupper('ENCUESTA DIRIGIDA A '.$rsGrupoInteres->fields['nombre']),0,0,'C');

$pdf->SetFont('Helvetica','B',12);
$pdf->SetXY(95,30);
$pdf->Cell(40,0,'Universidad de Cundinamarca',0,0,'C');

$pdf->SetXY(95,36);
$pdf->Cell(40,0,'Dirección de Autoevaluación y Acreditación',0,0,'C');

$pdf->SetFont('Helvetica','B',8);
$pdf->SetXY(0,45);
$pdf->Cell(0,0,'Proceso 2014',0,0,'C');

$pdf->SetFont('Helvetica','',10);
$pdf->SetXY(20,60);
$pdf->MultiCell(0,5,utf8_decode($rsDatosEncuesta->fields['descripcion']),0,'J');

$y=$pdf->GetY()+5;
$pdf->SetXY(20,$y);
$pdf->MultiCell(0,5,utf8_decode($rsDatosEncuesta->fields['instrucciones']),0,'J');

if($pkEncuesta != -1){
    if($rsDatosPreguntas->RecordCount()>0){
        $y=$pdf->GetY()+10;
        foreach($rsDatosPreguntas as $pregunta){
            $pdf->SetXY(20,$y);
            $pdf->MultiCell(0,5,'('.$pregunta['pk_pregunta'].') '.utf8_decode($pregunta['texto']),0,'J');
            //$numPregunta=1;
            $rsDatosRespuestas=$objRespuestas->getDatosRespuestasSolucionEncuesta($pregunta['pk_pregunta']);
            $identificador='a';
            $y=$pdf->GetY()+1; 
            foreach($rsDatosRespuestas as $respuesta){
                $pdf->SetXY(30,$y);
                $pdf->Rect(27, $y+1, 3, 3);
                $pdf->MultiCell(0,5,'('.$identificador.') '.utf8_decode($respuesta['texto']),0,'J');
                $identificador++;
                $y=$pdf->GetY();
            }
            /*$pdf->SetXY(30,$y);
            $pdf->Rect(27, $y+1, 3, 3);
            $pdf->MultiCell(0,5,'Valor Y:'.$y,0,'J');*/
            $y=$pdf->GetY()+3;
            /*if($y>270){
                $pdf->AddPage();
                $y=30;
            }*/
        }
    }else{
        $y=$pdf->GetY()+10;
        $pdf->SetXY(20,$y);
        $pdf->MultiCell(0,5,'No hay preguntas activas en este momento',0,'C');
    }
}else{
    $y=$pdf->GetY()+10;
    $pdf->SetXY(20,$y);
    $pdf->MultiCell(0,5,'No hay preguntas activas en este momento',0,'C');
}

//$y=$pdf->GetY()+10;
//$pdf->SetXY(20,$y);
//$pdf->Write(5,'valor y:'.$y);
switch($idGrupo){
    case 1:$pdf->Output('formato_encuesta_estudiantes','I');  break;
    case 2:$pdf->Output('formato_encuesta_docentes','I');  break;
    case 3:$pdf->Output('formato_encuesta_directivos_academicos','I'); break;
    case 4:$pdf->Output('formato_encuesta_graduados','I');  break;
    case 5:$pdf->Output('formato_encuesta_funcionarios_administrativos','I'); break;
    case 6:$pdf->Output('formato_encuesta_empleadores','I');  break;
}

?>