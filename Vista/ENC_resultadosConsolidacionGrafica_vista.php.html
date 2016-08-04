<!--<script src="../Js/jquery.min.2.1.1.js" type="text/javascript"></script>-->
<script src="../Js/Chart.js" type="text/javascript"></script>
<?php
$datos=array("tipo"=>"una-columna",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Resultado consolidacion", // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-izquierda", //(necesario) alineacion del contenido del div
            "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
$objComp->div_bloque_principal($datos);
?>
<style type="text/css">
    fieldset{
        margin:0 0 1rem 0;
        text-align:left;
    }
    fieldset legend{
        font-size:1.1rem;
    }
    fieldset > div{
        padding-bottom:1rem;
    }
    fieldset > div:nth-child(2n){
        background-color:rgba(200,200,200,0.3);
    }
    fieldset div span.titulo{
        position:relative;
        display:inline-block;
        padding-right: 2rem;
        width:10%;
        font-weight: 600;
    }
    fieldset div span.texto{
        position:relative;
        width: 90%;
    }
    fieldset > div#seccion-informe-detallado{
        background-color: white;
    }
    div#seccion-informe-general{
        display:block;
        width:100%;
        vertical-align: top;
    }
    div#seccion-informe-general .seccion-grafica{
        position:relative;
        display:inline-block;
        width:55%;
    }
    div#seccion-informe-general .seccion-datos{
        position:relative;
        display:inline-block;
        width:44%;
        vertical-align: top;
        padding-top:9rem;
    }
    div#seccion-informe-general .seccion-datos thead tr{
        background-color:#037A03;
        color:white;
    }
    div#seccion-informe-general .seccion-datos tr{
        background-color:white;
    }
    div#seccion-informe-general .seccion-datos td{
        text-align: center;
    }
</style>
<fieldset>
<legend>Datos Evidencia</legend>
<div>
<span class="titulo">Factor</span><span class="texto" id="texto-factor"><?php echo $txFactor;?></span>
</div>
<div>
<span class="titulo">Caracteristica</span><span class="texto" id="texto-caracteristica"><?php echo $txCaracteristica;?></span>
</div>
<div>
<span class="titulo">Aspecto</span><span class="texto" id="texto-aspecto"><?php echo $txAspecto;?></span>
</div>
<div>
<span class="titulo">Evidencia</span><span class="texto" id="texto-evidencia"><?php echo $txEvidencia;?></span>
</div>
</fieldset>
<div class="texto-centro"><?php
$datos = array(
            "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
            "value"=>"Volver a seleccion",//(necesario) valor que mostrar el boton
            "icono"=>"arrow-left", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "onclick"=>"enc_regresar('ENC_resultadosConsolidacion_controlador.php');"// (necesario) funcion js que se ejecutara si se hace click en el boton
            ); 
$objComp->button_link($datos);?>
</div>
<br />
<fieldset>
<legend>Resultados</legend>
<?php
$color=0;
$cant=count($rsResultados);//->RecordCount();
?>
<script>
/*var pieData = [
<?php foreach($rsResultados as $resultado){
    echo '{';
    echo 'value:'.$resultado['calificacion'].',';
    echo 'color:"'.$arrayColores[$color].'",';
    echo 'label:"'.$resultado['nombre'].'"';
    echo '}';
    if($color!=($cant-1)){
        echo ',';
    }
    $color++;
} ?>
        ];
        */
var data = {
    <?php 
    echo 'labels:[';
    foreach($rsResultados as $resultado){
        echo '"'.$resultado['nombre'].'"';
        if($color!=($cant-1)){
            echo ',';
        }
    } 
    echo '],';
    echo 'datasets: [{';
    echo 'label:"Grupos de interes",';
    echo 'fillColor: "rgba(220,220,220,0.5)",';
    echo 'strokeColor: "rgba(220,220,220,0.8)",';
    echo 'data: [';
    foreach($rsResultados as $resultado){
        echo '"'.$resultado['calificacion'].'"';
        if($color!=($cant-1)){
            echo ',';
        }
    } 
    echo ']';
    echo '}]';
    ?>
};
    $(document).ready(function(){
        var ctx = $("#grafica").get(0).getContext("2d");
        var myNewChart = new Chart(ctx).Bar(data);
        //alert(myNewChart.defaults);
	});
</script>
<div id="seccion-informe-general">
    <div class="seccion-grafica">
    <canvas id="grafica" class="chart-holder" width="500px" height="500px;"></canvas>
    </div>
    <div class="seccion-datos">
    <table>
        <thead>
        <tr>
            <td>Grupo</td>
            <td>Puntaje</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php 
        foreach($rsResultados as $resultado){
            echo '<tr>';
            echo '<td>'.$resultado['nombre'].'</td>';
            echo '<td>'.$resultado['calificacion'].'</td>';
            ?><td><a href="#" onclick="enc_informeDetallado(this);">(ver informe detallado)<input type="hidden" id="grupo" value="<?php echo $resultado['fk_grupo_interes']; ?>"/></a></td> <?php
            echo '</tr>';
        }?>
        </tbody>
    </table>
    </div>
</div>
<div id="seccion-informe-detallado" style="display: none;">
</div>
</fieldset>
<?php
$objComp->cerrar_bloque_div_normal();
?>