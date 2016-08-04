<?php
 
$objComponentes=new Elementos();
    
$datos=array("tipo"=>"una-columna-centro-medio",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Subir Archivo M&oacute;dulo", // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-centro", //(necesario) alineacion del contenido del div
            "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
            
$objComponentes->div_bloque_principal($datos);

    $datos=array("id"=>"formulario");// (no-necesario) id del formulario
    
    $objComponentes->form($datos);
    
        ///////////////////////////input hidden//////////////////////////////
        $datos=array(
                    "id"=>"T_Estado", //(no necesario) define el id que tendra el campo
                    "name"=>"T_Estado", // (necesario) define el name que tendra el campo
                    "value"=>"");// (necesario) El atributo value especifica el valor de un elemento
                    
                    
        $objComponentes->input_hidden($datos);
        
        /////////////////////////////////input file//////////////////////////////////////////////////
        $datos = array(
                    "id"=>"file",//(no necesario)el id que tendra el input
                    "name"=>"file[]", // (necesario) define el name del campo
                    "label"=>"Subir Archivo M&oacute;dulo",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "required"=>"on"//especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    );
                            
        $objComponentes->input_file ($datos);
        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"subir",//(no necesario) el id que tendra el boton
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "value"=>"Enviar",//(necesario) valor que mostrar el boton
                    "onclick"=>"EnviarFile('../Controlador/SAD_Subir_Modulo_Controlador.php');"// (necesario) funcion js que se ejecutara si se hace click en el boton
                    );
        $objComponentes->button_normal($datos);
        
    $objComponentes->cerrar_form();

$objComponentes->cerrar_div_bloque_principal();

?>