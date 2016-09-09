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
$datos=array("id"=>"ventana-info",//(necesario) id de la ventana
            "alignTitulo"=>"texto-centro",// (no necesario - si no se pone se alinea a la izquierda por defecto) alineacion del titulo
            "alignContenido"=>"texto-centro",// (no necesario - si no se pone se aliena al centro por defeccto) alienacion del contenido
            "ancho"=>"50",
            "alto"=>"auto",
            "des"=>"10" 
            );
$objComp->bloque_div_flotante($datos);
if($id_pregunta!=false){
    ?><p id="datos-respuesta-ventana"><?php echo "Pregunta guardada correctamente.";?></p><?php
}else{
    ?><p><?php echo "Ocurrio un error desconocido al Guardar la pregunta."; ?></p><?php
}
if($institucional==0){
    $datos = array(
        "class"=>"mediano",//(necesario) tama�o del boton puede ser {grande,mediano,small}
        "value"=>"Aceptar",//(necesario) valor que mostrar el boton
        "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
        "onclick"=>"enc_aceptarCrearPregunta(this,'../Controlador/ENC_crearpreguntas_genericas.php');"// (necesario) funcion js que se ejecutara si se hace click en el boton
        );
}else{
    $datos = array(
        "class"=>"mediano",//(necesario) tama�o del boton puede ser {grande,mediano,small}
        "value"=>"Aceptar",//(necesario) valor que mostrar el boton
        "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
        "onclick"=>"enc_aceptarCrearPregunta(this,'../Controlador/ENC_encuestaCargosInstitucionales_controlador.php');"// (necesario) funcion js que se ejecutara si se hace click en el boton
        );
}

$objComp->button_link($datos);
$objComp->cerrar_bloque_div_flotante();
?>
