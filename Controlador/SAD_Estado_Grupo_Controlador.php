<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'cambiar_estado':{
            
            LinesBasicas();
            
            $modelo = new Grupo_Modulos();
            
            $mensaje = $modelo->CambiarEstado($_POST);            
            
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
    
    require_once('../Modelo/SAD_Grupo_Modulos_Modelo.php');
    
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
    
    $modelo = new Grupo_Modulos();
    
    $resSql = $modelo->Ver();
    
    $strNombreBuscador = 'Cambiar Estado Grupo';
    
    $strNombreHidden = 'pk_grupo';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Nombre",
                        "col3"=>"Estado"
                        );
                        
    $eleConteTabla = array(
                        "radio"=>"pk_grupos_actividades",
                        "contenido_1"=>"nombre",
                        "estado"=>"estado"
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Cambiar Estado';
    
    $strFuncion = "ValidarEstado('../Controlador/SAD_Estado_Grupo_Controlador.php', 'cambiar_estado');";
    
    $strTipoColumna = "una-columna-centro-medio";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
}
?>
