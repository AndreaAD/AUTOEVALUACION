<?php
    require_once("../Modelo/DOC_preguntas_modelo.php");
    require_once("../Modelo/DOC_tipoRespuesta_modelo.php");
    require_once("../Modelo/DOC_respuestas_modelo.php");
    $objPreguntas=new Preguntas();
    $objTipoRes=new TiposRespuesta();
    $rsCantidadRes=$objTipoRes->getCantidadRespuestas();
    $objRespuestas=new Respuestas();
    require_once("../Vista/DOC_crearPreguntas2_vista.php");
  
?>