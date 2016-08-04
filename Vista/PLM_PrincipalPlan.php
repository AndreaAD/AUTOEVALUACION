<?php

        //en este formulario se establecen los botones 
        //para la dministración de las actividades de mejoramiento
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="mvc" />

	<title>Plan de Mejoramiento</title>
</head>

<body>
<br />
<br />

<form id="llenar" method="post">        
    <div class="bloque una-columna-centro-medio">
      <div class="titulo-bloque texto-izquierda">
          <h2 class="icon-quill">Plan de Mejoramiento</h2>
      </div>
      <div class="cuerpo-bloque texto-centro">
      
        <a id="BTN_agregar" class="boton-icono" onclick="enlace_llenar_plm();" ><i class="icono icon-download"></i><span class="texto-boton">Diligenciar</span></a>
        <!--<a id="BTN_modifica" class="boton-icono" onclick="enlace_modificar_plm();" ><i class="icono icon-busy"></i><span class="texto-boton">Modificar</span></a>--!>
        <!--<a id="BTN_modifica" class="boton-icono" onclick="enlace_modificar_plm();" ><i class="icono icon-pencil"></i><span class="texto-boton">Habilitar</span></a>--!>
        <!--<a id="BTN_modifica" class="boton-icono" onclick="enlace_modificar_plm();" ><i class="icono icon-busy"></i><span class="texto-boton">Inhabilitar</span></a>--!>
    
        <!--<a id="BTN_consulta" class="boton-icono" onclick="enlace_consulta_plm();" ><i class="icono icon-quill"></i><span class="texto-boton">Consultar</span></a>--!>
           
       </div>
    </div>
</form>
</body>
</html>