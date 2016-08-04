<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'modificar':{
            
            LinesBasicas();
            
            $modelo = new Grupo_Modulos();
            
            $sqlRol = $modelo->Ver_X_Grupo($_POST);
            
            modificar();            
    
        }break;
        
        case 'guardar':{
            
            LinesBasicas();
            
            $modelo = new Grupo_Modulos();
            
            $mensaje = $modelo->Modificar($_POST);            
            
            vista();
                        
        }break;
        
        case 'filtrar':{
            
            filtrar();            
                 
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
    
    require_once("../Modelo/SAD_Actividad_Modelo.php");
    require_once("../Modelo/SAD_Grupo_Modulos_Modelo.php");
    require_once("../Modelo/SAD_Sub_Grupo_Modelo.php");
    require_once("../Modelo/SAD_Modulo_Modelo.php");
    
}

function modificar(){
    
    LinesBasicas();
    
    global $sqlRol;
    global $sqlSubGrupo;
    
    $mensaje = "";
    
    $claMod = new Modulo();
    $resSqlRol = $claMod->Ver();
    
    require_once('../Vista/SAD_Modificar_Grupo_Vista.php');
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
    
    $strNombreBuscador = 'Modificar Grupo';
    
    $strNombreHidden = 'pk_actividad';
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
            
    $strNombreBoton = 'Modificar.';
    
    $strFuncion = "ValidarEstado('../Controlador/SAD_Modificar_Grupo_Controlador.php', 'modificar');";
    
    $strTipoColumna = "una-columna-centro-medio";
    
    require_once('../Vista/SAD_Buscador_Vista.php');
}
?>