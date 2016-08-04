<?php
$datos=array("id"=>"modificar-tipo-pregunta",// (necesario) id de la ventana
            "ancho"=>"50",//(necesario) ancho en porcentaje que tendra la ventana emergente valores entre 10 y 95
            "alto"=>"80",// (necesario) alto en porcentaje que tendra la ventana valor entre 10 y 90
            "alignContenido"=>"texto-centro",// (no necesario - si no se pone se aliena al centro por defeccto) alienacion del contenido
            "des"=>"4" // desplazamiento de la ventana con respecto a la parte superior porcentaje de 0 a 100
            );
$objComp->bloque_div_flotante($datos);
?>
<form id="datos" style="padding:0rem;margin:0rem;">
<h1 style="font-size:1.2rem;">MODIFICACI&Oacute;N TIPO RESPUESTA</h1>
<input type="hidden" name="id" value="<?php echo $idTipo;?>"/>
<ul style="list-style: none;">
    <li>Descripcion</li>
    <li><textarea name="descripcion" style="width: 90%;"><?php echo $datosTipo->fields['descripcion']; ?></textarea></li>
    <li>Cantidad respuestas</li>
    <li><?php echo $datosTipo->fields['cantidad_respuestas']; ?></li>
    <li>Estado</li>
    <li><input name="estado" type="radio" value="1" <?php if($datosTipo->fields['estado']==1){ echo 'checked';} ?>/>Habilitado
    <input name="estado" type="radio" value="0" <?php if($datosTipo->fields['estado']==0){ echo 'checked';} ?>/>Deshabilitado</li>
</ul>
<div class="texto-centro">
<table style="width:80%;margin-left:10%;">
<?php
    $i=1;
    foreach($rsPonderacion as $ponderacion){
    ?><tr>
        <td>Opcion <?php echo $i;?></td>
    </tr>
    <tr>
        <td>
        <input type="hidden" name="ponderacionid[]" value="<?php echo $ponderacion['pk_respuesta_ponderacion'];?>"/>
        <input name="ponderacion<?php echo $ponderacion['pk_respuesta_ponderacion'];?>" type="text" value="<?php echo $ponderacion['ponderacion'];?>"/></td>
    </tr><?php
     $i++;
    }
?>
</table>
</div>
<br />
</form>
<?php
$datos = array(
            "class"=>"small",//(necesario) tamaño del boton puede ser {grande,mediano,small}
            "value"=>"Guardar Cambios",//(necesario) valor que mostrar el boton
            "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "onclick"=>"enc_guardarModificacionTipoPregunta(this);"// (necesario) funcion js que se ejecutara si se hace click en el boton
            );
$objComp->button_normal($datos);
$datos = array(
            "class"=>"small",//(necesario) tamaño del boton puede ser {grande,mediano,small}
            "value"=>"Cancelar",//(necesario) valor que mostrar el boton
            "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "onclick"=>"enc_aceptarEmergente(this);"// (necesario) funcion js que se ejecutara si se hace click en el boton
            );
$objComp->button_normal($datos);
$objComp->cerrar_bloque_div_flotante();
?>