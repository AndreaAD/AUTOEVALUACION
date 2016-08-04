<?php

session_start();

if($_FILES != null){
    
    require_once("../BaseDatos/AdoDB.php");
            
    require_once("../Modelo/SAD_Modulo_Modelo.php");
    
    $modelo = new Modulo();
    
    $modelo->AgregarArchivo($_FILES);   
    
    $mensaje =  "Archivo subido correctamente : ".$_FILES['archivo0']['name'];
    
    vista(); 
    
}
else{ 
    vista();
}

function vista(){  
    
    global $mensaje;
    
    require_once("../Vista/VIS_Elementos_Vista.php");
    
    require_once("../BaseDatos/AdoDB.php");
    
    require_once("../Vista/SAD_Subir_Archivo_Modulo_Vista.php");
}

?>