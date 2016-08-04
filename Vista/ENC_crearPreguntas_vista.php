<?php if($faseProceso!=3){
    ?>
    <div class="aletra-fase">
    <p>Este proceso se encuentra fuera de la fase de creacion, no podra realizar cambios en esta seccion.</p>
    <p>Para realizar cambios asegurese de estar en la fase correcta.</p>
    </div>
<?php }
require_once("elementos_vista.php");
$objComp=new Elementos();
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
            "onclick"=>"enc_regresar('../Controlador/ENC_seleccionEvidencia_controlador.php','../Controlador/ENC_crearPreguntas_controlador.php','Seleccion de evidencia - Encuestas normales');"// (necesario) funcion js que se ejecutara si se hace click en el boton
            );     
$objComp->button_link($datos);?>
</div>
<br />
<div class="contenedor-tabla100">
<table id="tabla-preguntas">
    <th style="width: 5%;display: none;">Id</th>
    <th style="">Texto Pregunta</th>
    <th style="vertical-align:bottom;"><span style="position:relative;display:inline-block;"></span></th>
    <?php
    $count=count($rsPreguntas);
    if($rsPreguntas!=null && $count>0){
        foreach($rsPreguntas as $fila){
           foreach($fila as $col)
            {
                ?>
                <tr>
                    <td id="id" style="display: none;"><?php echo $col[0];?></td>
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
                        </div>
                    </td>
                    <td> <?php
                    $datos = array(
                        "icono"=>"pencil", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                        "onclick"=>"enc_modificarPregunta(this);"// (necesario) funcion js que se ejecutara si se hace click en el boton
                        );
                        if($faseProceso==3){
                            $objComp->button_solo_icono($datos);
                        }
                    ?>
                    </td>
                </tr><?php
            }
        }
    }else{
        ?>
        <tr>
        <td colspan="3"><p>No hay preguntas Actualemnte</p></td>
        </tr>
        <?php
    }
    ?>
</table>
</div>
<?php
$objComp->cerrar_div_bloque_principal();

if($faseProceso==3){
    
$datos=array("id"=>"bloque-crear-modificar",///(necesario) id que tendra el div que contendra nuevos elementos
            "tipo"=>"una-columna", //(necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "alignContenido"=>"texto-centro");//(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
$objComp->bloque_div_normal($datos);

$datos=array(
            "tipo"=>"una-columna",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Crear nueva pregunta", // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-centro", //(necesario) alineacion del contenido del div
            "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
$objComp->div_bloque_principal($datos);
$objComp->form(array("id"=>"crearPregunta"));
$datos=array(
            "id"=>"hidden", //(no necesario) define el id que tendra el campo
            "name"=>"idPregunta", // (necesario) define el name que tendra el campo
            "value"=>"");// (necesario) El atributo value especifica el valor de un elemento            
$objComp->input_hidden($datos);
$datos=array(
            "id"=>"textarea-pregunta",// (no necesario) define el id que tendra el campo
            "name"=>"textoPregunta", // (necesario) define el name del campo
            "label"=>"Texto de la pregunta",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
            "placeholder"=>"Escriba aqui la pregunta",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
            "help"=>"En este espacio debe redactar la pregunta que desea que aparesca."//Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
            );
$objComp->textarea($datos);

$datos = array(
            "id"=>"cantidad-respuestas",// (no necesario) id que tendra el select
            "name"=>"cantidadRespuestas", // (necesario) nombre que tendra el select
            "label"=>"Cantidad de respuestas",//(necesario - si se omite queda como si se pasara vacio) el nombre que se mostrara
            "textodefault"=>"Seleccione una cantidad",
            "onchange"=>"enc_selectCantidadRespuesta(this)"
            );
                    
$objComp->select ($rsCantidadRes,$datos);

$datos=array("id"=>"bloque-respuestas-principal",///(necesario) id que tendra el div que contendra nuevos elementos
            "tipo"=>"una-columna", //(necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "alignContenido"=>"texto-centro");//(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
$objComp->bloque_div_normal($datos);

$datos = array(
            "id"=>"tipo-respuesta",//(no necesario)el id que tendra el select
            "name"=>"tipoRespuesta",// (necesario) nombre que tendra el select
            "textodefault"=>"Seleccione una cantidad primero",
            "label"=>"Tipo de respuesta",//(necesario - si se omite queda como si se pasara vacio)el nombre que se mostrara
            "onchange"=>"enc_selectTipoRespuesta(this)",
            "disable"=>"on"
            );
$datos_select=array();
$objComp->select($datos_select,$datos);
?>
<div class="grupo-controles-formulario">
    <label for="" class="texto-control-formulario">Respuestas</label>
    <div class="controles-formulario" id="respuestas-contenido">
        <p style="padding-top: 0.5em;">Seleccione primero una cantidad de respuestas, luego seleccione un tipo de respuesta.</p>
    </div><!--controles-formulario-->        
</div><!--grupo-controles-formulario-->
<?php
$objComp->cerrar_bloque_div_normal();

$datos = array(
    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
    "value"=>"Guardar Pregunta",//(necesario) valor que mostrar el boton
    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
    "onclick"=>"enc_guardarPregunta()"// (necesario) funcion js que se ejecutara si se hace click en el boton
    );
$objComp->button_normal($datos);
        
$datos=array("id"=>"bloque-dinamico",///(necesario) id que tendra el div que contendra nuevos elementos
            "tipo"=>"una-columna", //(necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "alignContenido"=>"texto-centro");//(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
$objComp->bloque_div_normal($datos);

$objComp->cerrar_bloque_div_normal();
$objComp->cerrar_form();
$objComp->cerrar_div_bloque_principal();
$objComp->cerrar_bloque_div_normal();
}
?>