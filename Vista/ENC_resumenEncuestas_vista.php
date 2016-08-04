<?php
$datos=array("tipo"=>"una-columna",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Resumen de Encuestas", // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-izquierda", //(necesario) alineacion del contenido del div
            "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
$objComp->div_bloque_principal($datos);

if($faseProceso==3){
    ?>
    <div class="aletra-fase">
    <p>Esta seccion solo esta habilitada cuando el proceso se encuetre en fase de 'captura de datos', 'plan de mejoramiento', 'consolidacion', 'cerrado' o 'suspendido'.</p>
    </div>
<?php }else{?>
<p>La siguiente tabla hace un resumen de la cantidad de encuestas que han sido llenadas por cada grupo de interes
hasta el momento de entrar en esta pagina.</p>
<style type="text/css">
    table{
        width: 80%;
        margin-left: 10%;
        margin-top:1rem;
    }
    table thead th{
        text-align: center;
        font-size:0.8rem;
    }
    table tbody tr td a{
        padding-left:0.5rem;
    }
    table tbody tr td:first-child{
        padding-left:1rem;
    }
    table tbody tr td:last-child{
        text-align:center;
    }
</style>
<table>
    <thead>
    <th>GRUPO DE INTERES</th>
    <th>CANTIDA DE ENCUESTAS</th>
    </thead>
    <tbody>
    <?php
        foreach($rsGrupos as $grupo){
            ?><tr>
            <td><?php echo $grupo['nombre'];?><a href="#" onclick="enc_resumenDetallado(this);"><input type="hidden" id="grupo" value="<?php echo $grupo['pk_grupo_interes'];?>"/>(ver detalles)</a></td>
            <?php
            $cantidad=$objConsultas->getEncuestasGrupoInteres($idProceso,$grupo['pk_grupo_interes'])->fields[0];
            ?>
            <td><?php echo $cantidad; ?></td>
            </tr><?php
        }
    ?>
    </tbody>
</table>
<?php
}
$objComp->cerrar_bloque_div_normal();
?>