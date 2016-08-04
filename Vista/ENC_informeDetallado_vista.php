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
<a href="#" onclick="enc_volverResultados(this);">(Volver a resultados)</a>
<div class="texto-centro titulo">
<h1><?php echo strtoupper($datosGrupo[0]['nombre']);?></h1>
</div>
<ul class="preguntas"><?php
foreach($rsPreguntas as $pregunta){
    ?><li>
    <div class="pregunta"><?php
    $cantPregunta=$objConsultas->numeroVecesPregunta($idProceso,$idGrupo,$pregunta['pk_pregunta'])->fields[0];
    //echo 'cantidad respuesta:'.$cantPregunta;
    echo $pregunta['texto'];
    $rsRespuestas=$objRespuestas->getDatosRespuestasSolucionEncuesta($pregunta['pk_pregunta']);
     ?><ul><?php   
    $datosGrafica=array();
    $opcion='A';
    $color=0;
    foreach($rsRespuestas as $respuesta){
        ?><li><?php
        $cantRespuesta=$objConsultas->numeroVecesRespuesta($idProceso,$idGrupo,$pregunta['pk_pregunta'],$respuesta['pk_respuesta_pregunta'])->fields[0];
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
        //Chart.defaults.global.showTooltips=true;
        var ctx = $("#grafica-pregunta<?php echo $pregunta['pk_pregunta'];?>").get(0).getContext("2d");
        var myNewChart =new Chart(ctx).Doughnut(data,{percentageInnerCutout:50});
    });
    </script>
    </div>
    <div class="grafica">
    <canvas id="grafica-pregunta<?php echo $pregunta['pk_pregunta'];?>" class="chart-holder" width="200" height="200"></canvas>
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
        
        echo $dato['label'].' '.$dato['valor'].' = '.$porcentaje.'%';
        echo '</li>';*/
    }
    ?>
    <li>Total de ecuestas : <?php echo $cantPregunta;?></li>
     </ul>
    </div>
    </li>
    <?php
}
?>
</ul>
<a href="#" onclick="enc_volverResultados(this);">(Volver a resultados)</a>