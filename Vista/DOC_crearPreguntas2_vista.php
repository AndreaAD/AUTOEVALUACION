<?php
require_once("elementos_vista.php");
?>
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<script src="../Js/DOC_TipoRespuesta.js" type="text/javascript"></script>
<script src="../Js/DOC_Selectores.js" type="text/javascript"></script>
<input type="hidden" name="_section" value="tipo_respuesta">
<input type="hidden" name="id_pregunta" value="">
<?php
$objComp=new Elementos();

$objComp->cerrar_div_bloque_principal();

$datos=array("id"=>"bloque-crear-modificar",///(necesario) id que tendra el div que contendra nuevos elementos
            "tipo"=>"una-columna", //(necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "alignContenido"=>"texto-centro");//(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
$objComp->bloque_div_normal($datos);

$datos=array(
            "tipo"=>"una-columna",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Crear Tipos de respuesta", // (no necesario) titulo del bloque
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

$datos = array(
            "id"=>"cantidad-respuestas",// (no necesario) id que tendra el select
            "name"=>"cantidadRespuestas", // (necesario) nombre que tendra el select
            "label"=>"Seleccione la Cantidad de respuestas",//(necesario - si se omite queda como si se pasara vacio) el nombre que se mostrara
            "textodefault"=>"Seleccione una cantidad",
            "onchange"=>"doc_selectCantidadRespuesta(this)"
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
            "onchange"=>"doc_selectTipoRespuesta(this)",
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
    "value"=>"Guardar",//(necesario) valor que mostrar el boton
    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
    "onclick"=>"doc_guardarPregunta()"// (necesario) funcion js que se ejecutara si se hace click en el boton
    );
$objComp->button_normal($datos);

$datos3 = array(
    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
    "value"=>"Modificar",//(necesario) valor que mostrar el boton
    "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
    "id"=>"modificar_tipo"
    );
$objComp->button_normal($datos3);

        
$datos=array("id"=>"bloque-dinamico",///(necesario) id que tendra el div que contendra nuevos elementos
            "tipo"=>"una-columna", //(necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "alignContenido"=>"texto-centro");//(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
$objComp->bloque_div_normal($datos);
$objComp->cerrar_bloque_div_normal();
$objComp->cerrar_form();
?>
<div class="row">   
    <table class="tablas_2" id="tabla_tipo_respuestas">
    </table>
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

<?php

$objComp->cerrar_div_bloque_principal();
$objComp->cerrar_bloque_div_normal();
?>