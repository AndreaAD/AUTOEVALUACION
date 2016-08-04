<?php
if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'inhabilitar':{
            
            LinesBasicas();
            
            $modelo = new Modulo();
            
            $modelo->Inhabilitar($_POST);            
            
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
    
    require_once('../Modelo/SAD_Modulo_Modelo.php');
    
}

function vista(){
    
    LinesBasicas();
    
    $modelo = new Modulo();
    
    $resSql = $modelo->Ver();
    
    $strFuncion = "InhabilitarDatos('../Controlador/SAD_Inhabilitar_Modulo_Controlador.php');";
    
    $intValorRadio = "pk_modulo";
    $intElementoCol1 = "nombre";
    $intElementoCol2 = "estado";
    
    $strNombreCol1 = "opcion";
    $strNombreCol2 = "nombre";
    $strNombreCol3 = "estado";
    
    $strNombreBoton = 'Inhabilitar';
    $strNombreBuscador = 'Inhabilitar Modulo';
    
    $strChecked = "on";
    $strCheckedCampo = "nombre";
    $strCheckedValor = "sin modulo";
    $strCheckedElemento = " == ";
    
    require_once('../Vista/SAD_Buscar_Vista.php');
}

