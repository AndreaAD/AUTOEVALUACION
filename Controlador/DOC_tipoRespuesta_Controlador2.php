<?php

/**
 * En este momento enviamos datos s el modelo DOC_tipoRespuesta_modelo.php que es donde se procesa las opciones y ponderacion que tiene cada tipo de respuesta 
 */
if(isset($_REQUEST["cantidad"])){
    $cantidadRespuestas=$_REQUEST["cantidad"];
    require_once("../Modelo/DOC_tipoRespuesta_modelo.php");
    /*require_once("../Modelo/DOC_gruposInteres_modelo.php");*/
    $objTipoRes=new TiposRespuesta();
    $arrayTipoRespuestas=$objTipoRes->getTiposRespuesta($cantidadRespuestas);
    $opcion="cantidad";
    require_once("../Vista/DOC_tipoRespuesta_vista.php");
}else{
    if(isset($_REQUEST["tipo"])){
        $tipoRespuesta=$_REQUEST["tipo"];
        require_once("../Modelo/DOC_tipoRespuesta_modelo.php");
        $objTipoRes=new TiposRespuesta();
        $rsDatosPonderacion=$objTipoRes->getValoresRespuesta($tipoRespuesta);
        $opcion="tipo";
        require_once("../Vista/DOC_tipoRespuesta_vista.php");
    }
}
?>