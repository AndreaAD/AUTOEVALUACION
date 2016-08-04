<?php
class AddProView{
    
    //en esta interface se puede captuar el nuevo proyecto
    public function guardar(){
    ?>
    
    <br />
    <br />
    <form id="guardar" method="post">
        <input type="hidden" id="H_opcion" name="H_opcion" value="guardar" />
        
    <div class="bloque una-columna-centro-medio">
      <div class="titulo-bloque texto-izquierda">
          <h2 class="icon-quill">Agregar Proyecto</h2>
      </div>
      <br />
            
                    <label>Proyecto</label> 
                    
                    <input id="T_nombre" name="T_nombre" type="text" size="30" />
            
            <br />
            <input type="button" value="Guardar" id="B_guardar" onclick="add();" />
    </div>
    </form>
<?PHP
    }
    // se muestra un mensaje de advertencia
    public function mensaje($strMen)
    {
        ?>
        
        <div class="bloque una-columna-centro-medio">
          <div class="titulo-bloque texto-izquierda">
              <h2 class="icon-quill">Agregar Area</h2>
          </div>
          <br />
        <?php
        echo "<h3> $strMen </h3>";
        ?>
        </div>
        <?php        
    }
}
?>