<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'ver':{
            
            LinesBasicas();
            
            $modelo = new Caracteristica();
            
            $sqlRol = $modelo->Ver_X_Caracteristica($_POST);
            
            ver();            
    
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
    
    require_once("../Modelo/CNA_Caracteristica_Modelo.php");
    require_once("../Modelo/CNA_Factor_Modelo.php");
    
}

function ver(){
    
    LinesBasicas();
    
    global $mensaje;
    
    global $sqlRol;
    
    require_once('../Vista/CNA_Ver_Caracteristica_Vista.php');
}

function vista(){
    
    LinesBasicas();
    
    global $mensaje;
    
    $datosSelect = "off";
    
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
    
    $resSql = $modelo->Ver();
    
    $strNombreBuscador = 'Ver Caracter&iacute;stica';
    
    $strNombreHidden = 'pk_caracteristica';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Codigo",
                        "col3"=>"Caracter&iacute;stica",
                        "col4"=>"Estado",
                        "col5"=>"Factor"
                        );
                        
    $eleConteTabla = array(
                        "radio"=>"pk_caracteristica",
                        "contenido_1"=>"codigo",
                        "contenido_2"=>"nombre",
                        "estado"=>"estado",
                        "filtro_3_texto_flotante"=>"fk_factor"
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Ver';
    
    $strFuncion = "ValidarEstado('../Controlador/CNA_Ver_Caracteristica_Controlador.php', 'ver');";
    
    $strTipoColumna = "una-columna";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
}
?>
