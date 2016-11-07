<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<script type="text/javascript" src="../Js/DOC_Selectores.js"></script>
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
                <select name="procesos_resultados" id="procesos_resultados">
                    <option value="0">Seleccionar</option>
                    <?php
                        foreach ($procesos as $value) {
                            echo '<option value="'.$value['pk_proceso'].'">'.$value['nombre'].'</option>';  
                        }
                    ?>
                </select><br><br><br>
            </div>
        </div>
        <h4 style="float: left;font-size: 17px;">Resultados</h4>
        <div class="row">
            <div class="col">
                <label class="label_caja">Proceso institucional</label>
            </div>
            <div class="col_2" id="proceso_institucional">
                
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label class="label_caja">Total instrumentos de evaluación</label>
            </div>
            <div class="col_2" id="texto_total">
                
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label class="label_caja">Porcentaje de respuesta actual</label>
            </div>
            <div class="col_2" id="texto_porcentaje">

            </div>
        </div>
        <div class="row">
            <br><br>
        </div> 
        <div class="row" style="width:96%;">
            <div class="col-md-12">
                <table id="tabla_resultados" class="display select" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Instrumento de evaluación</th>
                            <th>Factor</th>
                            <th>Codigo caracteristica</th>
                            <th>Puntaje obtenido</th>
                            <th>Lista de documentos</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>