<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar':{
            
            lineasBasicas();
            
            $modelo = new Caracteristica();
        
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
    
    require_once("../Modelo/CNA_Caracteristica_Modelo.php");
    require_once("../Modelo/CNA_Factor_Modelo.php");
        
}

function vista(){  
    
    lineasBasicas();
    
    global $mensaje;

    $_SESSION["cna_idaspecto"] = null;
    $_SESSION["cna_idcaracteristica"] = null;
    $_SESSION["cna_idfactor"] = null;
    
    $claMod = new Factor();
    $resSql = $claMod->Ver();
                 
    require_once("../Vista/CNA_Agregar_Caracteristica_Vista.php");
}

?>