<style type="text/css">
    .titulo-ventana{
        display: block;
        font-size:1.1rem;
        background-color:#007800;
        color:white;
        padding:0.5rem 0 0.5rem 0;
        margin:1rem 0rem 0rem 0rem;
    }
    .bloque-datos{
        text-align: left;
        margin: 0rem 1.2rem 1.2rem 1.2rem;
    }
</style>
<?php
$datos=array("id"=>"ventana-deshabilitar-eliminar",// (necesario) id de la ventana
            "titulo"=>"", //(no necesario) titulo que tendra la ventana
            "alignTitulo"=>"texto-centro",// (no necesario - si no se pone se alinea a la izquierda por defecto) alineacion del titulo
            "ancho"=>"80",//(necesario) ancho en porcentaje que tendra la ventana emergente valores entre 10 y 95
            "alto"=>"60",// (necesario) alto en porcentaje que tendra la ventana valor entre 10 y 90
            "alignContenido"=>"texto-centro",// (no necesario - si no se pone se aliena al centro por defeccto) alienacion del contenido
            "des"=>"5" // desplazamiento de la ventana con respecto a la parte superior porcentaje de 0 a 100
            );
$objComp->bloque_div_flotante($datos);
?>
<p class="titulo-ventana">DESHABILITAR O ELIMINAR PREGUNTA</p>
<div class="bloque-datos">
<p><?php echo $rsPreguntas->fields[1];?></p>
<p style="font-weight:600;">Respuestas:</p>
<?php $numeracion='A';
foreach($rsRespuestas as $respuesta){
    ?>
    <p><?php echo "(".$numeracion++.") ";?><?php echo ($respuesta[1]);?></p>
    <?php
}
?>
<p style="font-weight:600;">Estados de la pregunta:</p>
<p>Tipo : <?php if($rsPreguntas->fields[5]==1){
                        echo 'Insitucional';
                    }else if($rsPreguntas->fields[5]==0){
                        echo 'Normal';
                    } ?></p>
<p>Estado : <?php if($rsPreguntas->fields[4]==1){
                            echo 'Habilitada';
                            $datos_boton = array(
                            "class"=>"small",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                            "value"=>"Deshabilitar",//(necesario) valor que mostrar el boton
                            "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                            "onclick"=>"enc_cambarEstadoPregunta(".$rsPreguntas->fields[0].",".$rsPreguntas->fields[4].");"
                            );
                        }else if($rsPreguntas->fields[4]==0){
                            echo 'Deshabilitada';
                            $datos_boton = array(
                            "class"=>"small",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                            "value"=>"Habilitar",//(necesario) valor que mostrar el boton
                            "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                            "onclick"=>"enc_cambarEstadoPregunta(".$rsPreguntas->fields[0].",".$rsPreguntas->fields[4].");"
                            );
                        } ?></p>
</div>
<?php 
        $objComp->button_normal($datos_boton);
        $datos_boton = array(
            "class"=>"small",//(necesario) tamaño del boton puede ser {grande,mediano,small}
            "value"=>"Eliminar",//(necesario) valor que mostrar el boton
            "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "onclick"=>"enc_eliminarPregunta(".$rsPreguntas->fields[0].")"
            );
        $objComp->button_normal($datos_boton);
        $datos_boton = array(
            "class"=>"small",//(necesario) tamaño del boton puede ser {grande,mediano,small}
            "value"=>"Cancelar",//(necesario) valor que mostrar el boton
            "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "onclick"=>"enc_aceptarEmergente(this);"
            );
        $objComp->button_normal($datos_boton);
?>
<?php
$objComp->cerrar_bloque_div_flotante();
?>