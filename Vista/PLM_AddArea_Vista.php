<?php
class AddAreaView{
 
 //aqui se meustra la interface para guardar un áreas
    public function guardar(){
    ?>
    
    <br />
    <br />
    <form id="guardar" method="post">
        <input type="hidden" id="H_opcion" name="H_opcion" value="guardar" />
        
    <div class="bloque una-columna-centro-medio">
      <div class="titulo-bloque texto-izquierda">
          <h2 class="icon-quill"><?php echo utf8_encode("Agregar Área");?></h2>
      </div>
      <br />
            
                    <label><?php echo utf8_encode("Área");?></label> 
                    
                    <input id="T_nombre" name="T_nombre" type="text" size="30" />
            
            <br />
            <input type="button" value="Guardar" id="B_guardar" onclick="add();" />
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
<?PHP
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
	  
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2><?php echo $strMensaje;?></h2></p>');
		div_emergente.css('display','block');	
	  </script>
      <?php
    }
}
?>