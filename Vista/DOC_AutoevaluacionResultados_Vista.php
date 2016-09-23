<link rel="stylesheet" type="text/css" href="../Css/DOC_Estilos.css">
<script type="text/javascript" src="../Js/DOC_Selectores.js"></script>
<script type="text/javascript" src="../Js/DOC_FileUploader.js"></script>

<input type="hidden" name="_section" value="resultados">

<div class="bloque una-columna">
    <div class="titulo-bloque texto-izquierda">
        <h2 class="icon-quill">Grafica de resultados</h2>
    </div>
	<div id="contenido">
		<?php
			include '../Controlador/DOC_graficas.php';
			//include '../Controlador/DOC_graficasPrograma.php';
	    ?>
	</div>
</div>
