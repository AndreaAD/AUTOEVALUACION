<link href="../Css/demo_table.css" rel="stylesheet" type="text/css"/> 

<script type="text/javascript" src="../Js/jquery.js"></script>
<script type="text/javascript" src="../Js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../Js/SAD_Table.js"></script>
<script type="text/javascript" src="../Js/SAD_Table_2.js"></script>
    
<?php
            
$objComponentes=new Elementos();
             
    $datos=array("id"=>"formulario");// (no-necesario) id del formulario
    
    $objComponentes->form($datos);
     
    $datos=array("tipo"=>"una-columna-centro-medio",// (necesario) tamaño del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
                "titulo"=>$strNombreBuscador, // (no necesario) titulo del bloque
                "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
                "alignContenido"=>"texto-centro", //(necesario) alineacion del contenido del div
                "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
                
    $objComponentes->div_bloque_principal($datos);
        
        ///////////////////////////input hidden//////////////////////////////
        $datos=array(
                    "id"=>"pk_usuario", //(no necesario) define el id que tendra el campo
                    "name"=>"pk_usuario", // (necesario) define el name que tendra el campo
                    "value"=>$pk_cabeza);// (necesario) El atributo value especifica el valor de un elemento                        
                    
        $objComponentes->input_hidden($datos);
        
        //////////////////////////tabla /////////////////////////////////////
        $datos=array(
                    "id"=>"tabla_datos", //(no necesario) define el id que tendra el campo
                    "name"=>"tabla_datos",
                    "type"=>$strType,
                    "valor_radio"=>$intValorRadio,
                    "Name_radio"=>$strNameRadio,
                    "valor_col1"=>$intElementoCol1,
                    "valor_col2"=>$intElementoCol2,
                    "Checked" => $strChecked,
                    "CheckedCampo" => $strCheckedCampo,
                    "CheckedValor" => $strCheckedValor,
                    "CheckedElemento" => $strCheckedElemento,
                    "nombreCol1" => $strNombreCol1,
                    "nombreCol2" => $strNombreCol2,
                    "nombreCol3" => $strNombreCol3,
                    "Linea1" => $strLinea1,
                    "Linea2" => $strLinea2,
                    "Linea3" => $strLinea3,
                    "obligatorio" => $obligatorio
                    ); // (necesario) define el name que tendra el campo
                    
        $objComponentes->table_filtro($datos, $resSql, $resFiltro);
        
/////****************************************************************************************************///////////
     
        ///////////////////////////input hidden//////////////////////////////
        $datos=array(
                    "id"=>"T_Estado", //(no necesario) define el id que tendra el campo
                    "name"=>"T_Estado", // (necesario) define el name que tendra el campo
                    "value"=>"");// (necesario) El atributo value especifica el valor de un elemento                        
                    
        $objComponentes->input_hidden($datos);
        
        /////////////////////////////////input button///////////////////////////////////////////////////        
        $datos = array(
                    "id"=>"seleccionar",//(no necesario) el id que tendra el boton
                    "class"=>"grande",//(necesario) tamaño del boton puede ser {grande,mediano,small}
                    "value"=>$strNombreBoton,//(necesario) valor que mostrar el boton
                    "onclick"=>$strFuncion// (necesario) funcion js que se ejecutara si se hace click en el boton
                    );
        $objComponentes->button_normal($datos);
        
    $objComponentes->cerrar_div_bloque_principal();

$objComponentes->cerrar_form();

?>