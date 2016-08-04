<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar_actividad':{
            
            LinesBasicas();
            
            $modelo = new Caracteristica();
            
            $mensaje = $modelo->Agregar_Ambito_X_Caracteristica($_POST);            
            
            vista();
                        
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
    
    require_once("../Modelo/CNA_Grupo_Interes_Modelo.php");
    require_once("../Modelo/CNA_Aspecto_Modelo.php");    
    
    require_once("../Modelo/CNA_Evidencia_Modelo.php");
    require_once("../Modelo/CNA_Aspecto_Modelo.php");
    require_once("../Modelo/CNA_Caracteristica_Modelo.php");
    require_once("../Modelo/CNA_Factor_Modelo.php");
    
    require_once("../Modelo/SAD_Modulo_Modelo.php");
    
}

function vista(){
    
    LinesBasicas();
    
    global $mensaje;
    
    /*es la aprte pertienen de creacionde un select en la tabala si se es necesario para dar mas 
    infomacion al momento de genrar algun filtro sobre la tabla actualemtne*/
    $nombreSelect = 'pk_ambito';
    $labelSelect = 'Ambito : ';
    $pkSelect = 'pk_ambito';
    $nombreSelectBD = 'nombre';
        
    $estadoSelect = "on";
    $datosSelect = array();    
    $datosFiltroCheck  = array();
        
    $strNombreHiddenSec = '';
    $strValorHiddenSec = ''; 
    
    $strNombreHiddenTer = '';
    $strValorHiddenTer = ''; 
    
    $encabezadoTabla = array();    
    /*************************************************************************************************/
    
    $datosFiltro = array();
    
    /*se crea el encabezado de la tabla para poder dar mas informacion al usuario de que contiene 
    la tabla o de que operacion esta ejecutando*/

    $encabezadoTabla[] = array(
                            "linea"=>"Seleccionar el ambito que desea agregarle a las caracter&iacute;sticas que seleccione"
                            );
    /*************************************************************************************************/
    
    /*se llena el elmento con los datos correspondientes de la consulta que se esta efectuando*/
    $modelo = new Caracteristica();
    
    $datosSelect = $modelo->Ver_Ambito();
    
    /*************************************************************************************************/
    
    /* Se crea el array donde se hara el filtrado apra mostra los nombre correspondientes del factor,
    caractersitica, aspecto. Estos datos seran de ayuda al usuario para entender un poco mejor lo que
    esta viendo actualmente */
    
    $modelo = new Caracteristica();
    
    $resSql = $modelo->Ver_Ambito();
    
    while(!$resSql->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_ambito",
                            "pk"=>$resSql->fields['pk_ambito'],
                            "nombre"=>$resSql->fields['nombre']
                            );
        
        $resSql->MoveNext(); 
    }
    /*************************************************************************************************/
    /* Se crea el array donde se hara el filtrado apra mostra los nombre correspondientes del factor */    
    $modelo = new Factor();
    
    $resSql = $modelo->Ver();
    
    while(!$resSql->EOF){
        
        $datosFiltro[] = array(
                            "identificador"=>"fk_factor",
                            "pk"=>$resSql->fields['pk_factor'],
                            "nombre"=>$resSql->fields['codigo'],
                            "texto_flotante"=>$resSql->fields['nombre']
                            );
        
        $resSql->MoveNext(); 
    }    
    /*************************************************************************************/
       
    $modelo = new Caracteristica();
    
    $resSql = $modelo->Ver_X_Estado();
    
    $strNombreBuscador = 'Agregar Ambito a la Caracter&iacute;stica';
    
    $strNombreHidden = 'pk_caractersitica';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Codigo",
                        "col3"=>"Caracter&iacute;stica",
                        "col4"=>"Estado",
                        "col5"=>"Factor",
                        "col6"=>"Ambito de Responsabilitad"
                        );
                        
    $eleConteTabla = array(
                        "check"=>"pk_caracteristica",
                        "contenido_1"=>"codigo",
                        "contenido_2"=>"nombre",
                        "estado"=>"estado",
                        "filtro_1_texto_flotante"=>"fk_factor",
                        "filtro_1"=>"fk_ambito"
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Agregar Ambito';
    
    $strFuncion = "ValidarEstado('../Controlador/CNA_Agregar_Ambito_Caractersitica_Controlador.php', 'guardar_actividad');";
    
    $strTipoColumna = "una-columna";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
}
?>
