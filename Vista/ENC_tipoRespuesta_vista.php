<?php
require_once("elementos_vista.php");
$objComp=new Elementos();
switch($opcion){
    case "cantidad":
        $datos = array(
                    "id"=>"tipo-respuesta",//(no necesario)el id que tendra el select
                    "name"=>"tipoRespuesta",// (necesario) nombre que tendra el select
                    "textodefault"=>"Seleccione un tipo",
                    "label"=>"Tipo de respuesta",//(necesario - si se omite queda como si se pasara vacio)el nombre que se mostrara
                    "onchange"=>"enc_selectTipoRespuesta(this)"
                    );
        $objComp->select($arrayTipoRespuestas,$datos);
        ?>
        <div class="grupo-controles-formulario">
            <label for="" class="texto-control-formulario">Respuestas</label>
            <div class="controles-formulario" id="respuestas-contenido">
        <?php
        for($i=0;$i<$cantidadRespuestas;$i++){
            ?>
            <div style="width:100%; height:100%; display:block; clear:both; margin-bottom:5.5em;">
                    <div style="display:inline-block;width:60%;float:left; margin-right:3em;">
                        <textarea style="width:100%; height:60px; overflow-y:auto;" id="textoRespuesta" name="textoRespuesta[]"></textarea>
                    </div>
                    <div style="display:inline-block; float:left; width:20%; text-align:center;">
                        <span>Valor</span>
                        <select name="ponderacion[]" style="width:100%;">
                            <option style="display:block;" value="0">Sin tipo</option>
                    </select>
                    </div>
                </div>
                <?php
        }
        ?>
            </div><!--controles-formulario-->        
        </div><!--grupo-controles-formulario-->
        <?php
        break;
    case "tipo":
            while(!$rsDatosPonderacion->EOF) //Mientras no estemos al final de RecordSet
            {
                ?><option style="display:block;" 
                value="<?php echo $rsDatosPonderacion->fields[0];?>">
                <?php echo $rsDatosPonderacion->fields[1];?>
                </option><?php
               $rsDatosPonderacion->MoveNext();
            }
        break;
     case "ideal":
            if($isIdeal){
            ?>
            <div id="div-ideal" class="grupo-controles-formulario">
            <label for="" class="texto-control-formulario">Escriba el Ideal</label>
                <div class="controles-formulario" id="respuestas-contenido">
                    <input type="text" name="ideal" style="width:100px;"/>
                </div><!--controles-formulario-->  
            </div><!--grupo-controles-formulario-->
            <?php
            }
        break;
}
?>


   