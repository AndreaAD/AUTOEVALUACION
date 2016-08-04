<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar':{
            
            lineasBasicas();
            
            $modelo = new Grupo_Modulos();
        
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
    
    require_once("../Modelo/SAD_Grupo_Modulos_Modelo.php");
    require_once("../Modelo/SAD_Modulo_Modelo.php");
        
}

function vista(){  
    
    lineasBasicas();
    
    global $mensaje;

    $claMod = new Modulo();
    $resSqlRol = $claMod->Ver();
    
    require_once("../Vista/SAD_Agregar_Grupo_Vista.php");
}

?>