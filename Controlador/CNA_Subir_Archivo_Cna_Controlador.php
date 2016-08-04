<?php

session_start();

if($_FILES != null){
    
    require_once("../BaseDatos/AdoDB.php");
            
    require_once("../Modelo/CNA_Factor_Modelo.php");
    
    $modelo = new Factor();
    
    $mensaje = $modelo->Agregar_Archivo($_FILES);
    
    vista(); 
    
}
else{ 
    vista();
}

function vista(){  
    
    global $mensaje;
    
    require_once("../Vista/VIS_Elementos_Vista.php");
    
    require_once("../BaseDatos/AdoDB.php");
    
    require_once("../Vista/CNA_Subir_Archivo_Cna_Vista.php");
}

?>