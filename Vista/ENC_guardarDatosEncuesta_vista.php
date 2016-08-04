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
            "ancho"=>"40",
            "alto"=>"auto",
            "des"=>"10" 
            );
$objComp->bloque_div_flotante($datos);
if($res!=false){
    if($opcion=="guardar"){
        ?><p id="datos-respuesta-ventana"><?php echo "Datos guardados satisfactoriamente.";?></p><?php
    }else{
       if($opcion=="publicar"){
        ?><p id="datos-respuesta-ventana"><?php echo "Encuesta publicada satisfactoriamente.";?></p><?php
        }else{
            if($opcion=="cancelar"){
             ?><p id="datos-respuesta-ventana"><?php echo "Cancelacion de publicacion exitosa.";?></p><?php
            }
        }
    }
}else{
    ?><p id="datos-respuesta-ventana"><?php echo "Ocurrio un error al procesar su solicitud."; ?></p><?php
}
$datos = array(
        "class"=>"mediano",//(necesario) tamaño del boton puede ser {grande,mediano,small}
        "value"=>"Aceptar",//(necesario) valor que mostrar el boton
        "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
        "onclick"=>"enc_aceptarEmergente(this);"// (necesario) funcion js que se ejecutara si se hace click en el boton
        );
$objComp->button_link($datos);
$objComp->cerrar_bloque_div_flotante();
?>

