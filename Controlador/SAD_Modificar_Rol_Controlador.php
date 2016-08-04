<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'modificar':{
            
            LinesBasicas();
            
            $modelo = new Rol();
            
            $sqlRol = $modelo->Ver_X_Rol($_POST);
            
            modificar();            
    
        }break;
        
        case 'guardar':{
            
            LinesBasicas();
            
            $modelo = new Rol();
            
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
    
    require_once("../Modelo/SAD_Rol_Modelo.php");
    
}

function modificar(){
    
    LinesBasicas();
    
    $mensaje = "";
    
    global $sqlRol;
    
    require_once('../Vista/SAD_Modificar_Rol_Vista.php');
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
    /*************************************************************************************************/
    
    $datosFiltro = array();
    
    $modelo = new Rol();
    
    $resSql = $modelo->Ver();
    
    $strNombreBuscador = 'Modificar Rol';
    
    $strNombreHidden = 'pk_rol';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Nombre",
                        "col3"=>"Estado"
                        );
                        
    $eleConteTabla = array(
                        "radio"=>"pk_rol",
                        "contenido_1"=>"nombre",
                        "estado"=>"estado"
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Modificar';
    
    $strFuncion = "ValidarEstado('../Controlador/SAD_Modificar_Rol_Controlador.php', 'modificar');";
    
    $strTipoColumna = "una-columna-centro-medio";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
}
?>
