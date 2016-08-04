<?php

session_start();

require_once("../Vista/VIS_Elementos_Vista.php");

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar':{
            
            lineasBasicas();
            
            $modelo = new Tipo_Usuario();
        
            $mensaje = $modelo->Agregar($_POST);
            
            mensaje();
            
            //require_once("../Vista/SAD_Mensaje_Vista.php");            
            
        }break;
        
        default:{            
            vista();            
        }break;
    }
}
else{
    vista();
}

function lineasBasicas(){
    
    require_once("../BaseDatos/AdoDB.php");
    
    require_once("../Modelo/SAD_Tipo_Usuario_Modelo.php");
        
}

function vista(){  
    
    lineasBasicas();
    
    $mensaje = "";
    
    require_once("../Vista/SAD_Agregar_Tipo_Usuario_Vista.php");
}

function mensaje(){
    
    lineasBasicas();
    
    global $mensaje;
    
    require_once("../Vista/SAD_Agregar_Tipo_Usuario_Vista.php");
}

?>