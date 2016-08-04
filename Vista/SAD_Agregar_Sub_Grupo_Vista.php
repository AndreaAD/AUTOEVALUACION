<?php
     
$objComponentes=new Elementos();

$datos=array("tipo"=>"una-columna-centro-medio",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
            "titulo"=>"Agregar Sub Grupo", // (no necesario) titulo del bloque
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
        
        ///////////////////////////input hidden//////////////////////////////
        $datos=array(
                    "id"=>"pk_sub_grupo", //(no necesario) define el id que tendra el campo
                    "name"=>"pk_sub_grupo", // (necesario) define el name que tendra el campo
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
                    );
                    
        $objComponentes->textarea($datos);
        
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
                    "onchange"=>"FiltrarDato('../Controlador/SAD_Agregar_Sub_Grupo_Controlador.php', 'fk_grupo');", 
                    );
                         
        $objComponentes->select_sql ($resSqlRol,$datos);
        
        /////////////////////////////////select con sql////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"fk_grupo",//(no necesario)el id que tendra el select
                    "name"=>"fk_grupo",// (necesario) nombre que tendra el select
                    "label"=>"Grupo",//(necesario - si se omite queda como si se pasara vacio)el nombre que se mostrara
                    "valor"=>"pk_grupos_actividades",//(necesario)el valor que tendra cada elemento segun la consulta sql
                    "mostrar"=>"nombre",// (necesario)el valor a msotrar de cada elemnto segun la consulta sql
                    "obligatorio"=>"obligatorio_grupo",
                    );
                         
        $objComponentes->select_sql ($sqlGrupo,$datos);
        
        ///////////////////////////Iconos//////////////////////////////
        $datos = array(
                        "icono1"=>"icono icon-none",
                        "icono2"=>"icono icon-home",
                        "icono3"=>"icono icon-home2",
                        "icono4"=>"icono icon-home3",
                        "icono5"=>"icono icon-pencil",
                        "icono6"=>"icono icon-pencil2",
                        "icono7"=>"icono icon-quill",
                        "icono8"=>"icono icon-image",
                        "icono9"=>"icono icon-camera",
                        "icono10"=>"icono icon-music",
                        "icono11"=>"icono icon-headphones",
                        "icono12"=>"icono icon-connection",
                        "icono13"=>"icono icon-book",
                        "icono14"=>"icono icon-file",
                        "icono15"=>"icono icon-file2",
                        "icono16"=>"icono icon-file3",
                        "icono17"=>"icono icon-copy",
                        "icono18"=>"icono icon-copy2",
                        "icono19"=>"icono icon-stack",
                        "icono20"=>"icono icon-folder",
                        "icono21"=>"icono icon-folder-open",
                        "icono22"=>"icono icon-tag",
                        "icono23"=>"icono icon-tags",
                        "icono24"=>"icono icon-envelope",
                        "icono25"=>"icono icon-map",
                        "icono26"=>"icono icon-map2",
                        "icono27"=>"icono icon-calendar",
                        "icono28"=>"icono icon-keyboard",
                        "icono29"=>"icono icon-drawer",
                        "icono30"=>"icono icon-drawer2",
                        "icono31"=>"icono icon-box-add",
                        "icono32"=>"icono icon-box-remove",
                        "icono33"=>"icono icon-download",
                        "icono34"=>"icono icon-upload",
                        "icono35"=>"icono icon-undo",
                        "icono36"=>"icono icon-undo2",
                        "icono37"=>"icono icon-redo",
                        "icono38"=>"icono icon-redo2",
                        "icono39"=>"icono icon-forward",
                        "icono40"=>"icono icon-reply",
                        "icono41"=>"icono icon-bubble",
                        "icono42"=>"icono icon-bubble2",
                        "icono43"=>"icono icon-bubbles",
                        "icono44"=>"icono icon-bubbles2",
                        "icono45"=>"icono icon-bubbles3",
                        "icono46"=>"icono icon-bubbles4",                
                        "icono47"=>"icono icon-busy",
                        "icono48"=>"icono icon-spinner",
                        "icono49"=>"icono icon-spinner2",
                        "icono50"=>"icono icon-spinner3",
                        "icono51"=>"icono icon-spinner4",
                        "icono52"=>"icono icon-spinner5",
                        "icono53"=>"icono icon-spinner6",
                        "icono54"=>"icono icon-key",
                        "icono55"=>"icono icon-key2",
                        "icono56"=>"icono icon-lock",
                        "icono57"=>"icono icon-lock2",
                        "icono58"=>"icono icon-unlocked",
                        "icono59"=>"icono icon-wrench",
                        "icono60"=>"icono icon-settings",
                        "icono61"=>"icono icon-equalizer",
                        "icono62"=>"icono icon-cog",
                        "icono63"=>"icono icon-cogs",
                        "icono64"=>"icono icon-cog2",
                        "icono65"=>"icono icon-bars",
                        "icono66"=>"icono icon-switch",
                        "icono67"=>"icono icon-powercord",
                        "icono68"=>"icono icon-numbered-list",
                        "icono69"=>"icono icon-menu",
                        "icono70"=>"icono icon-tree",
                        "icono71"=>"icono icon-bookmark",
                        "icono72"=>"icono icon-close",
                        "icono73"=>"icono icon-checkmark",
                        "icono74"=>"icono icon-checkmark2",
                        "icono75"=>"icono icon-minus",
                        "icono76"=>"icono icon-plus",
                        "icono77"=>"icono icon-enter",
                        "icono78"=>"icono icon-loop",
                        "icono79"=>"icono icon-arrow-up",
                        "icono80"=>"icono icon-arrow-right",
                        "icono81"=>"icono icon-arrow-down",
                        "icono82"=>"icono icon-arrow-left",
                        "icono83"=>"icono icon-arrow-up2",
                        "icono84"=>"icono icon-arrow-right2",
                        "icono85"=>"icono icon-arrow-down2",
                        "icono86"=>"icono icon-arrow-left2",
                        "icono87"=>"icono icon-table",
                        "icono88"=>"icono icon-table2",
                        "icono89"=>"icono icon-file-pdf",
                        "icono90"=>"icono icon-file-openoffice",
                        "icono91"=>"icono icon-file-word",
                        "icono92"=>"icono icon-file-excel",
                        "icono93"=>"icono icon-file-zip",
                        "icono94"=>"icono icon-file-powerpoint",
                        );
        
        $objComponentes->iconos($datos, $sqlRol);
                
        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"button",//(no necesario) el id que tendra el boton
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "value"=>"Enviar",//(necesario) valor que mostrar el boton
                    "onclick"=>"ValidarDatosSubGrupo('../Controlador/SAD_Agregar_Sub_Grupo_Controlador.php', this);"// (necesario) funcion js que se ejecutara si se hace click en el boton
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
        
    $objComponentes->cerrar_form();

$objComponentes->cerrar_div_bloque_principal();

?>