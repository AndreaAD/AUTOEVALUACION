<?php
$objComponentes=new Elementos();
    
$datos=array("tipo"=>"una-columna-centro-medio",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>$strNombreFormulario, // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-centro", //(necesario) alineacion del contenido del div
            "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
            
$objComponentes->div_bloque_principal($datos);

    $datos=array("id"=>"formulario");// (no-necesario) id del formulario
    
    $objComponentes->form($datos);
    
        while(!$resSql->EOF) //Mientras no estemos al final de RecordSet
        {
            
            ///////////////////////////input hidden//////////////////////////////
            $datos=array(
                        "id"=>"T_Estado", //(no necesario) define el id que tendra el campo
                        "name"=>"T_Estado", // (necesario) define el name que tendra el campo
                        "value"=>"");// (necesario) El atributo value especifica el valor de un elemento
                     
            $objComponentes->input_hidden($datos);        
                     
            ///////////////////////////input hidden//////////////////////////////
            $datos=array(
                        "id"=>"pk_modulo", //(no necesario) define el id que tendra el campo
                        "name"=>"pk_modulo", // (necesario) define el name que tendra el campo
                        "value"=>$resSql->fields["pk_modulo"]);// (necesario) El atributo value especifica el valor de un elemento
                     
            $objComponentes->input_hidden($datos);        
                     
            ///////////////////////////input text//////////////////////////////
            $datos=array(
                        "id"=>"nombre",//(no necesario)define el id que tendra el campo
                        "name"=>"nombre", // (necesario) define el name del campo
                        "label"=>"Nombre del Modulo",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                        "value"=>$resSql->fields["nombre"],//(no necesario) El atributo value especifica el valor de un elemento
                        "help"=>"help"//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                        );
                        
            $objComponentes->input_text($datos);

            /////////////////////////////////////textarea////////////////////////////////////////////////
            $datos=array(
                        "id"=>"descripcion",// (no necesario) define el id que tendra el campo
                        "name"=>"descripcion", // (necesario) define el name del campo
                        "label"=>"Descripcion del Modulo",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                        "value"=>$resSql->fields["descripcion"],//(no necesario) El atributo value especifica el valor de un elemento
                        "help"=>"help"//Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                        );
                        
            $objComponentes->textarea_value($datos);

            ///////////////////////////input text//////////////////////////////
            $datos=array(
                        "id"=>"color",//(no necesario)define el id que tendra el campo
                        "name"=>"color", // (necesario) define el name del campo
                        "label"=>"Color del Modulo",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                        "value"=>$resSql->fields["color"],//(no necesario) El atributo value especifica el valor de un elemento
                        "readonly"=>"on",//(no necesario) especifica de sólo lectura
                        "help"=>"help"//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                        );
                        
            $objComponentes->input_color($datos);
                        
            /////////////////////////////////input button///////////////////////////////////////////////////        
            $datos = array(
                        "id"=>"subir",//(no necesario) el id que tendra el boton
                        "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                        "value"=>"Enviar",//(necesario) valor que mostrar el boton
                        "onclick"=>"EnviarDatos('../Controlador/SAD_Modificar_Modulo_Controlador.php');"// (necesario) funcion js que se ejecutara si se hace click en el boton
                        );
            $objComponentes->button_normal($datos);
            
            
            $resSql->MoveNext(); //Nos movemos al siguiente registro
        }
    
    $objComponentes->cerrar_form();

$objComponentes->cerrar_div_bloque_principal();

?>