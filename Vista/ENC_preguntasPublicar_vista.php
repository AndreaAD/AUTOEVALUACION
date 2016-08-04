<?php
require_once("elementos_vista.php");
$objComp=new Elementos();
$datos=array("id"=>"lista-preguntas",//(necesario) id de la ventana
            "titulo"=>"", //(no necesario) titulo que tendra la ventana
            "alignTitulo"=>"texto-centro",// (no necesario - si no se pone se alinea a la izquierda por defecto) alineacion del titulo
            "alignContenido"=>"texto-izquierda",// (no necesario - si no se pone se aliena al centro por defeccto) alienacion del contenido
            "ancho"=>"60",
            "alto"=>"85",
            "des"=>"3" 
            );
$objComp->bloque_div_flotante($datos);
?>
<div>
<h1><?php echo (strtoupper($txTitulo)); ?></h1>
<p><?php echo (ucfirst($txDescripcion)); ?></p>
<p><?php echo (ucfirst($txInstrucciones)); ?></p>
</div>
<div>
<?php
$j=1;
foreach($rsDatosPreguntas as $pregunta){
?>
    <div>
    <p id="pregunta"><input type="hidden" id="idPregunta" value="<?php echo $pregunta[0]; ?>"/><span><?php echo "(".$j++.") ";?></span><?php echo ucfirst($pregunta[1]);?></p>
    <?php
    $rsRespuestas=$objRespuestas->getDatosRespuestas($pregunta[0]);
    $i="A";
    ?>
    <div class="grupo-controles-formulario"> 
        <div class="controles-formulario">
<?php  foreach($rsRespuestas as $respuesta) {  ?>      
            <div class="radiobutton-lista">
                <span><?php echo $i++.".";?></span>
                <div class="control-radiobutton">
                    <input type="radio" id="<?php echo "idRes".$respuesta[0];?>" name="<?php echo "respuestas".$pregunta[0];?>" value="<?php echo $respuesta[0];?>"/><!--input--> 
                    <label for="<?php echo "idRes".$respuesta[0];?>" class="radiobutton-label"></label><!-- label -->
                </div><!--control-radiobutton-->
                <span class="radiobutton-texto"><label for="<?php echo "idRes".$respuesta[0];?>"><?php echo $respuesta[1];?></label></span>
            </div><!--radiobutton-bloque-->
<?php }  ?>
        </div><!--controles-formulario-->
    </div><!--grupo-controles-formulario-->
    </div>
<?php
}
?>
</div>
<?php
$objComp->cerrar_bloque_div_flotante();
?>