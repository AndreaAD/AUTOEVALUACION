
<?php
class LlenarPlanView {
    
    // en este metodo se pretende seleccionar los factores y características 
    //para despues poder crear una actividad de mejoramiento
    public function buscaFactores() {
    ?>
	
    
     <form id="buscar_factor" name="buscar_factor" method="post" >
    <input type="hidden" id="H_opcion" name="H_opcion" value="" />
	<input type="hidden" name="factor" value="">
	<input type="hidden"name ="caracteristica" value="">
	
		<div class="row">
                <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor">Factor</label>
                <button type="button" id="A_factor" class="boton-solo-icono"><i class="icon-redo2"></i></button>
                <textarea id="factor" style="width:90%; height:50px;" placeholder="Seleccione un factor" id="texto-factor" readonly="on"></textarea>
        </div>
		<div class="row">
                <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor"><?php echo utf8_encode("Característica");?></label>
                <button type="button" id="A_caracteristica" class="boton-solo-icono"><i class="icon-redo2"></i></button>
                <textarea id="caracteristica" style="width:90%; height:50px;" placeholder="Seleccione una caracteristica" id="texto-factor" readonly="on"></textarea>
        </div>	

	</form>
	
		
		<div class="errores"></div>
			<div id="div_emergente" class="fondo_emergente">
				<div class="emergente">
					<div data-role="contenido"></div>
					<div data-role="botones"></div>
					<span title="cerrar" data-rol="cerrar"> x </span>
				</div>
			</div>
		</div>
		
		
		<input type="button" value="Diligenciar" id="B_diligencia" />
        
        <?php    
    }
    
    //se muestra la información de un proceso
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
        <th style="width: 20%;"><?php echo utf8_encode("Facultad"); ?></th>
        <th style="width: 20%;"><?php echo utf8_encode("Programa Académico"); ?></th>
        <th style="width: 20%;">Sede/ Seccional</th>
        <th style="width: 20%;">Nombre del Director/ <?php echo utf8_encode("coordinador académico"); ?></th>
        <th style="width: 20%;"><?php echo utf8_encode("Año"); ?></th>
        <tr>
            <td><?php echo ($strFacultad);?></td>
            <td><?php echo ($strPrograma);?></td>
            <td><?php echo ($strSede);?></td>
            <td><?php echo ($strDirector);?></td>
            <td><?php echo $strAnio;?></td>
        </tr>
        </table>
        
        <?php
        
        $objComponentes->cerrar_div_bloque_principal();
    }
    
    //en esta función se cargan todos los datos para poder generar un plan de mejoramiento
    // se carga el analisi causal, la caracteristica y el puntaje
    public function cargarDatos($caracteristica, $consolidado, $areas, $rubros, $proyectos)
    {	   
        global $objComponentes;
        $this->elementos();
		$temp=0;
		?>         
    
    
    
    <script src="../Js/PLM_mensajes.js" type="text/javascript" > </script>
    <br />
    <br />
    <form id="guardar_plan" name="guardar_plan" method="post">
        <input type="hidden" id="H_opcion" name="H_opcion" value="guardar"  />
        
        
        <div class="bloque una-columna-centro-medio" style="width:70%">
          <div class="titulo-bloque texto-izquierda">
              <h2 class="icon-quill">Crear Actividad de mejoramiento</h2>
          </div>
          <br />
        <table border="0" align="center" style="padding: 5px;"> 
             <tr>
                <td style="text-align: center;">
                   <?php echo utf8_encode("Característica:");?>
                </td>
                    <td style="text-align: center;">
                <?php
                
                if(($caracteristica[0][0]))
                {
                    ?>
                        <input type="hidden" id="T_caracteristica" name="T_caracteristica" value="<?php echo $caracteristica[0][0]; ?>"  />
                        <?php echo ($caracteristica[0][1]); ?>
                   
                    <?php
                }
                else
                { 
					$temp=1;
                    ?>
                    
                       <label><?php echo "Debe hacer antes la consolidación!!! "?></label>
              
              
                    <?php
                }
                ?> 
                </td>
             </tr>
             <tr>
                <td style="text-align: center;">
                    <label>Puntaje</label> 
                </td>
                
                    <td style="text-align: center;">
                <?php 
                
                if(($consolidado[0][0]))
                {
                    ?>
                        <input type="hidden" width="100%" id="T_puntaje" name="T_puntaje" value="<?php echo $consolidado[0][0];?>"  size="30" /><?php echo $consolidado[0][0];?>
            
                    <?php
                }
                else
                {
					$temp=1;
                     ?>
                     
                       <label><?php echo utf8_encode("Debe hacer primero la consolidación!!!"); ?></label>
                
                    <?php
                }
                ?>
                </td>
             </tr>
             <tr>         
                <td style="text-align: center;">
                    <label><?php echo utf8_encode("Ámbito");?></label>   
                </td>       
                    <td style="text-align: center;">
                <?php 
                if(($caracteristica[0][2]))
                {
                    
                    ?>
                    <input type="hidden" id="T_ambito" name="T_ambito" value="<?php echo $caracteristica[0][2]; ?>"  />    
                       <?php echo ($caracteristica[0][3]);?>
           
                    <?php
                    
                }
                else 
                {   
					$temp=2;
                    ?>
                    <label> <?php echo utf8_encode("Debe crear mínimo un ámbito !!!"); ?></label> 
                    <?php
                }
                ?>               
                </td>
             </tr>
             <tr>
                <td style="text-align: center;">
                    <label>Fortalezas</label> 
                </td>
                    <td style="text-align: center;">
                <?php
                if(($consolidado[0][1]))
                {
                    ?>
                        <input type="hidden" id="T_fortaleza" name="T_fortaleza" value="<?php echo $consolidado[0][1];?>"  size="30" /><?php echo $consolidado[0][1];?>
                
                    <?php
                }
                else
                {
                    ?>
                    <label>No hay fortalezas detectadas!!</label>
                    <?php
                }
                
                ?>  
                  </td>
             </tr>
             <tr>
                <td style="text-align: center;">
                    <label>Debilidades</label> 
                </td>
                    <td style="text-align: center;">
                <?php
                if(($consolidado[0][2]))
                {
                    ?>
                        <input type="hidden" id="T_debilidad" name="T_debilidad" value="<?php echo $consolidado[0][2];?>"  size="30" /><?php echo $consolidado[0][2];?>
                   
                    <?php
                }
                else
                {
                    ?>
                    <label>No hay debilidades detectadas!!!</label>
                    <?php
                }
                ?>
                 </td>
             </tr>
             <tr>
                <td style="text-align: center;">
                    <label>Causas</label> 
                </td>
                    <td style="text-align: center;">
                <?php
                if(($consolidado[0][3]))
                {
                    ?>
                        <input type="hidden" id="T_causa" name="T_causa" value="<?php echo $consolidado[0][3];?>"  size="30" /><?php echo $consolidado[0][3];?>
             
                    <?php
                }
                else
                {
                    ?>
                    <label>No hay Causas detectadas!!!</label>
                    <?php
                }
                ?>    
                </td>
             </tr>
			 
             <tr>
                <td style="text-align: center;">
                    <label>Nombre del Proyecto</label> 
                </td>
                <td style="text-align: center;">
                   
				   <?php
					if (($proyectos))
					{
						?>                
						<select name="S_proyecto" style= "width: 200px;">
							<?php
							for($i=0; $i<count($proyectos); $i++)
							{
								?>
								<option value="<?php echo $proyectos[$i][0];?>"> <?php echo $proyectos[$i][1];?> </option>
								<?php
							}
							?>
						</select>
					<?php
					}
					else
					{
						$temp=3;
						?>
						<label> <?php echo utf8_encode("Debe crear mínimo un proyecto!!!"); ?></label>                    
						<?php
					}
					?>
				   
                </td>
             </tr>
			 
             <tr>
                <td style="text-align: center;">
                    <label>Objetivo</label> 
                </td>
                <td style="text-align: center;">
                    <input type="text" id="T_objetivo" name="T_objetivo" size="30" />
                </td>
             </tr>
             <tr>
                <td style="text-align: center;">
                
               <label>Acciones para el logro del proyecto</label>
                </td>
                <td style="text-align: center;">
                     <?php 
                                
                      $datos=array(
                            "id"=>"T_acciones",//define el nombre que tendra el campo
                            "name"=>"T_acciones", // (necesario) define el name del campo
            				"label"=>"",//La etiqueta label define una etiqueta para un elemento
                            "placeholder"=>"Acciones",//El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                            "maxlength"=>"300",//El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                            "disabled"=>"",//Cuando está presente, especifica que el elemento <input> debe ser desactivada
                            "required"=>"on",//especifica que un campo de entrada debe ser completado antes de enviar el formulario
                            "onkeypress"=>"",//El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()"
                            "onkeydown"=>"",//El evento onkeydown se produce cuando el usuario presiona una tecla onkeydown="myFunction()"
                            "help"=>utf8_encode("Realice una breve descripción de las acciones para el logro del proyecto")//Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                            );
                                
                    $objComponentes->textarea($datos);
                    ?>
                </td>
             </tr>
             <tr>         
                <td style="text-align: center;">
                    <label><?php echo utf8_encode("Área líder");?></label>   
                </td>
                <td style="text-align: center;">
                <?php
                if (($areas))
                {
                    ?>                
                    <select name="S_area" style= "width: 200px;">
                        <?php
                        for($i=0; $i<count($areas); $i++)
                        {
                            ?>
                            <option value="<?php echo $areas[$i][0];?>"> <?php echo $areas[$i][1];?> </option>
                            <?php
                        }
                        ?>
                    </select>
                <?php
                }
                else
                {
					$temp=3;
                    ?>
                    <label> <?php echo utf8_encode("Debe crear mínimo un área!!!"); ?></label>                    
                    <?php
                }
                ?>
                </td>
             </tr>
             <tr>         
                <td style="text-align: center;">
                    <label><?php echo utf8_encode("Área Secundaria");?></label>   
                </td>
                <td style="text-align: center;">
                <?php
                if (($areas))
                {
                    ?>                
                    <select name="S_area2" style= "width: 200px;">
                        <?php
                        for($i=0; $i<count($areas); $i++)
                        {
                            ?>
                            <option value="<?php echo $areas[$i][0];?>"> <?php echo $areas[$i][1];?> </option>
                            <?php
                        }
                        ?>
                    </select>
                <?php
                }
                else
                {
					$temp=3;
                    ?>
                    <label> <?php echo utf8_encode("Debe crear mínimo un área!!!"); ?></label>                    
                    <?php
                }
                ?>
                </td>
             </tr>
             <tr>
                <td style="text-align: center;">
                    <label>Metas</label> 
                </td>
                <td style="text-align: center;">
                    
                    <?php 
                                
                      $datos=array(
                            "id"=>"T_metas",//define el nombre que tendra el campo
                            "name"=>"T_metas", // (necesario) define el name del campo
            				"label"=>"",//La etiqueta label define una etiqueta para un elemento
                            "placeholder"=>"Metas",//El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                            "maxlength"=>"300",//El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                            "disabled"=>"",//Cuando está presente, especifica que el elemento <input> debe ser desactivada
                            "required"=>"on",//especifica que un campo de entrada debe ser completado antes de enviar el formulario
                            "onkeypress"=>"",//El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()"
                            "onkeydown"=>"",//El evento onkeydown se produce cuando el usuario presiona una tecla onkeydown="myFunction()"
                            "help"=>utf8_encode("Realice una breve descripción de las metas para el logro del proyecto")//Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                            );
                                
                    $objComponentes->textarea($datos);
                    ?>
                </td>
             </tr>
             <tr>
                <td style="text-align: center;">
                    <label>Indicadores</label> 
                </td>
                <td style="text-align: center;">
                    <?php 
                                
                      $datos=array(
                            "id"=>"T_indicador",//define el nombre que tendra el campo
                            "name"=>"T_indicador", // (necesario) define el name del campo
            				"label"=>"",//La etiqueta label define una etiqueta para un elemento
                            "placeholder"=>"Indicadores",//El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                            "maxlength"=>"300",//El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                            "disabled"=>"",//Cuando está presente, especifica que el elemento <input> debe ser desactivada
                            "required"=>"on",//especifica que un campo de entrada debe ser completado antes de enviar el formulario
                            "onkeypress"=>"",//El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()"
                            "onkeydown"=>"",//El evento onkeydown se produce cuando el usuario presiona una tecla onkeydown="myFunction()"
                            "help"=>utf8_encode("Realice una breve descripción de los indicadores")//Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                            );
                                
                    $objComponentes->textarea($datos);
                    ?>
                </td>
             </tr>
             <tr>
                <td style="text-align: center;">
                    <label>Fecha inicial</label> 
                </td>
                <td style="text-align: center;">
                <script type='text/javascript' >

					$('#calendario-T_fechainicio').toggle();
						
				</script>
                <?php
				    $datos=array(
                    "id"=>"T_fechainicio",//(no necesario)define el id que tendra el campo
                    "name"=>"T_fechainicio", // (necesario) define el name del campo
                    "label"=>"",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Fecha Inicio",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"15",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "help"=>"Por favor digite la fecha de inicio de la actividad",//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    "obligatorio"=>"obligatorio_fechaI",
                    "formulario"=>"guardar_plan"
                    );
                    
					$objComponentes->input_text_calendario($datos);
				?>
                
				
                </td>
             </tr>
             <tr>
                <td style="text-align: center;">
                    <label>Fecha final</label> 
                </td>
                <td style="text-align: center;">
				
				  <script type='text/javascript' >

					$('#calendario-T_fechafin').toggle();
						
				</script>
                <?php
				    $datos=array(
                    "id"=>"T_fechafin",//(no necesario)define el id que tendra el campo
                    "name"=>"T_fechafin", // (necesario) define el name del campo
                    "label"=>"",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Fecha Final",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"15",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "help"=>"Por favor digite la fecha final de la actividad",//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    "obligatorio"=>"obligatorio_fechaI",
                    "formulario"=>"guardar_plan"
                    );
                    
					$objComponentes->input_text_calendario($datos);
					
				?>
                
      
				
                </td>
             </tr>
             
             <tr>
                <td>
				<?php
				if($temp==0)					
				{
					?>
						<input type="button" value="Guardar" id="B_guardar_plan"  />
					<?php
				}
				else if($temp != 0)
				{
					echo utf8_encode("<h2>Se han encontrado varios errores en el proceso !!!</h2>");
					echo "</ br>";
					echo utf8_encode("<h2>Se debe validar si la consolidación ya se hizo!!!</h2>");
				}
				
				?>
                </td>
             </tr>
        </table>
		<link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
		<div class="errores"></div>
			<div id="div_emergente" class="fondo_emergente">
				<div class="emergente">
					<div data-role="contenido"></div>
					<div data-role="botones"></div>
					<span title="cerrar" data-rol="cerrar"> x </span>
				</div>
			</div>
		</div>
		
		
        <label id="nombreP" ></label>
        
        </div>
    </form>
    <?php
		
    }
    
    
    //mensaje de advertencia
    public function mensaje($strMensaje)
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
	  
        var div_emergente = $('#div_emergente');
        
        var cerrarEmergente = function(e){
        div_emergente.css('display','none');
        e.preventDefault();
        }
        
        var ocultar_emergente = function(){
        	setTimeout(function(){ div_emergente.fadeOut("slow"); },2000)
        }
        
        div_emergente.find('.emergente span[data-rol="cerrar"]').on('click', function(e){
        	div_emergente.css('display','none');
        	e.preventDefault();
        });
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2><?php echo $strMensaje;?></h2></p>');
		div_emergente.css('display','block');	
	  </script>
      <?php
    }
    
    //esta  función crea un boton atrás
    function atras( $js_var, $formu, $atrass)
    {
        global $objComponentes;
        $this->elementos();
        
        $datos=array("id"=>"".$formu);
                    
        $objComponentes->form($datos);
        
        
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",//define el nombre que tendra el campo
                "value"=>"".$atrass,//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        
        $datos = array(
                    "id"=>"B_atras",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",
                    "icono"=>"none",
                    "value"=>utf8_encode("Atrás"),
                    "onclick"=>"".$js_var
                    );
                     
        $objComponentes->button_normal($datos);
        
                    
        $objComponentes->cerrar_form();
        
    }
    
    // enesta función se crea un objeto a la clase elementos vista
    function elementos()
    {
        global $objComponentes;   
        require_once("../Vista/VIS_Elementos_Vista.php");
        $objComponentes=new Elementos();
        
    }
}
?>
