<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'modificar':{
            
            LinesBasicas();
            
            $modelo = new Grupo_Interes();
            
            $sqlRol = $modelo->Ver_X_Grupo_Interes($_POST);
            
            modificar();            
    
        }break;
        
        case 'guardar':{
            
            LinesBasicas();
            
            $modelo = new Grupo_Interes();
            
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
    
    require_once("../Modelo/CNA_Grupo_Interes_Modelo.php");
    
}

function modificar(){
    
    LinesBasicas();
    
    global $mensaje;
    
    global $sqlRol;
    
    require_once('../Vista/CNA_Modificar_Grupo_Interes_Vista.php');
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
    
    $modelo = new Grupo_Interes();
    
    $resSql = $modelo->Ver();
    
    $strNombreBuscador = 'Modificar Grupo Inter&eacute;s';
    
    $strNombreHidden = 'pk_grupo_interes';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Grupo Inter&eacute;s",
                        "col3"=>"Estado"
                        );
                        
    $eleConteTabla = array(
                        "radio"=>"pk_grupo_interes",
                        "contenido_1"=>"nombre",
                        "estado"=>"estado"
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Modificar';
    
    $strFuncion = "ValidarEstado('../Controlador/CNA_Modificar_Grupo_Interes_Controlador.php', 'modificar');";
    
    $strTipoColumna = "una-columna-centro-medio";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
}
?>
