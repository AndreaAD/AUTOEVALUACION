<?php

session_start();

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar':{
            
            lineasBasicas();
            
            $modelo = new Programa();
        
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
    
    require_once("../Modelo/SAD_Sede_Modelo.php");
    require_once("../Modelo/SAD_Facultad_Modelo.php");
    require_once("../Modelo/SAD_Programa_Modelo.php");
        
}

function vista(){  
    
    lineasBasicas();
    
    global $mensaje;
    
    $modelo = new Sede();

    $resSqlSede = $modelo->Ver($_POST);

    $modelo = new Facultad();

    $resSqlFacultad = $modelo->Ver($_POST);

    require_once("../Vista/SAD_Agregar_Programa_Vista.php");
}

?>