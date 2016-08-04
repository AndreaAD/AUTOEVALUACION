<?php if($faseProceso!=3){
    ?>
    <div class="aletra-fase">
    <p>Este proceso se encuentra fuera de la fase de creacion, no podra realizar cambios en esta seccion.</p>
    <p>Para realizar cambios asegurese de estar en la fase correcta.</p>
    </div>
<?php }
$datos=array(
            "tipo"=>"una-columna",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Creación y Modificación de Preguntas", // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-centro", //(necesario) alineacion del contenido del div
            "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
$objComp->div_bloque_principal($datos);
?>
<style type="text/css">
    fieldset{
        margin:0 0 1rem 0;
        text-align:left;
    }
    fieldset legend{
        font-size:1.1rem;
        /*font-weight: 400;*/
    }
    fieldset > div{
        padding-bottom:1rem;
    }
    fieldset > div:nth-child(2n){
        background-color:rgba(200,200,200,0.3);
    }
    fieldset div span.titulo{
        position:relative;
        display:inline-block;
        padding-right: 2rem;
        width:10%;
        font-weight: 600;
    }
    fieldset div span.texto{
        position:relative;
        width: 90%;
    }
</style>
<fieldset>
<legend>Datos Evidencia</legend>
<div>
<span class="titulo">Factor</span><span class="texto" id="texto-factor"><?php echo $txFactor;?></span>
</div>
<div>
<span class="titulo">Caracteristica</span><span class="texto" id="texto-caracteristica"><?php echo $txCaracteristica;?></span>
</div>
<div>
<span class="titulo">Aspecto</span><span class="texto" id="texto-aspecto"><?php echo $txAspecto;?></span>
</div>
<div>
<span class="titulo">Evidencia</span><span class="texto" id="texto-evidencia"><?php echo $txEvidencia;?></span>
</div>
</fieldset>
<div class="texto-centro"><?php
$datos = array(
            "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
            "value"=>"Volver a seleccion",//(necesario) valor que mostrar el boton
            "icono"=>"arrow-left", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "onclick"=>"enc_regresar('ENC_seleccionEliminar_controlador.php');"// (necesario) funcion js que se ejecutara si se hace click en el boton
            ); 
$objComp->button_link($datos);?>
</div>
<br />
<div class="contenedor-tabla100">
<table id="tabla-preguntas">
    <th style="width: 5%;">Id</th>
    <th style="width: auto; min-height: 50px; height:50px;">Texto Pregunta</th>
    <th style="">Tipo Pregunta</th>
    <th style="">Estado</th>
    <th style="width: 3em; vertical-align:bottom;"><span style="position:relative;width:2em;bottom:1em;-webkit-transform: rotate(-90deg);-moz-transform: rotate(-90deg); tansform: rotate(-90deg); display:inline-block;"></span></th>
    <?php
    $count=count($rsPreguntas);
    if($rsPreguntas!=null && $count>0){
        foreach($rsPreguntas as $fila){
           foreach($fila as $col)
            {
                ?>
                <tr>
                <td id="id"><?php echo $col[0];?></td>
                <td class="texto-izquierda" style="padding-left:2em;"><p><?php echo ($col[1]);?></p>
                <a onclick="enc_mostarOcultarRespuestas(this);" style="cursor:pointer;font-weight:bold;">(Ver respuestas)</a>
                        <div id="respuestas-pregunta" style="display: none;">
                            <ul style="list-style:none;">
                            <?php
                                $numeracion='A';
                                $rsRespuestas=$objRespuestas->getDatosRespuestas($col[0]);
                                foreach($rsRespuestas as $respuesta){
                                    ?>
                                    <li><?php echo "(".$numeracion++.")";?><?php echo ($respuesta[1]);?></li>
                                    <?php
                                }
                            ?>
                            </ul>
                        </div></td>
                <td>
                   <?php 
                        if($col[4]==1){
                            echo 'Insitucional';
                        }else if($col[4]==0){
                            echo 'Normal';
                        }
                   ?>
                </td>
                <td>
                   <?php 
                        if($col[3]==1){
                            echo 'Habilitada';
                        }else if($col[3]==0){
                            echo 'Deshabilitada';
                        }
                        ?>
                </td>
                <td> <?php
                /*$datos = array(
                    "icono"=>"pencil", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "onclick"=>"enc_modificarPregunta(this,'institucional');"// (necesario) funcion js que se ejecutara si se hace click en el boton
                    );
                $objComp->button_solo_icono($datos);*/
                $datos_boton = array(
                    "class"=>"small",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "value"=>"Cambiar Estado",//(necesario) valor que mostrar el boton
                    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                    "onclick"=>"enc_ventanaEstadoPregunta(this);"
                    );
                    if($faseProceso==3){
                        $objComp->button_normal($datos_boton);
                    }
                ?>
                </td>
                </tr><?php
            }
        }
    }else{
        ?>
        <tr>
        <td colspan="5"><p>No hay preguntas Actualemnte</p></td>
        </tr>
        <?php
    }
    ?>
</table>
</div>
<?php
$objComp->cerrar_div_bloque_principal();
$datos=array("id"=>"bloque-deshabilitar-eliminar",///(necesario) id que tendra el div que contendra nuevos elementos
            "tipo"=>"una-columna", //(necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "alignContenido"=>"texto-centro");//(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
$objComp->bloque_div_normal($datos);

$objComp->cerrar_bloque_div_normal();
?>