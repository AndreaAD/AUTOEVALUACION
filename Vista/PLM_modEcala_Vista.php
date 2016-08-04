<?php
class ModEscalaView
{
    function elementos()
    {
        global $objComponentes;   
        require_once("../Vista/VIS_Elementos_Vista.php");
        $objComponentes=new Elementos();
        
    }
    //se muestra la interfce para guardar una ecala modificada
    function guardar($arrEsa)
    {
        global $objComponentes;
        $this->elementos(); 
        
        $datos=array("id"=>"guardar");
                    
        $objComponentes->form($datos);
        
                
        $datos=array(
                    "id"=>"H_opcion", //(no necesario) define el id que tendra el campo
                    "name"=>"H_opcion", // (necesario) define el name que tendra el campo
                    "value"=>"guardar2");// (necesario) El atributo value especifica el valor de un elemento    
        $objComponentes->input_hidden($datos);
        $datos=array(
                    "id"=>"H_idEsca", //(no necesario) define el id que tendra el campo
                    "name"=>"H_idEsca", // (necesario) define el name que tendra el campo
                    "value"=>"".$arrEsa[0][0]);// (necesario) El atributo value especifica el valor de un elemento    
        $objComponentes->input_hidden($datos);
         
        $datos=array("tipo"=>"bloque una-columna",
                    "titulo"=>"Modificar Escalas",
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
                
                
        $datos=array(
                    "id"=>"T_escala",//(no necesario)define el id que tendra el campo
                    "name"=>"T_escala", // (necesario) define el name del campo
                    "label"=>"Escala Cualitativa",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"45",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "value"=>"".$arrEsa[0][1],//(no necesario) El atributo value especifica el valor de un elemento
                    "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "onkeypress"=>"",//(no necesario) El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()" en este campo pones la funcion a llamar
                    "onkeydown"=>"",//(no necesario) El evento onkeydown se produce cuando el usuario presiona una tecla onkeydown="myFunction()" en este campo pones la funcion a llamar
                    "help"=>"Describa la escala cualitativa"//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    );
                    
        $objComponentes->input_text($datos);
        
                
        $datos=array(
                    "id"=>"T_valorIni",//(no necesario)define el id que tendra el campo
                    "name"=>"T_valorIni", // (necesario) define el name del campo
                    "label"=>"Valor Inicial",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"valor",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"11",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "value"=>"".$arrEsa[0][2],//(no necesario) El atributo value especifica el valor de un elemento
                     "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "onkeypress"=>"",//(no necesario) El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()" en este campo pones la funcion a llamar
                    "onkeydown"=>"",//(no necesario) El evento onkeydown se produce cuando el usuario presiona una tecla onkeydown="myFunction()" en este campo pones la funcion a llamar
                    "help"=>"Digite el valor inicial"//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    );
                    
        $objComponentes->input_text($datos);
                
                        
                
        $datos=array(
                    "id"=>"T_valorFin",//(no necesario)define el id que tendra el campo
                    "name"=>"T_valorFin", // (necesario) define el name del campo
                    "label"=>"Valor Final",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"valor",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"11",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "value"=>"".$arrEsa[0][3],//(no necesario) El atributo value especifica el valor de un elemento
                     "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "onkeypress"=>"",//(no necesario) El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()" en este campo pones la funcion a llamar
                    "onkeydown"=>"",//(no necesario) El evento onkeydown se produce cuando el usuario presiona una tecla onkeydown="myFunction()" en este campo pones la funcion a llamar
                    "help"=>"Digite el valor final"//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    );
                    
        $objComponentes->input_text($datos);
        
                
        $datos=array(
                    "id"=>"T_concepto",//(no necesario)define el id que tendra el campo
                    "name"=>"T_concepto", // (necesario) define el name del campo
                    "label"=>"Concepto de la Categoria",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"45",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "value"=>"".$arrEsa[0][4],//(no necesario) El atributo value especifica el valor de un elemento
                    "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "onkeypress"=>"",//(no necesario) El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()" en este campo pones la funcion a llamar
                    "onkeydown"=>"",//(no necesario) El evento onkeydown se produce cuando el usuario presiona una tecla onkeydown="myFunction()" en este campo pones la funcion a llamar
                    "help"=>"Digite el Conceto de la categoria"//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    );
                    
        $objComponentes->input_text($datos);
                
                        
                
        $datos = array(
                    "id"=>"B_guardar",//(no necesario) el id que tendra el boton
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "value"=>"Guardar",//(necesario) valor que mostrar el boton
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "reset"=>"off",// (no necesario) si se establece reset es para crear un boton que borre el contenido del formulario y el onclick no funcionara
                    "onclick"=>"guardarFinal();"// (necesario) funcion js que se ejecutara si se hace click en el boton
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
    
    // se muestra una lista de escalas para despues seleccionar y modificar
    function mostrar($arrEsca)
    {
        global $objComponentes;
        $this->elementos(); 
        
        $datos=array("id"=>"guardar");
                    
        $objComponentes->form($datos);
        
                
        $datos=array(
                    "id"=>"H_opcion", //(no necesario) define el id que tendra el campo
                    "name"=>"H_opcion", // (necesario) define el name que tendra el campo
                    "value"=>"guardar");// (necesario) El atributo value especifica el valor de un elemento    
        $objComponentes->input_hidden($datos);
         
        $datos=array("tipo"=>"bloque una-columna-centro-medio",
                    "titulo"=>"Modificar Escalas",
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        ?>
        <br />
        <select name="S_escala">
        <?php
        for($i=0; $i<count($arrEsca); $i++)
        {
            ?>
            <option value="<?php echo $arrEsca[$i][0];?>"> <?php echo $arrEsca[$i][1];?> </option>
            <?php
        }
        ?>
        </select>
        <br />
        <br />
        <?php
                
        $datos = array(
                    "id"=>"B_buscar",//(no necesario) el id que tendra el boton
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "value"=>"Buscar",//(necesario) valor que mostrar el boton
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "reset"=>"off",// (no necesario) si se establece reset es para crear un boton que borre el contenido del formulario y el onclick no funcionara
                    "onclick"=>"buscar();"// (necesario) funcion js que se ejecutara si se hace click en el boton
                    );
        $objComponentes->button_normal($datos);
        
        $objComponentes->cerrar_div_bloque_principal();
        $objComponentes->cerrar_form();    
    } 
    
    // se muestra mensaje de advertencia
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