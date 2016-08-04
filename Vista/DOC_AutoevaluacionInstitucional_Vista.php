<?php  session_start(); ?>
<?php  require_once("elementos_vista.php");
$objComp=new Elementos(); ?>
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<script type="text/javascript" src="../Js/DOC_Selectores.js"></script>
<script type="text/javascript" src="../Js/DOC_FileUploader.js"></script>

<input type="hidden" name="cambio_estado" value="0">
<input type="hidden" name="_section" value="autoevaluacion_Institucional">
<input type="hidden" name="grupoI" value="<?php echo $_SESSION['grupos_documental']['grupoI'] ?>">

<div id="div_procesos_verificados">
    <div class="una-columna">
        <div id="progreso-total" class="progress-bar">
            <span class="principal"></span>
            <div class="progreso"></div>
        </div>
    </div>
    <div class="bloque una-columna">
        <div class="titulo-bloque texto-izquierda">
            <h2 class="icon-quill">Factores</h2>
            <input type="hidden" name="factor" value="">
            <input type="hidden" name="pregunta" value="">
            <div class="row">
                <br><br><h4 id="nombre_proceso"></h4>
            </div>
            <div class="row">
                    <label style="font-weight:bold;font-size:1.3em; padding-right:4em;" for="texto-factor">Factor</label>
                    <button  type="button" id="A_factor" class="boton-solo-icono"><i class="icon-redo2"></i></button>
                    <textarea id="factor" style="width:90%; height:50px;" placeholder="Seleccione un factor" id="texto-factor" readonly="on"></textarea>
                   <!--  <div class="col">
                        <a id="A_factor" href="#">Seleccionar el factor  </a>
                    </div>
                    <div class="col_2">
                        <label class="label_caja" id="factor"></label>
                    </div> -->
            </div>
        </div>
    </div>
    <div id="div_contenido_completo" class="una-columna hide">
        <div class="titulo-bloque">
            <h2 class="icon-quill">Factores</h2>
        </div>
    </div>
    <div id="paginador" data-role="paginador">
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