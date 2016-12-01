<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Js/jquery-1.9.1.js"></script>
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/extensions/Buttons/js/dataTables.buttons.js"></script>
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/extensions/Buttons/css/buttons.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/extensions/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/extensions/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/extensions/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/extensions/Buttons/js/buttons.html5.js"></script>




<?php
class HistoricosFactorVista
{
    //se establece el objeto asia elementos vista
    function elementos()
    {
        global $objComponentes;   
        require_once("../Vista/VIS_Elementos_Vista.php");
        $objComponentes=new Elementos();
        
    }
    
    //borra variables de sesión
    function limpiarSesion()
    {
        $i=0;
        while(isset($_SESSION["plm_histoFac".$i]))
        {
            unset($_SESSION["plm_histoFac".$i]);
            $i++;   
        }
        $i=0;
        while(isset($_SESSION["plm_histo".$i]))
        {
            unset($_SESSION["plm_histo".$i]);
            $i++;   
        }
    }
    
    //muestra un comparartivo de procesos historicos
    function mostrarHistorico($arrFator, $arrProceCal)
    {
        
        global $objComponentes;
        
        $this->elementos();
        $this->limpiarSesion();
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Comparativo de los resultados Históricos de Autoevaluación del Programa"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        if(($arrFator[0][0]) & ($arrProceCal[0][0]))
        {
            
            $temp=0;
            while(isset($_SESSION["plm_histoFac".$temp]))
            {
                unset($_SESSION["plm_histoFac".$temp]);
                $temp++;
            }
            
            for($i=0; $i<count($arrFator); $i++)
            {
                $temp=0;
                $aux=0;
                while(isset($_SESSION["plm_histoFac".$temp]))
                {
                    if($_SESSION["plm_histoFac".$temp]==$arrFator[$i][1])
                    {
                        $aux=1;
                    }
                    $temp++;
                } 
                
                if($aux==0) 
                {
                    $_SESSION["plm_histoFac".$i]=$arrFator[$i][1];                         
                }
            }
            
            
    
        ?>
<!--         <label>Paginador Por :</label>
        <select name="s_paginador" id="s_paginador" onchange="paginador(1);" >
            <option value="5"> 5 </option>
            <option value="10"> 10 </option>
            <option value="20"> 20 </option>
        </select>  -->
        
        <?php
        ?>
        
        <script type='text/javascript' >
            //paginador(1);
         </script>
        <div class="contenedor-tabla80">
        <table id="T_tabla"  >
        <thead>
            <th style="width: 100%;"><?php echo utf8_encode("Código factor");?></th>
            <th style="width: 100%;">Factores</th>
            <th style="width: 50%;"><?php echo utf8_encode("Año");?></th>
            <th style="width: 50%;"><?php echo utf8_encode("Calificación");?></th>
            <th style="width: 50%;">Cod Proceso</th>
            <th style="width: 50%;">Proceso</th>
            <th style="width: 50%;">Sede</th>
        </thead>
        <tbody>
        <?php 
        $arrCal[][]=array();
        $cont=0;
        $temp=0;
        for($i=0; $i<count($arrProceCal); $i++)
        {
            for($k=0; $k<count($arrProceCal[$i]); $k++)
            {
                for($j=0; $j<count($arrFator); $j++)
                {
                    if($arrProceCal[$i][$k][0]==$arrFator[$j][0])
                    {
                        $arrCal[$cont][0]=$arrProceCal[$i][$k][2];
                        $arrCal[$cont][1]=$arrProceCal[$i][$k][1];
                        $arrCal[$cont][2]=$arrFator[$j][0];
                        $arrCal[$cont][3]=$arrProceCal[$i][$k][2];
                        
                        $_SESSION["plm_histo".$temp]=$arrFator[$j][1];
                        $_SESSION["plm_histo".($temp+1)]=$arrProceCal[$i][$k][2];
                        $_SESSION["plm_histo".($temp+2)]=$arrProceCal[$i][$k][1];
                        $_SESSION["plm_histo".($temp+3)]=$arrProceCal[$i][$k][5];
                        $_SESSION["plm_histo".($temp+4)]=$arrProceCal[$i][$k][3];
                        $_SESSION["plm_histo".($temp+5)]=$arrProceCal[$i][$k][4];
                        $temp=$temp+6;
                        
                        $cont++;
                        ?>
                        
                        <tr>
                            <td ><?php echo $arrFator[$j][2];?></td>
                            <td ><?php echo $arrFator[$j][1];?></td>
                            <td ><?php echo $arrProceCal[$i][$k][2];?></td>
                            <td ><?php echo  sprintf('%.2f',$arrProceCal[$i][$k][1]);?></td>
                            <td ><?php echo $arrProceCal[$i][$k][5];?></td>
                            <td ><?php echo $arrProceCal[$i][$k][3];?></td>
                            <td ><?php echo $arrProceCal[$i][$k][4];?></td>
                        </tr>
                        <?php 
                        
                    }
                }
            }
        }
        
        $strFactor="";
        $strCal[][]=array();
        
        $cont=0;
        
        for($i=0; $i<(count($arrFator)); $i++)
        {
            $cont2=0;
            if($i==0)
            {
                $strFactor="\"".$arrFator[$i][1]."";
            }
            else
            {
                $strFactor=$strFactor."\",\"".$arrFator[$i][1]."";
            }
            $aux=0;
            for($j=0;$j<count($arrCal);$j++)
            {
                if($arrFator[$i][0])
                {
                    if($arrCal[$j][2])
                    {
                        if($arrFator[$i][0]==$arrCal[$j][2])
                        {
                            
                            $strCal[$cont][$cont2]=$arrCal[$j][1];   
                            $cont2++;  
                    
                        }
                    }
                }
            }
            $cont++;
        }
        $strFactor = $strFactor."\"";
        
        
        $arrCalF[][]=array();
        $temp=0;
        $temp2=0;
        for($i=0; $i<count($strCal); $i++)
        {
            $temp2=0;
            for($j=0; $j<count($strCal[$i]); $j++)
            {
                $arrCalF[$temp2][$temp]=$strCal[$i][$j]; 
                $temp2++;
            }
            $temp++;
        }
         
        $arrColor[]=array();
        
        $arrColor[0]="#F7464A"; //rojo
        $arrColor[1]="#46BFBD"; //azul agua marina
        $arrColor[2]="#FDB45C"; //amarillo ladrillo
        $arrColor[3]="#949FB1"; //morado claro
        $arrColor[4]="#4D5360"; //morado oscuro
        $arrColor[5]="rgba(151,187,205,0.5)"; //azul claro transparente
        $arrColor[6]="#F38630"; //naranja claro
        $arrColor[7]="#E0E4CC"; //gris claro
        $arrColor[8]="#69D2E7"; //azul claro 
        $arrColor[9]="#69D557"; //verde claro
        $aux=0; 
        $col=0;
        ?>
        </tbody>
        </table>
        
            <!-- <div id="num_pag">        
            </div> -->
        </div>    
        <br />
        <br />
            <script>
            
                    var barChartData = {
                        labels: [<?php echo $strFactor;?>],
                        datasets: [
                            <?php 
                            for($i=0; $i<count($arrCalF); $i++)
                            {
                                if($i%2)
                                {
                                    while($col==$aux)
                                    {
                                        $col=rand(0,9); 
                                    }
                                    $aux=$col;
                                    if($i<(count($arrCalF)-1))
                                    {
                                        ?>
                            				{
                            				    fillColor: "<?php echo $arrColor[$col];?>",
                            				    strokeColor: "<?php echo $arrColor[$col];?>",
                            				    data:[<?php 
                                                
                                                for($j=0; $j<count($arrCalF[$i]); $j++)
                                                {
                                                    echo $arrCalF[$i][$j].",";
                                                } 
                                                    ?> 0]
                            				},
                                        <?php 
                                    }
                                    else
                                    {
                                         ?>
                            				{
                            				    fillColor: "<?php echo $arrColor[$col];?>",
                            				    strokeColor: "<?php echo $arrColor[$col];?>",
                            				    data:[<?php 
                                                for($j=0; $j<count($arrCalF[$i]); $j++)
                                                {
                                                    echo $arrCalF[$i][$j].",";
                                                } 
                                                ?> 0]
                            				}
                                        <?php 
                                    }
                                }
                                else
                                {
                                    
                                    while($col==$aux)
                                    {
                                        $col=rand(0,9); 
                                    }
                                    $aux=$col;
                                    if($i<(count($arrCalF)-1))
                                    {
                                        ?>
                            				{
                            				    fillColor: "<?php echo $arrColor[$col];?>",
                            				    strokeColor: "<?php echo $arrColor[$col];?>",
                            				    data:[<?php 
                                                
                                                for($j=0; $j<count($arrCalF[$i]); $j++)
                                                {
                                                    echo $arrCalF[$i][$j].",";
                                                } 
                                                    ?> 0]
                            				},
                                        <?php 
                                    }
                                    else
                                    {
                                         ?>
                            				{
                            				    fillColor: "<?php echo $arrColor[$col];?>",
                            				    strokeColor: "<?php echo $arrColor[$col];?>",
                            				    data:[<?php 
                                                for($j=0; $j<count($arrCalF[$i]); $j++)
                                                {
                                                    echo $arrCalF[$i][$j].",";
                                                } 
                                                ?> 0]
                            				}
                                        <?php 
                                    }
                                }
                                    
                            }
                                
                            ?>
                        
                        ]     
                    }
            
                var myLine = new Chart(document.getElementById("bar-chart").getContext("2d")).Bar(barChartData);

            </script>
            <div align="center">
                <canvas id="bar-chart" class="chart-holder" width="900" height="600">
                
                </canvas>
            </div>
                
        <?php
        
         ?>
         <br />
         <br />
         <br />
         <br />
              
                   <?php
                
                
        }
        else
        {
            $this->mensaje("No hay factores consolidados");
        }
        
         $datos = array(
                    "id"=>"B_atras",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>utf8_encode("Atrás"),
                    "onclick"=>"atras_process();"
                    );                     
		$objComponentes->button_normal($datos); 
        
        $objComponentes->cerrar_div_bloque_principal();
    }
    
    
    //muestra los procesos almacenados y que el usuario puede ver
    function historico_procesos($arrProcesos)
    {

        global $objComponentes;
        
        $this->elementos();
        
        $datos=array("id"=>"generaConsolidado");
                    
        $objComponentes->form($datos);
        
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",
                "value"=>"generaConsoli",//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        $datos=array(
                "id"=>"H_contProce",//define el nombre que tendra el campo
                "name"=>"H_contProce",
                "value"=>"".count($arrProcesos),//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Procesos Históricos"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        
        ?>
        
        <div class="contenedor-tabla80">
       
        <table> 
        <th style="width: 20%;"><?php echo utf8_encode("Código");?> </th>
        <th style="width: 80%;">Nombre      </th>
        <th style="width: 30%;">Fecha Inicio</th>
        <th style="width: 30%;">Fecha Fin   </th>
        <th style="width: 50%;"><?php echo utf8_encode("Descripción");?> </th>
        <th style="width: 50%;"><?php echo utf8_encode("Observación");?> </th>       
        <th style="width: 50%;">Seleccionar </th>        
        
        <?php
        
        for($i=0; $i<count($arrProcesos); $i++)
        {
            ?>
            <tr>
            <?php
            for($j=0; $j<6; $j++)
            {
                ?>
                <td>
                <?php
                echo $arrProcesos[$i][$j];
                
                ?>
                </td>
                <?php
            }       
            ?>
            <td>
            <?php
            $strName="C_select".$i;
            
            $_datos_checkbox=array(
                        $strName=>$arrProcesos[$i][0],//el nombre de identificacion y el valor que tendra
                        );
            
            $datos = array(
                        "label"=>"",//el nombre que se mostrara
                        "class"=>"lista",//decir como queremos que se muestre los elementos
                        "name"=>$strName//nombre que tendra el grupo de elementos
                        );
                                
            $objComponentes->input_checkbox ($_datos_checkbox,$datos);
				
            
            ?>
            
            </td>
            
            </tr>
            <?php
        }        
        ?>
        </table>
        </div>
        <?php
        
        
         $datos = array(
                    "id"=>"B_geneConsilidado",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>"Generar Consolidado",
                    "onclick"=>"geneConsilidado();"
                    );                     
		$objComponentes->button_normal($datos); 
               
        
        $objComponentes->cerrar_div_bloque_principal();
        
        $objComponentes->cerrar_form();
        ?>
        
		<div class="errores"></div>
			<div id="div_emergente" class="fondo_emergente">
				<div class="emergente">
					<div data-role="contenido"></div>
					<div data-role="botones"></div>
					<span title="cerrar" data-rol="cerrar"> x </span>
				</div>
			</div>
		</div>
		
        <?PHP
    }
    
    
    //muestra un mensaje de advertencia
    function mensaje($strMensaje)
    {
     ?> 
		<div class="errores"></div>
			<div id="div_emergente" class="fondo_emergente">
				<div class="emergente">
					<div data-role="contenido"></div>
					<div data-role="botones"></div>
					<span title="cerrar" data-rol="cerrar"> x </span>
				</div>
			</div>
		</div>
	  <script>
	  
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2><?php echo $strMensaje;?></h2></p>');
		div_emergente.css('display','block');	
	  </script>
      <?php     
    
    }
}

?>

<script>
$('#T_tabla').DataTable(
            {
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Ultimo",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]

        }
        );
</script>