<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<script type="text/javascript" src="../Js/DOC_Selectores.js"></script>
<!-- <script>
    $(function(e){
        $('#tabla_resultados').DataTable();
    })


</script> -->
<div class="bloque una-columna">
    <div class="titulo-bloque texto-izquierda">
        <h2 class="icon-quill">Resultados</h2>
    </div>
    <div class="div_formularios">
        <div class="row">
            <div class="col">
                <label class="label_caja">Seleccione el proceso</label>
            </div>
            <div class="col_2">
                <select name="procesos_ponderacion" id="procesos_ponderacion">
                    <option value="0">Seleccionar</option>
                    <?php
                        foreach ($procesos as $value) {
                            echo '<option value="'.$value['pk_proceso'].'">'.$value['nombre'].'</option>';  
                        }
                    ?>
                </select><br><br><br>
            </div>
        </div>
    </div>
</div>