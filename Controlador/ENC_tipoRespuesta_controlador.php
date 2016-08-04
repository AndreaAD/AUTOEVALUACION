<?php
if(isset($_REQUEST["cantidad"])){
    $cantidadRespuestas=$_REQUEST["cantidad"];
    require_once("../Modelo/ENC_tipoRespuesta_modelo.php");
    require_once("../Modelo/ENC_gruposInteres_modelo.php");
    $objTipoRes=new TiposRespuesta();
    $arrayTipoRespuestas=$objTipoRes->getTiposRespuesta($cantidadRespuestas);
    $opcion="cantidad";
    require_once("../Vista/ENC_tipoRespuesta_vista.php");
}else{
    if(isset($_REQUEST["tipo"])){
        $tipoRespuesta=$_REQUEST["tipo"];
        require_once("../Modelo/ENC_tipoRespuesta_modelo.php");
        $objTipoRes=new TiposRespuesta();
        $rsDatosPonderacion=$objTipoRes->getValoresRespuesta($tipoRespuesta);
        $opcion="tipo";
        require_once("../Vista/ENC_tipoRespuesta_vista.php");
    }else{
        if(isset($_REQUEST["ideal"])){
            $tipoRespuesta=$_REQUEST["ideal"];
            require_once("../Modelo/ENC_tipoRespuesta_modelo.php");
            $objTipoRes=new TiposRespuesta();
            $isIdeal=$objTipoRes->verificarIdeal($tipoRespuesta);
            $opcion="ideal";
            require_once("../Vista/ENC_tipoRespuesta_vista.php");
        }
    }
}
?>