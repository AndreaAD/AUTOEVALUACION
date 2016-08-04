<?php
     
$objComponentes=new Elementos();

$datos=array("tipo"=>"una-columna-centro-medio",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Cambiar Contrase&ntilde;a", // (no necesario) titulo del bloque
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
        
        ///////////////////////////input text//////////////////////////////
        $datos=array(
                    "id"=>"clave_actual",//(no necesario)define el id que tendra el campo
                    "name"=>"clave_actual", // (necesario) define el name del campo
                    "label"=>"Clave Actual",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Clave Actual",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"15",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "help"=>"Por favor digite la clave actual"//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    );
                    
        $objComponentes->input_password($datos);
    
        ///////////////////////////input text//////////////////////////////
        $datos=array(
                    "id"=>"clave_nueva",//(no necesario)define el id que tendra el campo
                    "name"=>"clave_nueva", // (necesario) define el name del campo
                    "label"=>"Clave Nueva",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Clave Nueva",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"15",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "help"=>"Por favor digite la clave nueva"//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    );
                    
        $objComponentes->input_password($datos);
        
        ///////////////////////////input text//////////////////////////////
        $datos=array(
                    "id"=>"clave_confirmar",//(no necesario)define el id que tendra el campo
                    "name"=>"clave_confirmar", // (necesario) define el name del campo
                    "label"=>"Confirmar Clave",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Confirmar Clave",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"15",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "help"=>"Por favor confirme la clave"//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    );
                    
        $objComponentes->input_password($datos);
        
        
        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"button",//(no necesario) el id que tendra el boton
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "value"=>"Enviar",//(necesario) valor que mostrar el boton
                    "onclick"=>"ModificarClave('../Controlador/VIS_Modificar_Clave_Controlador.php');"// (necesario) funcion js que se ejecutara si se hace click en el boton
                    );
        $objComponentes->button_normal($datos);
        
    $objComponentes->cerrar_form();

$objComponentes->cerrar_div_bloque_principal();

?>