<?php

session_start();

$opcion=$_REQUEST["opcion"];
if($opcion=="pagina"){
    require_once("../modelo/ENC_evidencias_modelo.php");
    $objEvidencias=new Evidencias();
    if(isset($_SESSION["enc_idaspecto"])){
        $rsDatos=$objEvidencias->getEvidencias($_SESSION["enc_idaspecto"]);
    }else{
        $rsDatos=null;
    }
    require_once("../vista/ENC_listaEvidencias_vista.php");
}else{
    if($opcion=="guardarId"){
        $_SESSION["enc_idevidencia"]=$_REQUEST["id"];
        //$_SESSION["enc_idfactor"]=null;
        //$_SESSION["enc_idcaracteristica"]=null;
        //$_SESSION["enc_idaspecto"]=null;
        //$_SESSION["enc_idevidencia"]=null;
    }
}
?>