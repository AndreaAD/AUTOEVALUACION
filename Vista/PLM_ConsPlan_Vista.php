<?php
class ConsPlanView
{  
    //en esta funcion se muestra la interface para seleccionar un factor 
    //una característica y un proyecto y una actividad 
    //
    public function buscaFactores() {
	
    ?>
	<!-----------nueva seleccion --------------------->
	
	
    <form id="buscar_factor" name="buscar_factor" method="post" >
    <input type="hidden" id="H_opcion" name="H_opcion" value="" />
	<input type="hidden" name="factor" value="">
	<input type="hidden"name ="caracteristica" value="">
	<input type="hidden"name ="proyecto" value="">
	<input type="hidden"name ="actividad" value="">
	
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
		<div class="row">
                <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor"><?php echo utf8_encode("Proyectos");?></label>
                <button type="button" id="A_proyecto" class="boton-solo-icono"><i class="icon-redo2"></i></button>
                <textarea id="proyecto" style="width:90%; height:50px;" placeholder="Seleccione un proyecto" id="texto-factor" readonly="on"></textarea>
        </div>
		<div class="row">
                <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor"><?php echo utf8_encode("Actividades");?></label>
                <button type="button" id="A_actividad" class="boton-solo-icono"><i class="icon-redo2"></i></button>
                <textarea id="actividad" style="width:90%; height:50px;" placeholder="Seleccione una actividad" id="texto-factor" readonly="on"></textarea>
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
		
		<input type="button" value="Buscar" id="B_buscar" />
        <?php    
    }
    
    //aqui se muestran las características
    public function buscaCaracteristicas($caracteristicas, $factor)
    {
    ?>
          
    <br />
    <br />
    <form id="buscar_caracteristica" name="buscar_caracteristica" method="post">
        <input type="hidden" id="H_opcion" name="H_opcion" value="ver_activi_carac"  />
        <br /> 
        <div class="bloque una-columna-centro-medio" style="width:70%">
          <div class="titulo-bloque texto-izquierda">
              <h2 class="icon-quill">Seleccione Caracteristica</h2>
          </div>
          <br />
        <table border="0" align="center"> 
            <?php
            if($caracteristicas[0][0])
            {
            ?>
             <tr>
                <td style="text-align: right;">
                    Factor:
                </td>
                <td style="text-align: left;">
                    <?php echo ($factor[0][1]); ?>
                </td>
             </tr>
             <tr>         
                <td style="text-align: right;">
                    <label><?php echo utf8_encode("Característica");?></label>   
                </td>
                <td style="text-align: left;">
                    <select name="S_caracteristica" style= "width: 200px;">
                        <?php
                        for($i=0; $i<count($caracteristicas); $i++)
                        {
                            ?>
                            <option value="<?php echo $caracteristicas[$i][0];?>"> <?php echo ($caracteristicas[$i][1]);?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
             </tr>
             <tr>
                <td>
                    <input type="button" value="Buscar" id="B_buscar_caracteristica" onclick="buscar_Activi_Carac();" />
                </td>
             </tr>
             <?php
              }
                 else
                {
                    ?>
                    <tr>
                        <td><?php echo utf8_encode("La Característica NO EXISTE!!");?></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
        </div>
    </form>
    <?php
    }
    
    
    //en esta función se muestra la información de un proceso
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
    
    //este es un mensaje de advertencia
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
    
    //se establece el objeto para apuntar a la clase elementos vista
    function elementos()
    {
        global $objComponentes;   
        require_once("../Vista/VIS_Elementos_Vista.php");
        $objComponentes=new Elementos();
        
    }
    
    //muestra los las actividades de los proyectos
    public function buscaPlan($plan)
    {
        ?>
        <br />
        <br />
        <form id="buscar" name="buscar" method="post" >
            <input type="hidden" id="H_opcion" name="H_opcion" value="ver" />
            
            <div class="bloque una-columna-centro-medio" style="width:70%">
              <div class="titulo-bloque texto-izquierda">
                  <h2 class="icon-quill">Consultar Actividades de mejoramiento</h2>
              </div>
              <br />
              <?php
              if($plan[0][0])
              {
              
              ?>
                <table border="0" align="center">
                     <tr>
                        <td>
                            <label>Proyectos de mejoramiento</label>   
                        </td>
                        <td>
                            <select name="S_plan">
                            <?php
                            for($i=0; $i<count($plan); $i++)
                            {
                                ?>
                                <option value="<?php echo $plan[$i][0];?>"> <?php echo $plan[$i][1];?> </option>
                                <?php
                            }
                            ?>
                            </select>
                        </td>
                     </tr>
                     <tr>
                        <td>
                            <input type="button" value="Buscar" id="B_buscar" onclick="busca2c();" />
                        </td>
                     </tr>
                </table>
              <?php
              }
              else
              {
              ?>
                <h3>No hay actividades de mejoramiento creadas!</h3>
              <?php
              }
              ?>
            </div>
        </form>
        <?php    
    }
    
    //imprime todas las actividades de mejoramiento de un proyecto
    public function imprimePlanes($arrPlan,$atras)
    {
        global $objComponentes;
        
        $this->elementos();
        
        $datos=array("id"=>"mostrarPlanes");
                    
        $objComponentes->form($datos);
        
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",
                "value"=>"ver_activi_planes",//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Actividades"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        
        ?>
        
        <script src="../Js/PLM_paginador.js" type="text/javascript"></script> 
        <label>Paginador Por :</label>
        <select name="s_paginador" id="s_paginador" onchange="paginador(1);" >
            <option value="5"> 5 </option>
            <option value="10"> 10 </option>
            <option value="20"> 20 </option>
        </select> 
        
        
        <script type='text/javascript' >
            paginador(1);
         </script>
       
        <div class="contenedor-tabla80">
            <table id="T_tabla" >
        <th style="width: 10%;"><?php echo utf8_encode("Código");?> </th>
        <th style="width: 10%;"><?php echo utf8_encode("Característica");?> </th>
        <th style="width: 10%;"><?php echo utf8_encode("Objetivo");?> </th>
        <th style="width: 10%;"><?php echo utf8_encode("Acciones para el logro del proyecto");?> </th>
        <th style="width: 10%;"><?php echo utf8_encode("Área Líder");?> </th>
        <th style="width: 10%;"><?php echo utf8_encode("Área segundaria");?> </th>
        <th style="width: 10%;"><?php echo utf8_encode("Metas");?> </th>
        <th style="width: 10%;"><?php echo utf8_encode("Indicadores");?> </th>
        <th style="width: 10%;"><?php echo utf8_encode("Fecha Inicial");?> </th>
        <th style="width: 10%;"><?php echo utf8_encode("Fecha Final");?> </th>
         
        
        <?php
        for($i=0; $i<count($arrPlan); $i++)
        {

            ?>
            <tr>        
                <td><?php echo  $arrPlan[$i][0]; ?></td>
                <td><?php echo  $arrPlan[$i][1]; ?></td>
                <td><?php echo  $arrPlan[$i][2]; ?></td>
                <td><?php echo  $arrPlan[$i][3]; ?></td>
                <td><?php echo  $arrPlan[$i][4]; ?></td>
                <td><?php echo  $arrPlan[$i][5]; ?></td>
                <td><?php echo  $arrPlan[$i][6]; ?></td>
                <td><?php echo  $arrPlan[$i][7]; ?></td>
                <td><?php echo  $arrPlan[$i][8]; ?></td>
                <td><?php echo  $arrPlan[$i][9]; ?></td>
                <td><?php echo  $arrPlan[$i][10]; ?></td>
            </tr>
            <?php
        }        
        ?>
        </table>
        <div id="num_pag">        
        </div>
        </div>
        <?php
        
        
         $datos = array(
                    "id"=>"B_buscar",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>utf8_encode("Atrás"),
                    "onclick"=>"$atras"
                    );                     
		$objComponentes->button_normal($datos); 
               
        
        $objComponentes->cerrar_div_bloque_principal();
        
        $objComponentes->cerrar_form();
    }
    
    //se muestra una acividad de mejoramiento en especifico
    public function imprime($arrPlan, $atras)
    {
        
    ?>
       
    <br />
    <form id="guardar" name="guardar" method="post">
        <input type="hidden" id="H_opcion" name="H_opcion" value="modificar"  />
         
         
        <br /> 
        <div class="bloque una-columna-centro-medio">
          <div class="titulo-bloque texto-izquierda">
              <h2 class="icon-quill">Consultar Actividades de mejoramiento</h2>
          </div>
          <br />
        <table border="0" align="center"> 
            <?php
            
            if(($arrPlan[0][0]))
            {
            ?>
             <tr>         
                <td>
                    <label><?php echo utf8_encode("Código")?> </label>   
                </td>
                <td>
                    <input type="hidden" id="T_codigo" name="T_codigo" value="<?php echo $arrPlan[0][0];?>"  size="30" /><?php echo $arrPlan[0][0];?>
                </td>
             </tr>
             <tr>         
                <td>
                    <label><?php echo utf8_encode("Característica");?></label>   
                </td>
                <td>
                    <input type="hidden" id="T_caracteristica" name="T_caracteristica" value="<?php echo ($arrPlan[0][1]);?>"  size="30" /><?php echo ($arrPlan[0][1]);?>
                </td>
             </tr>
             <tr>
                <td>
                    <label><?php echo utf8_encode("Calificación");?></label>
                </td>
                <td>
                    <input type="hidden" id="T_calificacion" name="T_calificacion" value="<?php echo $arrPlan[0][2];?>"  size="30" /><?php echo ($arrPlan[0][2]);?>
                </td>
             </tr>
             <tr>
                <td>
                    <label><?php echo utf8_encode("Ámbito");?></label></label> 
                </td>
                <td>
                    <input type="hidden" id="T_ambito" name="T_ambito" value="<?php echo ($arrPlan[0][3]);?>"  size="30" /><?php echo ($arrPlan[0][3]);?>
                </td>
             </tr>
             <tr>         
                <td>
                    <label>Fortalezas</label>   
                </td>
                <td>
                    <input type="hidden" id="T_fortalezas" name="T_fortalezas" value="<?php echo ($arrPlan[0][4]);?>"  size="30" /><?php echo ($arrPlan[0][4]);?>
                </td>
             </tr>
             <tr>
                <td>
                    <label>Debilidades</label> 
                </td>
                <td>
                    <input type="hidden" id="T_debilidades" name="T_debilidades" value="<?php echo ($arrPlan[0][5]);?>"  size="30" /><?php echo ($arrPlan[0][5]);?>
                </td>
             </tr>
             <tr>
                <td>
                    <label>Causas</label>
                </td>
                <td>
                    <input type="hidden" id="T_causas" name="T_causas" value="<?php echo ($arrPlan[0][6]);?>"  size="30" /><?php echo ($arrPlan[0][6]);?>
                </td>
             </tr>
             <tr>
                <td>
                    <label>Proyecto</label> 
                </td>
                <td>
                    <input type="hidden" id="T_proyecto" name="T_proyecto" value="<?php echo ($arrPlan[0][7]);?>"  size="30" /><?php echo ($arrPlan[0][7]);?>
                </td>
             </tr>
             <tr>         
                <td>
                    <label>Objetivo</label>   
                </td>
                <td>
                    <input type="hidden" id="T_objetivo" name="T_objetivo" value="<?php echo $arrPlan[0][8];?>"  size="30" /><?php echo $arrPlan[0][8];?>
                </td>
             </tr>
             <tr>
                <td>
                    <label>Acciones</label> 
                </td>
                <td>
                    <input type="hidden" id="T_acciones" name="T_acciones" value="<?php echo $arrPlan[0][9];?>"  size="30" /><?php echo $arrPlan[0][9];?>
                </td>
             </tr>
             <tr>
                <td>
                    <label><?php echo utf8_encode(" Área Líder");?></label>
                </td>
                <td>
                    <input type="hidden" id="T_area" name="T_area" value="<?php echo $arrPlan[0][10];?>"  size="30" /><?php echo $arrPlan[0][10];?>
                </td>
             </tr>
             <tr>
                <td>
                    <label><?php echo utf8_encode("Área Secundaria");?></label> 
                </td>
                <td>
                    <input type="hidden" id="T_area2" name="T_area2" value="<?php echo $arrPlan[0][11];?>"  size="30" /><?php echo $arrPlan[0][11];?>
                </td>
             </tr>
             <tr>         
                <td>
                    <label>Metas</label>   
                </td>
                <td>
                    <input type="hidden" id="T_metas" name="T_metas" value="<?php echo $arrPlan[0][12];?>"  size="30" /><?php echo $arrPlan[0][12];?>
                </td>
             </tr>
             <tr>
                <td>
                    <label>Indicador</label> 
                </td>
                <td>
                    <input type="hidden" id="T_indicador" name="T_indicador" value="<?php echo $arrPlan[0][13];?>"  size="30" /><?php echo $arrPlan[0][13];?>
                </td>
             </tr>
             <tr>
                <td>
                    <label>Fecha Inicial</label> 
                </td>
                <td>
                    <input type="hidden" id="T_fechainicio" name="T_fechainicio" value="<?php echo utf8_decode($arrPlan[0][14]);?>"  size="30" /><?php echo $arrPlan[0][14];?>
                </td>
             </tr>
             <tr>         
                <td>
                    <label>Fecha Final</label>   
                </td>
                <td>
                    <input type="hidden" id="T_fechafin" name="T_fechafin" value="<?php echo $arrPlan[0][15];?>"  size="30" /><?php echo $arrPlan[0][15];?>
                </td>
             </tr>
             <tr>
                <td>
                    <label>Recursos adicionales</label> 
                </td>
                <td>
                    <input type="hidden" id="T_recursos" name="T_recursos" value="<?php echo $arrPlan[0][16];?>"  size="30" /><?php echo $arrPlan[0][16];?>
                </td>
             </tr>
             <tr>
                <td>
                    <label><?php echo utf8_encode("Inversión 2015");?></label>
                </td>
                <td>
                    <input type="hidden" id="T_valor" name="T_valor" value="<?php echo $arrPlan[0][17];?>"  size="30" /><?php echo $arrPlan[0][17];?>
                </td>
             </tr>
             <tr>
                <td>
                    <label><?php echo utf8_encode("Inversión 2016");?></label> 
                </td>
                <td>
                    <input type="hidden" id="T_valor2" name="T_valor2" value="<?php echo $arrPlan[0][18];?>"  size="30" /><?php echo $arrPlan[0][18];?>
                </td>
             </tr>
             <tr>         
                <td>
                    <label><?php echo utf8_encode("Inversión 2017");?></label>   
                </td>
                <td>
                    <input type="hidden" id="T_valor3" name="T_valor3" value="<?php echo $arrPlan[0][19];?>"  size="30" /><?php echo $arrPlan[0][19];?>
                </td>
             </tr>
             <tr>
                <td>
                    <label>Rubro</label> 
                </td>
                <td>
                    <input type="hidden" id="T_rubro" name="T_rubro" value="<?php echo $arrPlan[0][20];?>"  size="30" /><?php echo $arrPlan[0][20];?>
                </td>
             </tr>
             <tr>
                <td>
                    <input type="button" value="<?php echo utf8_encode("Atrás");?>" id="B_guardar" onclick="<?php echo $atras;?>" />
                </td>
             </tr> 
             <?php
              }
                 else
                {
                    ?>
                    <tr>
                        <td>La actividad NO se encuentra</td>
                    </tr>
                    <?php
                }
            ?>
        </table>
        </div>
    </form>
    <?php
    }
    
    
    
    
    //muestra los procesos almacenados y que el usuario puede ver
    function mostrarProcesos($arrProcesos)
    {
        global $objComponentes;
        
        $this->elementos();
        
        $datos=array("id"=>"buscarActivi");
                    
        $objComponentes->form($datos);
        
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",
                "value"=>"ver_activi_proceso",//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Procesos Asignados"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        if(isset($arrProcesos[0][0]))
        {
        ?>
        
        <div class="contenedor-tabla80">
       
        <table> 
        <th style="width: 50%;"><?php echo utf8_encode("Código");?> </th>
        <th style="width: 80%;">Nombre      </th>
        <th style="width: 50%;">Fecha Inicio</th>
        <th style="width: 50%;">Fecha Fin   </th>
        <th style="width: 100%;"><?php echo utf8_encode("Descripción");?> </th>
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
                if(($arrProcesos[$i][$j]))
                {
                    echo $arrProcesos[$i][$j];
                }
                
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
                        "name"=>"radio"//nombre que tendra el grupo de elementos
                        );
                                
            $objComponentes->input_radio ($_datos_checkbox,$datos);
				
            
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
                    "id"=>"B_buscar",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>"Buscar Actividades",
                    "onclick"=>"busca_acti_proce();"
                    );                     
		$objComponentes->button_normal($datos); 
              
        
        }
        else
        {
            echo "<h3>No hay procesos para mostrar!!!</h3>";
        }
         
        
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

        //muestra los procesos almacenados y que el usuario puede ver
    function mostrarProcesosCerrados($arrProcesos)
    {
        global $objComponentes;
        
        $this->elementos();
        
        $datos=array("id"=>"busca_acti_historicos");
                    
        $objComponentes->form($datos);
        
        $datos=array(
                "id"=>"H_opcion",//define el nombre que tendra el campo
                "name"=>"H_opcion",
                "value"=>"ver_historico_plm",//El atributo value especifica el valor de un elemento
                );
                
        $objComponentes->input_hidden($datos);
        
        
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>utf8_encode("Procesos Asignados"),
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        if(isset($arrProcesos[0][0]))
        {
        ?>
        
        <div class="contenedor-tabla80">
       
        <table> 
        <th style="width: 50%;"><?php echo utf8_encode("Código");?> </th>
        <th style="width: 80%;">Nombre      </th>
        <th style="width: 50%;">Fecha Inicio</th>
        <th style="width: 50%;">Fecha Fin   </th>
        <th style="width: 100%;"><?php echo utf8_encode("Descripción");?> </th>
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
                if(($arrProcesos[$i][$j]))
                {
                    echo $arrProcesos[$i][$j];
                }
                
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
                        "name"=>"radio"//nombre que tendra el grupo de elementos
                        );
                                
            $objComponentes->input_radio ($_datos_checkbox,$datos);
                
            
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
                    "id"=>"B_buscar",//el nombre que tendra el grupo de elementos
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "value"=>"Buscar Historico",
                    "onclick"=>"busca_acti_historicos();"
                    );                     
        $objComponentes->button_normal($datos); 
              
        
        }
        else
        {
            echo "<h3>No hay procesos para mostrar!!!</h3>";
        }
         
        
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
    
    }
    
    ?>