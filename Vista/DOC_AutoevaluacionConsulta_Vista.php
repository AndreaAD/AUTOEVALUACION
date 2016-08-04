<?php  require_once("elementos_vista.php");
$objComp=new Elementos(); ?>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<script type="text/javascript" src="../Js/DOC_Selectores.js"></script>
<script type="text/javascript" src="../Js/DOC_FileUploader.js"></script>

<input type="hidden" name="proceso" value=""> 
<input type="hidden" name="_section" value="consultas_programa"> 
<div class="bloque una-columna">
    <div class="titulo-bloque texto-izquierda">
        <h2 class="icon-quill">Documentos</h2>
    </div>
    <div class="div_formularios">
        <input type="hidden" name="H_operacion" value="crearInstrumento">
        <input type="hidden" name="factor" value="">
        <input type="hidden"name ="caracteristica" value="">
        <input type="hidden" name="aspecto" value="">
        <input type="hidden" name="evidencia" value="">
        <input type="hidden" name="id_pregunta" value="">
        <inpuy type="hidden" name="tipoproceso" value="">
            <div class="row">
                <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor">Procesos</label>
                <button  type="button" id="A_procesos" class="boton-solo-icono"><i class="icon-redo2"></i></button>
                <textarea id="procesos" style="width:90%; height:50px;" placeholder="Seleccione un proceso" id="texto-factor" readonly="on"></textarea>
            </div>
            <div class="row">
                <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor">Factor</label>
                <button  type="button" id="A_factor" class="boton-solo-icono"><i class="icon-redo2"></i></button>
                <textarea id="factor" style="width:90%; height:50px;" placeholder="Seleccione un factor" id="texto-factor" readonly="on"></textarea>
            </div>
            <div class="row">
                <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor">Característica</label>
                <button  type="button" id="A_caracteristica" class="boton-solo-icono"><i class="icon-redo2"></i></button>
                <textarea id="caracteristica" style="width:90%; height:50px;" placeholder="Seleccione una caracteristica" id="texto-factor" readonly="on"></textarea>
            </div>
            <div class="row">
                <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor">Aspecto</label>
                <button  type="button" id="A_aspecto" class="boton-solo-icono"><i class="icon-redo2"></i></button>
                <textarea id="aspecto" style="width:90%; height:50px;" placeholder="Seleccione un aspecto" id="texto-factor" readonly="on"></textarea>
            </div>
            <div class="row">
                <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor">Evidencia</label>
                <button  type="button" id="A_evidencia" class="boton-solo-icono"><i class="icon-redo2"></i></button>
                <textarea id="evidencia" style="width:90%; height:50px;" placeholder="Seleccione una evidencia" id="texto-factor" readonly="on"></textarea>
            </div>
            <div class="row">
                <div id="men_err" class="mensaje_error"></div>
            </div>
            <div class="row">
              <table class="tabla2" id="tabla_agregar_documentos">
              </table>
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