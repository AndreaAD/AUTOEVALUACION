<meta charset="UTF-8">
<?php  session_start(); ?>
<link rel="stylesheet" type="text/css" href="../Css/PLM_Estilos.css">
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<div class="bloque una-columna">
    <div class="titulo-bloque texto-izquierda">
        <h2 class="icon-quill">Agregar plan de mejoramiento</h2>
    </div>
    <div id="contenido" class="div_formularios">
        <div class="container">
            <div class="row">
                <div class="row" id="mensajes"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col">
                            <label class="label_caja">Proceso</label>
                        </div>
                        <div class="col_2">
                            <?php echo '<h4>'.$proceso.'</h4>'; ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col">
                            <label class="label_caja">Factor</label>
                        </div>
                        <div class="col_2">
                            <select name="lista_factores" id="lista_factores">
                                <option value="0">Seleccionar</option>
                                <?php
                                    foreach ($factores as &$factor) {
                                        echo  '<option value="'.$factor['pk_factor'].'">'.$factor['nombre'].'</option>';
                                    }
                                ?>
                            </select>  
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col">
                            <label class="label_caja">Nombre del proyecto</label>
                        </div>
                        <div class="col_2">
                            <textarea id="nombre" name="nombre"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col">
                            <label class="label_caja">Fecha de inicio programada</label>
                        </div>
                        <div class="col_2">
                            <input type="date" id="fecha_inicio">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col">
                            <label class="label_caja">Fecha de fin programada</label>
                        </div>
                        <div class="col_2">
                            <input type="date" id="fecha_fin">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col">
                            <label class="label_caja">Peso del proyecto</label>
                        </div>
                        <div class="col_2">
                            <input type="text" id="peso" name="peso">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col">
                            <label class="label_caja">Indicador</label>
                        </div>
                        <div class="col_2">
                            <textarea id="indicador" name="indicador"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col">
                            <label class="label_caja">Responsable</label>
                        </div>
                        <div class="col_2">
                            <input type="text" id="responsable" name="responsable">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col">
                            <label class="label_caja">Cargo</label>
                        </div>
                        <div class="col_2">
                            <input type="text" id="cargo" name="cargo">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col">
                            <label class="label_caja">Meta</label>
                        </div>
                        <div class="col_2">
                            <textarea id="meta" name="meta"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col">
                            <label class="label_caja">Descripcion</label>
                        </div>
                        <div class="col_2">
                            <textarea id="descripcion" name="descripcion"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col">
                            <label class="label_caja">Recursos</label>
                        </div>
                        <div class="col_2">
                            <textarea id="recursos" name="recursos"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col">
                            <label class="label_caja">Evidencias</label>
                        </div>
                        <div class="col_2">
                            <textarea id="evidencias" name="evidencias"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="button" id="guardar_plm" value="Guardar">
                    <button><a style="color:#fff;" target="_blank" href="../Vista/PLM_PlanesPdf_Vista.php?proceso=<?php echo $id_proceso;?> ">Pdf</a></button>
                    <input type="hidden" id="proceso" value="<?php echo $id_proceso; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="tabla_factor_plm">
                        <thead>
                            <tr>
                                <th>Factor</th>
                                <th>Nombre del proyecto</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4">No hay datos disponibles.</td>
                            </tr>
                        </tbody>
                    </table><br><br><br><br>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="div_emergente" class="fondo_emergente">
    <div class="emergente">
        <div data-role="contenido"></div>
        <div data-role="botones"></div>
        <span title="cerrar" data-rol="cerrar"> x </span>
    </div>
</div>
<script type="text/javascript" src="../Js/PLM_Plan.js"></script>