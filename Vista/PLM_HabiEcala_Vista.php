<?php

class HabiEscalaView
{
    //se hace objeto de elementos vista
    function elementos()
    {
        global $objComponentes;   
        require_once("../Vista/VIS_Elementos_Vista.php");
        $objComponentes=new Elementos();
        
    }
    
    //se muestra una lista con todas las escalas habilitadas  
    function mostrar($arrEsca)
    {
        global $objComponentes;
        $this->elementos(); 
        
        $datos=array("id"=>"buscar");
                    
        $objComponentes->form($datos);
        
                
        $datos=array(
                    "id"=>"H_opcion", //(no necesario) define el id que tendra el campo
                    "name"=>"H_opcion", // (necesario) define el name que tendra el campo
                    "value"=>"buscar");// (necesario) El atributo value especifica el valor de un elemento    
        $objComponentes->input_hidden($datos);
         
        $datos=array("tipo"=>"bloque una-columna-centro-medio",
                    "titulo"=>"Habilitar Escalas",
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
                    "onclick"=>"buscarHabi();"// (necesario) funcion js que se ejecutara si se hace click en el boton
                    );
        $objComponentes->button_normal($datos);
        
        $objComponentes->cerrar_div_bloque_principal();
        $objComponentes->cerrar_form();    
    } 
    
    //se muestra una escala en especifico, para ser habilitada
    function mostrarEscala($arrEsa)
    {
        
        global $objComponentes;
        $this->elementos(); 
        
        $datos=array("id"=>"guardar");
                    
        $objComponentes->form($datos);
        
                
        $datos=array(
                    "id"=>"H_opcion", //(no necesario) define el id que tendra el campo
                    "name"=>"H_opcion", // (necesario) define el name que tendra el campo
                    "value"=>"habilitar");// (necesario) El atributo value especifica el valor de un elemento    
        $objComponentes->input_hidden($datos);
                
        $datos=array(
                    "id"=>"H_idEsca", //(no necesario) define el id que tendra el campo
                    "name"=>"H_idEsca", // (necesario) define el name que tendra el campo
                    "value"=>"".$arrEsa[0][0]);// (necesario) El atributo value especifica el valor de un elemento    
        $objComponentes->input_hidden($datos);
         
        $datos=array("tipo"=>"bloque una-columna-centro-medio",
                    "titulo"=>"Habilitar Escalas",
                    "alignTitulo"=>"titulo-bloque texto-izquierda",
                    "alignContenido"=>"texto-centro",
                    "icono"=>"icon-quill");
        $objComponentes->div_bloque_principal($datos);
        
        ?>
        <table>
        <tr>
            <td>Codigo </td><td><?php echo $arrEsa[0][0]?></td>
        </tr>
        <tr>
            <td>Escala </td> <td><?php echo $arrEsa[0][1]?></td>
        </tr>
        </table>
        
        <?php
                
        $datos = array(
                    "id"=>"B_habi",//(no necesario) el id que tendra el boton
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "value"=>"Habilitar",//(necesario) valor que mostrar el boton
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "reset"=>"off",// (no necesario) si se establece reset es para crear un boton que borre el contenido del formulario y el onclick no funcionara
                    "onclick"=>"guardarHabi();"// (necesario) funcion js que se ejecutara si se hace click en el boton
                    );
        $objComponentes->button_normal($datos);
        
        $objComponentes->cerrar_div_bloque_principal();
        $objComponentes->cerrar_form();   
    }
    
    // se muestra un mensaje de advertencia
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