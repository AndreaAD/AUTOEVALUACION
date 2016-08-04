<?php
function ultimoDia($mes,$ano){
    $ultimo_dia=28;
    while (checkdate($mes,$ultimo_dia + 1,$ano)){
       $ultimo_dia++;
    }
    return $ultimo_dia;
} 

function calendar_html($nombre){
	$meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
	//$fecha_fin=date('d-m-Y',time());
	$mes=date('m',time());
	$anio=date('Y',time());
	?>
	<table style="width:218px;border:1px solid #808080;" cellpadding="0" cellspacing="0">
	 <tr>
	  <td colspan="4">
	  	<select style="width: 117px;" id="calendar_mes-<?php echo $nombre; ?>" onchange="update_calendar('<?php echo $nombre; ?>')">
		 <?php
		 $mes_numero=1;
		 while($mes_numero<=12){
		 	if($mes_numero==$mes){
				echo "<option value=".$mes_numero." selected=\"selected\">".$meses[$mes_numero-1]."</option> <br>";
			}else{
		 		echo "<option value=".$mes_numero.">".$meses[$mes_numero-1]."</option> <br>";
			}
			$mes_numero++;
		 }
		 ?>
		</select>
	  </td>
	  <td colspan="3">
	  	<select style="width:90px;" id="calendar_anio-<?php echo $nombre; ?>" onchange="update_calendar()">
		 <?php
		 // años a mostrar
		 //$anio_min=$anio-30; //hace 30 años
		 $anio_max=$anio; //año actual
		 //while($anio_min<=$anio_max){
		 	echo "<option value=".$anio_max.">".$anio_max."</option> \n";
			//$anio_max--;
		 //}
		 ?>
		</select>
	  </td>
	 </tr>
	</table>
	<div id="calendario_dias-<?php echo $nombre; ?>">
	<?php calendar($mes,$anio,$nombre) ?>
	</div>
	<?php
}

function calendar($mes,$anio,$nombre){
	$dia=1;
	if(strlen($mes)==1) $mes='0'.$mes;
	?>
	<table id="<?php echo $nombre; ?>" style="width:218px;text-align:center;border:1px solid #808080;border-top:0px;" cellpadding="0" cellspacing="0">
	 <tr style="background-color:#CCCCCC; width: 100%;">
	  <td style="width: 25px;" >D</td>
	  <td style="width: 25px;" >L</td>
	  <td style="width: 25px;" >M</td>
	  <td style="width: 25px;" >M</td>
	  <td style="width: 25px;" >J</td>
	  <td style="width: 25px;" >V</td>
	  <td style="width: 25px;" >S</td>
	 </tr>
	<?php

	//echo $mes.$dia.$anio;
	$numero_primer_dia = date('w', mktime(0,0,0,$mes,$dia,$anio));
	$ultimo_dia=ultimoDia($mes,$anio);
	
	$total_dias=$numero_primer_dia+$ultimo_dia;
    
	$diames=1;
	//$j dias totales (dias que empieza a contarse el 1º + los dias del mes)
	$j=1;
	while($j<=$total_dias){
		echo "<tr> \n";
		//$i contador dias por semana
		$i=0;
		while($i<7){
			if($j<=$numero_primer_dia){
				echo " <td style='width: 25px;'></td> \n";
			}elseif($diames>$ultimo_dia){
				echo " <td style='width: 25px;'></td> \n";
			}else{
				if($diames<10) $diames_con_cero='0'.$diames;
				else $diames_con_cero=$diames;

				echo " <td><a style=\"width: 25px;display:block;cursor:pointer;\" onclick=\"set_date('".$anio."-".$mes."-".$diames_con_cero."','#".$nombre."','".$nombre."')\">".$diames."</a></td> \n";
				$diames++;
                
			}
			$i++;
			$j++;
		}
		echo "</tr> \n";
	}
	?>
	</table>
	<?php
}
?>