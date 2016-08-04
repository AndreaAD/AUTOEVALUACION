<?php
$datos=array("id"=>"ventana-mensaje",// (necesario) id de la ventana
            "ancho"=>"30",//(necesario) ancho en porcentaje que tendra la ventana emergente valores entre 10 y 95
            "alto"=>"auto",// (necesario) alto en porcentaje que tendra la ventana valor entre 10 y 90
            "alignContenido"=>"texto-centro",// (no necesario - si no se pone se aliena al centro por defeccto) alienacion del contenido
            "des"=>"5" // desplazamiento de la ventana con respecto a la parte superior porcentaje de 0 a 100
            );
$objComp->bloque_div_flotante($datos);
?>
<p><?php
if($resultado==true){
    echo "Su opinion fue gruardada exitosamente.";
    ?></p><?php
    $datos = array(
            "class"=>"small",//(necesario) tamaño del boton puede ser {grande,mediano,small}
            "value"=>"Aceptar",//(necesario) valor que mostrar el boton
            "icono"=>"envelope", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "onclick"=>"enc_aceptarEmergenteUrl(this,'../Controlador/ENC_responderEncuesta_controlador.php');"// (necesario) funcion js que se ejecutara si se hace click en el boton
            );
    $objComp->button_normal($datos);
}else{
    echo "Se presento un error al procesas su encuesta porfavot vuelva a enviarla.";
     ?></p><?php
     $datos = array(
            "class"=>"small",//(necesario) tamaño del boton puede ser {grande,mediano,small}
            "value"=>"Aceptar",//(necesario) valor que mostrar el boton
            "icono"=>"envelope", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "onclick"=>"enc_aceptarEmergente(this);"// (necesario) funcion js que se ejecutara si se hace click en el boton
            );
    $objComp->button_normal($datos);
}
$objComp->cerrar_bloque_div_flotante();
?>