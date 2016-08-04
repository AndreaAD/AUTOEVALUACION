<?php
class EliProyectoView
{
    //muestra los proyectos de un proceso
    public function buscaProyectos($proyectos)
    {
        ?>
        <br />
        <br />
        <form id="buscar" name="buscar" method="post" >
            <input type="hidden" id="H_opcion" name="H_opcion" value="ver" />
            
            <div class="bloque una-columna-centro-medio">
              <div class="titulo-bloque texto-izquierda">
                  <h2 class="icon-quill">Deshabilitar Proyecto</h2>
              </div>
              <br />
              
              <?php
              if($proyectos[0][0])
              {
              ?>
                <table border="0" align="center">
                     <tr>
                        <td>
                            <label>Proyecto</label>   
                        </td>
                        <td>
                            <select name="S_proyecto">
                            <?php
                            for($i=0; $i<count($proyectos); $i++)
                            {
                                ?>
                                <option value="<?php echo $proyectos[$i][0];?>"> <?php echo utf8_encode($proyectos[$i][1]);?> </option>
                                <?php
                            }
                            ?>
                            </select>
                        </td>
                     </tr>
                     <tr>
                        <td>
                            <input type="button" value="Buscar" id="B_buscar" onclick="busca3();" />
                        </td>
                     </tr>
                </table>
                
              <?php
              }
              else
              {
                ?>
                <h3>No hay Proyectos Habilitados!!!</h3>
                <?php
              }
              ?>
            </div>
        </form>
        <?php    
    }
    //imprime un proyecto en detalle
    public function imprime($arrProyecto)
    {
    ?>  
		<br />
		<br />
		<form id="eliminar" method="post">
		<div class="bloque una-columna-centro-medio">
		  <div class="titulo-bloque texto-izquierda">
			  <h2 class="icon-quill">Deshabilitar Proyecto</h2>
		  </div>
			<input type="hidden" id="H_opcion" name="H_opcion" value="eliminar"  />
			
			<table border="0" align="center">
			<?php
			
			if($arrProyecto[0][0])
			{
			?>
			 <tr>         
				<td>
					<label>Código</label>   
				</td>
				<td>
					<input type="hidden" id="T_codigo" name="T_codigo" value="<?php echo $arrProyecto[0][0];?>"  size="11" /><?php echo $arrProyecto[0][0];?>
				</td>
			 </tr>
			 <tr>
				<td>
					<label>Proyecto</label> 
				</td>
				<td>
					<label> <?php echo utf8_encode($arrProyecto[0][1]);?> </label>
				</td>
			 </tr>
			 
			 <tr>
				<td>
					<input type="button" value="Deshabilitar" id="B_guardar" onclick="eli();" />
				</td>
			 </tr>
			  <?php
			  }
				 else
				{
					?>
					<tr>
						<td>EL Proyecto NO EXISTE!!</td>
					</tr>
					<?php
				}
			?>
		</table>
		</form>
		</div>
		
		
		<?php
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