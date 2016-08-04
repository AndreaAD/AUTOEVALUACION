<?php 
$datos=array(
            "tipo"=>"una-columna",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Administrar tipo respuesta", // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-centro", //(necesario) alineacion del contenido del div
            "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
$objComp->div_bloque_principal($datos);
?>
<div class="contenedor-tabla100">
<table>
<thead>
    <?php
        $cont=1;
        foreach($arrTiposRespuesta as $tipo){
            ?><th>
            <h2>Respuesta tipo <?php echo $cont;?></h2>
            <p><?php echo $tipo['descripcion'];?>
            </p></th><?php
            $cont++;
        }
    ?>
</thead>
    <tr>
    <?php
    foreach($arrTiposRespuesta as $tipo){
        ?><td> Cantidad de respuestas :
        <?php echo $tipo['cantidad_respuestas'];?>
        </td><?php
    }
    ?>
    </tr>
    <tr>
    <?php
    foreach($arrTiposRespuesta as $tipo){
        ?><td style="font-size: 0.8rem;"> Estado :
        <?php 
        $estado=$tipo['estado']==1? 'Habilitado':'Deshabilidato';
        echo $estado;?>
        </td><?php
    }
    ?>
    </tr>
    <tr style="text-align: center;">
    <?php
    foreach($arrTiposRespuesta as $tipo){
        ?><td style="vertical-align: top; background-color: #fff;">
            <table style="width:80%;margin-left: 1rem;">
            <?php
            $rsPonderacion=$objTipoRespuesta->getPonderacionesTipoRespuesta($tipo['pk_tipo_respuesta']);
            $i=1;
            foreach($rsPonderacion as $ponderacion){
                ?>
                <tr><td><span>Opcion <?php echo $i;?></span></td></tr>
                <tr><td><p>Ponderacion: <?php echo $ponderacion['ponderacion'];?></p></td></tr>
            <?php
            $i++;
            }
        ?>
        </table>
        </td><?php
    }
    ?>
    </tr>
    <tr>
    <?php
    foreach($arrTiposRespuesta as $tipo){
        ?><td><?php
        $datos = array(
            "class"=>"mediano",//(necesario) tamaño del boton puede ser {grande,mediano,small}
            "value"=>"Modificar",//(necesario) valor que mostrar el boton
            "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "onclick"=>"enc_modificarTipoPregunta(this,".$tipo['pk_tipo_respuesta'].")"// (necesario) funcion js que se ejecutara si se hace click en el boton
        );
        $objComp->button_normal($datos);
        ?></td><?php
    }
    ?>
    </tr>
</table>
</div>
<?php
$objComp->cerrar_div_bloque_principal();
$datos=array("id"=>"bloque-dinamico",///(necesario) id que tendra el div que contendra nuevos elementos
            "tipo"=>"una-columna", //(necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "alignContenido"=>"texto-centro");//(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
$objComp->bloque_div_normal($datos);
$objComp->cerrar_bloque_div_normal();
?>