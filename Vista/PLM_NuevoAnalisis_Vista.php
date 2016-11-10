<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
<script src="../Js/PLM_Analisis.js" type="text/javascript"></script> 

<div class="bloque una-columna">
	<div class="titulo-bloque texto-izquierda">
        <h2 class="icon-quill">Emisión de juicios de la caracteristica</h2>
    </div>
    <div class="contenido">
        <div class="row">
            <div class="col">
                &nbsp;<label class="label_caja">Fortalezas</label>
            </div>
            <div class="col_2">
                <textarea class="text_pregunta" id="fortalezas"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col">
                &nbsp;<label class="label_caja">Debilidades</label>
            </div>
            <div class="col_2">
                <textarea class="text_pregunta" id="debilidades"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col">
                &nbsp;<label class="label_caja">Analisis causal</label>
            </div>
            <div class="col_2">
                <textarea class="text_pregunta" id="analisis_causal"></textarea>
            </div>
        </div>
        <input type="hidden" id="pk_caracteristica_proceso" value="<?php echo $valor_pk;  ?>">
        <input type="hidden" id="valor_carac" value="<?php echo $valor_carac;  ?>">
        <input type="hidden" id="valor_fac" value="<?php echo $valor_fac;  ?>">
        <input type="button" id="guardar_analisis" value="Guardar">
        <input type="button" value="Atrás" id="atras_carac">
    </div>
</div>
