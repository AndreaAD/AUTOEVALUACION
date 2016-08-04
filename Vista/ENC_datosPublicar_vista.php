<?php
////header('Content-Type: text/html; charset=UTF-8');
$datos = array(
            "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
            "value"=>"Volver",//(necesario) valor que mostrar el boton
            "icono"=>"arrow-left", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
            "onclick"=>"enc_regresar('ENC_publicarEncuesta_controlador.php');"// (necesario) funcion js que se ejecutara si se hace click en el boton
            );     
$objComp->button_link($datos);
?><br /><br /><?php
$datos=array("tipo"=>"una-columna",
            "titulo"=>"Datos basicos para la encuesta",
            "alignTitulo"=>"texto-izquierda",
            "alignContenido"=>"texto-centro",
            "icono"=>"pencil2"); 
$objComp->div_bloque_principal($datos);
?>
    <div class="grupo-controles-formulario">
        <label for="" class="texto-control-formulario">Grupo de interes</label>
        <div class="controles-formulario texto-centro">
          <span style="font-size:1.3em;"><?php echo (strtoupper($rsGrupos->fields[1]));?></span>
        </div>
    </div>
<?php
$datos=array("id"=>"titulo",
            "name"=>"titulo", 
            "label"=>"Titulo de la encuesta",
            "placeholder"=>"Escriba el titulo que tendra la encuesta",
            "value"=>utf8_decode($txTitulo)
            );
$objComp->textarea($datos);

$datos=array("id"=>"descripcion",
            "name"=>"descripcion", 
            "label"=>"Descripcion",
            "placeholder"=>"Escriba un texto de introducción para la encuesta",
            "value"=>utf8_decode($txDescripcion)
            );
$objComp->textarea($datos);

$datos=array("id"=>"instrucciones",
            "name"=>"instrucciones", 
            "label"=>"Instrucciones para solucionar la encuesta",
            "placeholder"=>"Escriba instrucciones para solucionar la encuesta si son necesrias",
            "value"=>utf8_decode($txInstrucciones)
            );
$objComp->textarea($datos);

$objComp->linea_separador(80);

$datos = array(
        "class"=>"mediano",//(necesario) tamaño del boton puede ser {grande,mediano,small}
        "value"=>"Guardar datos",//(necesario) valor que mostrar el boton
        "icono"=>"none", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
        "onclick"=>"enc_procesarEncuesta(this,'guardar',".$idGrupoInt.");"// (necesario) funcion js que se ejecutara si se hace click en el boton
        );
$objComp->button_link($datos);

$objComp->cerrar_div_bloque_principal();

$datos=array("id"=>"bloque-dinamico",
            "tipo"=>"una-columna", 
            "alignContenido"=>"texto-centro");         
$objComp->bloque_div_normal($datos);

$objComp->cerrar_bloque_div_normal();
?>