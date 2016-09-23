<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../Complementos/DataTables-1.10.12/media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../Complementos/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<link rel="stylesheet" href="../Complementos/font-awesome/css/font-awesome.min.css">
<!-- <link rel="stylesheet" href="../Complementos/jQuery-File-Upload/css/jquery.fileupload.css"> -->
<!-- <script type="text/javascript" src="../Js/DOC_Selectores.js"></script> -->
<script type="text/javascript" src="../Js/DOC_autoevaluacion.js"></script>
<script type="text/javascript" src="../Js/DOC_FileUploader.js"></script>
<input type="hidden" name="alcance" value="1">

<div id="div_procesos_verificados">
    <div id="div_contenido_completo">
        <div id="div_procesos" style="width:100%; float:left;">
            
        </div>
    </div>
</div>
<div id="paginador" data-role="paginador">
</div>
<div class="errores"></div>
<div id="div_emergente" class="fondo_emergente">
    <div class="emergente">
        <div data-role="contenido"></div>
        <div data-role="botones"></div>
        <span title="cerrar" data-rol="cerrar"> x </span>
    </div>
</div>


<script>
    $(function () { 

        $('body').delegate('.accordion', 'click', function(e)
        {
            $(this).toggleClass("active");
            $(this).next('.panel').toggleClass("show");
        });
    });

</script>
<!-- <div class="bloque una-columna">
    <div class="titulo-bloque texto-izquierda">
        <h2 class="icon-quill">Lista de instrumentos</h2>
    </div>
</div> -->