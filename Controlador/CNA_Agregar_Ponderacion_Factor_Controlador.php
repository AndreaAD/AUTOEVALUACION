<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar':{
            
            LinesBasicas();
            
            $modelo = new Factor();
            
            $mensaje = $modelo->Agregar_Ponderacion($_POST);            
            
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

function vista(){
    
    LinesBasicas();
    
    $datosFiltro = array();
    
    global $mensaje;
    
    $modelo = new Factor();
    
    $resSql = $modelo->Ver_Habilitados();
    
    $strNombreBuscador = 'Agregar Ponderaci&oacute;n Factor';
    
    $strNombreHidden = 'pk_factor';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "clo1"=>"factor",
                        "col2"=>"nombre",
                        "col3"=>"estado",
                        "col4"=>"Ponderacion"
                        );
                        
    $eleConteTabla = array(
                        "check"=>"pk_factor",
                        "letras"=>"nombre",
                        "estado"=>"estado",
                        "ponderacion"=>"pk_factor"
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Agregar Ponderaci&oacute;n Factor';
    
    $strFuncion = "ValidarPonderacion('../Controlador/CNA_Agregar_Ponderacion_Factor_Controlador.php', 'guardar');";
    
    $strTipoColumna = "una-columna";
    
    require_once('../Vista/CNA_Ponderacion_Vista.php');
}
?>
