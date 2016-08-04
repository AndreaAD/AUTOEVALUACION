<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'modificar':{
            
            LinesBasicas();
            
            $modelo = new Factor();
            
            $sqlRol = $modelo->Ver_X_Factor($_POST);
            
            modificar();            
    
        }break;
        
        case 'guardar':{
            
            LinesBasicas();
            
            $modelo = new Factor();
            
            $mensaje = $modelo->Modificar($_POST);            
            
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
    
    require_once("../Modelo/CNA_Factor_Modelo.php");
    
}

function modificar(){
    
    LinesBasicas();
    
    $mensaje = "";
    
    global $sqlRol;
    
    require_once('../Vista/CNA_Modificar_Factor_Vista.php');
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
    
    $modelo = new Factor();
    
    $resSql = $modelo->Ver();
    
    $strNombreBuscador = 'Modificar Factor';
    
    $strNombreHidden = 'pk_factor';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Codigo",
                        "col3"=>"Factor",
                        "col4"=>"Estado"
                        );
                        
    $eleConteTabla = array(
                        "radio"=>"pk_factor",
                        "contenido_1"=>"codigo",
                        "contenido_2"=>"nombre",
                        "estado"=>"estado"
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Modificar';
    
    $strFuncion = "ValidarEstado('../Controlador/CNA_Modificar_Factor_Controlador.php', 'modificar');";
    
    $strTipoColumna = "una-columna";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
}
?>
