<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<link rel="stylesheet" href="../Complementos/font-awesome/css/font-awesome.min.css">
<script type="text/javascript" src="../Js/DOC_Selectores.js"></script>
<!-- <script type="text/javascript" src="../Js/DOC_autoevaluacion.js"></script> -->



<?php

	if(count($listaProcesosG) > 0 ){
		echo '<div class="row">';
            echo '<div class="col">';
                echo '<label class="label_caja">Seleccione el proceso</label>';
            echo '</div>';
            echo '<div class="col_2">';
                echo '<select name="proceso_consolidacion" id="proceso_consolidacion">';
                    echo '<option value="0">Seleccionar</option>';
                        foreach ($listaProcesosG as $value) {
                            echo '<option value="'.$value['pk_proceso'].'">'.$value['nombre_proceso'].'</option>';  
                        }
                echo '</select><br><br>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
        echo '<input type="button" id="boton_consolidaciondb" value="Consolidar">';
	}else{
		echo '<h4>En este momento no cuenta con ningun proceso en fase de CONSOLIDACIÓN para consolidar información.</h4>';

	}
?>