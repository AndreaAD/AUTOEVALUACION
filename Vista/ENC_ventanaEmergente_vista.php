<style  type="text/css">
    #datos-respuesta-ventana{
        display: block;
        position: relative;
        font-size: 1.1rem;
        margin:1rem;
        padding:0rem;   
    }
</style>
<?php
$datos=array("id"=>"ventana-error",// (necesario) id de la ventana
            "ancho"=>"30",//(necesario) ancho en porcentaje que tendra la ventana emergente valores entre 10 y 95
            "alto"=>"auto",// (necesario) alto en porcentaje que tendra la ventana valor entre 10 y 90
            "alignContenido"=>"texto-centro",// (no necesario - si no se pone se aliena al centro por defeccto) alienacion del contenido
            "des"=>"5" // desplazamiento de la ventana con respecto a la parte superior porcentaje de 0 a 100
            );
$objComp->bloque_div_flotante($datos);
?>
<p id="datos-respuesta-ventana"><?php echo $texto;?></p>
<?php
$datos = array(
            "class"=>"small",//(necesario) tamaño del boton puede ser {grande,mediano,small}
            "value"=>"Aceptar",//(necesario) valor que mostrar el boton
            "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "onclick"=>"enc_aceptarEmergente(this);"// (necesario) funcion js que se ejecutara si se hace click en el boton
            );
$objComp->button_normal($datos);
$objComp->cerrar_bloque_div_flotante();
?>