<?php
     
$objComponentes=new Elementos();

$datos=array("tipo"=>"una-columna-centro-medio",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Modificar Caracter&iacute;stica", // (no necesario) titulo del bloque
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
        
        ///////////////////////////input hidden//////////////////////////////
        $datos=array(
                    "id"=>"pk_caracteristica", //(no necesario) define el id que tendra el campo
                    "name"=>"pk_caracteristica", // (necesario) define el name que tendra el campo
                    "value"=>$sqlRol->fields['pk_caracteristica']
                    );// (necesario) El atributo value especifica el valor de un elemento
                    
                    
        $objComponentes->input_hidden($datos);
        
        ///////////////////////////textarea para seleccionar//////////////////////////////
        $_SESSION["cna_idfactor"] = $sqlRol->fields['fk_factor'];
        
        $datos=array(
        "id"=>"texto-factor",// (no necesario) define el id que tendra el campo
        "name"=>"texto-factor", // (necesario) define el name del campo
        "label"=>"Factor",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
        "placeholder"=>"Seleccione un factor",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
        "value"=>$sqlRol->fields['nombre_factor']
        );

        $datos_boton = array(
                "class"=>"small",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                "value"=>"Seleccionar",//(necesario) valor que mostrar el boton
                "icono"=>"redo2", //(necesario) icono que aparecera en el boton, si se desea sin icono poner {none}
                "onclick"=>"Lista_Emergente(this,'../Controlador/VIS_Lista_Factores_Controlador.php','#ventana-factores');"// (necesario) funcion js que se ejecutara si se hace click en el boton
                );
        
        $objComponentes->Lista_FCA($datos, $datos_boton);
        
        $datos=array("id"=>"bloque-dinamico",///(necesario) id que tendra el div que contendra nuevos elementos
                    "tipo"=>"una-columna", //(necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
                    "alignContenido"=>"texto-centro");//(necesario) alineacion del contenido del div {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
        
        $objComponentes->bloque_div_normal($datos);
        $objComponentes->cerrar_bloque_div_normal();

        ///////////////////////////input text//////////////////////////////
        $datos=array(
                    "id"=>"nombre",//(no necesario)define el id que tendra el campo
                    "name"=>"nombre", // (necesario) define el name del campo
                    "label"=>"Nombre",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Nombre",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"200",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "onkeypress"=>"return ValidarTexto(event)",//(no necesario) El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()"
                    "help"=>"Por favor digite el nombre",//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    "obligatorio"=>"obligatorio_nombre",
                    "value"=>$sqlRol->fields['nombre']
                    );
        
        $objComponentes->textarea($datos);
        
        ///////////////////////////textarea//////////////////////////////
        $datos=array(
                    "id"=>"descripcion",//(no necesario)define el id que tendra el campo
                    "name"=>"descripcion", // (necesario) define el name del campo
                    "label"=>"Descripci&oacute;n",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Descripci&oacute;n",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"150",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "help"=>"Por favor dijite una descripci&oacute;n",//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    "obligatorio"=>"obligatorio_descripcion",
                    "value"=>$sqlRol->fields['descripcion']
                    );
                    
        $objComponentes->textarea($datos);
        
        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"button",//(no necesario) el id que tendra el boton
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "value"=>"Modificar",//(necesario) valor que mostrar el boton
                    "onclick"=>"ValidacionCaracteristica('../Controlador/CNA_Modificar_Caracteristica_Controlador.php', this);"// (necesario) funcion js que se ejecutara si se hace click en el boton
                    );
        $objComponentes->button_normal($datos);
        
        ///////////////////////////////ventana Emergente//////////////////////////////////////////////        
        $datos=array("id"=>"ventana-error",// (necesario) id de la ventana
            "ancho"=>"30",//(necesario) ancho en porcentaje que tendra la ventana emergente valores entre 10 y 95
            "alto"=>"auto",// (necesario) alto en porcentaje que tendra la ventana valor entre 10 y 90
            "alignContenido"=>"texto-centro",// (no necesario - si no se pone se aliena al centro por defeccto) alienacion del contenido
            "des"=>"5" // desplazamiento de la ventana con respecto a la parte superior porcentaje de 0 a 100
            );
            
        $objComponentes->bloque_div_flotante($datos); 
        
        echo $mensaje;
        
        $objComponentes->cerrar_bloque_div_flotante();
    
        $sqlRol->MoveNext();
        
    }
    
    $objComponentes->cerrar_form();

$objComponentes->cerrar_div_bloque_principal();

?>