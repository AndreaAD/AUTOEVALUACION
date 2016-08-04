<?php
require_once("elementos_vista.php");
$objComp=new Elementos();
$datos=array("tipo"=>"una-columna",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Seleccione un grupo de interes", // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-izquierda", //(necesario) alineacion del contenido del div
            "icono"=>"tree"); // (necesario si se pone titulo) icono que aparece al lado del titulo
$objComp->div_bloque_principal($datos);
?><div style="-moz-column-count:2; -webkit-column-count:2; column-count:2;"><?php
while(!$rsGrupos->EOF){
    ?><span style="padding-bottom:1.5em; display:block;"><?php 
    $datos=array(
            "icono"=>"upload",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "onclick"=>"enc_mostrarEncuesta(this,".$rsGrupos->fields[0].");");// (necesario) funcion js que se ejecutara si se hace click en el boton
    $objComp->button_solo_icono($datos);
    echo ucfirst($rsGrupos->fields[1]);
    ?>
    </span> <?php
    $rsGrupos->MoveNext();
}
?></div><?php
$objComp->cerrar_div_bloque_principal();

$datos=array("id"=>"ventana-encuesta",///(necesario) id que tendra el div que contendra nuevos elementos
            "tipo"=>"una-columna", //(necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "alignContenido"=>"texto-centro");//(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
$objComp->bloque_div_normal($datos);
$objComp->cerrar_bloque_div_normal();
?>