<style>
    .titulo_circulo{
        background: #0E3D38; 
        color: white; 
        border-style: solid; 
        font:normal bold 82% Verdana;
        padding: 5px;
    }

</style>
<link rel="stylesheet" type="text/css" href="../Css/div_circular/demo.css" />
<link rel="stylesheet" type="text/css" href="../Css/div_circular/common.css" />
<link rel="stylesheet" type="text/css" href="../Css/div_circular/style7.css" />
<link href='../Css/div_circular/fuentes_div_circular.css' rel='stylesheet' type='text/css' />
<script type="text/javascript" src="../Js/modernizr.custom.79639.js"></script> 
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,700' rel='stylesheet' type='text/css' />



<?php
$objComp = new Elementos();
$datos = array(
    "tipo" => "una-columna", // (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
    "titulo" => "Fuentes Primarias", // (no necesario) titulo del bloque
    "alignTitulo" => "texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
    "alignContenido" => "texto-centro", //(necesario) alineacion del contenido del div
    "icono" => "pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo

$objComp->div_bloque_principal($datos);
?>
<section class="main">
    <ul class="ch-grid">

        <li><div class="titulo_circulo">Tablero de Factores</div><br>
            <div class="ch-item">				
                <div class="ch-info">
                    <div class="ch-info-front ch-img-1"></div>
                    <div class="ch-info-back">
                        <h3>Tablero</h3>
                        <p>Resultado por Factores<a onclick="Entrar('../Controlador/ENC_resultadosConsolidacion_controlador.php?opcion=grafica_consolidacion_factores');">Ver</a></p>
                    </div>	
                </div>
            </div>
        </li>
        <li><div class="titulo_circulo">Grafico de Factores</div><br>
            <div class="ch-item">
                <div class="ch-info">
                    <div class="ch-info-front ch-img-2"></div>
                    <div class="ch-info-back">
                        <h3>Grafico</h3>
                        <p>Resultado por Factores<a onclick="Entrar('../Controlador/ENC_resultadosConsolidacion_controlador.php?opcion=tabla_consolidacion_factores');">Ver</a></p>
                    </div>
                </div>
            </div>
        </li>
        <li><div class="titulo_circulo">Comparacion de resultados</div><br>
            <div class="ch-item">
                <div class="ch-info">
                    <div class="ch-info-front ch-img-3"></div>
                    <div class="ch-info-back">
                        <h3>Tablero</h3>
                        <p>Encuestas<a onclick="Entrar('../Controlador/ENC_resumenEncuestas_controlador.php');">Ver</a></p>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</section>
<br><br>
<?php
$objComp->cerrar_div_bloque_principal();
$datos = array(
    "tipo" => "una-columna", // (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
    "titulo" => "Documental", // (no necesario) titulo del bloque
    "alignTitulo" => "texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
    "alignContenido" => "texto-centro", //(necesario) alineacion del contenido del div
    "icono" => "pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo

$objComp->div_bloque_principal($datos);
?>
<section class="main">
    <ul class="ch-grid">

        <li><div class="titulo_circulo">Tablero de Ponderacion</div><br>
            <div class="ch-item">				
                <div class="ch-info">
                    <div class="ch-info-front ch-img-4"></div>
                    <div class="ch-info-back">
                        <h3>Tablero</h3>
                        <p>Fuentes Secundarias<a onclick="Entrar('../Vista/DOC_ConsolidacionResultados_index_Vista.php');">Ver</a></p>
                    </div>	
                </div>
            </div>
        </li>
        <li><div class="titulo_circulo">Grafico de Resultados</div><br>
            <div class="ch-item">
                <div class="ch-info">
                    <div class="ch-info-front ch-img-5"></div>
                    <div class="ch-info-back">
                        <h3>Grafico</h3>
                        <p>Fuentes Secundarias<a onclick="Entrar('../Controlador/DOC_AutoevaluacionResultados_Controlador.php');">Ver</a></p>
                    </div>
                </div>
            </div>
        </li>
        <li><div class="titulo_circulo">Tablero de Resultados</div><br>
            <div class="ch-item">
                <div class="ch-info">
                    <div class="ch-info-front ch-img-6"></div>
                    <div class="ch-info-back">
                        <h3>Resultado</h3>
                        <p>Fuentes Secundarias<a onclick="Entrar('../Controlador/DOC_tabla_resultados.php');">Ver</a></p>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</section>
<br><br>
<?php
$objComp->cerrar_div_bloque_principal();
$datos = array(
    "tipo" => "una-columna", // (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
    "titulo" => "Plan de Mejoramiento", // (no necesario) titulo del bloque
    "alignTitulo" => "texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
    "alignContenido" => "texto-centro", //(necesario) alineacion del contenido del div
    "icono" => "pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo

$objComp->div_bloque_principal($datos);
?>
<section class="main">
    <ul class="ch-grid">

        <li><div class="titulo_circulo">Tablero de Resultados</div><br>
            <div class="ch-item">				
                <div class="ch-info">
                    <div class="ch-info-front ch-img-7"></div>
                    <div class="ch-info-back">
                        <h3>Rubros</h3>
                        <p>Resultados <a>Ver</a></p>
                    </div>	
                </div>
            </div>
        </li>
        <li><div class="titulo_circulo">Grafica PLM</div><br>
            <div class="ch-item">
                <div class="ch-info">
                    <div class="ch-info-front ch-img-8"></div>
                    <div class="ch-info-back">
                        <h3>Mejoramiento</h3>
                        <p>Resultados<a >Ver</a></p>
                    </div>
                </div>
            </div>
        </li>

    </ul>
</section>
<br><br>
<?php $objComp->cerrar_div_bloque_principal(); ?>
<script>
    function Entrar($url){
    
    $.ajax({
        url:   $url,
        type:  'get',
        dataType:'html',
        data: "",
        success:  function (data) {
                    $('.principal-panel-contenido').html(data);                 
        }
   });
                    
   AbrirSubPagina('../Vista/VIS_Vacio_Vista.php', '0', '0', '0');
   
    return false;
    
}
    </script>