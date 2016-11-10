<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="../Css/PLM_Estilos.css"/>
<script src="../Js/PLM_Plan.js" type="text/javascript"></script> 

<div class="bloque una-columna">
	<div class="titulo-bloque texto-izquierda">
        <h2 class="icon-quill">Historico planes de mejoramiento</h2>
    </div>
    <div class="contenido">
        <div class="row">
        	<br>
        	<div class="col">
                &nbsp;<label class="label_caja">Sede</label>
            </div>
            <div class="col_2">
                <select name="sede_plm" id="sede_plm">
	            	<option value="0">Seleccionar</option>
	            	<?php foreach ($sedes as &$sede): ?>
	            		<option value="<?php echo $sede['pk_sede'] ?>"><?php echo $sede['nombre'] ?></option>
	            	<?php endforeach ?>
	            </select>
            </div>
        </div>
        <div class="row">
        	<br>
        	<div class="col">
                &nbsp;<label class="label_caja">Facultad</label>
            </div>
            <div class="col_2">
                <select name="facultad_plm" id="facultad_plm">
	            	<option value="0">Seleccionar</option>
	            	<?php foreach ($facultades as &$facultad): ?>
	            		<option value="<?php echo $facultad['pk_facultad'] ?>"><?php echo $facultad['nombre'] ?></option>
	            	<?php endforeach ?>
	            </select>
            </div>
        </div>
        <div class="row">
        	<br>
        	<div class="col">
                &nbsp;<label class="label_caja">Programa</label>
            </div>
            <div class="col_2">
                <select name="programa_plm" id="programa_plm">
                	<option value="0">Seleccionar</option>
	            </select>
            </div>
        </div>
        <input type="button" id="buscar_plm_historico" value="buscar">
        <div class="row">
        	<div class="lista_plm" style="margin-left: 5px;    margin-top: 24px;">
        		
        	</div>
        </div>
    </div>
</div>
