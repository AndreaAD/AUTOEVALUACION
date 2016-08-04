<?php

    require_once("../BaseDatos/AdoDB.php");
    
        $conexion = new Ado();        
        
        $cadena = ' SELECT
                        seg.fecha,
                        seg.observacion,
                        seg.ip,
                        seg.mac,
                        tip_seg.nombre AS nombre_tipo,
                        CONCAT(usu.nombre," ",  usu.apellido) AS nombre_usuario
                    FROM
                        sad_seguridad seg,
                        sad_tipo_transaccion tip_seg,
                        sad_usuario usu
                    WHERE
                            seg.usuario = usu.pk_usuario
                        AND
                            tip_seg.pk_tipo_transaccion = seg.fk_tipo_transaccion;'; //Realizamos una consulta
        
        $ResSql = $conexion->conectarAdo($cadena);
        
require_once '../PHPExcel/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();

$objPHPExcel->
	getProperties()
		->setCreator("SIA.com")
		->setLastModifiedBy("SIA.com")
		->setTitle("Reporte de Seguridad de SIA")
		->setSubject("Reporte de Seguridad")
		->setDescription("Se podra ver todo el listado de la seguridad de los procesos que han sido efectuados en el aplicativo")
		->setKeywords("SIA")
		->setCategory("Reporte");

        $i=1;
     
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, 'Reporte de Seguridad de SIA (Sistema de Informacion de Autoevaluacion)');
            
            $i++;
            
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, 'Fecha de Creacion')
            ->setCellValue('B'.$i, 'Usuario')
            ->setCellValue('C'.$i, 'Observacion')
            ->setCellValue('D'.$i, 'IP')
            ->setCellValue('E'.$i, 'MAC')
            ->setCellValue('F'.$i, 'Tipo de Transaccion');
            
            $i++;
            
        while(!$ResSql->EOF){
             
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $ResSql->fields['fecha'])
            ->setCellValue('B'.$i, $ResSql->fields['nombre_usuario'])
            ->setCellValue('C'.$i, $ResSql->fields['observacion'])
            ->setCellValue('D'.$i, $ResSql->fields['ip'])
            ->setCellValue('E'.$i, $ResSql->fields['mac'])
            ->setCellValue('F'.$i, $ResSql->fields['nombre_tipo']);
            
            $i++;
            
            $ResSql->MoveNext();
        }
        



$objPHPExcel->getActiveSheet()->setTitle('SIA');

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(0);


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte Seguridad SIA.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;


?>