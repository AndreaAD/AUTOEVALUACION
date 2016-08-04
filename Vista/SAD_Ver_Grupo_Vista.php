<?php
     
$objComponentes=new Elementos();

$datos=array("tipo"=>"una-columna-centro-medio",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Ver Grupo", // (no necesario) titulo del bloque
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
                    "id"=>"pk_grupo", //(no necesario) define el id que tendra el campo
                    "name"=>"pk_grupo", // (necesario) define el name que tendra el campo
                    "value"=>$sqlRol->fields['pk_grupos_actividades']
                    );// (necesario) El atributo value especifica el valor de un elemento
                    
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
        
        ///////////////////////////select Url//////////////////////////////
        $array_url = array();
        
        $directorio = opendir("."); //ruta actual
        while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
        {
            if (is_dir($archivo))//verificamos si es o no un directorio
            {
                //echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
            }
            else
            {
                //echo $archivo . "<br />";
                $array_url[] = array('../Controlador/'.$archivo=>$archivo);
            }
        }
        $datos=array(
                    "id"=>"url", //(no necesario) define el id que tendra el campo
                    "name"=>"url", // (necesario) define el name que tendra el campo
                    "value"=>"",
                    "label"=>"Url",
                    "obligatorio"=>"obligatorio_url",
                    "selected"=>$sqlRol->fields['url'],
                    "disable"=>"on"
                    );// (necesario) El atributo value especifica el valor de un elemento
                    
               
        $objComponentes->select_url($array_url, $datos);
        
        /////////////////////////////////select con sql////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"fk_modulo",//(no necesario)el id que tendra el select
                    "name"=>"fk_modulo",// (necesario) nombre que tendra el select
                    "label"=>"M&oacute;dulo",//(necesario - si se omite queda como si se pasara vacio)el nombre que se mostrara
                    "valor"=>"pk_modulo",//(necesario)el valor que tendra cada elemento segun la consulta sql
                    "mostrar"=>"nombre",// (necesario)el valor a msotrar de cada elemnto segun la consulta sql
                    "obligatorio"=>"obligatorio_modulo",        
                    "selected"=>$sqlRol->fields['fk_modulo'],
                    "disable"=>"on"
                    );
                         
        $objComponentes->select_sql ($resSqlRol,$datos);
        
        $sqlRol->MoveNext();
        
    }
    
    $objComponentes->cerrar_form();

$objComponentes->cerrar_div_bloque_principal();

?>