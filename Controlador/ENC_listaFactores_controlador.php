<?php session_start();
$opcion=$_REQUEST["opcion"];
if($opcion=="pagina"){
    require_once("../Modelo/ENC_factores_modelo.php");
    $objFactores=new Factores();
    $rsDatos=$objFactores->getAllFactores();
    require_once("../Vista/ENC_listaFactores_vista.php");
}else{
    if($opcion=="guardarId"){
        $_SESSION["enc_idfactor"]=$_REQUEST["id"];
        //$_SESSION["enc_idfactor"]=null;
        $_SESSION["enc_idcaracteristica"]=null;
        $_SESSION["enc_idaspecto"]=null;
        $_SESSION["enc_idevidencia"]=null;
    }
}?>