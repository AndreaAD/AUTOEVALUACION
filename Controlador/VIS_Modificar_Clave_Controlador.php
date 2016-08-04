<?php

session_start();

require_once("../Vista/VIS_Elementos_Vista.php");

if(isset($_REQUEST['T_Estado'])){
    switch($_REQUEST['T_Estado']){
    
        case 'guardar':{
            
            require_once("../BaseDatos/AdoDB.php");
    
            require_once('../Modelo/SAD_Loggin_Modelo.php');
            
            $modelo = new Loggin();
    
            $modelo->ModificarClave($_POST);
            
        }break;
        
        default:{            
            vista();            
        }break;
    }
}
else{
    vista();
}

function vista(){    
    require_once("../Vista/VIS_Modificar_Clave_Vista.php");
}

?>