<?php
//header('Content-Type: text/html; charset=UTF-8');
require_once("elementos_vista.php");
$objComp=new Elementos();
$datos=array("tipo"=>"una-columna",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>$tituloPagina, // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-centro", //(necesario) alineacion del contenido del div
            "icono"=>"numbered-list"); // (necesario si se pone titulo) icono que aparece al lado del titulo
$objComp->div_bloque_principal($datos);
$datos=array(
        "id"=>"texto-factor",// (no necesario) define el id que tendra el campo
        "name"=>"texto-factor", // (necesario) define el name del campo
        "label"=>"Factor",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
        "placeholder"=>"Seleccione un factor"//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
        );
?>
<div class="grupo-controles-formulario">
    <div style="display:block;margin-left:2.5em;" class="texto-izquierda">
        <label style="font-size:1.3rem; padding-right:0.8rem;" for="<?php echo $datos["id"];?>"><?php echo $datos["label"];?></label>
    <?php
        $datos_boton = array(
                "class"=>"small",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                "value"=>"Seleccionar",//(necesario) valor que mostrar el boton
                "icono"=>"redo2", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                "onclick"=>"enc_listaEmergente(this,'ENC_listaFactores_controlador.php','#ventana-factores');"// (necesario) funcion js que se ejecutara si se hace click en el boton
                );
        //$objComp->button_normal($datos_boton);
        $objComp->button_solo_icono($datos_boton);
    ?>
    </div>
    <div style="display:block;width:100%;text-align:center;margin-top: 0.2em;" class="controles-formulario">
        <textarea style="width:90%; height:50px;" placeholder="<?php echo $datos["placeholder"];?>" id="<?php echo $datos["id"];?>" readonly="on"><?php
            if($existenDatos){
                echo ucfirst(strtolower($txFactor));
            }
        ?></textarea>
    </div>
</div>
<?php

$datos=array(
            "id"=>"texto-caracteristica",// (no necesario) define el id que tendra el campo
            "name"=>"texto-caracteristica", // (necesario) define el name del campo
            "label"=>"Caracteristica",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
            "placeholder"=>"Seleccione una caracteristica"//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
            );
?>
<div class="grupo-controles-formulario">
    <div style="display:block;margin-left:2.5em;" class="texto-izquierda">
        <label style="font-size:1.3rem; padding-right:0.8rem;" for="<?php echo $datos["id"];?>"><?php echo $datos["label"];?></label>
    <?php
        $datos_boton = array(
                "class"=>"small",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                "value"=>"Seleccionar",//(necesario) valor que mostrar el boton
                "icono"=>"redo2", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                "onclick"=>"enc_listaEmergente(this,'ENC_listaCaracteristicas_controlador.php','#ventana-caracteristicas');"// (necesario) funcion js que se ejecutara si se hace click en el boton
                );
        //$objComp->button_normal($datos_boton);
        $objComp->button_solo_icono($datos_boton);
    ?>
    </div>
    <div style="display:block;width:100%;text-align:center;margin-top: 0.2em;" class="controles-formulario">
        <textarea style="width:90%; height:50px;" placeholder="<?php echo $datos["placeholder"];?>" id="<?php echo $datos["id"];?>" readonly="on"><?php
            if($existenDatos){
                echo ucfirst(strtolower($txCaracteristica));
            }
        ?></textarea>
    </div>
</div>
<?php
$datos=array(
            "id"=>"texto-aspecto",// (no necesario) define el id que tendra el campo
            "name"=>"texto-aspecto", // (necesario) define el name del campo
            "label"=>"Aspecto",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
            "placeholder"=>"Seleccione un aspecto"//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
             );
?>
<div class="grupo-controles-formulario">
     <div style="display:block;margin-left:2.5em;" class="texto-izquierda">
        <label style="font-size:1.3rem; padding-right:0.8rem;" for="<?php echo $datos["id"];?>"><?php echo ($datos["label"]);?></label>
    <?php
        $datos_boton = array(
                "class"=>"small",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                "value"=>"Seleccionar",//(necesario) valor que mostrar el boton
                "icono"=>"redo2", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                "onclick"=>"enc_listaEmergente(this,'ENC_listaAspectos_controlador.php','#ventana-aspectos');"// (necesario) funcion js que se ejecutara si se hace click en el boton
                );
        //$objComp->button_normal($datos_boton);
        $objComp->button_solo_icono($datos_boton);
    ?>
    </div>
    <div style="display:block;width:100%;text-align:center;margin-top: 0.2em;" class="controles-formulario">
        <textarea style="width:90%; height:50px;" placeholder="<?php echo $datos["placeholder"];?>" id="<?php echo $datos["id"];?>" readonly="on"><?php
            if($existenDatos){
                echo ucfirst(strtolower($txAspecto));
            }
        ?></textarea>
    </div>
</div>
<?php
$datos=array(
            "id"=>"texto-evidencia",// (no necesario) define el id que tendra el campo
            "name"=>"texto-evidencia", // (necesario) define el name del campo
            "label"=>"Evidencia",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
            "placeholder"=>"Seleccione una evidencia"//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
            );
?>
<div class="grupo-controles-formulario">
    <div style="display:block;margin-left:2.5em;" class="texto-izquierda">
        <label style="font-size:1.3rem; padding-right:0.8rem;" for="<?php echo $datos["id"];?>"><?php echo ($datos["label"]);?></label>
    <?php
        $datos_boton = array(
                "class"=>"small",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                "value"=>"Seleccionar",//(necesario) valor que mostrar el boton
                "icono"=>"redo2", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                "onclick"=>"enc_listaEmergente(this,'ENC_listaEvidencias_controlador.php','#ventana-evidencias');"// (necesario) funcion js que se ejecutara si se hace click en el boton
                );
        //$objComp->button_normal($datos_boton);}
        $objComp->button_solo_icono($datos_boton);
    ?>
    </div>
    <div style="display:block;width:100%;text-align:center;margin-top: 0.2em;" class="controles-formulario">
        <textarea style="width:90%; height:50px;" placeholder="<?php echo $datos["placeholder"];?>" id="<?php echo $datos["id"];?>" readonly="on"><?php
            if($existenDatos){
                echo ucfirst(strtolower($txEvidencia));
            }
        ?></textarea>
    </div>
</div>
<?php
$objComp->linea_separador(90);

$datos=array("id"=>"bloque5",///(necesario) id que tendra el div que contendra nuevos elementos
            "tipo"=>"una-columna", //(necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "alignContenido"=>"texto-centro");//(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
$objComp->bloque_div_normal($datos);
$datos = array(
            "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
            "value"=>"Siguiente",//(necesario) valor que mostrar el boton
            "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "onclick"=>"enc_verPreguntas(this,'".$urlDestino."');"// (necesario) funcion js que se ejecutara si se hace click en el boton
            );     
$objComp->button_link($datos);
$objComp->cerrar_bloque_div_normal();

$objComp->cerrar_div_bloque_principal();

$datos=array("id"=>"bloque-dinamico",///(necesario) id que tendra el div que contendra nuevos elementos
            "tipo"=>"una-columna", //(necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "alignContenido"=>"texto-centro");//(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
$objComp->bloque_div_normal($datos);
$objComp->cerrar_bloque_div_normal();
?>