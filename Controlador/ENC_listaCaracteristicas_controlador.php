<?php session_start();
$opcion=$_REQUEST["opcion"];
if($opcion=="pagina"){
    require_once("../Modelo/ENC_caracteristicas_modelo.php");
    $objCaracteristica=new Caracteristicas();
    if(isset($_SESSION["enc_idfactor"])){
        $rsDatos=$objCaracteristica->getCaracteristicas($_SESSION["enc_idfactor"]);
    }else{
        $rsDatos=null;
    }
    require_once("../Vista/ENC_listaCaracteristicas_vista.php");
}else{
    if($opcion=="guardarId"){
        $_SESSION["enc_idcaracteristica"]=$_REQUEST["id"];
        //$_SESSION["enc_idfactor"]=null;
        //$_SESSION["enc_idcaracteristica"]=null;
        $_SESSION["enc_idaspecto"]=null;
        $_SESSION["enc_idevidencia"]=null;
    }
}?>