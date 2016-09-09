<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<script type="text/javascript" src="../Js/DOC_Selectores.js"></script>
<script type="text/javascript" src="../Js/DOC_Instrueval.js"></script>
<input type="hidden" name="_section" value="intru_evaluacion"> 
<div class="bloque una-columna">
    <div class="titulo-bloque texto-izquierda">
        <h2 class="icon-quill">Agregar instrumento de evaluación</h2>
    </div>
        <input type="hidden" name="H_operacion" value="crearInstrumento">
        <input type="hidden" name="factor" value="">
        <input type="hidden" name="factor_codigo" value="">
        <input type="hidden" name="grupoInt" value="">
        <input type="hidden" name ="caracteristica" value="">
        <input type="hidden" name ="caracteristica_codigo" value="">
        <input type="hidden" name="aspecto" value="">
        <input type="hidden" name="aspecto_codigo" value="">
        <input type="hidden" name="evidencia" value="">
        <input type="hidden" name="evidencia_codigo" value="">
        <input type="hidden" name="id_pregunta" value="">
        <div id="contenido_instru" class="div_formularios">
            <div class="row" id="mensajes"></div>
                <label style="font-weight:bold;font-size:1.3em; display:inline-block; float:left;margin-bottom: 15px;" for="texto-factor" >Grupo interés</label>
                <div id="div_chechbox" style="display:inline-block; float: left; margin-left: 40px;}"></div>
            <div class="row">
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
            <div class="row">
                <div class="col">
                    <label class="label_caja">Ingrese el instrumento de evaluación  </label>
                </div>
                <div class="col_2">
                    <textarea class="text_pregunta" id="text_pregunta" name="T_pregunta"></textarea>
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
                <br>
                <input type="hidden" name="opc" value="1">
                <input type="submit" id="B_guardarInstru" value="Crear nuevo">
                <input type="submit" id="B_limpiar" value="Limpiar">
                <br><br>
            </div>
        </div>
    </div>
    <div class="errores"></div>
        <div id="div_emergente" class="fondo_emergente">
            <div class="emergente">
                <div data-role="contenido"></div>
                <div data-role="botones"></div>
                <span title="cerrar" data-rol="cerrar"> x </span>
            </div>
        </div>
    </div>