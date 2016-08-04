<?php
$datos=array("tipo"=>"una-columna",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Administrar Preguntas", // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-centro", //(necesario) alineacion del contenido del div
            "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
$objComp->div_bloque_principal($datos);

$datos=array(
            "icono"=>"pencil",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "value"=>"Encuestas cargos institucionales",//(necesario) valor que mostrar el boton
            "onclick"=>"enc_cargarNuevaPagina(this,'ENC_seleccionEncuestaInstitucional_controlador.php');");//"enc_cargarSeleccionEvidencia(this,'ENC_seleccionEvidencia_controlador.php','../Controlador/ENC_encuestaCargosInstitucionales_controlador.php','Seleccion de evidencia - Encuestas cargos institucionales');");// (necesario) funcion js que se ejecutara si se hace click en el boton
$objComp->button_icono($datos);

$datos=array(
            "icono"=>"pencil",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "value"=>"Encuestas normales, banco de preguntas",//(necesario) valor que mostrar el boton
            "onclick"=>"enc_cargarNuevaPagina(this,'ENC_seleccionBancoPreguntas_controlador.php');");//"enc_cargarSeleccionEvidencia(this,'ENC_seleccionEvidencia_controlador.php','../Controlador/ENC_crearPreguntas2_controlador.php','Seleccion de evidencia - Encuestas normales');");// (necesario) funcion js que se ejecutara si se hace click en el boton
$objComp->button_icono($datos);

$datos=array(
            "icono"=>"pencil",//(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "value"=>"Cambiar estado o Eliminar preguntas",//(necesario) valor que mostrar el boton
            "onclick"=>"enc_cargarNuevaPagina(this,'ENC_seleccionEliminar_controlador.php');");//(necesario) funcion js que se ejecutara si se hace click en el boton
$objComp->button_icono($datos);
$objComp->cerrar_div_bloque_principal();

?>