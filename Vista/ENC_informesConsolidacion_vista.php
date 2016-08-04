<?php
$datos=array("tipo"=>"una-columna",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Informes", // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-izquierda", //(necesario) alineacion del contenido del div
            "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
$objComp->div_bloque_principal($datos);

$datos=array(
            "icono"=>"cog",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "value"=>"Resultados de consolidacion",//(necesario) valor que mostrar el boton
            "onclick"=>"enc_cargarNuevaPagina(this,'../Controlador/ENC_resultadosConsolidacion_controlador.php');");// (necesario) funcion js que se ejecutara si se hace click en el boton
$objComp->button_icono($datos);

$datos=array(
            "icono"=>"cog",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "value"=>"Resumen encuestas",//(necesario) valor que mostrar el boton
            "onclick"=>"enc_cargarNuevaPagina(this,'../Controlador/ENC_resumenEncuestas_controlador.php');");// (necesario) funcion js que se ejecutara si se hace click en el boton
$objComp->button_icono($datos);
/*
$datos=array(
            "icono"=>"cog",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "value"=>"Comparacion de Procesos",//(necesario) valor que mostrar el boton
            "onclick"=>"enc_cargarNuevaPagina(this,'../Controlador/ENC_comparacionProcesos_controlador.php');");// (necesario) funcion js que se ejecutara si se hace click en el boton
$objComp->button_icono($datos);
*/
$objComp->cerrar_bloque_div_normal();
?>