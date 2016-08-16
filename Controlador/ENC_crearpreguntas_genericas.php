<?php

session_start();
// verificamos que exista la variable de sesion con la evidencia y el proceso 
// si no existen se devueleve a seleccion de evidencia

if(isset($_SESSION["pk_proceso"])){
    // Extraer el pk de proceso y la evidencia que se selecciono de las variables de sesion
    $idProceso=$_SESSION["pk_proceso"];
     
    // verificamos que el id del proceso y la evidencia no sea nulo
    if($idProceso!=null){
        // incluimos los modelos
       
        require_once("../Modelo/ENC_preguntas_modelo.php");

        require_once("../Modelo/ENC_tipoRespuesta_modelo.php");
        require_once("../Modelo/ENC_respuestas_modelo.php");
       
        require_once("../Modelo/ENC_caracteristicas_modelo.php");
        
        require_once("../Modelo/ENC_gruposInteres_modelo.php");
  
        $objTipoRes=new TiposRespuesta();        
        $rsCantidadRes=$objTipoRes->getCantidadRespuestas();
        
        $objRespuestas=new Respuestas(); 
        
        $objCaracteristica=new Caracteristicas();        
        $listado_caracteristicas = $objCaracteristica->getCaracteristicasAll();
        
       $objGruposInteres=new GruposInteres();
       $rsDatosGrupos=$objGruposInteres->getGruposEncuestasNormales();

        $faseProceso=$_SESSION['pk_fase'];
        require_once("../Vista/ENC_crearpreguntas_genericas_vista.php");
    }else{
        ?><script type="text/javascript"> window.location = '../Controlador/VIS_Index_Controlador.php'; </script><?php
    } 
}else{
    ?><script type="text/javascript"> window.location = '../Controlador/VIS_Index_Controlador.php'; </script><?php
}
?>