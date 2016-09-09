      
<?php
    
$objComponentes=new Elementos();
             
    echo '<form name="formulario" id="formulario">';
     
    $datos=array("tipo"=>$strTipoColumna,// (necesario) tama�o del bloque puede ser {una-columna,una-columna-centro,una-columna-centro-medio}
                "titulo"=>$strNombreBuscador, // (no necesario) titulo del bloque
                "alignTitulo"=>"texto-izquierda", //  (necesario si se pone titulo) alienacion del titulo {texto-izquierda,texto-derecha,texto-centro, texto-justificado}
                "alignContenido"=>"texto-centro", //(necesario) alineacion del contenido del div
                "icono"=>"pencil2"); // (necesario si se pone titulo) icono que aparece al lado del titulo
                
    $objComponentes->div_bloque_principal($datos);
        
        ///////////////////////////input hidden//////////////////////////////
        $datos=array(
                    "id"=>$strNombreHidden, //(no necesario) define el id que tendra el campo
                    "name"=>$strNombreHidden,
                    "value"=>$strValorHidden
                    );                        
                    
        $objComponentes->input_hidden($datos);
        
        ///////////////////////////input hidden//////////////////////////////
        $datos=array(
                    "id"=>$strNombreHiddenSec,//(no necesario) define el id que tendra el campo
                    "name"=>$strNombreHiddenSec,
                    "value"=>$strValorHiddenSec
                    );                        
                    
        $objComponentes->input_hidden($datos);
        
        ///////////////////////////input hidden//////////////////////////////
        $datos=array(
                    "id"=>$strNombreHiddenTer,//(no necesario) define el id que tendra el campo
                    "name"=>$strNombreHiddenTer,
                    "value"=>$strValorHiddenTer
                    );                        
                    
        $objComponentes->input_hidden($datos);
        
        ///////////////////////////input button filtro check//////////////////////////////
        if(isset($filtro_check)){
            $datos = array(
                        "id"=>"seleccionar",//(no necesario) el id que tendra el boton
                        "class"=>"grande",//(necesario) tama�o del boton puede ser {grande,mediano,small}
                        "value"=>"Ver solo los chequeados",//(necesario) valor que mostrar el boton
                        "onclick"=>"FiltrarCheck('$url_filtro_check', 'filtrar_check');"// (necesario) funcion js que se ejecutara si se hace click en el boton
                        );
            $objComponentes->button_normal($datos);
        }
        
        ///////////////////////////input button filtro no-check//////////////////////////////
        if(isset($filtro_no_check)){
            $datos = array(
                        "id"=>"seleccionar",//(no necesario) el id que tendra el boton
                        "class"=>"grande",//(necesario) tama�o del boton puede ser {grande,mediano,small}
                        "value"=>"Ver los no chequeados",//(necesario) valor que mostrar el boton
                        "onclick"=>"FiltrarCheck('$url_filtro_check', 'filtrar_no_check');"// (necesario) funcion js que se ejecutara si se hace click en el boton
                        );
            $objComponentes->button_normal($datos);
        }
        
        ///////////////////////////input button filtro todo//////////////////////////////
        if(isset($filtro_todo)){
            $datos = array(
                        "id"=>"seleccionar",//(no necesario) el id que tendra el boton
                        "class"=>"grande",//(necesario) tama�o del boton puede ser {grande,mediano,small}
                        "value"=>"Ver Todos",//(necesario) valor que mostrar el boton
                        "onclick"=>"FiltrarCheck('$url_filtro_check', 'filtrar_todo');"// (necesario) funcion js que se ejecutara si se hace click en el boton
                        );
            $objComponentes->button_normal($datos);
        }
        
        ///////////////////////////input hidden//////////////////////////////
        $datos=array(
                    "id"=>$strNombreHiddenSec,//(no necesario) define el id que tendra el campo
                    "name"=>$strNombreHiddenSec,
                    "value"=>$strValorHiddenSec
                    );                        
                    
        $objComponentes->input_hidden($datos);
        
        //////////////////////////////////////////////////////////////////////
        $datos=array(
                    "id"=>"tabla", //(no necesario) define el id que tendra el campo
                    "name"=>"tabla",
                    "encabezadoTabla"=>$encabezadoTabla,                   
                    "obligatorio"=>$obligatorio_tabla,
                    "filtro_check"=>$datosFiltroCheck,
                    "filtro"=>$datosFiltro,
                    "select"=>$datosSelect,
                    "select_estado"=>$estadoSelect,
                    "select_nombre"=>$nombreSelect,
                    "select_label"=>$labelSelect,
                    "select_pk_bd"=>$pkSelect,
                    "select_nombre_bd"=>$nombreSelectBD           
                    ); 
        
        $objComponentes->Buscador($datos, $eleTituloTabla, $eleConteTabla, $resSql);
        
        ///////////////////////////input hidden//////////////////////////////
        $datos=array(
                    "id"=>"T_Estado", //(no necesario) define el id que tendra el campo
                    "name"=>"T_Estado", // (necesario) define el name que tendra el campo
                    "value"=>"");// (necesario) El atributo value especifica el valor de un elemento                        
                    
        $objComponentes->input_hidden($datos);
        
        /////////////////////////////////input button///////////////////////////////////////////////////        
        
        if(isset($boton_a_herf)){
            $objComponentes->button_a_herf($datos);
        }
        else{
            $datos = array(
                        "id"=>"seleccionar",//(no necesario) el id que tendra el boton
                        "class"=>"grande",//(necesario) tama�o del boton puede ser {grande,mediano,small}
                        "value"=>$strNombreBoton,//(necesario) valor que mostrar el boton
                        "onclick"=>$strFuncion// (necesario) funcion js que se ejecutara si se hace click en el boton
                        );
            $objComponentes->button_normal($datos);
        }
        
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
        
    $objComponentes->cerrar_div_bloque_principal();

$objComponentes->cerrar_form();

?>
