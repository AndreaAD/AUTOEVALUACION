<?php

$objComponentes=new Elementos();

$urlactual = $_SERVER['REQUEST_URI']; 
      
if(!$resSqlActGru->EOF){
    
    while(!$resSqlNomActGru->EOF){
                
        $datos=array("tipo"=>"bloque una-columna",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
                    "titulo"=>"M&oacute;dulo ".$resSqlNomActGru->fields['nombre_modulo']." - ".$resSqlNomActGru->fields['nombre_grupo']." - ".$resSqlNomActGru->fields['nombre_sub'], // (no necesario) titulo del bloque
                    "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
                    "alignContenido"=>"texto-centro", //(necesario) alineacion del contenido del div
                    "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
                    
        $objComponentes->div_bloque_principal($datos);
        
        $resSqlNomActGru->MoveNext();
    }
                 
            $datos=array(
                        "id"=>"text",//define el nombre que tendra el campo
                        "label"=>"text",//La etiqueta label define una etiqueta para un elemento
                        );
                
            $objComponentes->boton_act_grupo($datos, $resSqlActGru, $urlactual);
            
        $objComponentes->cerrar_div_bloque_principal();
 
}

?>
