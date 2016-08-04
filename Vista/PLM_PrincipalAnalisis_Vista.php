<?PHP
class AnalisisFactor
{
    function elementos()
    {
        global $objComponentes;   
        require_once("../Vista/VIS_Elementos_Vista.php");
        $objComponentes=new Elementos();
        
    }
    //se limpian todas la variables de sesión 
    function limpiarSesion()
    { 
        unset($_SESSION["plm_titulo"]);
        
        $i=0;
        while(isset($_SESSION["plm_id".$i]))
        {
            unset($_SESSION["plm_id".$i]);
            unset($_SESSION["plm_nombre".$i]);
            unset($_SESSION["plm_desc".$i]);
            unset($_SESSION["plm_ponde".$i]);
            unset($_SESSION["plm_cal".$i]);
            unset($_SESSION["plm_esca".$i]);
            $i++;
        }
        $i=0;
        while(isset($_SESSION["plm_esca2".$i]))
        {            
            unset($_SESSION["plm_esca2".$i]);
            $i++;
        }
        $i=0;
        while(isset($_SESSION["plm_esca3".$i]))
        {            
            unset($_SESSION["plm_esca3".$i]);
            $i++;
        }
        $i=0;
        while(isset($_SESSION["plm_esca4".$i]))
        {            
            unset($_SESSION["plm_esca4".$i]);
            $i++;
        }
        $i=0;
        while(isset($_SESSION["plm_esca".$i]))
        {            
            unset($_SESSION["plm_esca".$i]);
            $i++;
        }
        
        unset($_SESSION["plm_tot"]);
				
		
		
    }
    
    //es un función para pintar un boton 
    //atrás
    function botonAtras($funcion, $formulario)
    {
            
        global $objComponentes;
        $this->elementos();
        
        
        $datos=array("id"=>"$formulario");
                    
        $objComponentes->form($datos);
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",//define el nombre que tendra el campo
                "value"=>"$formulario",//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        $datos = array(
                    "id"=>"B_atras",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>utf8_encode("Atrás"),
                    "onclick"=>"$funcion;"
                    );
                     
		$objComponentes->button_normal($datos);
    }
    
	function atrasFinal()
	{
	?>
	<script>
		$('#H_opcion').val("buscarCaract");
		$.ajax({
			url:   '../Controlador/PLM_PrincipalAnalisis_Control.php',
			 type:  'post',
			dataType:'html',
			data: $('#buscarEvi').serialize(),
			success:  function (data) {
				$('.principal-panel-sub-contenido').html(data);
			}       
	   });
	</script>
	<?php
	}
    //muestra las observaciones de las características
	function verObserCarac($observaciones)
	{
		 global $objComponentes;
        $this->elementos();
        
        $datos=array("id"=>"observaciones");
                    
        $objComponentes->form($datos);
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",//define el nombre que tendra el campo
                "value"=>"AddAnalisis",//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>"".utf8_encode("Observaciones / Acciones de mejoramiento Identificadas Por caracteristicas"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        
		
        ?>
        <label>Paginador Por :</label>
        <select name="s_paginador" id="s_paginador" onchange="paginador(1);" >
            <option value="5"> 5 </option>
            <option value="10"> 10 </option>
            <option value="20"> 20 </option>
        </select> 
        
        <?php
        
		?>
        <script type='text/javascript' >
            paginador(1);
         </script>		 
        <div class="contenedor-tabla80">
            <table id="T_tabla" >
			<th style="width: 10%;"><?php echo utf8_encode("Código Aspecto")?></th>
			<th style="width: 20%;"><?php echo utf8_encode("Aspecto")?></th>
			<th style="width: 70%;"><?php echo utf8_encode("Observación")?></th>
		   
			<?php		
				for($i=0; $i<count($observaciones); $i++)
				{
					echo "<tr>";
						echo "<td>";
							echo $observaciones[$i][0];	
						echo "</td>";
						echo "<td>";
							echo utf8_encode($observaciones[$i][1]);		
						echo "</td>";
						echo "<td>";
							echo utf8_encode($observaciones[$i][2]);		
						echo "</td>";
					echo "</tr>";
				}
			?>
        </table>	
		
		<div id="num_pag">        
		</div>
        <br />
        <br />
        <?php
        
        $datos = array(
                    "id"=>"B_atras",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>utf8_encode("Atrás"),
                    "onclick"=>"atrasObserCarac();"
                    );
                     
		$objComponentes->button_normal($datos);
		
        $objComponentes->cerrar_div_bloque_principal();        
        $objComponentes->cerrar_form(); 
	}
	
    //muestra las observaciones de los aspectos
    function mostrarObserva($observaciones)
    {
        global $objComponentes;
        $this->elementos();
        
        $datos=array("id"=>"graficaGrupoInt");
                    
        $objComponentes->form($datos);
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",//define el nombre que tendra el campo
                "value"=>"graficaGrupoInt",//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>"".utf8_encode("Observaciones / Acciones de mejoramiento Identificadas"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        
        
        ?>
        <p><?php echo $observaciones;?></p>
        
        <br />
        <br />
        <?php
        
        
        $datos = array(
                    "id"=>"B_atras",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>utf8_encode("Atrás"),
                    "onclick"=>"AtrasEvi();"
                    );
                     
		$objComponentes->button_normal($datos);
        $objComponentes->cerrar_div_bloque_principal();
        
        $objComponentes->cerrar_form();       
        
    }
    
    
    //muestra una tabla con el historial de factoe, caracerística y aspecto
    function mostrarTablaDinamic($arrArreglo, $titulo, $cal)
    {
        global $objComponentes;
              
        ?>
        <table>
        <th style="width: 10%;"><?php echo utf8_encode("Código")?></th>
        <th style="width: 90%;"><?php echo utf8_encode("".$titulo)?></th>
        <th style="width: 10%;"><?php echo utf8_encode("Calificación")?></th>
        
        <?php
        for($i=0; $i<count($arrArreglo); $i++)
        {
            echo "<tr>";
                echo "<td>";
				if($titulo=="Factor")
				{
					echo  utf8_encode($arrArreglo[$i][5]);
				}
				else if($titulo=="Característica")
				{
					echo  utf8_encode($arrArreglo[$i][5]);
				}
				else if($titulo=="Aspecto")
				{
					echo  utf8_encode($arrArreglo[$i][5]);
				}
				else if($titulo=="Evidencia")
				{
					echo  utf8_encode($arrArreglo[$i][5]);
				}
				
                echo "</td>";
                echo "<td>";
                echo  utf8_encode($arrArreglo[$i][1]);
                echo "</td>";
                echo "<td>";
                echo  sprintf('%.2f', $cal);
                echo "</td>";
            echo "</tr>";
        }
        ?>
        </table>
        <?php                   
        
    }
    //muestra una tabla de los factores, características y aspectos
    // con el porcentaje de cumplimiento, 
    function mostrarFactorProcessEsca($arrFactores,$titulo,$sub)
    {
        global $objComponentes;
        $this->elementos();
          
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>"".utf8_encode($titulo),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
              
        ?>
        <table>
        <th style="width: 80%;"><?php echo utf8_encode("".$sub)?></th>
        <th style="width: 20%;"><?php echo utf8_encode("Escala")?></th>
        <th style="width: 20%;"><?php echo utf8_encode("Porcentaje de Cumplimiento")?></th>
        
        <?php
        for($i=0; $i<count($arrFactores); $i++)
        {
            echo "<tr>";
                echo "<td>";
                echo  utf8_encode($arrFactores[$i][0]);
                echo "</td>";
                echo "<td>";
                echo  utf8_encode($arrFactores[$i][1]);
                echo "</td>";
                echo "<td>";
				if($arrFactores[$i][2]<0)
				{
					$arrFactores[$i][2]=0;
					echo "0%";
				}
				else
				{
					echo   sprintf('%.2f', ($arrFactores[$i][2]))."%";
				}
                echo "</td>";
            echo "</tr>";
        }
        ?>
        </table>
        <?php                   
        
        $objComponentes->cerrar_div_bloque_principal();
        
    }
    
    // se hace todo el analisis de la escala de cumplimiento de los factores, características y aspectos 
    //se muestra la gráfca del análisis de la ecala cualitativa
    function analisisEscala($arrEscala, $titulo, $atras, $formulario, $arrFactores, $titulo2,$sub)
    {
        global $objComponentes;
        $this->elementos();
        
        $datos=array("id"=>"".$formulario);
                    
        $objComponentes->form($datos);
        
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",//define el nombre que tendra el campo
                "value"=>"graficaGrupoInt",//El atributo value especifica el valor de un elemento
                );
                
                
        $objComponentes->input_hidden($datos);
        
         
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>"".utf8_encode($titulo),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
               
        ?>
        <table>
        
            <th>Total CNA</th>
            <?php
            for($k=0; $k<count($arrEscala); $k++)
            {            
                ?>
                <th><?php echo $arrEscala[$k][1]; ?></th>
                <?php
            }
            
            echo "<tr>";       
            echo "<td>";
            
            $i=0;
            $cant=0;
            while(isset($_SESSION["plm_id".$i]))
            {
                $cant++;
                $_SESSION["plm_tot"]=$cant;
                $i++;
            }
            
            echo $cant;
            echo "<br />";
            echo "100%";
            echo "</td>";
            
            $temp=0;
            $arrPorEsca[][]=array(); 
            $aux=0;
            for($i=0; $i<count($arrEscala); $i++)
            {
                $cont=0;
                $k=0;
                while(isset($_SESSION["plm_id".$k]))
                {
                    if($arrEscala[$i][1]==$_SESSION["plm_esca".$k])
                    {
                        $cont++;
                    }
                    $k++;
                }
                
                if($cont!=0)
                {
                    $arrPorEsca[$temp][0] = (($cont*100)/$cant);
                    $arrPorEsca[$temp][1] = $arrEscala[$i][1];
                    echo "<td>";
                    echo "".$cont;    
                    echo "<br />".sprintf('%.2f',(($cont*100)/$cant))."%";                
                    echo "</td>"; 
                    $temp++;
                    
                    $_SESSION["plm_esca4".$aux]="".$cont;
                    $_SESSION["plm_esca3".$aux]="".(($cont*100)/$cant);
                    $aux++;
                }
                else
                {
                    echo "<td>";
                    echo "0";
                    echo "<br />";
                    echo "0%";
                    echo "</td>";
                    $_SESSION["plm_esca3".$aux]="".(($cont*100)/$cant);
                    $_SESSION["plm_esca4".$aux]="".$cont;
                    $aux++;
                }
            }        
            ?>
        
        </tr>
        </table>   
        <br />   
        <br />
        <?php
        
        
        for($k=0; $k<count($arrEscala); $k++)
        {            
            ?>
            <th><?php $_SESSION["plm_esca2".$k] = $arrEscala[$k][1]; ?></th>
            <?php
        }
        
        $objComponentes->cerrar_div_bloque_principal();
         
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Gráfica - ".$titulo),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        
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
        
        ?>
        <script>
        var pieData = [
        <?php
        $i=0; 
        $cont=0;
        $col=0;
        $aux=0;
        $arrFinal[][]=array();
        for($i=0; $i<(count($arrPorEsca)-1); $i++)
        {            
            ?>
            {
                value: <?php $cont++; echo $arrPorEsca[$i][0];?>,
                color: "<?php $col=rand(0,9); 
                
                while($col==$aux)
                {
                    $col=rand(0,9); 
                }
                 $aux=$col; $arrFinal[$i][0]=sprintf('%.2f',$arrPorEsca[$i][0]) ."% - ". $arrPorEsca[$i][1]; $arrFinal[$i][1]=$col;  echo $arrColor[$col];?>"
            },
           
            <?php
          }
          ?> 
          
          
            {
                value: <?php echo $arrPorEsca[$cont++][0];?>,
                color: "<?php $col=rand(0,9);
                
                while($col==$aux)
                {
                    $col=rand(0,9); 
                }
                 $aux=$col; $arrFinal[$i][0]= sprintf('%.2f',$arrPorEsca[$i][0]) ."% - ". $arrPorEsca[$i][1]; $arrFinal[$i][1]=$col; echo $arrColor[$col];?>"
            }           
         ];
        
        var myPie = new Chart(document.getElementById("pie-chart").getContext("2d")).Pie(pieData);
        
        </script>
        <div align="center">
            <canvas id="pie-chart" class="chart-holder" width="500" height="300">
            
            </canvas>
        </div>  
        <br />   
        <br />
        
        <div class="contenedor-tabla80">
        <table >
        
        <?php 
        for($i=0; $i<count($arrFinal); $i++)
        {
        ?>
            <tr>
                <td>
                    <input type="button" style=" color: black;background: <?php echo $arrColor[$arrFinal[$i][1]];?>;" id="B_boton" name="B_boton" class="boton-small" value="<?php echo $arrFinal[$i][0];?>"/>
                </td>
            </tr>
        <?php
        }
         ?>
         </table>
         </div>
            
          <br />
          <br />  
        <?php
        
        if($arrFactores[0][0])
        {
            $this->mostrarFactorProcessEsca($arrFactores,$titulo2,$sub);            
        }
        
        $objComponentes->cerrar_div_bloque_principal();
        $datos = array(
                "id"=>"B_atras",//el nombre que tendra el grupo de elementos
                "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                "value"=>utf8_encode("Atrás"),
                "onclick"=>"".$atras
                );
        
        $objComponentes->button_normal($datos);
        
        
        $_SESSION["plm_titulo"]="".utf8_encode($titulo);
        
        ?>
            <a class="boton-normal boton-grande" target="_blank" href="../Vista/PLM_ReporteEscalaPdf_Vista.php"><i class=""></i><span class="texto-boton">Reporte Pdf</span></a>
            <a class="boton-normal boton-grande" target="_blank" href="../Vista/PLM_ReporteEscalaExcel_Vista.php"><i class=""></i><span class="texto-boton">Reporte Excel</span></a>
        <?php
        
        $objComponentes->cerrar_form();
        
    }
    
    //muestra el análisis causal de las características
    function mostrarAnalisis()
    {
        global $objComponentes;
        $this->elementos();
                
        $datos=array("id"=>"guardarAnalisis");
                    
        $objComponentes->form($datos);
        
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",
                "value"=>"guardarAnalisis",//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
         
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Emisión de juicios de la característica"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        

          $datos=array(
                "id"=>"TA_fortaleza",//define el nombre que tendra el campo
                "name"=>"TA_fortaleza", // (necesario) define el name del campo
				"label"=>"Fortalezas detectadas",//La etiqueta label define una etiqueta para un elemento
                "placeholder"=>"Fortalezas",//El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                "maxlength"=>"45",//El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                "disabled"=>"",//Cuando está presente, especifica que el elemento <input> debe ser desactivada
                "required"=>"on",//especifica que un campo de entrada debe ser completado antes de enviar el formulario
                "onkeypress"=>"",//El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()"
                "onkeydown"=>"",//El evento onkeydown se produce cuando el usuario presiona una tecla onkeydown="myFunction()"
                "help"=>utf8_encode("Realice una breve descripción de las fortalezas que se han encontrado en las características")//Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                );
                    
        $objComponentes->textarea($datos);
        
        $datos=array(
                "id"=>"TA_debilidad",//define el nombre que tendra el campo
                "name"=>"TA_debilidad", // (necesario) define el name del campo
                "label"=>"Debilidades detectadas",//La etiqueta label define una etiqueta para un elemento
                "placeholder"=>"Debilidades",//El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                "maxlength"=>"45",//El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                "disabled"=>"",//Cuando está presente, especifica que el elemento <input> debe ser desactivada
                "required"=>"on",//especifica que un campo de entrada debe ser completado antes de enviar el formulario
                "onkeypress"=>"",//El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()"
                "onkeydown"=>"",//El evento onkeydown se produce cuando el usuario presiona una tecla onkeydown="myFunction()"
                "help"=>utf8_encode("Realice una breve descripción de las debilidades encontradas en las características")//Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                );
                    
        $objComponentes->textarea($datos);
        $objComponentes->cerrar_div_bloque_principal();
					
                            
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Análisis Causal"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
		
        $datos=array(
                "id"=>"TA_analisis",//define el nombre que tendra el campo
                "name"=>"TA_analisis", // (necesario) define el name del campo
                "label"=>utf8_encode("Análisis causal"),//La etiqueta label define una etiqueta para un elemento
                "placeholder"=>utf8_encode("Análisis"),//El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                "maxlength"=>"100",//El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                "disabled"=>"",//Cuando está presente, especifica que el elemento <input> debe ser desactivada
                "required"=>"on",//especifica que un campo de entrada debe ser completado antes de enviar el formulario
                "onkeypress"=>"",//El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()"
                "onkeydown"=>"",//El evento onkeydown se produce cuando el usuario presiona una tecla onkeydown="myFunction()"
                "help"=>utf8_encode("Identificación de las causas raíz de los problemas y/o debilidades encontradas")//Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                );                    
        $objComponentes->textarea($datos);
        $objComponentes->cerrar_div_bloque_principal();
            
					
        
        $datos = array(
                    "id"=>"B_guardar",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",
					"icono"=>"none",
                    "value"=>utf8_encode("Guardar Análisis"),
                    "onclick"=>"guardarAnalisis();"
                    );                     
        $objComponentes->button_normal($datos);
		
        $datos = array(
                    "id"=>"B_guardar",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",
					"icono"=>"none",
                    "value"=>utf8_encode("Ver Observaciones"),
                    "onclick"=>"verObserCarac();"
                    );                     
        $objComponentes->button_normal($datos);
        
        $datos = array(
                    "id"=>"B_atras",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",
					"icono"=>"none",
                    "value"=>utf8_encode("Atrás"),
                    "onclick"=>"AtrasAnalisis();"
                    );                     
        $objComponentes->button_normal($datos);
        
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
		<?php
    }
    
    //esta función muestra la información de los procesos
    function mostrarInfo($strFacultad, $strPrograma, $strSede, $strDirector, $strAnio)
    {
        
        global $objComponentes;
        $this->elementos();
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Información"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        ?>
        
        <table >
        <th style="width: 30%;"><?php echo utf8_encode("Facultad"); ?></th>
        <th style="width: 50%;"><?php echo utf8_encode("Programa Académico"); ?></th>
        <th style="width: 50%;">Sede/ Seccional</th>
        <th style="width: 50%;">Nombre del Director/ <?php echo utf8_encode("coordinador académico"); ?></th>
        <th style="width: 60%;"><?php echo utf8_encode("Año"); ?></th>
        <tr>
            <td><?php echo utf8_encode($strFacultad);?></td>
            <td><?php echo utf8_encode($strPrograma);?></td>
            <td><?php echo utf8_encode($strSede);?></td>
            <td><?php echo utf8_encode($strDirector);?></td>
            <td><?php echo $strAnio;?></td>
        </tr>
        </table>
        
        <?php
        
        $objComponentes->cerrar_div_bloque_principal();
    }
    
    //muestra una tabla con los factores
    function mostrarFac($arrFactor, $arrCalFac, $arrEscaFac)
    {       
	
        global $objComponentes;
        $this->elementos();
        
		
		unset($_SESSION["plm_cal_fac"]);
		unset($_SESSION["plm_cal_car"]);		
		unset($_SESSION["plm_cal_asp"]);
		unset($_SESSION["plm_cal_evi"]);
		
		
        $datos=array("id"=>"buscarCaract");
                    
        $objComponentes->form($datos);
        
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",
                "value"=>"buscarCaract",//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        $datos=array(
                "id"=>"H_contFac",//define el nombre que tendra el campo
                "name"=>"H_contFac",
                "value"=>count($arrFactor),//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Análisis de Resultados por Factores"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
    
    
        ?>
        <label>Paginador Por :</label>
        <select name="s_paginador" id="s_paginador" onchange="paginador(1);" >
            <option value="5"> 5 </option>
            <option value="10"> 10 </option>
            <option value="20"> 20 </option>
        </select> 
        
        <?php
        
		
	
    
        $temp=0;
        if($arrFactor[0][0])
        {
        ?>
        <script type='text/javascript' >
            paginador(1);
         </script>
        <div class="contenedor-tabla80">
            <table id="T_tabla" >
                <th>
                    <?php echo utf8_encode("Código"); ?>  
                </th>
                <th style="width: 200%;">
                    Nombre
                </th>
                <th style="width: 200%;">
                   <?php echo utf8_encode("Descripción"); ?> 
                </th>
                <th style="width: 50%;">
                    <?php echo utf8_encode("Ponderación"); ?>  
                    Porcentual 
                </th>
                <th style="width: 50%;">
                    <?php echo utf8_encode("Calificación"); ?>  
                </th>
                <th style="width: 50%;">
                    Porcentaje de 
                    Cumplimiento
                </th>
                <th style="width: 80%;">
                    Escala
                    Cualitativa
                </th>
                <th style="width: 50%;">
                    Seleccionar
                </th>
            <?php
            
            for($i=0; $i<count($arrFactor); $i++ )
            {
                if(isset($arrFactor[$i][0]))
                {
            ?>
            <tr>
                <?php
                for($j=0; $j<5; $j++)
                {
                    if($j!=3 & $j!=0)
                    {
                    ?>
                        <td> 
                            <?php echo utf8_encode($arrFactor[$i][$j]);
                            
                            if($j==4)
                            {
                                echo "%";
                            }
                            ?>
                        </td>
                    <?php
                    }
					else if($j==0)
                    {
                    ?>
                        <td> 
                            <?php echo utf8_encode($arrFactor[$i][5]);?>
                            
                        </td>
                    <?php
                    }
					
					
                }
                
                
                echo "<td>";
                for($k=0; $k<count($arrCalFac); $k++)
                {
                    if($arrCalFac[$k][0]==$arrFactor[$i][0])
                    {   
                        echo sprintf('%.2f', $arrCalFac[$k][1]);
                        break;
                    }
                }
                echo "</td>";
                
                echo "<td>";
                
                for($n=0; $n<count($arrCalFac); $n++)
                {
                    if($arrCalFac[$n][0]==$arrFactor[$i][0])
                    {
						if(((($arrCalFac[$n][1]-1)/4)*100)<0)
						{
							echo "0%";
						}
						else
						{
							echo sprintf('%.2f', ((($arrCalFac[$n][1]-1)/4)*100));
							echo "%";
						}
                        break;
                    }
                }
                echo "</td>";
                
                echo "<td>";
                
                for($l=0; $l<count($arrEscaFac); $l++)
                {
                    if($arrEscaFac[$l][0]==$arrFactor[$i][0])
                    {
                        echo utf8_encode($arrEscaFac[$l][1]);
                        break;
                    }
                }
                echo "</td>";
                
                
                
                
                echo "<td>";
                
                $strName="C_select".$i;
                $_datos_checkbox=array(
                            $strName=>$arrFactor[$i][0],//el nombre de identificacion y el valor que tendra
                            );
                
                $datos = array(
                            "label"=>"",//el nombre que se mostrara
                            "class"=>"lista",//decir como queremos que se muestre los elementos
                            "name"=>"select"//nombre que tendra el grupo de elementos
                            );
                                    
                $objComponentes->input_radio ($_datos_checkbox,$datos);
				
                
                echo "</td>";
                }
                }
                ?>                
            </tr>
            
            </table>
            
                
            <div id="num_pag">        
            </div>
            <?php  
            }
            else
            {
            $temp=1;
            ?>
            <tr>
                <td>NO HAY FACTORES REGISTRADOS !</td>
            </tr>
            <?php
            }
            ?>
            <br />
            <br />
            <?php
            if($temp==0)
            {           
                $floCalTot=0;
                $cont=0;
                for($m=0; $m<count($arrFactor); $m++)
                {
                    if($arrCalFac[$m][0]==$arrFactor[$m][0])
                    {
                        $floCalTot = $floCalTot+(($arrCalFac[$m][1]*$arrFactor[$m][4])/100);  
                    }
                }
                
            
                ?>
                <div class="contenedor-tabla80">
                    <table style="width: 20%;" >
                        <th>
                        Total de los factores
                        </th>
                        <tr>
                            <td><?php echo  sprintf('%.2f', $floCalTot);?></td>
                        </tr>
                    </table>
                </div>
                <?php
                
                
                 $datos = array(
                            "id"=>"B_buscar",//el nombre que tendra el grupo de elementos
                            "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                            "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                            "value"=>utf8_encode("Buscar Características"),
                            "onclick"=>"buscaCarac();"
                            );
                             
				$objComponentes->button_normal($datos); 
                
                
                 $datos = array(
                            "id"=>"B_ver",//el nombre que tendra el grupo de elementos
                            "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                            "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                            "value"=>utf8_encode("Ver Gráfica"),
                            "onclick"=>"verGrafiFac();"
                            );
                             
				$objComponentes->button_normal($datos);                  
                
                
               $this->limpiarSesion();
               $_SESSION["plm_titulo"]=utf8_encode("REPORTE ANÁLISIS DE RESULTADOS POR FACTOR ");
               
                $aux=0;
                $aux2=0;
                for($i=0; $i<count($arrFactor); $i++)
                {
                    if($arrFactor[$i][0]==$arrCalFac[$i][0])
                    {
                        if($arrFactor[$i][0]==$arrEscaFac[$i][0])
                        {
                            if($arrCalFac[$i][1]>=0.1)
                            {
                                $_SESSION["plm_id".$i]=$arrFactor[$i][0];
                                $_SESSION["plm_nombre".$i]=$arrFactor[$i][1];
                                $_SESSION["plm_desc".$i]=$arrFactor[$i][2];
                                $_SESSION["plm_ponde".$i]=$arrFactor[$i][4];
                                $_SESSION["plm_cal".$i]=$arrCalFac[$i][1];
                                $_SESSION["plm_esca".$i]=$arrEscaFac[$i][1];
								$aux2++;
                            }
                            else
                            {
                                $_SESSION["plm_id".$i]=$arrFactor[$i][0];
                                $_SESSION["plm_nombre".$i]=$arrFactor[$i][1];
                                $_SESSION["plm_desc".$i]=$arrFactor[$i][2];
                                $_SESSION["plm_ponde".$i]=0;
                                $_SESSION["plm_cal".$i]=0;
                                $_SESSION["plm_esca".$i]=$arrEscaFac[$i][1];
                                $aux++;
                            }
                        }
                    }
                }
                if($aux<$aux2)
                {
                    ?>
                    <a class="boton-normal boton-grande" target="_blank" href="../Vista/PLM_ReportePdf_Vista.php"><i class=""></i><span class="texto-boton">Reporte Pdf</span></a>
                    <?php
                }
				?>
				<a class="boton-normal boton-grande" target="_blank" href="../Vista/PLM_ReporteExcel_Vista.php"><i class=""></i><span class="texto-boton">Reporte Excel</span></a>
				<?php               
                
                 $datos = array(
                            "id"=>"B_verAnalis",//el nombre que tendra el grupo de elementos
                            "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                            "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                            "value"=>"Escala Cualitativa",
                            "onclick"=>"verEscaFac();"
                            );
                             
				$objComponentes->button_normal($datos);     
                
            }
            ?>
        </div>
            
        <?php

        
        $objComponentes->cerrar_div_bloque_principal();
        $objComponentes -> cerrar_form();
		
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
		
		<?php
    }
    
    //muestra una tabla con todas las características
    function mostrarCaract($arrCaract,$arrCalCaract, $arrEscaCarac, $arrPondeCarac)
    {
        global $objComponentes;
        $this->elementos();
        
        $datos=array("id"=>"buscarAspec");
                    
        $objComponentes->form($datos);
        
		unset($_SESSION["plm_cal_car"]);		
		unset($_SESSION["plm_cal_asp"]);
		unset($_SESSION["plm_cal_evi"]);
         
        
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",//define el nombre que tendra el campo
                "value"=>"buscarAspec",//El atributo value especifica el valor de un elemento
                );                
        $objComponentes->input_hidden($datos);
        
        
		
        $datos=array(
                "id"=>"H_contCarac",//define el nombre que tendra el campo
                "name"=>"H_contCarac",//define el nombre que tendra el campo
                "value"=>count($arrCaract),//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Análisis de Resultados por Características"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
                
        		
                
    
        ?>
        <label>Paginador Por :</label>
        <select name="s_paginador" id="s_paginador" onchange="paginador(1);" >
            <option value="5"> 5 </option>
            <option value="10"> 10 </option>
            <option value="20"> 20 </option>
        </select> 
        
		
        <script type='text/javascript' >
            paginador(1);
         </script>
        <?php       
         
        $temp=0;
        if($arrCaract[0][0])
        {
        ?>
        <div class="contenedor-tabla80">
            <table id="T_tabla" >
                <th style="width: 50%;">
                    <?php echo utf8_encode("Código"); ?>  
                    
                </th>
                <th style="width: 200%;">
                    Nombre
                </th>
                <th style="width: 300%;">
                    
                    <?php echo utf8_encode("Descripción"); ?>  
                </th>
                <th style="width: 50%;">
                    <?php echo utf8_encode("Ponderación Porcentual"); ?>  
                    
                </th>
                <th style="width: 50%;">
                    <?php echo utf8_encode("Calificación"); ?>  
                </th>
                <th style="width: 50%;">
                    Porcentaje de
                    Cumplimiento
                </th>
                <th style="width: 50%;">
                    Escala
                    Cualitativa
                </th>
                <th style="width: 50%;">
                    Seleccionar
                </th>
            <?php
            for($i=0; $i<count($arrCaract); $i++ )
            {
                if(isset($arrCaract[$i][0]))
                {
                ?>
                <tr>
                    <?php
                    for($j=0; $j<5; $j++)
                    {
                        if($j != 3 & $j != 4 & $j!=0)
                        {
                            ?>
                                <td>
                                    <?php echo utf8_encode($arrCaract[$i][$j]);?>
                                </td>
                            <?php
                        }
						else if($j==0)
						{
							?>
							<td>
								<?php echo utf8_encode($arrCaract[$i][5]);?>
							</td>
							<?php
						}
                    }
                    
                    
                    echo "<td>";
					$tempP=0;
                    for($j=0; $j<count($arrPondeCarac); $j++)
                    {
                        if($arrPondeCarac[$j][0]==$arrCaract[$i][0])
                        {
                            echo sprintf('%.2f', $arrPondeCarac[$j][2]);
                            echo "%";
							$tempP=1;
                            break;
                        }
                    }
                    
					if($tempP==0)
					{
						$temp=1;
						echo utf8_encode("la característica no ha sido ponderada");
					}
                    echo "</td>";
                    
                    echo "<td>";
                    
                    for($j=0; $j<count($arrCalCaract); $j++)
                    {
                        if($arrCalCaract[$j][0]==$arrCaract[$i][0])
                        {
                            echo sprintf('%.2f', $arrCalCaract[$j][1]);
                            break;
                        }
                    }
                    
                    
                    echo "</td>";
                                        
                    echo "<td>";
                    
                    for($j=0; $j<count($arrCalCaract); $j++)
                    {
                        if($arrCalCaract[$j][0]==$arrCaract[$i][0])
                        {
							if(((($arrCalCaract[$j][1]-1)/4)*100)<0)
							{
								echo "0";
							}
							else
							{
								echo sprintf('%.2f', ((($arrCalCaract[$j][1]-1)/4)*100));
							}
                            echo "%";
                            break;
                        }
                    }
                    
                    echo "</td>";
                    
                    
                    echo "<td>";
                    
                    for($j=0; $j<count($arrEscaCarac); $j++)
                    {
                        if($arrEscaCarac[$j][0]==$arrCaract[$i][0])
                        {
                            echo utf8_encode($arrEscaCarac[$j][1]);
                            break;
                        }
                    }
                    
                    echo "</td>";
                    
                    echo "<td>";
                    
                    $strName="C_select".$i;
                    $_datos_checkbox=array(
                                $strName=>$arrCaract[$i][0],//el nombre de identificacion y el valor que tendra
                                );
                    
                    $datos = array(
                                "label"=>"",//el nombre que se mostrara
                                "class"=>"lista",//decir como queremos que se muestre los elementos
								"name"=>"select"
                                );
                                        
                    $objComponentes->input_radio ($_datos_checkbox,$datos);
                    echo "</td>";
                    
                    
                    ?>
                    
                    
                </tr>
                <?php 
                }
                ?>
            <?php
            
            }
            }
            else
            {
            $temp=1;
            ?>
            <tr>
                <td><?php echo utf8_encode("NO HAY CARACTERÍSTICAS REGISTRADAS !"); ?> </td>
            </tr>
            <?php
            }
            ?>
            </table>
            
            
            <div id="num_pag">        
            </div>
            
            <br />
            <br />
            <?php
            if($temp==0)
            {
                
                $datos = array(
                        "id"=>"B_buscar",//el nombre que tendra el grupo de elementos
                        "class"=>"grande",
						"icono"=>"none",
                        "value"=>"Buscar Aspectos",
                        "onclick"=>"buscaAspec();"
                        );
                         
                $objComponentes->button_normal($datos);
                
                          
            	
                $datos = array(
                        "id"=>"B_add",//el nombre que tendra el grupo de elementos
                        "class"=>"mediano",
						"icono"=>"none",
                        "value"=>utf8_encode("Agregar Análisis"),
                        "onclick"=>"AddAnalisis();"
                        );
                         
                $objComponentes->button_normal($datos);
                
            	
                 $datos = array(
                            "id"=>"B_ver",//el nombre que tendra el grupo de elementos
                            "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                            "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                            "value"=>utf8_encode("ver Gráfica"),
                            "onclick"=>"verGrafiCarac();"
                            );
                             
				$objComponentes->button_normal($datos);     
                
               $this->limpiarSesion();
               
               $_SESSION["plm_titulo"]=utf8_encode("REPORTE ANÁLISIS DE RESULTADOS POR CARACTERÍSTICA");
                
                //esto se hace para poder generar los reportes
                $aux=0;
                $aux2=0;
                for($i=0; $i<count($arrCaract); $i++)
                {
                    if($arrCaract[$i][0]==$arrCalCaract[$i][0])
                    {
                        if($arrCaract[$i][0]==$arrEscaCarac[$i][0])
                        {
                            if(isset($arrCaract[$i][0])) 
                            {
                                if (isset($arrPondeCarac[$i][0]))
                                {
                                    if($arrCaract[$i][0]==$arrPondeCarac[$i][0])
                                    {
                                        if($arrCalCaract[$i][1]>=0.1)
                                        {
                                            $_SESSION["plm_id".$i]=$arrCaract[$i][0];
                                            $_SESSION["plm_nombre".$i]=$arrCaract[$i][1];
                                            $_SESSION["plm_desc".$i]=$arrCaract[$i][2];
                                            $_SESSION["plm_ponde".$i]=$arrPondeCarac[$i][2];
                                            $_SESSION["plm_cal".$i]=$arrCalCaract[$i][1];
                                            $_SESSION["plm_esca".$i]=$arrEscaCarac[$i][1];
											$aux2++;
                                        }
                                        else
                                        {
                                            $_SESSION["plm_id".$i]=$arrCaract[$i][0];
                                            $_SESSION["plm_nombre".$i]=$arrCaract[$i][1];
                                            $_SESSION["plm_desc".$i]=$arrCaract[$i][2];
                                            $_SESSION["plm_ponde".$i]=0;
                                            $_SESSION["plm_cal".$i]=0;
                                            $_SESSION["plm_esca".$i]=$arrEscaCarac[$i][1];
                                            $aux++;
                                        }
                                        
                                    }
                                }
                            }
                        }
                    }
                }
                
                if($aux<$aux2)
                {
                    ?>
                    <a class="boton-normal boton-grande" target="_blank" href="../Vista/PLM_ReportePdf_Vista.php"><i class=""></i><span class="texto-boton">Reporte Pdf</span></a>
                    
                    <?php
                }
                
                 ?>
                    <a class="boton-normal boton-grande" target="_blank" href="../Vista/PLM_ReporteExcel_Vista.php"><i class=""></i><span class="texto-boton">Reporte Excel</span></a>
                    
                    <?php
                
                
                 $datos = array(
                            "id"=>"B_verAnalis",//el nombre que tendra el grupo de elementos
                            "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                            "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                            "value"=>"Escala Cualitativa",
                            "onclick"=>"verEscaCarac();"
                            );
                             
				$objComponentes->button_normal($datos); 
                
                
            }
            ?>
        </div>
        <?php
        
        
        $datos = array(
                    "id"=>"B_atras",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>utf8_encode("Atrás"),
                    "onclick"=>"AtrasCarac();"
                    );
                     
		$objComponentes->button_normal($datos); 
        
        $objComponentes->cerrar_div_bloque_principal();
        $objComponentes -> cerrar_form();
		
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
		
		<?php
    }
    
    //crea una tabla de aspectos y recibe como parametros
    //un array con todos los aspectos y sus calificaciones
    function mostrarAspec($arrAspec, $arrCalAspec, $arrObAspec,$arrEscaAsp)
    {
        global $objComponentes;
        $this->elementos();
        
        $datos=array("id"=>"buscarEvi");
                    
        $objComponentes->form($datos);
        
				
		unset($_SESSION["plm_cal_asp"]);
		unset($_SESSION["plm_cal_evi"]);
		
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",//define el nombre que tendra el campo
                "value"=>"buscarEvi",//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        $datos=array(
                "id"=>"H_contAspec",//define el nombre que tendra el campo
                "name"=>"H_contAspec",//define el nombre que tendra el campo
                "value"=>count($arrAspec),//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Análisis de Resultados por Aspectos"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        
    
        ?>
        <label>Paginador Por :</label>
        <select name="s_paginador" id="s_paginador" onchange="paginador(1);" >
            <option value="5"> 5 </option>
            <option value="10"> 10 </option>
            <option value="20"> 20 </option>
        </select> 
        
		
        <script type='text/javascript' >
            paginador(1);
         </script>
        <?php       
        
        
        $temp=0;
        if($arrAspec[0][0])
        {
        ?>
        <div class="contenedor-tabla80">
            <table id="T_tabla">
                <th>
                    <?php echo utf8_encode("Código"); ?>
                </th>
                <th style="width: 200%;">
                    Nombre
                </th>
                <th style="width: 300%;">
                    
                    <?php echo utf8_encode("Descripción"); ?> 
                </th>
                <th style="width: 50%;">
                    <?php echo utf8_encode("Calificación"); ?> 
                </th>
                <th style="width: 50%;">
                    Porcentaje de
                    Cumplimiento
                </th>
                <th style="width: 80%;">
                    Escala 
                    Cualitativa
                </th>
                <th style="width: 100%;">
                    Observaciones / Acciones de mejoramiento identificadas
                </th>
                
                <th style="width: 30%;">
                    Seleccionar
                </th>
            <?php
            for($i=0; $i<count($arrAspec); $i++ )
            {
                if(isset($arrAspec[$i][0]))
                {
                ?>
                <tr>
                    <?php
                    for($j=0; $j<3; $j++)
                    {
						if($j!=0)
						{
							?>
								<td>
									<?php echo utf8_encode($arrAspec[$i][$j]);?>
								</td>
							<?php
						}
						else if($j==0)
						{
							?>
								<td>
									<?php echo utf8_encode($arrAspec[$i][5]);?>
								</td>
							<?php
						}
                    }
                    
                    echo "<td>";
                    
                    for($j=0; $j<count($arrCalAspec); $j++)
                    {
                        if($arrCalAspec[$j][0]==$arrAspec[$i][0])
                        {
                            echo sprintf('%.2f',$arrCalAspec[$j][1]);
                            break;
                        }
                    }
                    
                    echo "</td>";
                    
                    echo "<td>";
                    for($j=0; $j<count($arrCalAspec); $j++)
                    {
                        if($arrCalAspec[$j][0]==$arrAspec[$i][0])
                        {
							if(((($arrCalAspec[$j][1]-1)/4)*100)<0)
							{
								echo "0";
							}
							else
							{
								echo  sprintf('%.2f', ((($arrCalAspec[$j][1]-1)/4)*100));
							}
                            echo "%";
                            break;
                        }
                    }
                    echo "</td>";
                    
                    echo "<td>";
                    
                    for($j=0; $j<count($arrEscaAsp); $j++)
                    {
                        if($arrEscaAsp[$j][0]==$arrAspec[$i][0])
                        {
                            echo utf8_encode($arrEscaAsp[$j][1]);
                            break;
                        }
                    }
                    echo "</td>";
                    
                    echo "<td>";
                    
                    for($j=0; $j<count($arrObAspec); $j++)
                    {
                        if($arrObAspec[$j][0]==$arrAspec[$i][0])
                        {
                            
                            $_SESSION["plm_observacion".$arrObAspec[$j][0]] ="". $arrObAspec[$j][1] ."";
                            break;
                        }
                    }
                    
                            
                    $datos = array(
                                "id"=>"B_observa",//el nombre que tendra el grupo de elementos
                                "class"=>"grande",
                                "icono"=>"none",
                                "value"=>"Ver Observaciones",
                                "onclick"=>"mostrarObserva();"
                                );
                                 
                    $objComponentes->button_normal($datos);
                    echo "</td>";
                    
                    echo "<td>";
                    
                    $strName="C_select".$i;
                    $_datos_checkbox=array(
                                $strName=>$arrAspec[$i][0],//el nombre de identificacion y el valor que tendra
                                );
                    
                    $datos = array(
                                "label"=>"",//el nombre que se mostrara
                                "class"=>"checkbox-bloque",//decir como queremos que se muestre los elementos
                                "name"=>"select"//nombre que tendra el grupo de elementos
                                );
                                        
                    $objComponentes->input_radio ($_datos_checkbox,$datos);
                    echo "</td>";
                    echo "</tr>";
            }
            }        ?>
            </table>
            <div id="num_pag">        
            </div>
            <?php
            
            }
            else
            {
            $temp=1;
            ?>
            <tr>
                <td>NO HAY ASPECTOS REGISTRADOS !</td>
            </tr>
            <?php
            }
            ?>
            <br />
            <br />
            <?php
            if($temp==0)
            {
                
            $datos = array(
                        "id"=>"B_buscar",//el nombre que tendra el grupo de elementos
                        "class"=>"grande",
                        "icono"=>"none",
                        "value"=>"Buscar Evidencias",
                        "onclick"=>"buscaEvi();"
                        );
                         
            $objComponentes->button_normal($datos);
                       
            
           $this->limpiarSesion();
           
           $_SESSION["plm_titulo"]=utf8_encode("REPORTE ANÁLISIS DE RESULTADOS POR ASPECTOS");
            
            $aux=0;
            $aux2=0;
            for($i=0; $i<count($arrAspec); $i++)
            {
                if(isset($arrAspec[$i][0]))
                {
                    if(isset($arrCalAspec[$i][0]))
                    {
                        if($arrAspec[$i][0]==$arrCalAspec[$i][0])
                        {
                            if($arrAspec[$i][0]==$arrEscaAsp[$i][0])
                            {
                                if($arrAspec[$i][0]==$arrObAspec[$i][0])
                                {
                                    if($arrCalAspec[$i][1]>-1)
                                    {
                                        $_SESSION["plm_id".$i]=$arrAspec[$i][0];
                                        $_SESSION["plm_id2".$i]=$arrAspec[$i][5];
                                        $_SESSION["plm_nombre".$i]=$arrAspec[$i][1];
                                        $_SESSION["plm_desc".$i]=$arrAspec[$i][2];
                                        $_SESSION["plm_ob".$i]=$arrObAspec[$i][1];
                                        $_SESSION["plm_cal".$i]=$arrCalAspec[$i][1];
                                        $_SESSION["plm_esca".$i]=$arrEscaAsp[$i][1];
										$aux2++;
                                    }
                                    else
                                    {
                                        $_SESSION["plm_id".$i]=$arrAspec[$i][0];
                                        $_SESSION["plm_id2".$i]=$arrAspec[$i][5];
                                        $_SESSION["plm_nombre".$i]=$arrAspec[$i][1];
                                        $_SESSION["plm_desc".$i]=$arrAspec[$i][2];
                                        $_SESSION["plm_ob".$i]=$arrObAspec[$i][1];
                                        $_SESSION["plm_cal".$i]=0;
                                        $_SESSION["plm_esca".$i]=$arrEscaAsp[$i][1];
                                        $aux++;
                                    }                                    
                                }
                            }
                        }
                    }
                }
            }
            
            if($aux<$aux2)
            {
                ?>
                <a class="boton-normal boton-grande" target="_blank" href="../Vista/PLM_ReportePdf_Vista.php"><i class=""></i><span class="texto-boton">Reporte Pdf</span></a>
               
                    
                <?php
            } ?>
                <a class="boton-normal boton-grande" target="_blank" href="../Vista/PLM_ReporteExcel_Vista.php"><i class=""></i><span class="texto-boton">Reporte Excel</span></a>
                    
                <?php
		
			 $datos = array(
						"id"=>"B_ver",//el nombre que tendra el grupo de elementos
						"class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
						"icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
						"value"=>utf8_encode("ver Gráfica"),
						"onclick"=>"verGrafiAspec();"
						);
						 
			$objComponentes->button_normal($datos);     
                
             $datos = array(
                        "id"=>"B_verAnalis",//el nombre que tendra el grupo de elementos
                        "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                        "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                        "value"=>"Escala Cualitativa",
                        "onclick"=>"verEscaAspec();"
                        );
                         
			$objComponentes->button_normal($datos); 
                
            }
                        
            ?>
        </div>
    
        <?php
        $datos = array(
                    "id"=>"B_atras",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>utf8_encode("Atrás"),
                    "onclick"=>"AtrasAspec();"
                    );
                     
		$objComponentes->button_normal($datos); 
        
        $objComponentes->cerrar_div_bloque_principal();
        $objComponentes -> cerrar_form();
		
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
		
		<?php
    }
    
    //muestra una tabla con todas las evidencias
    function mostrarEvi($arrEvi, $arrCalEvi, $datP)
    {
        
        global $objComponentes;
        $this->elementos();
        
        $datos=array("id"=>"graficaGrupoInt");
                    
        $objComponentes->form($datos);
        
		unset($_SESSION["plm_cal_evi"]);
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",//define el nombre que tendra el campo
                "value"=>"graficaGrupoInt",//El atributo value especifica el valor de un elemento
                );               
        $objComponentes->input_hidden($datos);
        
        
        $datos=array(
                "id"=>"H_contEvi",//define el nombre que tendra el campo
                "name"=>"H_contEvi",//define el nombre que tendra el campo
                "value"=>count($arrEvi),//El atributo value especifica el valor de un elemento
                );
                
                
        $objComponentes->input_hidden($datos);
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Análisis de Resultados por Evidencias"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        
        
        ?>
        <label>Paginador Por :</label>
        <select name="s_paginador" id="s_paginador" onchange="paginador(1);" >
            <option value="5"> 5 </option>
            <option value="10"> 10 </option>
            <option value="20"> 20 </option>
        </select> 
        
		
        <script type='text/javascript' >
            paginador(1);
         </script>
        <?php          
    
        if($arrEvi[0][0])
        {
        ?>
        <div class="contenedor-tabla80">
            <table id="T_tabla">
                <th style="width: 50%;">                    
                    <?php echo utf8_encode("Código"); ?>
                </th>
                <th style="width: 200%;">
                    Nombre
                </th>
                <th style="width: 200%;">
                    <?php echo utf8_encode("Descripción"); ?>
                </th>
                <th style="width: 50%;">
                    <?php echo utf8_encode("Calificación"); ?>
                    
                </th>
                <th style="width: 50%;">
                    Seleccionar
                </th>
            <?php
            for($i=0; $i<count($arrEvi); $i++ )
            { 
                if(isset($arrEvi[$i][0]))
                {
                ?>
                <tr>
                    <?php
                    for($j=0; $j<3; $j++)
                    {
						if($j!=0)
						{
							?>
								<td>
									<?php echo utf8_encode($arrEvi[$i][$j]);?>
								</td>
							<?php
						}
						else if($j==0)
						{
							?>
								<td>
									<?php echo utf8_encode($arrEvi[$i][5]);?>
								</td>
							<?php
						}
                    }
                    
                    ?>
                    <td>
                    <?php 
                    for($k=0; $k<count($arrCalEvi); $k++)
                    {
                        if($arrEvi[$i][0] == $arrCalEvi[$k][0])
                        {
                            echo  sprintf('%.2f',$arrCalEvi[$k][1]);
                        }                     
                    }
                    
                    ?>
                    </td>
                    <td> 
                    <?php
                        $strName="C_select".$i;
                        
                        $_datos_checkbox=array(
                                    $strName=>$arrEvi[$i][0],//el nombre de identificacion y el valor que tendra
                                    );
                        
                        $datos = array(
                                    "label"=>"",//el nombre que se mostrara
                                    "class"=>"checkbox-bloque",//decir como queremos que se muestre los elementos
                                    "name"=>"select"//nombre que tendra el grupo de elementos
                                    );
                                            
                        $objComponentes->input_radio ($_datos_checkbox,$datos);
                        ?>
                      
                    </td>
                </tr>
            <?php
                }
            }
            }
            else
            {
            ?>
            <tr>
                <td>NO HAY EVIDENCIAS REGISTRADAS !</td>
            </tr>
            <?php
            }
            ?>
            </table>
            <div id="num_pag">        
            </div>
        </div>
    
        <?php
        for($i=0; $i<count($arrEvi); $i++)
		{
			if(isset($arrEvi[$i][0]))
			{
				if(isset($arrCalEvi[$i][0]))
				{
					if($arrEvi[$i][0]==$arrCalEvi[$i][0])
					{
					   if($arrCalEvi[$i][1]>-1)
                       {
    						$_SESSION["plm_id".$i]=$arrEvi[$i][0];
    						$_SESSION["plm_nombre".$i]=$arrEvi[$i][1];
    						$_SESSION["plm_desc".$i]=$arrEvi[$i][2];
    						$_SESSION["plm_cal".$i]=$arrCalEvi[$i][1];  
                        }                 
                        else
                        {
                            $_SESSION["plm_id".$i]=$arrEvi[$i][0];
    						$_SESSION["plm_nombre".$i]=$arrEvi[$i][1];
    						$_SESSION["plm_desc".$i]=$arrEvi[$i][2];
    						$_SESSION["plm_cal".$i]=0;  
                        }     
					}
				}
			}
		}
        $datos = array(
        "id"=>"B_ver",//el nombre que tendra el grupo de elementos
        "class"=>"grande",
        "icono"=>"none",
        "value"=>"Ver",
        "onclick"=>"verGrupoInt();"
        );
         
        $objComponentes->button_normal($datos);
        $datos = array(
                    "id"=>"B_atras",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>utf8_encode("Atrás"),
                    "onclick"=>"AtrasEvi();"
                    );
                     
		$objComponentes->button_normal($datos);
        
        $objComponentes->cerrar_div_bloque_principal();
        $objComponentes -> cerrar_form();
		
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
		
		<?php
    }
    
    //muestra una grafica de cada grupo de interes
    //y su calificacion con un vector de entrada:
    // nombre, descripcion, estado, calificacion
    function mostrarGraficaGrupos($arrGrupos)
    {
        global $objComponentes;
        $this->elementos();
        
        $datos=array("id"=>"graficaGrupoInt");
                    
        $objComponentes->form($datos);
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",//define el nombre que tendra el campo
                "value"=>"buscarEvi",//El atributo value especifica el valor de un elemento
                );
        $objComponentes->input_hidden($datos);
                
        $strGrupo="";
        $strGrupo2="";
        if(count($arrGrupos)>5)
        {
            for($i=0; $i<count($arrGrupos)-2; $i++)
            {
                if($i==0)
                {
                    $strGrupo="\"".$arrGrupos[$i][0];
                    $strGrupo2="".$arrGrupos[$i][3];
                    
                }
                else
                {
                    $strGrupo=$strGrupo."\",\"".$arrGrupos[$i][0];
                    $strGrupo2=$strGrupo2.",".$arrGrupos[$i][3];
                    
                }
                
            }
        }
        else
        {
            for($i=0; $i<count($arrGrupos); $i++)
            {
                if($i==0)
                {
                    $strGrupo="\"".$arrGrupos[$i][0];
                    $strGrupo2="".$arrGrupos[$i][3];
                    
                }
                else
                {
                    $strGrupo=$strGrupo."\",\"".$arrGrupos[$i][0];
                    $strGrupo2=$strGrupo2.",".$arrGrupos[$i][3];
                    
                }
                
            }
        }
        
        $strGrupo=$strGrupo."\"";
        $strGrupo2=$strGrupo2.",";
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Gráfica De Percepción De Grupos De Interés"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        ?>
            <br />
            <br />
                <script>
                
                        var barChartData = {
                            labels: [<?php echo utf8_encode($strGrupo);?>],
                            datasets: [
                				{
                				    fillColor: "rgba(151,187,205,0.5)",
                				    strokeColor: "rgba(151,187,205,1)",
                				    data: [<?php echo $strGrupo2;?> 0]
                				}
                			]
              
                
                        }
                
                    var myLine = new Chart(document.getElementById("bar-chart").getContext("2d")).Bar(barChartData);

                </script>
                <div align="center">
                    <canvas id="bar-chart" class="chart-holder" width="700" height="400">
                    
                    </canvas>
                </div>
        <?php
        
        $datos = array(
                    "id"=>"B_atras",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>utf8_encode("Atrás"),
                    "onclick"=>"AtrasGrupo();"
                    );
                     
		$objComponentes->button_normal($datos);
        $objComponentes->cerrar_div_bloque_principal();
        $objComponentes -> cerrar_form();
		
    }
    
    //muestra un gráfica que puede ser de los factores, características y de los aspectos
    function mostGrafCarac($arrCarac, $strTitulo, $strAtras)
    {
        global $objComponentes;
        $this->elementos();
        
        $datos=array("id"=>"buscarAspec");
                    
        $objComponentes->form($datos);
        
         
        
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",//define el nombre que tendra el campo
                "value"=>"buscarAspec",//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        $strCaract="";
        $strCaract2="";
        for($i=0; $i<count($arrCarac); $i++)
        {
            if($arrCarac[$i][0])
            {
                if($arrCarac[$i][1])
                {
                    if($i==0)
                    {
                        $strCaract="\"".$arrCarac[$i][0];
                        $strCaract2="".$arrCarac[$i][1];                
                    }
                    else
                    {
                        $strCaract=$strCaract."\",\"".$arrCarac[$i][0];
                        $strCaract2=$strCaract2.",".$arrCarac[$i][1];
                        
                    }
                }
				else
				{
					if($i==0)
                    {
                        $strCaract="\"".$arrCarac[$i][0];
                        $strCaract2="0";                
                    }
                    else
                    {
                        $strCaract=$strCaract."\",\"".$arrCarac[$i][0];
                        $strCaract2=$strCaract2.",0";
                        
                    }
				}
				
            }
        }
        $strCaract=$strCaract."\"";
        $strCaract2=$strCaract2.",";
        
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode($strTitulo),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
               
        
        ?>
            <br />
            <br />
                <script>
                
                        var barChartData = {
                            labels: [<?php echo utf8_encode($strCaract);?>],
                            
                            datasets: [
                				{
                				    fillColor: "rgba(151,187,205,0.5)",
                				    strokeColor: "rgba(151,187,205,1)",
                				    data: [<?php echo $strCaract2;?> 0]
                				}
                			]                
                        }
                
                    var myLine = new Chart(document.getElementById("bar-chart").getContext("2d")).Bar(barChartData);

                </script>
                <div align="center">
                    <canvas id="bar-chart" class="chart-holder" width="900" height="600">
                    
                    </canvas>
                </div>
                
        <?php
        
        
         $datos = array(
                    "id"=>"B_atras",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>utf8_encode("Atrás"),
                    "onclick"=>$strAtras
                    );
                     
		$objComponentes->button_normal($datos); 
        
        $objComponentes->cerrar_div_bloque_principal();
        $objComponentes->cerrar_form();
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

<?PHP

?>