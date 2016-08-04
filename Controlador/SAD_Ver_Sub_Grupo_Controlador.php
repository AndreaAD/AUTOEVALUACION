<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'ver':{
            
            LinesBasicas();
            
            $modelo = new Sub_Grupo();
            
            $sqlRol = $modelo->Ver_X_Sub_Grupo($_POST);
            
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
    
    require_once('../Modelo/SAD_Sub_Grupo_Modelo.php');
    require_once("../Modelo/SAD_Grupo_Modulos_Modelo.php");
    require_once("../Modelo/SAD_Modulo_Modelo.php");
    
}

function ver(){
    
    LinesBasicas();
    
    $datosSelect = "off";
    
    $mensaje = "";
    
    global $sqlRol;
    
    $claMod = new Modulo();
    $resModulo = $claMod->Ver();
    
    $claMod = new Grupo_Modulos();
    $sqlGrupo = $claMod->Ver();
    
    require_once('../Vista/SAD_Ver_Sub_Grupo_Vista.php');
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
    
    $modelo = new Sub_Grupo();
    
    $resSql = $modelo->Ver();
    
    $strNombreBuscador = 'Ver Sub Grupo';
    
    $strNombreHidden = 'pk_sub_grupo';
    $strValorHidden = '0';
    
    $eleTituloTabla = array(
                        "col1"=>"Selec.",
                        "col2"=>"Nombre",
                        "col3"=>"Estado"
                        );
                        
    $eleConteTabla = array(
                        "radio"=>"pk_sub_grupo_actividades",
                        "contenido_1"=>"nombre",
                        "estado"=>"estado"
                        );
    
    $obligatorio_tabla = "obligatorio";
            
    $strNombreBoton = 'Ver';
    
    $strFuncion = "ValidarEstado('../Controlador/SAD_Ver_Sub_Grupo_Controlador.php', 'ver');";
    
    $strTipoColumna = "una-columna-centro-medio";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
}
?>
