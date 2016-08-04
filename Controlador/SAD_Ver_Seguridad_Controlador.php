<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'exportar':{
            
            LinesBasicas();
            
            $modelo = new Seguridad();
            
            require_once('../Vista/Excel.php');
                        
        }break;
        
        default:{
            
            vista();
            
        }break;
    
    }
}
else{
    vista();
}

function LinesBasicas(){
    
    require_once("../BaseDatos/AdoDB.php");
    
    require_once('../Vista/VIS_Elementos_Vista.php');
    
    require_once('../Modelo/SAD_Seguridad_Modelo.php');
    
    require_once('../Modelo/SAD_Actividad_Modelo.php');
    require_once('../Modelo/SAD_Usuario_Modelo.php');
    require_once('../Modelo/SAD_Sede_Modelo.php');
    require_once('../Modelo/SAD_Facultad_Modelo.php');
}

function vista(){
    
    LinesBasicas();
    
    global $mensaje;   
    
    /*es la parte pertienen de creacion de un select en la tabala si se necesario para dar mas 
    infomacion al momento de generar algun filtro sobre la tabla actualemtne*/
    $nombreSelect = '';
    $labelSelect = '';
    $pkSelect = '';
    $nombreSelectBD = '';
        
    $estadoSelect = "off";
    $datosSelect = array();
    
    $strNombreHiddenSec = '';
    $strValorHiddenSec = ''; 
    
    $strNombreHiddenTer = '';
    $strValorHiddenTer = ''; 
    
    $encabezadoTabla = array();
    
    $datosFiltroCheck  = array();    
    $datosFiltro = array();
    /*************************************************************************************************/
    
    $datosFiltro = array();
    
    /*se crea el encabezado de la tabla para poder dar mas informacion al usuario de que contiene 
    la tabla o de que operacion esta ejecutando*/

    $encabezadoTabla[] = array(
                            "linea"=>"Son todos aquellos datos que se han guardado como seguridad"
                            );
    /*************************************************************************************************/
    
    /*se llena el elmento con los datos correspondientes de la consulta que se esta efectuando*/
    $modelo = new Seguridad();
    
    $resSql = $modelo->Ver();
    
    /* Se crea el array donde se hara el filtrado apra mostra los nombre correspondientes de la sede y la facultad */
    
    $resSqlOtro = $modelo->Ver_Transaccion();
    
    while(!$resSqlOtro->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_tipo_transaccion",
                            "pk"=>$resSqlOtro->fields['pk_tipo_transaccion'],
                            "nombre"=>$resSqlOtro->fields['nombre']
                            );
        
        $resSqlOtro->MoveNext(); 
    }
    
    /*************************************************************************************/
    
    $strNombreBuscador = 'Seguridad';
    
    $strNombreHidden = 'pk_usuario';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Seguridad",
                        "col2"=>"Usuario",
                        "col3"=>"Fecha",
                        "col4"=>"Observacion",
                        "col5"=>"IP",
                        "col6"=>"MAC",
                        "col7"=>"Tipo de Transaccion"
                        );
                        
    $eleConteTabla = array(
                        "radio"=>"pk_seguridad",
                        "contenido_1"=>"usuario",
                        "contenido_2"=>"fecha",
                        "contenido_3"=>"observacion",
                        "contenido_4"=>"ip",
                        "contenido_5"=>"mac",
                        "filtro_1"=>"fk_tipo_transaccion"                       
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Exportar a Excel';
    
    $strFuncion = "../Vista/Excel.php";
    
    $strTipoColumna = "una-columna"; 
    
    $boton_a_herf = "true";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
    
}
?>
