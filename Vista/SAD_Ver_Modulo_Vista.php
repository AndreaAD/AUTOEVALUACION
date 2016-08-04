<?php
     
$objComponentes=new Elementos();

$datos=array("tipo"=>"una-columna-centro-medio",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Ver M&oacute;dulo", // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-centro", //(necesario) alineacion del contenido del div
            "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
            
$objComponentes->div_bloque_principal($datos);

    $datos=array("id"=>"formulario");// (no-necesario) id del formulario
    
    $objComponentes->form($datos);
    
    while(!$sqlRol->EOF){
    
        ///////////////////////////input hidden//////////////////////////////
        $datos=array(
                    "id"=>"T_Estado", //(no necesario) define el id que tendra el campo
                    "name"=>"T_Estado", // (necesario) define el name que tendra el campo
                    "value"=>"");// (necesario) El atributo value especifica el valor de un elemento
                    
                    
        $objComponentes->input_hidden($datos);
        
        ///////////////////////////input text//////////////////////////////
        $datos=array(
                    "id"=>"nombre",//(no necesario)define el id que tendra el campo
                    "name"=>"nombre", // (necesario) define el name del campo
                    "label"=>"Nombre",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Nombre",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"50",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "onkeypress"=>"return ValidarTexto(event)",//(no necesario) El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()"
                    "help"=>"Por favor digite el nombre",//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    "obligatorio"=>"obligatorio_nombre",
                    "value"=>$sqlRol->fields['nombre'],
                    "readonly"=>"on"
                    );
                    
        $objComponentes->input_text($datos);
        
        ///////////////////////////textarea//////////////////////////////
        $datos=array(
                    "id"=>"descripcion",//(no necesario)define el id que tendra el campo
                    "name"=>"descripcion", // (necesario) define el name del campo
                    "label"=>"Descripci&oacute;n",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Descripci&oacute;n",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"150",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "help"=>"Por favor digite una descripci&oacute;n",//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    "obligatorio"=>"obligatorio_descripcion",
                    "value"=>$sqlRol->fields['descripcion'],
                    "readonly"=>"on"
                    );
                    
        $objComponentes->textarea($datos);
        
        ///////////////////////////textarea//////////////////////////////
        $datos=array(
                    "id"=>"url",//(no necesario)define el id que tendra el campo
                    "name"=>"url", // (necesario) define el name del campo
                    "label"=>"Url",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Url",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"150",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "help"=>"Por favor digite la url",//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    "obligatorio"=>"obligatorio_descripcion",
                    "value"=>$sqlRol->fields['url'],
                    "readonly"=>"on"
                    );
                    
        $objComponentes->textarea($datos);
        
        ///////////////////////////////ventana Emergente//////////////////////////////////////////////        
        $datos=array(
                    "id"=>"mensaje_flotante",// (necesario) id de la ventana
                    "height"=>"25",
                    "width"=>"25",//(necesario) ancho en porcentaje que tendra la ventana emergente valores entre 10 y 90
                    "alignContenido"=>"texto-centro",
                    "mensaje"=>$mensaje
                    );// (no necesario - si no se pone se aliena al centro por defeccto) alienacion del contenido
        
        $objComponentes->mensaje_flotante($datos); 
        
        $sqlRol->MoveNext();
        
    }
    
    $objComponentes->cerrar_form();

$objComponentes->cerrar_div_bloque_principal();

?>