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