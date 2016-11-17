<meta charset="UTF-8">

<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>


<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<script type="text/javascript" src="../Js/DOC_Selectores.js"></script>
<script type="text/javascript" src="../Js/DOC_Instrueval.js"></script>
<input type="hidden" name="_section" value="intru_evaluacion"> 
<div class="bloque una-columna">
    <div class="titulo-bloque texto-izquierda">
        <h2 class="icon-quill">Agregar instrumento de evaluación por característica</h2>
    </div>
        <div id="contenido_instruCaracteristica" class="div_formularios">
            <div class="container">
                <form action="#" id="formulario_caracteristicas" >
                    <div class="row" id="mensajes">
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col">
                                <label class="label_caja">Seleccione el grupo de interés </label>
                            </div>
                            <div class="col_2">
                                <div id="div_chechbox"></div>
                            </div>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col">
                            <label class="label_caja">Ingrese el instrumento de evaluación  </label>
                        </div>
                        <div class="col_2">
                            <textarea class="text_pregunta" id="text_pregunta" name="T_pregunta"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="label_caja">Seleccione el tipo de respuesta </label>
                        </div>
                        <div class="col_2">
                            <select name="S_tipoRespuesta"></select>
                        </div>
                    </div>
                    <div name="div_oculto" id="div_oculto" class="row">
                        <div class="col">
                            <label class="label_num">Ingrese el porcentaje </label>
                           
                        </div>
                        <div class="col_2">
                            <input type="number" name="nuevo_tipo_respuesta" min="1" max="100">
                        </div>
                    </div>
                    <div id="div_opcional" class="row">
                        <div class="col">
                            <label class="label_caja">Seleccione las opciones de respuesta </label>
                        </div>
                        <div class="col_2">
                            <select name="S_opcionesRespuesta"></select>
                        </div>
                    </div>
                    <!-- <div class="row" id="selec_programa_2">
                        <div id="selec_programa" class="col">
                            <label id="lab_pro" class="label_caja">Seleccione el proceso  </label>
                        </div>
                        <div id="checkbox_programas" class="col_2">
                        </div>
                    </div> -->
                    <div class="row">
                        <br><br><h1>Características</h1>
                    </div>
                    <div class="row" style="width:96%;">
                        <div class="col-md-12">
                            <table id="tabla_caracteristicas" class="display select" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><input name="select_all" id="todos" type="checkbox"></th>
                                        <th>Factor</th>
                                        <th>Código característica</th>
                                        <th>Característica</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="button" id="B_guardarInstruCaracteristica" value="Guardar">
                            <br>
                            <input type="hidden" id="id" >
                            <input type="hidden" name="opc" value="2">
                            <input type="hidden" id="seccion_doc" value="Crear_instrumento_caracteristica">
                        </div>
                    </div>
                </form>

            
            <!-- <div class="row">
                <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor">Factor</label>
                <button type="button" id="A_factor" class="boton-solo-icono"><i class="icon-redo2"></i></button>
                <textarea id="factor" style="width:90%; height:50px;" placeholder="Seleccione un factor" id="texto-factor" readonly="on"></textarea>
            </div>
            <div class="row">
                <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor">Característica</label>
                <button type="button" id="A_caracteristica" class="boton-solo-icono"><i class="icon-redo2"></i></button>
                <textarea id="caracteristica" style="width:90%; height:50px;" placeholder="Seleccione una caracteristica" id="texto-factor" readonly="on"></textarea>
            </div>
            <div class="row">
                <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor">Aspecto</label>
                <button type="button" id="A_aspecto" class="boton-solo-icono"><i class="icon-redo2"></i></button>
                <textarea id="aspecto" style="width:90%; height:50px;" placeholder="Seleccione un aspecto" id="texto-factor" readonly="on"></textarea>
            </div>
            <div class="row">
                <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor">Evidencia</label>
                <button type="button" id="A_evidencia" class="boton-solo-icono"><i class="icon-redo2"></i></button>
                <textarea id="evidencia" style="width:90%; height:50px;" placeholder="Seleccione una evidencia" id="texto-factor" readonly="on"></textarea>
            </div> -->
            
            <!-- <div class="row">
                <div id="selec_programa" class="col">
                    <label id="lab_pro" class="label_caja">Seleccione el proceso  </label>
                </div>
                <div id="checkbox_programas" class="col_2">
                </div>
            </div>
            <div class="row">
                <br>
                <input type="submit" id="B_guardarInstru" value="Crear nuevo">
                <input type="submit" id="B_modificarInstru" value="Modificar" disabled>
                <input type="submit" id="B_limpiar" value="Limpiar">
                <br><br>
            </div> -->
            <div class="row">
                <div id="men_err" class="mensaje_error"></div>
            </div>
            <!-- <div class="row" style="padding-botton:15px;">
              <table class="tabla2"id="tabla_agregar">
              </table>
            </div> -->
        </div>
    </div>
</div>
<div id="div_emergente" class="fondo_emergente">
    <div class="emergente">
        <div data-role="contenido" style="text-align: center;"></div>
        <div data-role="botones"></div>
        <span title="cerrar" data-rol="cerrar"> x </span>
    </div>
</div>