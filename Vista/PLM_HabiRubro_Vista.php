
<?php

class SelRubroView
{
    //muestra los rubros deshabilitados
    public function buscaRubros($rubros)
    {
        ?>
        <br />
        <br />
        <form id="buscar" name="buscar" method="post" >
            <input type="hidden" id="H_opcion" name="H_opcion" value="ver" />
            
            <div class="bloque una-columna-centro-medio">
              <div class="titulo-bloque texto-izquierda">
                  <h2 class="icon-quill">Habilitar Rubro del P.O.A.I</h2>
              </div>
              <br />
              
              <?php
              if($rubros[0][0])
              {
              ?>
                <table border="0" align="center">
                     <tr>
                        <td>
                            <label>Rubro</label>   
                        </td>
                        <td>
                            <select name="S_rubro">
                            <?php
                            for($i=0; $i<count($rubros); $i++)
                            {
                                ?>
                                <option value="<?php echo $rubros[$i][0];?>"> <?php echo utf8_encode($rubros[$i][1]);?> </option>
                                <?php
                            }
                            ?>
                            </select>
                        </td>
                     </tr>
                     <tr>
                        <td>
                            <input type="button" value="Buscar" id="B_buscar" onclick="busca();" />
                        </td>
                     </tr>
                </table>
              <?php
              }
              else
              {
                ?>
                <h3>No hay Rubros Deshabilitados!!!</h3>
                <?php
              }
              ?>
            </div>
        </form>
        <?php    
    }
    
    //imprime un rubro en especifico para habilitarlo
    public function imprime($arrRubro)
    {
    ?>
    <br />
    <br />
    <form id="habilitar" method="post">
            <div class="bloque una-columna-centro-medio">
              <div class="titulo-bloque texto-izquierda">
          <h2 class="icon-quill">Habilitar Rubro del P.O.A.I</h2>
      </div>
        <input type="hidden" id="H_opcion" name="H_opcion" value="habilitar"  />
        
        <table border="0" align="center">
        <?php
        
        if($arrRubro[0][0])
        {
        ?>
         <tr>         
            <td>
                <label><?php echo utf8_encode("Código");?></label>   
            </td>
            <td>
                <input type="hidden" id="T_codigo" name="T_codigo" value="<?php echo $arrRubro[0][0];?>"  size="11" /><?php echo $arrRubro[0][0];?>
            </td>
         </tr>
         <tr>
            <td>
                <label>Rubro</label> 
            </td>
            <td>
                <label><?php echo utf8_encode($arrRubro[0][1]);?></label> 
            </td>
         </tr>
         
         <tr>
            <td>
                <input type="button" value="Habilitar" id="B_guardar" onclick="habi();" />
            </td>
         </tr>
          <?php
          }
             else
            {
                ?>
                <tr>
                    <td>EL Rubro NO EXISTE!!</td>
                </tr>
                <?php
            }
        ?>
    </table>
    </form>
    </div>
    
    
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
	  
		div_emergente.find('.emergente > div[data-role="contenido"]').html('<p><h2><?php echo $strMensaje;?></h2></p>');
		div_emergente.css('display','block');	
	  </script>
      <?php
    }
}
?>