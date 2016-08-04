<?php
class AddProyectoView{
    
    //muestra la interface para guaradar un proyecto 
    public function guardar(){
    ?>
    
    <br />
    <br />
        <form id="guardar" method="post">
    <div class="bloque una-columna-centro-medio">
      <div class="titulo-bloque texto-izquierda">
          <h2 class="icon-quill">Agregar Proyecto</h2>
      </div>
      <br />
            <input type="hidden" id="H_opcion" name="H_opcion" value="guardar" />
            
            
                    <label>Proyecto</label> 
                    
                    <input id="T_nombre" name="T_nombre" type="text" size="30" />
            
            <br />
            <input type="button" value="Guardar" id="B_guardar" onclick="add();" />
        </form>
    </div>
	
	
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
    public function mensaje($strMen)
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
	  
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2><?php echo $strMen;?></h2></p>');
		div_emergente.css('display','block');	
	  </script>
      <?php     
    }
}
?>