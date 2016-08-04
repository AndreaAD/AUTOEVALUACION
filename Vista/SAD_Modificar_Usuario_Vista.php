<?php
     
$objComponentes=new Elementos();

$datos=array("tipo"=>"una-columna-centro-medio",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Modificar Usuario", // (no necesario) titulo del bloque
            "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
            "alignContenido"=>"texto-centro", //(necesario) alineacion del contenido del div
            "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
            
$objComponentes->div_bloque_principal($datos);

    $datos=array("id"=>"formulario");// (no-necesario) id del formulario
    
    $objComponentes->form($datos);
    
    foreach($sqlUsu as $elemento=>$valor){
    
        ///////////////////////////input hidden//////////////////////////////
        $datos=array(
                    "id"=>"T_Estado", //(no necesario) define el id que tendra el campo
                    "name"=>"T_Estado", // (necesario) define el name que tendra el campo
                    "value"=>"");// (necesario) El atributo value especifica el valor de un elemento
                    
                    
        $objComponentes->input_hidden($datos);
        
        ///////////////////////////input hidden//////////////////////////////
        $datos=array(
                    "id"=>"pk_usuario", //(no necesario) define el id que tendra el campo
                    "name"=>"pk_usuario", // (necesario) define el name que tendra el campo
                    "value"=>$valor['pk_usuario']);// (necesario) El atributo value especifica el valor de un elemento
                    
        $objComponentes->input_hidden($datos);
        
        ///////////////////////////input text//////////////////////////////
        $datos=array(
                    "id"=>"cedula",//(no necesario)define el id que tendra el campo
                    "name"=>"cedula", // (necesario) define el name del campo
                    "label"=>"Cedula",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Cedula",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"50",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "onkeydown"=>"return ValidarNumero(event)",//(no necesario) El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()"
                    "help"=>"Por favor digite el documento",//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    "obligatorio"=>"obligatorio_cedula",
                    "value"=>$valor['cedula']
                    );
                    
        $objComponentes->input_text($datos);
    
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
                    "value"=>$valor['nombre']
                    );
                    
        $objComponentes->input_text($datos);
        
        ///////////////////////////input text//////////////////////////////
        $datos=array(
                    "id"=>"apellido",//(no necesario)define el id que tendra el campo
                    "name"=>"apellido", // (necesario) define el name del campo
                    "label"=>"Apellido",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Apellido",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"50",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "onkeypress"=>"return ValidarTexto(event)",//(no necesario) El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()"
                    "help"=>"Por favor digite el apellido",//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    "obligatorio"=>"obligatorio_apellido",
                    "value"=>$valor['apellido']
                    );
                    
        $objComponentes->input_text($datos);
        
        
        ///////////////////////////input text//////////////////////////////
        $datos=array(
                    "id"=>"correo",//(no necesario)define el id que tendra el campo
                    "name"=>"correo", // (necesario) define el name del campo
                    "label"=>"Correo",//(necesrio - si se omite queda como si se pasara vacio) La etiqueta label define una etiqueta para un elemento
                    "placeholder"=>"Correo",//(no necesario) El atributo placeholder especifica una pista corta que describe el valor esperado de un campo de entrada
                    "maxlength"=>"100",//(no necesario) El atributo maxlength especifica el número máximo de caracteres permitidos en el elemento
                    "required"=>"on",//(no necesario) especifica que un campo de entrada debe ser completado antes de enviar el formulario
                    "onkeypress"=>"ValidarCorreo();",//(no necesario) El evento onkeypress se produce cuando el usuario pulsa una tecla onkeypress="myFunction()"
                    "help"=>"Por favor digite el correo",//(no necesario) Es cuando se quiere colocar un testo de ayuda para le usuario que esta llenando el campo
                    "obligatorio"=>"obligatorio_correo",
                    "value"=>$valor['correo']
                    );
                    
        $objComponentes->input_text($datos);        
        
        //////////////////////////////////////Mensaje///////////////////////////////////////////////////  
        $objComponentes->mensaje();
        
        /////////////////////////////////select con sql////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"rol",//(no necesario)el id que tendra el select
                    "name"=>"rol",// (necesario) nombre que tendra el select
                    "label"=>"Rol",//(necesario - si se omite queda como si se pasara vacio)el nombre que se mostrara
                    "valor"=>"pk_rol",//(necesario)el valor que tendra cada elemento segun la consulta sql
                    "mostrar"=>"nombre",// (necesario)el valor a msotrar de cada elemnto segun la consulta sql
                    "obligatorio"=>"obligatorio_rol",
                    "selected"=>$valor['fk_rol']
                    );
                         
        $objComponentes->select_sql ($resSqlRol,$datos);
        
        /////////////////////////////////select con sql////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"sede",//(no necesario)el id que tendra el select
                    "name"=>"sede",// (necesario) nombre que tendra el select
                    "label"=>"Sede",//(necesario - si se omite queda como si se pasara vacio)el nombre que se mostrara
                    "valor"=>"pk_sede",//(necesario)el valor que tendra cada elemento segun la consulta sql
                    "mostrar"=>"nombre",// (necesario)el valor a msotrar de cada elemnto segun la consulta sql
                    "obligatorio"=>"obligatorio_sede",
                    "onchange"=>"FiltrarDato('../Controlador/SAD_Modificar_Usuario_Controlador.php', 'programa');",
                    "selected"=>$valor['pk_sede']
                    );
                         
        $objComponentes->select_sql ($resSqlSede,$datos);

        /////////////////////////////////select con sql////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"facultad",//(no necesario)el id que tendra el select
                    "name"=>"facultad",// (necesario) nombre que tendra el select
                    "label"=>"Facultad",//(necesario - si se omite queda como si se pasara vacio)el nombre que se mostrara
                    "valor"=>"pk_facultad",//(necesario)el valor que tendra cada elemento segun la consulta sql
                    "mostrar"=>"nombre",// (necesario)el valor a msotrar de cada elemnto segun la consulta sql
                    "obligatorio"=>"obligatorio_facultad",
                    "onchange"=>"FiltrarDato('../Controlador/SAD_Modificar_Usuario_Controlador.php', 'programa');",
                    "selected"=>$valor['pk_facultad']
                    );
                         
        $objComponentes->select_sql ($resSqlFacultad,$datos);

        /////////////////////////////////select con sql////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"programa",//(no necesario)el id que tendra el select
                    "name"=>"programa",// (necesario) nombre que tendra el select
                    "label"=>"Programa",//(necesario - si se omite queda como si se pasara vacio)el nombre que se mostrara
                    "valor"=>"pk_programa",//(necesario)el valor que tendra cada elemento segun la consulta sql
                    "mostrar"=>"nombre",// (necesario)el valor a msotrar de cada elemnto segun la consulta sql
                    "obligatorio"=>"obligatorio_programa",
                    "selected"=>$valor['fk_programa']
                    );
                         
        $objComponentes->select_sql ($resSqlPrograma,$datos);

        //////////////////////////////input checkbox bloque con sql//////////////////////////////////
        
        $datos = array(
                    "name"=>"pk_tipo_usuario[]",//(necesario) name del grupo al que pertenecen los checkbox
                    "label"=>"Tipo de Usuario",//(necesario - si se omite queda como si se pasara vacio)el nombre que se mostrara
                    "class"=>"bloque",//(necesario)decir como queremos que se muestre los elementos
                    "valor"=>"pk_tipo_usuario",//(necesario)el valor que tendra cada elemento segun la consulta sql
                    "mostrar"=>"nombre",// (necesario)el valor a msotrar de cada elemnto segun la consulta sql
                    "obligatorio"=>"obligatorio_tipo_usuario",
                    "Checked"=>"on",
                    "CheckedValor"=>$sqlTipUsu
                    );
                         
        $objComponentes->input_checkbox_sql ($resSqlTipo, $datos);

        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"button",//(no necesario) el id que tendra el boton
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "value"=>"Modificar",//(necesario) valor que mostrar el boton
                    "onclick"=>"ValidarDatos('../Controlador/SAD_Modificar_Usuario_Controlador.php', this);"// (necesario) funcion js que se ejecutara si se hace click en el boton
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
        
    }
    
    $objComponentes->cerrar_form();

$objComponentes->cerrar_div_bloque_principal();

?>