<?php
class PonderacionVista
{
    //se establece la función para iniciar 
    function elementos()
    {
        global $objComponentes;   
        require_once("../Vista/VIS_Elementos_Vista.php");
        $objComponentes=new Elementos();
        
    }
    
    
    
    //muestra una tabla con el historial del factor
    function mostrarTablaDinamic($arrArreglo, $titulo)
    {
        global $objComponentes;
              
        ?>
        <table>
        <th style="width: 10%;"><?php echo utf8_encode("Código")?></th>
        <th style="width: 90%;"><?php echo utf8_encode("".$titulo)?></th>
        
        <?php
        for($i=0; $i<count($arrArreglo); $i++)
        {
            echo "<tr>";
                echo "<td>";
				if($titulo=="Factor")
				{
					echo  $arrArreglo[$i][5];
				}
				
				
                echo "</td>";
                echo "<td>";
                echo  $arrArreglo[$i][1];
                echo "</td>";
            echo "</tr>";
        }
        ?>
        </table>
        <?php                   
        
    }
    
    //se establece esta función para mostrar un boton 
    //de atras en la pantalla 
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
    
    //muestra un mensaje de advertencia de la razón de ponderación 
    function advierteRazon()
    {        
        
        global $objComponentes;
        $this->elementos();
        
        $datos=array("id"=>"guardarRazon");
                    
        $objComponentes->form($datos);
        
        
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",//define el nombre que tendra el campo
                "value"=>"guardarRazon",//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        
        $this->mensaje(utf8_encode("Debe agregar primero la razón! "));
        
        $datos = array(
                    "id"=>"B_ir",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",
                    "icono"=>"none",
                    "value"=>utf8_encode("Aceptar"),
                    "onclick"=>"atrasRazon();"
                    );
                     
        $objComponentes->button_normal($datos);
        
        $objComponentes->cerrar_div_bloque_principal();   
    }
    
    //en esta interface se añade la razón de una ponderación
    function addRazon($strRazon)
    {
        
        global $objComponentes;
        $this->elementos();
        
        $datos=array("id"=>"guardarRazon");
                    
        $objComponentes->form($datos);
        
        
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",//define el nombre que tendra el campo
                "value"=>"guardarRazon",//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Agregar Razones de ponderación"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        if(($strRazon[0]))
        { 
            $datos=array(
                        "id"=>"TA_razon",//define el nombre que tendra el campo
                        "name"=>"TA_razon",//define el nombre que tendra el campo
                        "label"=>utf8_encode("Razones que justifican la ponderación de las características en cada factor"),//La etiqueta label define una etiqueta para un elemento
                        "placeholder"=>"Razones",//El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                        "value"=>"".$strRazon[0],//el valor por defecto 
                        "maxlength"=>"100",//El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                        "disabled"=>"",//Cuando está presente, especifica que el elemento <input> debe ser desactivada
                        "required"=>"on",//especifica que un campo de entrada debe ser completado antes de enviar el formulario
                        "onkeypress"=>"",//El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()"
                        "onkeydown"=>"",//El evento onkeydown se produce cuando el usuario presiona una tecla onkeydown="myFunction()"
                        "help"=>utf8_encode("Realice una breve descripción de las razones por las que se escogieron esas ponderaciones")//Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                        );
                        
            $objComponentes->textarea($datos);
        }
        else
        {
             $datos=array(
                        "id"=>"TA_razon",//define el nombre que tendra el campo
                        "name"=>"TA_razon",//define el nombre que tendra el campo
                        "label"=>utf8_encode("Razones que justifican la ponderación de las características en cada factor"),//La etiqueta label define una etiqueta para un elemento
                        "placeholder"=>"Razones",//El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                        "maxlength"=>"100",//El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                        "disabled"=>"",//Cuando está presente, especifica que el elemento <input> debe ser desactivada
                        "required"=>"on",//especifica que un campo de entrada debe ser completado antes de enviar el formulario
                        "onkeypress"=>"",//El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()"
                        "onkeydown"=>"",//El evento onkeydown se produce cuando el usuario presiona una tecla onkeydown="myFunction()"
                        "help"=>utf8_encode("Realice una breve descripción de las razones por las que se escogieron esas ponderaciones")//Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                        );
                        
            $objComponentes->textarea($datos);
        }
        
          
        $datos = array(
                    "id"=>"B_guardar",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",
                    "icono"=>"none",
                    "value"=>"Guardar Razones",
                    "onclick"=>"guardarRazon();"
                    );
                     
        $objComponentes->button_normal($datos);
        
        $datos = array(
                    "id"=>"B_atras",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",
                    "icono"=>"none",
                    "value"=>utf8_encode("Atrás"),
                    "onclick"=>"atrasRazon();"
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
		<?php
    }
    
    //en este punto se muestra la información de un proceso 
    function mostrarInfo($srtFacultad, $strPrograma, $strSede, $strDirector, $strAnio)
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
        <table>
        <th style="width: 20%;"><?php echo utf8_encode("Facultad"); ?></th>
        <th style="width: 20%;"><?php echo utf8_encode("Programa Académico"); ?></th>
        <th style="width: 20%;">Sede/ Seccional</th>
        <th style="width: 20%;">Nombre del Director/ coordinador <?php echo utf8_encode("académico"); ?></th>
        <th style="width: 20%;"><?php echo utf8_encode("Año"); ?></th>
        <tr>
            <td><?php echo $srtFacultad;?></td>
            <td><?php echo $strPrograma;?></td>
            <td><?php echo $strSede;?></td>
            <td><?php echo $strDirector;?></td>
            <td><?php echo $strAnio;?></td>
        </tr>
        </table>
        
        <?php
        
        $objComponentes->cerrar_div_bloque_principal();
    }
    
    // aqui se muestra un tabla con todos los factore y su 
    //ponderación final
    function mostrarFac($arrFactor)
    {
                
        global $objComponentes;
        $this->elementos();
                
        $datos=array("id"=>"buscarCaract");
                    
        $objComponentes->form($datos);
        
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",//define el nombre que tendra el campo
                "value"=>"buscarCaract",//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        $datos=array(
                "id"=>"H_contFac",//define el nombre que tendra el campo
                "name"=>"H_contFac",//define el nombre que tendra el campo
                "value"=>count($arrFactor),//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>"Ponderaciones Por Factores",
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        
        $temp=0;
        if($arrFactor[0][0])
        {
        ?>
        <div class="contenedor-tabla80">
            <table style="width: 100%;">
                <th style="width: 10%;">
                    <?php echo utf8_encode("Código")?>
                </th>
                <th style="width: 40%;">
                    Nombre
                </th>
                <th style="width: 45%;">
                    <?php echo utf8_encode("Descripción")?>
                    
                </th>
                <th style="width: 45%;">
                    <?php echo utf8_encode("Ponderación")?>
                     
                    porcentual 
                    del factor
                </th>
                <th style="width: 10%;">
                    Seleccionar
                </th>
            <?php
            
            for($i=0; $i<count($arrFactor); $i++ )
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
                            <?php echo $arrFactor[$i][$j];
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
                            <?php echo $arrFactor[$i][5];?>
                            
                        </td>
                    <?php
                    }
                }
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
                ?>                
            </tr>
            
            </table>
            
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
                $datos = array(
                            "id"=>"B_buscar",//el nombre que tendra el grupo de elementos
                            "class"=>"grande",
                            "icono"=>"none",
                            "value"=>utf8_encode("Buscar Características"),
                            "onclick"=>"buscaCarac();"
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
    
    //aqui se muestra todas las características de un factor y 
    //si tiene la ponderaciónfinal, si no aparece en blanco  
    function mostrarCaract($arrCaract, $arrPonde, $strRazon)
    {
        global $objComponentes;
        $this->elementos();
        
        $datos=array("id"=>"guardar");
                    
        $objComponentes->form($datos);
        
        
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",//define el nombre que tendra el campo
                "value"=>"calcularValor",//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        $datos=array(
                "id"=>"H_contCarac",//define el nombre que tendra el campo
                "name"=>"H_contCarac",//define el nombre que tendra el campo
                "value"=>count($arrCaract),//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
    
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Ponderaciones por Características "),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        $temp=0;
        
        if(isset($strRazon[0][0]))
        {
            if(($strRazon[0][0]))
            {
                echo utf8_encode("Las características ya tienen una razón agregada!!!");   
                echo "<br />";            
            }
        }
        if(isset($arrCaract[0][0]))
        {
        if($arrCaract[0][0])
        {
            if(isset($arrPonde[0][1]))            
            {
                if($arrPonde[0][1])            
                {
                    echo utf8_encode("Las características ya han sido ponderadas!!!");   
                }
            }
        ?>
        <div class="contenedor-tabla80">
            <table >
                <th style="width: 10%;">
                    <?php echo utf8_encode("Código")?>
                </th>
                <th>
                    Nombre
                </th>
                <th>
                    <?php echo utf8_encode("Descripción")?>
                    
                </th>
                <th>
                    <?php echo utf8_encode("Ponderación porcentual de Característica")?>
                    
                </th>
            <?php
            for($i=0; $i<count($arrCaract); $i++ )
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
                                <?php echo $arrCaract[$i][$j];
                                
                                ?>
                            </td>
                        <?php
						}
						else
						{
						?>
                            <td>
                                <?php echo $arrCaract[$i][3];
                                
                                ?>
                            </td>
                        <?php
						}
                    }
                    echo "<td>";
                    if(isset($arrPonde[$i][1]))
                    {
                        if($arrPonde[$i][0]==$arrCaract[$i][0])
                        { 
                            $datos=array(
                            "id"=>"T_pondera".$i,//define el nombre que tendra el campo
                            "name"=>"T_pondera".$i,//define el nombre que tendra el campo
                            "placeholder"=>"%",//El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                            "maxlength"=>"4",//El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                            "value"=>"". sprintf('%.2f',$arrPonde[$i][1])."%",//El atributo value especifica el valor de un elemento
                            "readonly"=>"",//especifica de sólo lectura
                            "disabled"=>"",//Cuando está presente, especifica que el elemento <input> debe ser desactivada
                            "required"=>"on",//especifica que un campo de entrada debe ser completado antes de enviar el formulario
                            "onkeypress"=>"",//El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()"
                            "onkeydown"=>""//El evento onkeydown se produce cuando el usuario presiona una tecla onkeydown="myFunction()"
                            
                            );
                            
                            $objComponentes->input_text($datos);
                        }
                    }
                    else
                    {
                        $datos=array(
                                    "id"=>"T_pondera".$i,//define el nombre que tendra el campo
                                    "name"=>"T_pondera".$i,//define el nombre que tendra el campo
                                    "placeholder"=>"%",//El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                                    "maxlength"=>"4",//El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                                    "value"=>"",//El atributo value especifica el valor de un elemento
                                    "readonly"=>"",//especifica de sólo lectura
                                    "disabled"=>"",//Cuando está presente, especifica que el elemento <input> debe ser desactivada
                                    "required"=>"on",//especifica que un campo de entrada debe ser completado antes de enviar el formulario
                                    "onkeypress"=>"",//El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()"
                                    "onkeydown"=>""//El evento onkeydown se produce cuando el usuario presiona una tecla onkeydown="myFunction()"
                                    
                                    );
                                    
                        $objComponentes->input_text($datos);
                    }
					
					?>					
					<script>
					  $('#<?php echo "T_pondera".$i;?>').keydown(function(event) {
						
						if(event.shiftKey)
					   {
							event.preventDefault();
					   }

					   if (event.keyCode == 46 || event.keyCode == 8)    {
					   }
					   else {
							if (event.keyCode < 95) {
							  if (event.keyCode < 48 || event.keyCode > 57) {
									event.preventDefault();
							  }
							} 
							else {
								  if (event.keyCode < 96 || event.keyCode > 105) {
									  event.preventDefault();
								  }
							}
						  }
	  
					  });
					</script>
						
					<?php
                    $datos=array(
                            "id"=>"H_idCar".$i,//define el nombre que tendra el campo
                            "name"=>"H_idCar".$i,//define el nombre que tendra el campo
                            "value"=>$arrCaract[$i][0],//El atributo value especifica el valor de un elemento
                            );
                            
                    $objComponentes->input_hidden($datos);
                    echo "</td>";

                    }
                    ?>
                    
                    
                </tr>
            </table>
            <?php
            
            }
            }
            else
            {
            $temp=1;
            ?>
            <tr>
                <td><?php echo utf8_encode("NO HAY CARACTERÍSTICAS REGISTRADAS !");?></td>
            </tr>
            <?php
            }
            ?>
            <br />
            <br />
            <?php
            if($temp==0)
            {
               
                $datos_select=array(
                            utf8_encode("Igual peso por característica")=>"1",//el nombre a mostrar y el valor que tendra
                            utf8_encode("Pesos variables por característica")=>"2",//el nombre a mostrar y el valor que tendra
                            );
                
                $datos = array(
                            "id"=>"S_opcion",//nombre que tendra el grupo de elementos
                            "name"=>"S_opcion",//nombre que tendra el grupo de elementos
                            "label"=>"Seleccionar"//el nombre que se mostrara
                            );
                                    
                $objComponentes->select ($datos_select,$datos);
                
                
    
                $datos = array(
                            "id"=>"B_guardar",//el nombre que tendra el grupo de elementos
                            "class"=>"grande",
                            "icono"=>"none",
                            "value"=>utf8_encode("Guardar Ponderación"),
                            "onclick"=>"guardarValor();"
                            );
                             
                $objComponentes->button_normal($datos);
                
                $datos = array(
                            "id"=>"B_add",//el nombre que tendra el grupo de elementos
                            "class"=>"grande",
                            "icono"=>"none",
                            "value"=>utf8_encode("Agregar Razón"),
                            "onclick"=>"addRazon();"
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
    
    // se muestra un mensaje de advertencia
    //usado o enviado por el controlador 
    
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