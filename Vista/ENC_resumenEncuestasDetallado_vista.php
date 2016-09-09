<script src="../Js/Chart.js" type="text/javascript"></script>
<style type="text/css">
    .titulo h1{
        font-size:1.3rem;
        font-weight: 600;
    }
    ul.preguntas > li{
        margin-bottom: 0.5rem;
    }
    ul > li > div > ul{
        list-style: none;
    }
    div.pregunta{
        margin-bottom:1.5rem;
    }
    div.grafica{
        position:relative;
        display:inline-block;
        width: 45%;
        text-align: right;
    }
    div.legenda{
        position:relative;
        display:inline-block;
        width: 45%;
        top: -0.5rem;
        left:-1rem;
    }
    div.legenda ul li{
        display: block;
        width:200px;
        text-align: left;
        margin-bottom:0.3rem;
        margin-top:0.3rem;
    }
    div.legenda ul li span.icono-color{
        position: relative;
        display: inline-block;
        width: 20px;
        height: 20px;
        margin:0 0.5rem 0 0;
        padding:0;
        border-radius:5px;
        border: 1px solid black;
    }
    div.legenda ul li span.legenda-texto{
        position: relative;
        display: inline-block;
        top:-0.2rem;
    }
</style>
<?php
$datos = array(
            "class"=>"grande",//(necesario) tama�o del boton puede ser {grande,mediano,small}
            "value"=>"Volver",//(necesario) valor que mostrar el boton
            "icono"=>"arrow-left", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "onclick"=>"enc_regresar('ENC_resumenEncuestas_controlador.php');"// (necesario) funcion js que se ejecutara si se hace click en el boton
            );     
$objComp->button_link($datos);
?><br /><br /><?php
$datos=array("tipo"=>"una-columna",// (necesario) tama�o del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Resumen de Detallado", // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-izquierda", //(necesario) alineacion del contenido del div
            "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
$objComp->div_bloque_principal($datos);
?>
<div class="texto-centro titulo">
<h1><?php echo strtoupper($datosGrupo[0]['nombre']);?></h1>
</div>
<?php
if($pkEncuesta != -1){
    if($rsDatosPreguntas->RecordCount()>0){
        ?><ul class="preguntas"><?php
        foreach($rsDatosPreguntas as $pregunta){
            ?><li>
            <div class="pregunta"><?php
            $cantPregunta=$objConsultas->numeroVecesPregunta($idProceso,$idGrupo,$pregunta['pk_pregunta']);
            echo $pregunta['texto'];
            $rsRespuestas=$objRespuestas->getDatosRespuestasSolucionEncuesta($pregunta['pk_pregunta']);
            ?><ul><?php   
            $datosGrafica=array();
            $opcion='A';
            $color=0;
            foreach($rsRespuestas as $respuesta){
                ?><li><?php
                $cantRespuesta=$objConsultas->numeroVecesPregunta($idProceso,$idGrupo,$pregunta['pk_pregunta'],$respuesta['pk_respuesta_pregunta']);
                $datosGrafica[]=array('label'=>$opcion,'valor'=>$cantRespuesta,'color'=>$arrayColores[$color]);
                //echo 'cantidad respuesta:'.$cantRespuesta;
                echo '('.$opcion.') '.$respuesta['texto'];
                ?></li><?php
                $opcion++;
                $color++;
            } 
            ?>
            </ul>
            <script>
            var data = [
            <?php 
            $limit=count($datosGrafica)-1;
            $i=0;
            foreach($datosGrafica as $dato){
                echo '{';
                echo 'value:'.$dato['valor'].',';
                echo 'color:"'.$dato['color'].'",';
                echo 'label:"'.$dato['label'].'"';
                echo '}';
                if($i<$limit)
                    echo ',';
                $i++;
            }?>
            ];
            $(document).ready(function(){
                var ctx = $("#grafica-pregunta<?php echo $pregunta['pk_pregunta'];?>").get(0).getContext("2d");
                var myNewChart = new Chart(ctx).Doughnut(data,{percentageInnerCutout:50,animateRotate : false});
            });
            </script>
            </div>
            <div class="grafica">
            <canvas id="grafica-pregunta<?php echo $pregunta['pk_pregunta'];?>" class="chart-holder"  height="200px"  ></canvas>
            </div>
            <div class="legenda">
            <ul>
            <?php
            foreach($datosGrafica as $dato){
                $porcentaje=round(($dato['valor']/$cantPregunta)*100,1);
                ?>
                <li><span class="icono-color" style="<?php echo 'background-color:'.$dato['color'].';'?>"></span><span class="legenda-texto"><?php echo $dato['label'].' = '.$porcentaje.'% ('.$dato['valor'].')';?></span></li>
                <?php
                /*echo '<li style="background-color:'.$dato['color'].';">';
                echo $dato['label'].' '.$dato['valor'];
                echo '</li>';*/
            }
            ?>
            <li>Total de ecuestas : <?php echo $cantPregunta;?></li>
            </ul>
            </div>
            </li>
            <?php
        }
        echo '</ul>';
    }else{
        echo 'No hay preguntas activas en este momento';
    }
}else{
    echo 'No hay preguntas activas en este momento';
}

$objComp->cerrar_bloque_div_normal()
?>