<?php

session_start();

if($_FILES != null){
    
    require_once("../BaseDatos/AdoDB.php");
            
    require_once("../Modelo/CNA_Grupo_Interes_Modelo.php");
    
    $modelo = new Grupo_Interes();
    
    $mensaje =  $modelo->AgregarArchivo($_FILES);   
    
    vista(); 
    
}
else{ 
    vista();
}

function vista(){  
    
    global $mensaje;
    
    require_once("../Vista/VIS_Elementos_Vista.php");
    
    require_once("../BaseDatos/AdoDB.php");
    
    require_once("../Vista/CNA_Subir_Archivo_Evidencia_Grupo_Interes_Vista.php");
}

?>