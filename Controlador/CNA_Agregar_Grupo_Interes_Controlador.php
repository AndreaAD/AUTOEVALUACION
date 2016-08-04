<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar':{
            
            lineasBasicas();
            
            $modelo = new Grupo_Interes();
        
            $mensaje = $modelo->Agregar($_POST);
            
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

function lineasBasicas(){
    
    require_once("../Vista/VIS_Elementos_Vista.php");

    require_once("../BaseDatos/AdoDB.php");
    
    require_once("../Modelo/CNA_Grupo_Interes_Modelo.php");
        
}

function vista(){  
    
    lineasBasicas();
    
    global $mensaje;
    
    require_once("../Vista/CNA_Agregar_Grupo_Interes_Vista.php");
}

?>